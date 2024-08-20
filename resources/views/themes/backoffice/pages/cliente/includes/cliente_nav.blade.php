<div class="collection">

    <a href="{{route('backoffice.cliente.show', $cliente)}}"  class="collection-item active" ><h5>Reservas:</h5></a>


        @if($cliente->reservas->isEmpty())
            <a class="collection-item center">Este cliente no tiene reservas. </a>
            <a href="{{ route('backoffice.reserva.create', ['cliente_id'=>$cliente->id]) }}" class="btn-floating activator btn-move-up waves-effect waves-light accent-2 z-depth-0 right"> <i class="material-icons">add</i> </a>

        @else
            @foreach($cliente->reservas as $reserva)
            <a class="collection-item center">{{ $reserva->fecha_visita }}</a>
            @endforeach
        @endif


    
 
 </div>