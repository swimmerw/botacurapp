@extends('themes.backoffice.layouts.admin')

@section('title', 'Reserva de '.$reserva->cliente->nombre_cliente)

@section('head')
@endsection

@section('breadcrumbs')
<li><a href="{{route('backoffice.reserva.index')}}">Reservas</a></li>
<li>{{$reserva->cliente->nombre_cliente}}</li>
@endsection

@section('dropdown_settings')
<li><a href="{{ route('backoffice.reserva.visitas.create',$reserva) }}" class="grey-text text-darken-2">Generar Visita</a></li>
@endsection

@section('content')
<div class="section">
    <p class="caption"><strong>Fecha de reserva:</strong> {{ $reserva->fecha_visita }}</p>
    <div class="divider"></div>
    <div id="basic-form" class="section">
        <div class="row">
            <div class="col s12 m8">
                {{-- TABLA CLIENTE --}}
                <div class="card">
                    <div class="card-content">
                        <span
                            class="card-title activator grey-text text-darken-4">{{$reserva->cliente->nombre_cliente}}</span>
                        <div class="row">
                            <div class="col s12 m6 l4">
                                <p>
                                    @if (is_null($reserva->cliente->whatsapp_cliente))
                                    <i class="material-icons">perm_phone_msg</i> No Registra
                                    @else
                                    <i class="material-icons">perm_phone_msg</i> <a
                                        href="https://api.whatsapp.com/send?phone={{$reserva->cliente->whatsapp_cliente}}"
                                        target="_blank">+{{$reserva->cliente->whatsapp_cliente}}</a>
                                    @endif

                                </p>
                            </div>
                            <div class="col s12 m6 l4">

                                <p>

                                    @if (is_null($reserva->cliente->instagram_cliente))
                                    <i class="material-icons">perm_identity</i> No Registra
                                    @else
                                    <i class="material-icons">perm_identity</i> <a
                                        href="https://www.instagram.com/{{$reserva->cliente->instagram_cliente}}"
                                        target="_blank">{{$reserva->cliente->instagram_cliente}}</a>
                                    @endif


                                </p>
                            </div>

                            <div class="col s12 m6 l4">
                                <p>

                                    @if (is_null($reserva->cliente->correo))
                                    <i class="material-icons">email</i> No Registra
                                    @else
                                    <i class="material-icons">email</i> <a href="mailto:{{$reserva->cliente->correo}}"
                                        target="_blank">{{$reserva->cliente->correo}}</a>
                                    @endif


                                </p>
                            </div>

                        </div>



                        <div class="card-action">
                            <a href="{{route('backoffice.cliente.edit', $reserva->cliente_id)}}"
                                class="purple-text">Editar</a>
                            {{-- <a href="#" style="color: red" onclick="enviar_formulario()">Eliminar</a> --}}
                        </div>
                    </div>
                </div>


                {{-- TABLA VISITA --}}

                <div class="card">
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Visita</span>


                        @if ($reserva->visitas->isEmpty())
                        
                        <h5>Aún no se registra la visita para esta reserva</h5>
                        @else
                        @foreach ($reserva->visitas as $visita)
                        <div class="row">
                            <div class="col s12 m6 l4">
                                <p>
                                    <i class="material-icons">perm_phone_msg</i> 
                                    
                                        {{$reserva->cliente->whatsapp_cliente}}
                                    
                                </p>
                                <p>Horario de Sauna: {{ $visita->horario_sauna }}</p>
                                <!-- Agrega más detalles de la visita aquí -->
                            </div>
                        </div>
                    @endforeach

                        
                        @endif


                    </div>
                </div>


            </div>


            <div class="col s12 m4">
                @include('themes.backoffice.pages.reserva.includes.reagendamiento')
            </div>

            {{-- @include('themes.backoffice.pages.reserva.includes.reserva') --}}


        </div>
    </div>
</div>
</div>

<form method="post" action="{{route('backoffice.reserva.destroy', $reserva) }} " name="delete_form">
    {{csrf_field()}}
    {{method_field('DELETE')}}
</form>
@endsection

@section('foot')
<script>
    function enviar_formulario()
 {
     Swal.fire({
         title: "¿Deseas eliminar esta reserva?",
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
{{--
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        M.Modal.init(elems);
    });
</script>

<script>
    $(document).ready(function(){
  $('.modal-trigger').on('click', function(){
        // Obtener los datos del cliente y la reserva seleccionada
        var clienteNombre = $(this).data('cliente');
        var fechaReserva = $(this).data('fecha');
        var observacionReserva = $(this).data('observacion');
        var masajeReserva = $(this).data('masaje');
        var personasReserva = $(this).data('personas');

        // Insertar los datos en los elementos del modal
        $('#modalClienteNombre').text(clienteNombre);
        $('#modalFechaReserva').text(fechaReserva);
        $('#modalObservacionReserva').text(observacionReserva);
        $('#modalMasajeReserva').text(masajeReserva);
        $('#modalPersonasReserva').text(personasReserva);

    // Abrir el modal
    var modal = M.Modal.getInstance($('#modalReserva'));
    modal.open();
  });
});
</script> --}}
@endsection