@extends('themes.backoffice.layouts.admin')

@section('title', '')

@section('head')
@endsection

@section('content')
<div class="section">
    <p class="caption"><strong>Reservaciones</strong></p>
    <div class="divider"></div>
    <div id="basic-form" class="section">
        <div class="row">
            <div class="col s12 ">
                <div class="card-panel">

                    <div class="row">


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

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection