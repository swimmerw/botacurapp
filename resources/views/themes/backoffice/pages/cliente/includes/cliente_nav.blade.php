<div class="collection">

    <a href="{{route('backoffice.cliente.show', $cliente)}}"  class="collection-item active" ><h5>Reservas:</h5></a>


        @if($cliente->reservas->isEmpty())
            <a class="collection-item center">Este cliente no tiene reservas. </a>
            <a href="{{ route('backoffice.reserva.create', $cliente->id) }}" class="btn-floating activator btn-move-up waves-effect waves-light accent-2 z-depth-0 right"> <i class="material-icons">add</i> </a>

        @else
            @foreach($cliente->reservas as $reserva)
            <a href="#modal-reserva{{$reserva->id}}" class="modal-trigger collection-item center" 
                data-id="{{ $reserva->id }}" 
                data-cliente="{{ $cliente->nombre_cliente }}" 
                data-fecha="{{ $reserva->fecha_visita }}" 
                data-observacion="{{ $reserva->observacion }}"
                data-masaje="{{$reserva->cantidad_masajes}}"
                data-personas="{{$reserva->cantidad_personas}}"
                >Visita: {{ $reserva->fecha_visita }}</a>
            {{-- <a class="btn modal-trigger">Ver detalles</a> --}}
            @endforeach
            <a href="{{ route('backoffice.reserva.create', $cliente->id) }}" class="btn-floating activator btn-move-up waves-effect waves-light accent-2 z-depth-0 right"> <i class="material-icons">add</i> </a>
        @endif


    
 
 </div>