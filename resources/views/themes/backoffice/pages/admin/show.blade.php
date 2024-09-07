@extends('themes.backoffice.layouts.admin')

@section('title','Panel de Administración')

@section('head')
@endsection

@section('breadcrumbs')
<li>Panel de Administración</li>
@endsection


@section('dropdown_settings')
@endsection

@section('content')

<div class="section">
    <p class="caption"><strong>Panel de Administración</strong></p>
    <div class="divider"></div>
    <div id="basic-form" class="section">
        <div class="row">
            <div class="col s12 ">
                <div class="card-panel">
                    <div class="row">



                        {{-- CONTENIDO --}}
                        <div id="card-stats">
                            <div class="row mt-1">
                                <!-- Tarjeta para mostrar el número de Reservas -->
                                <div class="col s12 m6 l3">
                                    <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text">
                                        <div class="padding-4">
                                            <div class="col s7 m7">
                                                <i class="material-icons background-round mt-5">assignment</i>
                                                <p>Reservas</p>
                                            </div>
                                            <div class="col s5 m5 right-align">
                                                <h5 id="reservas-count" class="mb-0">{{$totalReservas}}</h5>
                                                <p class="no-margin">Total</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- Tarjeta para mostrar el número de Clientes -->
                                <div class="col s12 m6 l3">
                                    <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text">
                                        <div class="padding-4">
                                            <div class="col s7 m7">
                                                <i class="material-icons background-round mt-5">airport_shuttle</i>
                                                <p>Clientes</p>
                                            </div>
                                            <div class="col s5 m5 right-align">
                                                <h5 id="clientes-count" class="mb-0">{{$totalClientes}}</h5>
                                                <p class="no-margin">Total</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Incorporar nuevas tarjetas --}}
                            </div>
                        </div>
                        
                        
                        



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('foot')
<script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.9.3/countUp.min.js"></script>
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Asegurar que los valores se conviertan correctamente en números
    var totalReservas = parseInt("{{ $totalReservas }}", 10) || 0;
    var totalClientes = parseInt("{{ $totalClientes }}", 10) || 0;


    // Inicializar el conteo para reservas
    var reservasCountUp = new CountUp('reservas-count',0, totalReservas);
    if (!reservasCountUp.error) {
        reservasCountUp.start();
    } else {
        console.error(reservasCountUp.error);
    }

    // Inicializar el conteo para clientes
    var clientesCountUp = new CountUp('clientes-count',0, totalClientes);
    if (!clientesCountUp.error) {
        clientesCountUp.start();
    } else {
        console.error(clientesCountUp.error);
    }
});

</script>

@endsection
