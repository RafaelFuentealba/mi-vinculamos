@extends('temas.baseusuario')

@section('panel-izquierdo')
@include('temas.panelizquierdo')
@endsection

@section('contenido-principal')

<div class="col-md-8 col-lg-6 vstack gap-4">
    <div class="card">
        <div class="card-header border-0 pb-0">
            <h1 class="h4 card-title mb-0">Actualizar perfil</h1>
        </div>
        <div class="card-body">
            <form class="row g-3" action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                @if(Session::has('errorUsuario'))
                    <div class="alert alert-danger alert-dismissible fade show mt-2 mb-2 text-center" role="alert">
                        <strong>{{ Session::get('errorUsuario') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif

                <div class="col-sm-6 col-lg-6">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" placeholder="Ejemplo: Camila" id="nombre" name="nombre" value="{{ old('nombre') ?? @$usuario->usvi_nombre }}">
                    @if($errors->has('nombre'))
                        <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                            <strong>{{ $errors->first('nombre') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif
                </div>
                <div class="col-sm-6 col-lg-6">
                    <label class="form-label">Apellido</label>
                    <input type="text" class="form-control" placeholder="Ejemplo: Orellana" id="apellido" name="apellido" value="{{ old('apellido') ?? @$usuario->usvi_apellido }}">
                    @if($errors->has('apellido'))
                        <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                            <strong>{{ $errors->first('apellido') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif
                </div>
                <div class="col-sm-6 col-lg-4">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Ejemplo: corellana@vinculamos.cl" id="email" name="email" value="{{ old('email') ?? @$usuario->usvi_email }}">
                    @if($errors->has('email'))
                        <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif
                </div>
                <div class="col-sm-6 col-lg-4">
                    <label class="form-label">Teléfono</label>
                    <input type="text" class="form-control" placeholder="Ejemplo: +56989814344" id="telefono" name="telefono" value="{{ old('telefono') ?? @$usuario->usvi_telefono }}">
                    @if($errors->has('telefono'))
                        <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                            <strong>{{ $errors->first('telefono') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif
                </div>
                <div class="col-sm-6 col-lg-4">
                    <label class="form-label">Nacimiento</label>
                    <input type="text" class="form-control flatpickr" placeholder="Ejemplo: 1990-12-31" id="nacimiento" name="nacimiento" value="{{ old('nacimiento') ?? @$usuario->usvi_nacimiento }}">
                    @if($errors->has('nacimiento'))
                        <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                            <strong>{{ $errors->first('nacimiento') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif
                </div>

                <hr>

                <div class="col-sm-12">
                    <label class="form-label">Dirección</label>
                    <input type="text" class="form-control" placeholder="Ejemplo: 4 Poniente, 1233" id="direccion" name="direccion" value="{{ old('direccion') ?? @$usuario->usvi_direccion }}">
                    @if($errors->has('direccion'))
                        <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                            <strong>{{ $errors->first('direccion') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif
                </div>
                <div class="col-sm-6 col-lg-6">
                    <label class="form-label">Comuna</label>
                    <input type="text" class="form-control" placeholder="Ejemplo: Temuco" id="comuna" name="comuna" value="{{ old('comuna') ?? @$usuario->usvi_comuna }}">
                    @if($errors->has('comuna'))
                        <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                            <strong>{{ $errors->first('comuna') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif
                </div>
                <div class="col-sm-6 col-lg-6">
                    <label class="form-label">Provincia</label>
                    <input type="text" class="form-control" placeholder="Ejemplo: Cautín" id="provincia" name="provincia" value="{{ old('provincia') ?? @$usuario->usvi_provincia }}">
                    @if($errors->has('provincia'))
                        <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                            <strong>{{ $errors->first('provincia') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif
                </div>
                <div class="col-sm-6 col-lg-6">
                    <label class="form-label">Región</label>
                    <input type="text" class="form-control" placeholder="Ejemplo: Araucanía" id="region" name="region" value="{{ old('region') ?? @$usuario->usvi_region }}">
                    @if($errors->has('region'))
                        <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                            <strong>{{ $errors->first('region') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif
                </div>
                <div class="col-sm-6 col-lg-6">
                    <label class="form-label">País</label>
                    <input type="text" class="form-control" placeholder="Ejemplo: Chile" id="pais" name="pais" value="{{ old('pais') ?? @$usuario->usvi_pais }}">
                    @if($errors->has('pais'))
                        <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                            <strong>{{ $errors->first('pais') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif
                </div>

                <hr>

                <div class="col-sm-6 col-lg-6">
                    <label class="form-label">Profesión</label>
                    <input type="text" class="form-control" placeholder="Ejemplo: Ingeniera Comercial" id="profesion" name="profesion" value="{{ old('profesion') ?? @$usuario->usvi_profesion }}">
                    @if($errors->has('profesion'))
                        <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                            <strong>{{ $errors->first('profesion') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif
                </div>
                <div class="col-sm-6 col-lg-6">
                    <label class="form-label">Ocupación</label>
                    <input type="text" class="form-control" placeholder="Ejemplo: Coordinadora de Administración y Finanzas" id="ocupacion" name="ocupacion" value="{{ old('ocupacion') ?? @$usuario->usvi_ocupacion }}">
                    @if($errors->has('ocupacion'))
                        <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                            <strong>{{ $errors->first('ocupacion') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif
                </div>
                <div class="col-12">
                    <label class="form-label">Presentación</label>
                    <textarea class="form-control" rows="3" placeholder="Descripción atractiva para mostrar en su portada. Ejemplo: Apoyando continuamente el desarrollo regional en Vinculamos SpA" id="presentacion" name="presentacion" value="{{ old('presentacion') ?? @$usuario->usvi_presentacion }}"></textarea>
                    @if($errors->has('presentacion'))
                        <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                            <strong>{{ $errors->first('presentacion') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif
                </div>
                <div class="col-12">
                    <label class="form-label">Intereses</label>
                    <textarea class="form-control" rows="5" placeholder="Relación entre su ocupación laboral, profesión y vinculación con el medio" id="intereses" name="intereses" value="{{ old('intereses') ?? @$usuario->usvi_intereses }}"></textarea>
                    @if($errors->has('intereses'))
                        <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                            <strong>{{ $errors->first('intereses') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif
                </div>
                <div class="col-12">
                    <label class="form-label">Habilidades</label>
                    <textarea class="form-control" rows="5" placeholder="Habilidades personales y/o profesionales" id="habilidades" name="habilidades" value="{{ old('habilidades') ?? @$usuario->usvi_habilidades }}"></textarea>
                    @if($errors->has('habilidades'))
                        <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                            <strong>{{ $errors->first('habilidades') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif
                </div>
                <hr>

                <div class="row mt-3">
                    <div class="col-sm-2 col-lg-2"></div>
                    <div class="col-sm-8 col-lg-8 text-center">
                        <div class="mb-2">
                            <label for="">Foto de perfil</label>
                            @if(isset($usuario->usvi_foto))
                                <div class="row">
                                    <div class="col-sm-9 col-lg-9">
                                        <input class="form-control" type="file" id="foto" name="foto" accept=".png, .jpg, .jpeg" width="100" style="display: none;" onchange="document.getElementById('img-usvi-foto-nueva').src = window.URL.createObjectURL(this.files[0])">
                                        <img id="img-usvi-foto-nueva" class="mt-2" src="" alt="" width="200">
                                    </div>
                                    <div class="col-sm-3 col-lg-3">
                                        <button type="button" id="btn-cancelar-usvi-foto" class="btn btn-light" style="display: none;">Cancelar</button>
                                    </div>
                                </div>
                                <img id="img-usvi-foto" src="{{ asset('public/'.$usuario->usvi_foto.'?nocache='.time()) }}" alt="" width="200">
                                <button type="button" id="btn-cambiar-usvi-foto" class="btn btn-light mt-2">Cambiar foto</button>
                            @else
                                <input class="form-control" type="file" id="foto" name="foto" accept=".png, .jpg, .jpeg" onchange="document.getElementById('img-usvi-foto').src = window.URL.createObjectURL(this.files[0])">
                                <img id="img-usvi-foto" class="mt-2" src="" alt="" width="200">
                            @endif
                            @if($errors->has('foto'))
                                <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                                    <strong>{{ $errors->first('foto') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-2 col-lg-2"></div>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary mb-0">Guardar cambios</button>
                    <a href="{{ route('perfil.index') }}" type="button" class="btn btn-danger mb-0">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
