@extends('themes.backoffice.layouts.admin')

@section('title', 'Masajes')

@section('breadcrumbs')
@endsection

@section('head')
@endsection

@section('content')
<div class="section">
    <p class="caption"><strong>Masajes {{ now()->format('d-m-Y') }}</strong></p>
    <div class="divider"></div>
    <div id="basic-form" class="section">
        <div class="card-panel ">



            <table class="responsive-table">
                <thead>
                    <tr>
                        <th>Horario Masajes</th>
                        <th>Nombre Cliente</th>
                        <th>Tipo Masajes</th>
                        <th>Lugar Masajes</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($reservasHoy as $fecha => $reserva)
                    @foreach ($reserva->visitas as $visita)
                    @if (!is_null($visita->horario_masaje))
                    <tr @if (now()->format('H:i') >= $visita->hora_fin_masaje || now()->format('H:i') >= $visita->hora_fin_masaje_extra)
                        style="background-color: green;"
                    @else
                        style="background-color: red;"
                    @endif>
                        <td>{{$visita->horario_masaje}} - @if ($visita->hora_fin_masaje)
                            
                            {{$visita->hora_fin_masaje}}
                            @else
                            {{$visita->hora_fin_masaje_extra}}
                            @endif
                        </td>
                        <td>{{$reserva->cliente->nombre_cliente}}</td>
                        <td>{{$visita->tipo_masaje}}</td>
                        <td>{{$visita->lugarMasaje->nombre}}</td>
                    </tr>
                    @endif
                    @endforeach
                    @endforeach
                </tbody>
            </table>
            {{-- Paginación --}}
            {{-- <div class="center">
                {{ $MasajesPaginados->links('vendor.pagination.materialize') }}
            </div> --}}



        </div>
    </div>
</div>
@endsection

@section('foot')


@endsection