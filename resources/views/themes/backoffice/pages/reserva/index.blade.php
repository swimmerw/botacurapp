@extends('themes.backoffice.layouts.admin')

@section('title', 'Reservas')

@section('breadcrumbs')
@endsection

@section('head')
@endsection

@section('content')
<div class="section">
    <p class="caption"><strong>Reservas desde {{ now()->format('d-m-Y') }}</strong></p>
    <div class="divider"></div>
    <div id="basic-form" class="section">
        <div class="card-panel ">

            @foreach($reservasPaginadas as $fecha => $reservas)
            <div class="col s12">
                <h5>Reservas: {{ $fecha }}</h5>
                <div class="row">
                    <div class="col s12 m6 l4">
                        <div class="card-panel animate__animated animate__backInDown" style="--animate-delay: 1s; --animate-duration: 2s; ">
                            <table class="highlight">
                                <thead>
                                    <tr>
                                        <th>Sauna</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservas as $reserva)
                                    @foreach ($reserva->visitas as $visita)
                                    @if ($visita->horario_sauna)
                                    <tr>
                                        <td>
                                            <a href="{{ route('backoffice.reserva.show', $reserva) }}">
                                                {{ $visita->horario_sauna }} - {{ $visita->hora_fin_sauna }}
                                                <strong>{{ addslashes($reserva->cliente->nombre_cliente) }} -</strong>
                                                {{ $reserva->cantidad_personas }} personas - {{ $reserva->programa->nombre_programa }}
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col s12 m6 l4">
                        <div class="card-panel animate__animated animate__backInDown" style="--animate-delay: 2s; --animate-duration: 2s; ">
                            <table class="highlight">
                                <thead>
                                    <tr>
                                        <th>Tinaja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservas as $reserva)
                                    @foreach ($reserva->visitas as $visita)
                                    @if ($visita->horario_tinaja)
                                    <tr>
                                        <td>
                                            <a href="{{ route('backoffice.reserva.show', $reserva) }}">
                                                {{ $visita->horario_tinaja }} - {{ $visita->hora_fin_tinaja }}
                                                <strong>{{ addslashes($reserva->cliente->nombre_cliente) }} -</strong>
                                                {{ $reserva->cantidad_personas }} personas - {{ $reserva->programa->nombre_programa }}
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col s12 m6 l4">
                        <div class="card-panel animate__animated animate__backInDown" style="--animate-delay: 3s; --animate-duration: 2s; ">
                            <table class="highlight">
                                <thead>
                                    <tr>
                                        <th>Masaje</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservas as $reserva)
                                    @foreach ($reserva->visitas as $visita)
                                    @if ($visita->horario_masaje)
                                    <tr>
                                        <td>
                                            <a href="{{ route('backoffice.reserva.show', $reserva) }}">
                                                {{ $visita->horario_masaje }} - {{ $visita->hora_fin_masaje }}
                                                <strong>{{ addslashes($reserva->cliente->nombre_cliente) }} -</strong>
                                                {{ $reserva->cantidad_personas }} personas - {{ $reserva->programa->nombre_programa }}
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Paginación -->
            <div class="center-align">
                {{ $reservasPaginadas->links('vendor.pagination.materialize') }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('foot')


@endsection