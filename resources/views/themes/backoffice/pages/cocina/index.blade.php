@extends('themes.backoffice.layouts.admin')

@section('title', 'Menus')

@section('breadcrumbs')
@endsection

@section('head')
@endsection

@section('content')
<div class="section">
    <p class="caption"><strong>Menus desde {{ now()->format('d-m-Y') }}</strong></p>
    <div class="divider"></div>
    <div id="basic-form" class="section">
        <div class="card-panel ">


            @foreach($menusPaginados as $fecha => $reservas)
            @foreach($reservas as $reserva)
            <div class="card-panel">
                <div class="card-content gradient-45deg-light-blue-cyan">
                    <h5 class="card-title center white-text"><i class='material-icons white-text'>restaurant_menu</i> Menús para {{ $reserva->cliente->nombre_cliente }} / {{$fecha}}</h5>
                </div>

                <div class="card-content  grey lighten-4">
                <table class="responsive-table">
                    <thead class="">
                      <tr>
                        <th>Menú</th>
                        <th>Entrada</th>
                        <th>Fondo</th>
                        <th>Acompañamiento</th>
                        <th>Observaciones</th>
                      </tr>
                    </thead>
                    <tbody>
                @foreach($reserva->visitas as $visita)
                        @foreach($visita->menus as $index => $menu)
                        <tr>


                            <td>
                              <strong>Menú {{$index + 1}}:</strong>
                            </td>
                            <td>
                              {{ $menu->productoEntrada->nombre }}
                            </td>
                            <td>
          
                              {{ $menu->productoFondo->nombre }}
                            </td>
                            <td>
          
                              {{ $menu->productoAcompanamiento->nombre }}
                            </td>
                            
                              @if ($menu->observacion == null)
                                <td> No Registra</td>
                              @endif
                              <td style="color: red">{{ $menu->observacion }}</td>
          
                          </tr>
                        @endforeach
                @endforeach

            </tbody>
        </table>
                </div>
            </div>
            @endforeach
        @endforeach
        
        {{-- Paginación --}}
        <div class="center">
            {{ $menusPaginados->links('vendor.pagination.materialize') }}
        </div>
        


        </div>
    </div>
</div>
@endsection

@section('foot')


@endsection