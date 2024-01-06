@extends('themes.backoffice.layouts.admin')

@section('tittle','Editar Programa ' . $programa->nombre_programa)
@section('head')
@endsection

@section('breadcrumbs')
@endsection


@section('dropdown_settings')
@endsection

@section('content')

<div class="section">
              <p class="caption">Introduce los datos para editar un Programa</p>
              <div class="divider"></div>
              <div id="basic-form" class="section">
                <div class="row">
                  <div class="col s12 m8 offset-m2 ">
                    <div class="card-panel">
                      <h4 class="header2">Editar Programa</h4>
                      <div class="row">
                        <form class="col s12" method="post" action="{{route('backoffice.programa.update', $programa)}}">

                        {{csrf_field()}}
                        {{method_field('PUT')}}

                          <div class="row">
                            <div class="input-field col s12">
                              <input id="nombre_programa" type="text" name="nombre_programa" value="{{$programa->nombre_programa}}">
                              <label for="nombre_programa">Nombre del Programa</label>
                                @error('nombre_programa')
                                      <span class="invalid-feedback" role="alert">
                                          <strong style="color:red">{{ $message }}</strong>
                                      </span>
                                  @enderror


                            </div>
                          </div>
                         
                          <div class="row">
                            <div class="input-field col s12">
                              <input id="valor_programa" type="text" name="valor_programa" value="{{$programa->valor_programa}}"></textarea>
                              <label for="valor_programa">Valor Programa</label>

                              @error('valor_programa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            </div>

                            <div class="row">
                            <div class="input-field col s12">
                              <input id="descuento" type="text" name="descuento" value="{{$programa->descuento}}"></textarea>
                              <label for="descuento">Descuento</label>

                              @error('descuento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="row">
                              <div class="input-field col s12">
                                <button class="btn waves-effect waves-light right" type="submit">Actualizar
                                  <i class="material-icons right">send</i>
                                </button>
                              </div>
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
