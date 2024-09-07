<div class="collection">

    <a href="{{--route('backoffice.venta.show', $reserva)--}}" class="collection-item active" ><h5>Venta:</h5></a>

    @if(is_null($reserva->venta))
        <a class="collection-item center">Esta reserva no posee venta. </a>
        <a href="{{ route('backoffice.reserva.venta.create', $reserva) }}" class="btn-floating activator btn-move-up waves-effect waves-light accent-2 z-depth-0 right"> 
            <i class="material-icons">add</i> 
        </a>
    @else
        {{-- @foreach($reserva->venta as $venta) --}}
            <a class="collection-item center-align valign-wrapper">
                {{$reserva->venta->abono_programa}} <span><i class="material-icons">arrow_forward</i></span> {{$reserva->venta->diferencia_programa}}
            </a>
        {{-- @endforeach --}}
    @endif

</div>
