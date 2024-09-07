@extends('themes.backoffice.layouts.admin')

@section('title', 'Reserva de '.$reserva->cliente->nombre_cliente)

@section('head')
@endsection

@section('breadcrumbs')
<li><a href="{{route('backoffice.reserva.index')}}">Reservas</a></li>
<li>{{$reserva->cliente->nombre_cliente}}</li>
@endsection

@section('dropdown_settings')
<li><a href="{{ route('backoffice.reserva.visitas.create',$reserva) }}" class="grey-text text-darken-2">Generar
    Visita</a></li>
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
            <span class="card-title activator grey-text text-darken-4">{{$reserva->cliente->nombre_cliente}}</span>
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

              <div class="col s12 m6 l4">
                <p>

                  <i class="material-icons">group</i> Reserva para: <strong>{{$reserva->cantidad_personas}}
                    personas</strong>

                </p>
              </div>
              <div class="col s12 m6 l4">
                <p>

                  <i class="material-icons">verified_user</i> Reserva Generada por: <a
                    href="{{route('backoffice.user.show', $reserva->user_id)}}">{{$reserva->user->name}}</a>

                </p>
              </div>

            </div>



            <div class="card-action">
              <a href="{{route('backoffice.cliente.edit', $reserva->cliente_id)}}" class="purple-text">Editar</a>
              {{-- <a href="#" style="color: red" onclick="enviar_formulario()">Eliminar</a> --}}
            </div>
          </div>
        </div>

      </div>

      <div class="col s12 m4">
        @include('themes.backoffice.pages.reserva.includes.reagendamiento')
      </div>
    </div>





    <div class="row">
      <div class="col s12 m8">



        {{-- TABLA PROGRAMA --}}
        <div id="work-collections">
          <div class="row">
            <div class="col s12 m12 l4">
              <ul id="projects-collection" class="collection z-depth-1">
                <li class="collection-item avatar">
                  <i class="material-icons cyan circle">card_travel</i>
                  <h6 class="collection-header m-0">Programa {{$reserva->programa->nombre_programa}}</h6>
                  <p>Servicios incluidos</p>
                </li>
                @foreach ($reserva->programa->servicios as $servicio)

                <li class="collection-item">
                  <div class="row">
                    <div class="col s9">
                      <p class="collections-title">{{$servicio->nombre_servicio}}</p>
                      <p class="collections-content">{{$servicio->duracion}} minutos</p>
                    </div>
                    <div class="col s3">
                      {{-- <span class="task-cat cyan accent-2">Pendiente</span> --}}
                    </div>
                  </div>
                </li>
                @endforeach

              </ul>
            </div>





            {{-- TABLA VISITA --}}

            <div class="col s12 m12 l8">
              <ul id="issues-collection" class="collection z-depth-1">
                <li class="collection-item avatar">
                  <i class="material-icons green accent-2 circle">spa</i>
                  <h6 class="collection-header m-0">Visita</h6>
                  @if ($reserva->visitas->isEmpty())

                  <h6>Aún no se registra la visita para esta reserva</h6>
                  @else
                  @foreach ($reserva->visitas as $visita)
                  <p>{{$visita->lugarMasaje->nombre}} - {{$visita->ubicacion->nombre}}</p>
                </li>


                @if($reserva->programa->servicios->contains('nombre_servicio', 'Sauna'))
                <li class="collection-item">
                  <div class="row">
                    <div class="col s7">
                      <p class="collections-title">Sauna: <strong id="horario-sauna"
                          data-fecha="{{ $reserva->fecha_visita }}" data-inicio="{{ $visita->horario_sauna }}"
                          data-fin="{{ $visita->hora_fin_sauna }}">{{ $visita->horario_sauna }}</strong></p>
                      <p class="collections-content">Hora Fin: <strong name="sauna" id="sauna"
                          data-sauna="duracion-sauna">{{ $visita->hora_fin_sauna }}</strong></p>
                    </div>
                    <div class="col s3">
                      <span class="task-cat" id="task-cat-sauna">Pendiente</span>
                    </div>
                    <div class="col s3">
                      <div class="progress">
                        <div class="determinate" id="progress-sauna" style="width: 0%;"></div>
                      </div>
                    </div>
                  </div>
                </li>
                @endif


                @if($reserva->programa->servicios->contains('nombre_servicio', 'Tinaja'))
                <li class="collection-item">
                  <div class="row">
                    <div class="col s7">
                      <p class="collections-title">Tinaja: <strong id="horario-tinaja"
                          data-fecha="{{ $reserva->fecha_visita }}" data-inicio="{{ $visita->horario_tinaja }}"
                          data-fin="{{ $visita->hora_fin_tinaja }}">{{ $visita->horario_tinaja }}</strong></p>
                      <p class="collections-content">Hora Fin: <strong name="tinaja" id="tinaja"
                          data-tinaja="duracion-tinaja">{{ $visita->hora_fin_tinaja }}</strong></p>
                    </div>
                    <div class="col s3">
                      <span class="task-cat" id="task-cat-tinaja">Pendiente</span>
                    </div>
                    <div class="col s3">
                      <div class="progress">
                        <div class="determinate" id="progress-tinaja" style="width: 0%;"></div>
                      </div>
                    </div>
                  </div>
                </li>
                @endif

                @if($reserva->programa->servicios->contains('nombre_servicio', 'Masaje'))
                <li class="collection-item">
                  <div class="row">
                    <div class="col s7">
                      <p class="collections-title">Masaje: <strong id="horario-masaje"
                          data-fecha="{{ $reserva->fecha_visita }}" data-inicio="{{ $visita->horario_masaje }}"
                          data-fin="{{ $visita->hora_fin_masaje }}">{{ $visita->horario_masaje }}</strong></p>
                      <p class="collections-content">Hora Fin: <strong name="masaje" id="masaje"
                          data-masaje="duracion-masaje">{{ $visita->hora_fin_masaje }}</strong></p>
                    </div>
                    <div class="col s3">
                      <span class="task-cat" id="task-cat-masaje">Pendiente</span>
                    </div>
                    <div class="col s3">
                      <div class="progress">
                        <div class="determinate" id="progress-masaje" style="width: 0%;"></div>
                      </div>
                    </div>
                  </div>
                </li>
                @endif


                @endforeach
                @endif




              </ul>
            </div>
          </div>
        </div>




      </div>


      <div class="col s12 m4">
        @include('themes.backoffice.pages.reserva.includes.venta')
      </div>


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


