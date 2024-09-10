<div class="collection">


    <a href="" class="collection-item active">

        <h5>Consumo:</h5>
    </a>


    @if(is_null($reserva->venta->consumo))
    <a class="collection-item center">Esta cuenta no posee consumos. </a>
    <a href="{{ route('backoffice.reserva.venta.create', $reserva) }}"
        class="btn-floating activator btn-move-up waves-effect waves-light accent-2 z-depth-0 right tooltipped" data-position="bottom" data-tooltip="Agregar Servicio">
        <i class="material-icons">hot_tub</i>
    </a>
    <a href="{{ route('backoffice.venta.consumo.create', $reserva->venta) }}"
        class="btn-floating activator btn-move-up waves-effect waves-light accent-2 z-depth-0 right mr-5 tooltipped" data-position="bottom" data-tooltip="Agregar Producto">
        <i class="material-icons">local_bar</i>
    </a>
    @else
    {{-- @foreach($reserva->venta as $venta) --}}
    <a class="collection-item center-align valign-wrapper left">
        Abono: {{$reserva->venta->abono_programa}}
    </a>
    <a class="collection-item center-align valign-wrapper left">
        Diferencia: @if (is_null($reserva->venta->consumo->subtotal))
        Debe Realizar pago
        @else
        {{$reserva->venta->diferencia_programa}}
        @endif
    </a>
    <a href="" class="modal-trigger collection-item center-align valign-wrapper left" {{--
        data-id="{{ $reserva->venta->id }}" data-abono="{{ $reserva->venta->abono_programa }}"
        data-abonoimg="{{$reserva->venta->imagen_abono ? route('backoffice.reserva.abono.imagen', $reserva->id) : '/images/gallary/no-image.png'}}"
        data-diferencia="{{ $reserva->venta->diferencia_programa }}"
        data-diferenciaimg="{{$reserva->venta->imagen_diferencia ? route('backoffice.reserva.diferencia.imagen', $reserva->id) : '/images/gallary/no-image.png'}}"
        data-descuento="{{$reserva->venta->descuento}}" data-totalpagar="{{$reserva->venta->total_pagar}}"
        data-tipoabono="{{$reserva->venta->tipoTransaccionAbono->nombre ?? 'No registra'}}"
        data-tipodiferencia="{{$reserva->venta->tipoTransaccionDiferencia->nombre ?? 'No registra'}}" --}}>
        {{-- <i class='material-icons tooltipped' data-position="bottom" data-tooltip="Ver Venta">remove_red_eye</i>
        --}}
    </a>
    <a href="{{route('backoffice.reserva.venta.edit', ['reserva'=>$reserva, 'ventum'=>$reserva->venta]) }}"
        class="collection-item center-align valign-wrapper left">
        {{-- <i class='material-icons tooltipped' data-position="bottom" data-tooltip="Cerrar Venta">attach_money</i>
        --}}
    </a>
    {{-- @endforeach --}}
    @endif

</div>