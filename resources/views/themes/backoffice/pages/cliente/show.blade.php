@extends('themes.backoffice.layouts.admin')

@section('title', $cliente->name)

@section('head')
@endsection

@section('breadcrumbs')
<li><a href="{{route('backoffice.cliente.index')}}">Clientes del Sistema</a></li>
<li>{{$cliente->nombre_cliente}}</li>
@endsection

@section('dropdown_settings')
<li><a href="{{route('backoffice.cliente.edit',$cliente)}}" class="grey-text text-darken-2">Editar Cliente</a></li>
@endsection

@section('content')
<div class="section">
    <p class="caption"><strong>Cliente:</strong> {{$cliente->nombre_cliente}}</p>
    <div class="divider"></div>
        <div id="basic-form" class="section">
            <div class="row">
                <div class="col s12 m8">
                    <div class="card">
                            <div class="card-content">
                                <span class="card-title">{{$cliente->nombre_cliente}}</span>
                                <p><strong>Contactos: </strong>{{$cliente->whatsapp_cliente()}}
                                {{$cliente->instagram_cliente()}}
                                {{$cliente->correo()}}
                                
                                </p>
                                <h4>Reservas: </h4>
                                <ul>
                                    @if($cliente->reservas->isEmpty())
                                        <p>Este cliente no tiene reservas.</p>
                                        <a href="{{ route('backoffice.reserva.create', ['cliente_id' => $cliente->id]) }}" class="btn btn-primary">Crear Reserva</a>
                                    @else
                                        @foreach($cliente->reservas as $reserva)
                                            <li>{{ $reserva->fecha_visita }}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                                <div class="card-action">
                                    <a href="{{route('backoffice.cliente.edit', $cliente) }}">Editar</a>
                                    <a href="#" style="color: red" onclick="enviar_formulario()">Eliminar</a>
                                </div>
                    </div>
                </div>

            
                        <div class="col s12 m4">
                        @include('themes.backoffice.pages.cliente.includes.cliente_nav')
                        </div>

        </div>
        </div>
    </div>
</div>

<form method="post" action="{{route('backoffice.cliente.destroy', $cliente) }} " name="delete_form">
{{csrf_field()}}
{{method_field('DELETE')}}
</form>
@endsection

@section('foot')
<script>
 function enviar_formulario()
 {
     Swal.fire({
         title: "¿Deseas eliminar este usuario?",
         text: "Esta acción no se puede deshacer",
         type: "warning",
         showCancelButton: true,
         confirmButtonText: "Si, continuar",
         cancelButtonText: "No, cancelar",
         closeOnCancel: false,
         closeOnConfirm: true
     }).then((result)=> {
         if(result.value){
             document.delete_form.submit();
         }else{
             Swal.fire(
                 'Operación Cancelada',
                 'Registro no eliminado',
                 'error'
             )
         }
     });
 }
</script>
@endsection