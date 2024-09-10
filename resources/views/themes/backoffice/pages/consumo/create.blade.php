@extends('themes.backoffice.layouts.admin')

@section('title','Ingresar Consumo')

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
            <div class="col s12 m8 offset-m2 ">
                <div class="card-panel">
                    <h4 class="header">Consumo para la venta de <strong>{{$venta->reserva->cliente->nombre_cliente}}</strong></h4>
                    <div class="row">
                        <form class="col s12" method="post"
                            action="{{route('backoffice.venta.consumo.store', $venta)}}">


                            {{csrf_field() }}



                            <div class="row">
                                <div class="input-field col s12 m6 l4" hidden>
                                    <input id="id_venta" type="hidden" class="form-control" name="id_venta"
                                        value="{{$venta->id}}" required>
                                </div>

                                <div class="input-field col s12 m6 l4">

                                    <label for="id_producto">Producto</label>
                                    <input id="id_producto" type="text" name="id_producto" class=""
                                        value="{{ old('id_producto') }}">
                                    @error('id_producto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l4">

                                    <label for="observacion">Observaciones</label>
                                    <input id="observacion" type="text" name="observacion" class=""
                                        value="{{ old('observacion') }}">
                                    @error('observacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>



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

</script>

@endsection