@extends('themes.backoffice.layouts.admin')

@section('title', 'Reservas')

@section('breadcrumbs')
@endsection

@section('head')
<link href='{{ asset('assets/fullcalendar/packages/core/main.css') }}' rel='stylesheet' />
<link href='{{asset('assets/fullcalendar/packages/daygrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('assets/fullcalendar/packages/timegrid/main.css')}}' rel='stylesheet' />
@endsection

@section('content')
<div class="section">
    <p class="caption"><strong>Reservaciones</strong></p>
    <div class="divider"></div>
    <div id="basic-form" class="section">
        <div class="row">
            <div class="col s12 ">
    

                    <div id="calendar"></div>



            </div>
        </div>
    </div>
</div>
@endsection

@section('foot')
<script src='{{ asset('assets/fullcalendar/packages/core/main.min.js')}}'></script>
<script src='{{ asset('assets/fullcalendar/packages/interaction/main.js')}}'></script>
<script src='{{ asset('assets/fullcalendar/packages/daygrid/main.js')}}'></script>
<script src='{{ asset('assets/fullcalendar/packages/timegrid/main.js')}}'></script>


<script>
    function convertirFecha(fecha) {
    var parts = fecha.split('-');
    return parts[2] + '-' + parts[1] + '-' + parts[0];
}

document.addEventListener('DOMContentLoaded', function() {

    if (window.calendarInitialized) {

        return;
    }
    window.calendarInitialized = true;


    var calendarEl = document.getElementById('calendar');

    var eventos = [];
    @foreach($reservasPorMes as $mes => $reservas)
        @foreach($reservas as $reserva)
        var formatoFecha = convertirFecha('{{$reserva->fecha_visita}}')
        eventos.push({
            title: '{{ addslashes($reserva->cliente->nombre_cliente) }} - {{ $reserva->cantidad_personas }} personas - {{$reserva->programa->nombre_programa}}',
            start: formatoFecha+' 10:00',
            end: formatoFecha+' 19:00',
            url: '{{ route('backoffice.reserva.show', $reserva->id) }}',
            description: '{{ addslashes($reserva->observacion) }}'
        });
        @endforeach
    @endforeach

    

    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'es',
        plugins: ['interaction', 'dayGrid', 'timeGrid'],
        header: {
            left: 'prev,next,today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        buttonText:{
            month: 'Mes',
            week: 'Semana',
            day: 'Día',
            today: 'Hoy'
        },
        height: 650,
        contentHeight: 800,
        firstDay: 1,
        editable: true,
        eventLimit: true,
        events: eventos,
        eventColor: 'gradient-45deg-light-blue-cyan',
        eventClick: function(event) {
            if (event.url) {
                window.open(event.url, '_blank');
                return false;
            }
        },
    });

    
    calendar.render();
    
    let title = document.querySelector('.fc-center h2');
    if (title) {
                title.textContent = title.textContent.replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                });
            }
});
</script>
@endsection