@extends('themes.backoffice.layouts.admin')

@section('tittle','Crear reserva')

@section('head')
@endsection

@section('breadcrumbs')
<li><a href="{{route('backoffice.cliente.show', $cliente->id) }}">Reservas del cliente</a></li>
<li>Crear Reserva</li>
@endsection



@section('content')

<div class="section">
              <p class="caption">Introduce los datos para crear un nuevo reserva</p>
              <div class="divider"></div>
              <div id="basic-form" class="section">
                <div class="row">
                  <div class="col s12 m8 offset-m2 ">
                    <div class="card-panel">
                      <h4 class="header">Crear reserva para <strong>{{$cliente->nombre_cliente}}</strong></h4>
                      <div class="row">
                        <form class="col s12" method="post" action="{{route('backoffice.reserva.store')}}">


                        {{csrf_field() }}
 
                            

                            <div class="row">
                                <div class="input-field col s12 m6">
                                <input id="cliente_id" type="hidden" class="form-control" name="cliente_id" value="{{$cliente->id}}" required>


                                    <label for="cantidad_personas">Cantidad Personas</label>

                                    <input id="cantidad_personas" type="number" class="form-control @error('cantidad_personas') is-invalid @enderror" name="cantidad_personas" value="{{old('cantidad_personas')}}" required autofocus>
                                    @error('cantidad_personas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                @enderror




                                </div>

                                <div class="input-field col s12 m6">
                                  <input id="cantidad_masajes" type="number" name="cantidad_masajes" value="{{ old('cantidad_masajes') }}">
                                  <label for="cantidad_masajes">Cantidad Masajes</label>
                                    @error('cantidad_masajes')
                                          <span class="invalid-feedback" role="alert">
                                              <strong style="color:red">{{ $message }}</strong>
                                          </span>
                                      @enderror
                                </div>

                            </div>     

                         
                          <div class="row">
                            {{-- <label for="">Fecha Visita</label> --}}
                            <p>Fecha Visita: </p>
                            <div class="input-field col s12 m6">
                              <input id="fecha_visita" type="date" name="fecha_visita" class="" value="{{ old('fecha_visita') }}" placeholder="fecha Visita">
                                @error('fecha_visita')
                                      <span class="invalid-feedback" role="alert">
                                          <strong style="color:red">{{ $message }}</strong>
                                      </span>
                                  @enderror
                            </div>

                            <div class="input-field col s12 m6">
                              <textarea id="observacion" name="observacion" class="materialize-textarea @error('nombre_reserva') is-invalid @enderror" {{ old('observacion') }}>{{ old('observacion') }}</textarea>
                              <label for="observacion">Observaciones</label>
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
@endsection
