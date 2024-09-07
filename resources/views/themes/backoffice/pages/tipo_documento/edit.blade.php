@extends('themes.backoffice.layouts.admin')

@section('title','Editar Tipo Documentos')

@section('head')
@endsection

@section('breadcrumbs')
<li><a href="{{route('backoffice.complemento.index') }}">Complementos</a></li>
<li>Editar Tipo Documentos</li>
@endsection



@section('content')

<div class="section">
              <p class="caption">Introduce los datos para editar tipo documento {{$documento->nombre}}.</p>
              <div class="divider"></div>
              <div id="basic-form" class="section">
                <div class="row">
                  <div class="col s12 m8 offset-m2 ">
                    <div class="card-panel">
                      <h4 class="header">Editar tipo documento</h4>
                      <div class="row">
                        <form class="col s12" method="post" action="{{route('backoffice.complemento.update', $documento)}}">


                        {{csrf_field() }}
                        {{  method_field('PUT') }}
 
                            

                            <div class="row">

                                <div class="input-field col s12">
                                  <input id="nombre" type="text" name="nombre" value="{{$documento->nombre}}">
                                  <label for="nombre">Nombre</label>
                                    @error('nombre')
                                          <span class="invalid-feedback" role="alert">
                                              <strong style="color:red">{{ $message }}</strong>
                                          </span>
                                      @enderror
                                </div>

                                <div class="input-field col s12">
                                  <textarea id="description" class="materialize-textarea" name="description">{{$documento->descripcion}}</textarea>
                                  <label for="description">Descripción</label>
                                  @error('descripcion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color:red">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                              </div>

                            </div>     

                         
                        
                         

                         


                          <div class="row">
                              <div class="input-field col s12">
                                <button class="btn waves-effect waves-light right" name="table" type="submit" value="tipos_documentos">Actualizar
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
