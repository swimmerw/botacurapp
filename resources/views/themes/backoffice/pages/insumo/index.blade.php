@extends('themes.backoffice.layouts.admin')

@section('title', '')

@section('head')
@endsection


@section('breadcrumbs')
{{-- <li><a href="{{route('backoffice.cliente.index')}}">Clientes del Sistema</a></li> --}}
{{-- <li>{{$cliente->nombre_cliente}}</li> --}}
@endsection

@section('dropdown_settings')
<li><a href="{{ route('backoffice.insumo.create') }}" class="grey-text text-darken-2">Ingresar Insumo</a></li>
@endsection


@section('content')
<div class="section">
    <p class="caption"><strong>Insumos</strong></p>
    <div class="divider"></div>
    <div id="basic-form" class="section">
        <div class="row">

            {{-- Cocina --}}
            <div class="col s12 m6">
                <div class="card-panel">
                    <div class="row">

                        <div class="card-panel gradient-45deg-light-blue-cyan white-text center">
                            <h4>Cocina</h4>
                        </div>
                        @if($insumos->isNotEmpty())
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Valor</th>
                                    <th>Cantidad Actual</th>
                                    <th>Sector</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($insumos as $insumo)
                                    <tr>
                                        <td>{{ $insumo->nombre }}</td>
                                        <td>{{ $insumo->valor }}</td>
                                        <td>{{ $insumo->cantidad }}</td>
                                        <td>{{ $insumo->sector->nombre }}</td> <!-- Mostrar el sector asociado -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <h5 class="center">No existen registros</h5>
                        @endif

                    </div>
                </div>
            </div>

            {{-- Barra --}}
            <div class="col s12 m6">
                <div class="card-panel">
                    <div class="row">

                        <div class="card-panel gradient-45deg-light-blue-cyan white-text center">
                            <h4>Barra</h4>
                        </div>
                        {{-- @if($transacciones->isNotEmpty()) --}}
                        <table class="centered responsive-table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th colspan="2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach($transacciones as $transaccion) --}}
                                <tr>
                                    <td>

                                        {{-- $transaccion->nombre --}}

                                    </td>
                                    <td>
                                        <a href="{{-- route('backoffice.tipo_transaccion.edit', $transaccion->id) --}}">
                                            <i class="material-icons">mode_edit</i> Editar
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" style="color: red"
                                            onclick="enviar_formulario('{{-- route('backoffice.complemento.destroy', $transaccion->id) --}}', 'tipos_transacciones')">
                                            <i class="material-icons">delete</i> Eliminar
                                        </a>

                                    </td>
                                </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                        {{-- @else --}}
                        <h5 class="center">No existen registros</h5>
                        {{-- @endif --}}

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

@endsection

@section('foot')

@endsection