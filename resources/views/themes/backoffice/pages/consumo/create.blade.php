@extends('themes.backoffice.layouts.admin')

@section('title', 'Ingresar Consumo')

@section('head')
@endsection

@section('breadcrumbs')
<li><a href="{{route('backoffice.reserva.show', $venta->id_reserva) }}">Consumo para reserva del cliente</a></li>
<li>Ingresar Consumo</li>
@endsection

@section('content')

<div class="section">
    <p class="caption">Ingrese los datos del consumo para la venta.</p>
    <div class="divider"></div>
    <div id="basic-form" class="section">
        <div class="row">
            <div class="col s12 m8 offset-m2">
                <div class="card-panel">
                    <h4 class="header">Consumo para la venta de
                        <strong>{{$venta->reserva->cliente->nombre_cliente}}</strong>
                    </h4>
                    <div class="row">
                        <form class="col s12" method="post"
                            action="{{route('backoffice.venta.consumo.store', $venta)}}">
                            {{csrf_field()}}



                            <div class="row">
                                <div class="input-field col s12 m6 l4" hidden>
                                    <input id="id_venta" type="hidden" name="id_venta" value="{{$venta->id}}" required>
                                </div>

                                <div class="card">
                                    @foreach($tipos as $tipo)
                                    <div class="card-content gradient-45deg-light-blue-cyan">
                                        <h5 class="white-text">{{ $tipo->nombre }}</h5>
                                    </div>

                                    <div class="card-tabs">
                                        <ul class="tabs tabs-fixed-width">
                                            <li class="tab"><a href="#tipo_{{$tipo->id}}">{{$tipo->nombre}}</a></li>
                                        </ul>
                                    </div>


                                    <div class="card-content grey lighten-4"
                                        >
                                        @foreach($tipo->productos as $producto)
                                        <div class="row">
                                            <div class="col s6" id="tipo_{{$producto->id_tipo_producto}}">
                                                <blockquote>
                                                    <h5>
                                                        {{$producto->nombre}}
                                                    </h5>
                                                </blockquote>
                                            </div>
                                            <div class="col s2" id="tipo_{{$producto->id_tipo_producto}}">

                                                <h5>
                                                    ${{$producto->valor}}
                                                </h5>
                                                <input id="productos_{{ $producto->id }}" type="hidden" name="productos[{{ $producto->id }}][valor]" value="{{$producto->valor}}">

                                            </div>
                                            <div class="input-field col s2 offset-s2">
                                                <label for="producto_{{ $producto->id }}">Cantidad</label>
                                                <input id="producto_{{ $producto->id }}" type="number"
                                                    name="productos[{{ $producto->id }}][cantidad]" value="">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                            @endforeach






                            <div class="row">


                                <!-- Listar productos por categorías -->


                                {{-- <div class="input-field col s12">
                                    <label for="observacion">Observaciones</label>
                                    <input id="observacion" type="text" name="observacion"
                                        value="{{ old('observacion') }}">
                                    @error('observacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> --}}

                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light right" type="submit">Guardar
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('foot')
<script>
    // Si deseas agregar algún comportamiento adicional con JavaScript
</script>
@endsection