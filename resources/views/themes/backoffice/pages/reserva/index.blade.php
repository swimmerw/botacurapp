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
                {{-- <div class="card-panel"> --}}

                    {{-- <div class="row">


                        @foreach($reservasPorMes as $mes => $reservas)
                        @php
                        // Obtener el mes y el año del grupo de reservas
                        $monthYear = Carbon\Carbon::createFromFormat('Y-m', $mes);
                        $isCurrentMonth = ($monthYear->month == $currentMonth && $monthYear->year == $currentYear);
                        @endphp

                        <div class="card-panel {{ $isCurrentMonth ? 'gradient-45deg-light-blue-cyan white-text' : 'pink accent-2 white-text' }} center"
                            style="border-radius: 30px">
                            <h3>{{ ucfirst($monthYear->translatedFormat('F Y')) }} {{ $isCurrentMonth ? '(Mes Actual)' :
                                ''
                                }}</h3>
                        </div>

                        <div class="row">
                            @forelse($reservas as $reserva)
                            <div class="col s12 m4 l3">
                                <div class="card small" style="border-radius: 20px">
                                    <div class="card-content">
                                        <span class="card-title">{{ $reserva->cliente->nombre_cliente }}</span>
                                        <p><strong>Fecha:</strong> {{
                                            ucfirst(Carbon\Carbon::parse($reserva->fecha_visita)->translatedFormat('d F
                                            Y'))
                                            }}</p>
                                        <p><strong>Personas:</strong> {{ $reserva->cantidad_personas }}</p>
                                        <p><strong>Masajes:</strong> {{ $reserva->cantidad_masajes }}</p>
                                        <p><strong>Observaciones:</strong> {{ $reserva->observacion }}</p>
                                    </div>
                                    <div class="card-action center">
                                        <a href="{{ route('backoffice.reserva.show', $reserva->id) }}"
                                            class="btn btn-small">Ver Detalles</a>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p>No hay reservas para este mes.</p>
                            @endforelse
                        </div>
                        @endforeach

                    </div> --}}


                    <div id="calendar"></div>





                    {{--
                </div> --}}
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
            title: '{{ addslashes($reserva->cliente->nombre_cliente) }} - {{ $reserva->cantidad_personas }} personas',
            start: formatoFecha,
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