<script>
  document.addEventListener('DOMContentLoaded', function() {
    function convertirFecha(fechaStr) {
        const partes = fechaStr.split('-'); //convertir la fecha recibida para formatearla
        return `${partes[2]}-${partes[1]}-${partes[0]}`; // Convertir a yyyy-mm-dd
    }

    function calcularProgreso(horaInicioStr, horaFinStr, fechaStr) {
        const fechaHoy = new Date(); //ingresar fecha actual en una constante
        const fechaConvertida = convertirFecha(fechaStr); //Fecha recibida desde data-fecha con la fecha de visita en la reserva
        const horaInicio = new Date(`${fechaConvertida} ${horaInicioStr}`); //se genera una constante con el formato esperado por JS (yyyy-mm-dd) de la fecha y hora Inicio
        const horaFin = new Date(`${fechaConvertida} ${horaFinStr}`); //se genera una constante con el formato esperado por JS (yyyy-mm-dd) de la fecha y hora Fin

        if (fechaHoy > horaFin) {
            return 100; // Si la fecha actual es mayor a la horaFin el estado sera Completado (ya sea por la hora o fecha)
        }

        if (fechaHoy < horaInicio) {
            return 0; // Si la fecha actual es menor a la HoraInicio el estado sera Pendiente (puesto que aun no es la fecha ni la hora)
        }

        const totalMilisegundos = horaFin.getTime() - horaInicio.getTime(); // Se obtienen los milisegundos de la hora de inicio con la duracion del servicio.
        
        const milisegundosTranscurridos = fechaHoy.getTime() - horaInicio.getTime();// Se obtienen los milisegundos que han pasado

        
        return (milisegundosTranscurridos / totalMilisegundos) * 100; // Retorna el tiempo en % hasta 100
    }

    function actualizarProgreso(idHorario, idProgressBar, idTaskCat) {
        const horarioElement = document.getElementById(idHorario); //captura el ID de Strong en la constante
        if (!horarioElement) return; // Si no existe ID no realizara ninguna accion

        const fecha = horarioElement.getAttribute('data-fecha'); //obtiene el valor de data-fecha del elemento Strong
        const horaInicio = horarioElement.getAttribute('data-inicio');//obtiene el valor de data-inicio del elemento Strong
        const horaFin = horarioElement.getAttribute('data-fin'); //obtiene el valor de data-fin del elemento Strong (hora de inicio + duracion de servicio)
        const progreso = calcularProgreso(horaInicio, horaFin, fecha);// almacena como progreso la funcion realizada anteriormente pasando los parametros que requiere

        const progressBar = document.getElementById(idProgressBar); //Captura el elemento div con la barra de progreso
        const taskCat = document.getElementById(idTaskCat); //Captura el span con sus propiedades

        progressBar.style.width = progreso + '%'; //modifica el style="width: 0-100%" en el div

        if (progreso === 0) {
            taskCat.innerText = 'Pendiente';
            taskCat.className = 'task-cat cyan';
        } else if (progreso > 0 && progreso < 100) {
            taskCat.innerText = 'En Proceso';
            taskCat.className = 'task-cat deep-orange';
        } else if (progreso === 100) {
            taskCat.innerText = 'Completado';
            taskCat.className = 'task-cat green';
        }//Estados segun progresos

        
        
    }

    // Actualizar barras cada segundo
    setInterval(function() {
        actualizarProgreso('horario-sauna', 'progress-sauna', 'task-cat-sauna');
        actualizarProgreso('horario-tinaja', 'progress-tinaja', 'task-cat-tinaja');
        actualizarProgreso('horario-masaje', 'progress-masaje', 'task-cat-masaje');
    }, 1000); // actualiza la barra cada 1 segundo
});





</script>

@endsection