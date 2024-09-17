<div class="collection">


    <a href="" class="collection-item active">

        <h5>Consumo:</h5>
    </a>


    @if(is_null($reserva->venta->consumos))
    <a class="collection-item center">Esta cuenta no posee consumos. </a>
    <a href="{{ route('backoffice.venta.consumo.create_service', $reserva->venta) }}"
        class="btn-floating activator btn-move-up waves-effect waves-light accent-2 z-depth-0 right tooltipped"
        data-position="bottom" data-tooltip="Agregar Servicio">
        <i class="material-icons">hot_tub</i>
    </a>
    <a href="{{ route('backoffice.venta.consumo.create', $reserva->venta) }}"
        class="btn-floating activator btn-move-up waves-effect waves-light accent-2 z-depth-0 right mr-5 tooltipped"
        data-position="bottom" data-tooltip="Agregar Producto">
        <i class="material-icons">local_bar</i>
    </a>
    @else
    @foreach($reserva->venta->consumos as $consumo)
    @foreach ($consumo->detallesConsumos as $detalle)


    <a class="collection-item center-align valign-wrapper">
        {{$detalle->producto->nombre}} - Cantidad: {{$detalle->cantidad_producto}}
    </a>

    {{-- <a href="" class="modal-trigger collection-item center-align valign-wrapper left" --}} {{--
        data-id="{{ $reserva->venta->id }}" data-abono="{{ $reserva->venta->abono_programa }}"
        data-abonoimg="{{$reserva->venta->imagen_abono ? route('backoffice.reserva.abono.imagen', $reserva->id) : '/images/gallary/no-image.png'}}"
        data-diferencia="{{ $reserva->venta->diferencia_programa }}"
        data-diferenciaimg="{{$reserva->venta->imagen_diferencia ? route('backoffice.reserva.diferencia.imagen', $reserva->id) : '/images/gallary/no-image.png'}}"
        data-descuento="{{$reserva->venta->descuento}}" data-totalpagar="{{$reserva->venta->total_pagar}}"
        data-tipoabono="{{$reserva->venta->tipoTransaccionAbono->nombre ?? 'No registra'}}"
        data-tipodiferencia="{{$reserva->venta->tipoTransaccionDiferencia->nombre ?? 'No registra'}}" --}} {{--> --}}
        {{-- <i class='material-icons tooltipped' data-position="bottom" data-tooltip="Ver Venta">remove_red_eye</i>
        --}}
        {{-- </a> --}}


    @endforeach
    @endforeach
    <a href="{{ route('backoffice.venta.consumo.create_service', $reserva->venta) }}"
        class="btn-floating activator btn-move-up waves-effect waves-light accent-2 z-depth-0 right tooltipped"
        data-position="bottom" data-tooltip="Agregar Servicio">
        <i class="material-icons">hot_tub</i>
    </a>
    <a href="{{ route('backoffice.venta.consumo.create', $reserva->venta) }}"
        class="btn-floating activator btn-move-up waves-effect waves-light accent-2 z-depth-0 right mr-5 tooltipped"
        data-position="bottom" data-tooltip="Agregar Producto">
        <i class="material-icons">local_bar</i>
    </a>
    @endif

</div>