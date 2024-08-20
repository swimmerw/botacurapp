@extends('themes.backoffice.layouts.admin')

@section('title', $cliente->nombre_cliente)

@section('head')
@endsection

@section('breadcrumbs')
<li><a href="{{route('backoffice.cliente.index')}}">Clientes del Sistema</a></li>
<li>{{$cliente->nombre_cliente}}</li>
@endsection

@section('dropdown_settings')
{{-- <li><a href="{{route('backoffice.cliente.edit',$cliente)}}" class="grey-text text-darken-2">Editar Cliente</a></li>
--}}
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



                        <span class="card-title activator grey-text text-darken-4">{{$cliente->nombre_cliente}}</span>
                        <p>
                            <i class="material-icons">perm_phone_msg</i> {{$cliente->whatsapp_cliente}}
                        </p>
                        <p>
                            <i class="material-icons">perm_identity</i> {{$cliente->instagram_cliente}}
                        </p>
                        <p>
                            <i class="material-icons">email</i> {{$cliente->correo}}
                        </p>




                    </div>
                    <div class="card-action">
                        <a href="{{route('backoffice.cliente.edit', $cliente) }}">Editar</a>
                        {{-- <a href="#" style="color: red" onclick="enviar_formulario()">Eliminar</a> --}}
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
         title: "¿Deseas eliminar este cliente?",
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