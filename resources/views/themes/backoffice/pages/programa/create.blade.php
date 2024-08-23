@extends('themes.backoffice.layouts.admin')

@section('tittle','Crear Programa')

@section('head')
@endsection

@section('breadcrumbs')
@endsection


@section('dropdown_settings')
@endsection

@section('content')

<div class="section">
              <p class="caption">Introduce los datos para crear un nuevo Programa</p>
              <div class="divider"></div>
              <div id="basic-form" class="section">
                <div class="row">
                  <div class="col s12 m8 offset-m2 ">
                    <div class="card-panel">
                      <h4 class="header2">Crear Programa</h4>
                      <div class="row">
                        <form class="col s12" method="post" action="{{route('backoffice.programa.store')}}">


                        {{csrf_field() }}
                          <div class="row">
                            <div class="input-field col s12">
                              <input id="nombre_programa" type="text" name="nombre_programa">
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
                              <input id="valor_programa"
                              type="text" class="materialize-textarea" name="valor_programa">
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
                              <input id="descuento"
                              type="text" class="materialize-textarea" name="descuento">
                              <label for="descuento">Descuento</label>

                              @error('descuento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="row">
                              <div class="input-field col s12">
                                <button class="btn waves-effect waves-light right" type="submit">Guardar
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
