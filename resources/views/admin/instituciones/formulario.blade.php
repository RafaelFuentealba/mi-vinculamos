@extends('temas.paneladmin')

@section('contenido-administracion')

<div class="col-md-8 col-lg-6 vstack gap-4">
    <div class="card">
        <div class="card-header border-0 pb-0">
            @if(isset($institucion))
                <h1 class="h4 card-title mb-4">Editar institución</h1>
            @else
                <h1 class="h4 card-title mb-4">Crear nueva institución</h1>
            @endif
        </div>
        <div class="card-body">
            @if(isset($institucion))
                <form class="row g-3" action="{{ route('instituciones.update', $institucion->inst_codigo) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
            @else
                <form class="row g-3" action="{{ route('instituciones.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
            @endif

            @if(Session::has('errorLogo'))
                <div class="alert alert-danger alert-dismissible fade show mt-2 mb-2 text-center" role="alert">
                    <strong>{{ Session::get('errorLogo') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            @if(Session::has('errorInstitucion'))
                <div class="alert alert-danger alert-dismissible fade show mt-2 mb-2 text-center" role="alert">
                    <strong>{{ Session::get('errorInstitucion') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            <div class="col-12">
                <label class="form-label">Nombre de la institución</label>
                <input type="text" class="form-control" placeholder="Ejemplo: Centro de Formación Técnica San Agustín" id="nombre" name="nombre" value="{{ old('nombre') ?? @$institucion->inst_nombre }}">
                @if($errors->has('nombre'))
                    <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong>{{ $errors->first('nombre') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif
            </div>
            <div class="col-sm-6 col-lg-6">
                <label class="form-label">Tipo de institución</label>
                @if(isset($institucion))
                    <select class="form-select js-choice" id="tipo" name="tipo">
                        <option value="universidad" {{ @$institucion->inst_tipo == 'universidad' ? 'selected' : '' }}> Universidad </option>
                        <option value="cft" {{ @$institucion->inst_tipo == 'cft' ? 'selected' : '' }}> Centro de Formación Técnica </option>
                        <option value="ip" {{ @$institucion->inst_tipo == 'ip' ? 'selected' : '' }}> Instituto Profesional </option>
                    </select>
                @else
                    <select class="form-select js-choice" id="tipo" name="tipo">
                        <option value="universidad">Universidad</option>
                        <option value="cft">Centro de Formación Técnica</option>
                        <option value="ip">Instituto Profesional</option>
                    </select>
                @endif

                @if($errors->has('tipo'))
                    <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong>{{ $errors->first('tipo') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif
            </div>
            <div class="col-sm-6 col-lg-6">
                <label class="form-label">Código de institución</label>
                @if(isset($institucion))
                    <input type="text" class="form-control" placeholder="Ejemplo: cftsanagustin" id="codigo" name="codigo" value="{{ $institucion->inst_codigo }}" readonly="readonly">
                @else
                    <input type="text" class="form-control" placeholder="Ejemplo: cftsanagustin" id="codigo" name="codigo" value="{{ old('codigo') }}">
                @endif
                @if($errors->has('codigo'))
                    <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong>{{ $errors->first('codigo') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif
            </div>

            <hr>

            <div class="col-sm-4 col-lg-4">
                <label class="form-label">País</label>
                <input type="text" class="form-control" placeholder="Ejemplo: Chile" id="pais" name="pais" value="{{ old('pais') ?? @$institucion->inst_pais }}">
                @if($errors->has('pais'))
                    <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong>{{ $errors->first('pais') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif
            </div>
            <div class="col-sm-4 col-lg-4">
                <label class="form-label">Región</label>
                <input type="text" class="form-control" placeholder="Ejemplo: Maule" id="region" name="region" value="{{ old('region') ?? @$institucion->inst_region }}">
                @if($errors->has('region'))
                    <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong>{{ $errors->first('region') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif
            </div>
            <div class="col-sm-4 col-lg-4">
                <label class="form-label">Provincia</label>
                <input type="text" class="form-control" placeholder="Ejemplo: Talca" id="provincia" name="provincia" value="{{ old('provincia') ?? @$institucion->inst_provincia }}">
                @if($errors->has('provincia'))
                    <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong>{{ $errors->first('provincia') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif
            </div>
            <div class="col-sm-4 col-lg-4">
                <label class="form-label">Comuna</label>
                <input type="text" class="form-control" placeholder="Ejemplo: Talca" id="comuna" name="comuna" value="{{ old('comuna') ?? @$institucion->inst_comuna }}">
                @if($errors->has('comuna'))
                    <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong>{{ $errors->first('comuna') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif
            </div>
            <div class="col-sm-8 col-lg-8">
                <label class="form-label">Dirección Sede Central</label>
                <input type="text" class="form-control" placeholder="Ejemplo: 4 Poniente, 1233" id="direccion" name="direccion" value="{{ old('direccion') ?? @$institucion->inst_direccion }}">
                @if($errors->has('direccion'))
                    <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong>{{ $errors->first('direccion') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif
            </div>

            <hr>

            <div class="col-sm-4 col-lg-4">
                <label class="form-label">Contacto</label>
                <input type="text" class="form-control" placeholder="Ejemplo: 71 223 38 39" id="contacto" name="contacto" value="{{ old('contacto') ?? @$institucion->inst_contacto }}">
                @if($errors->has('contacto'))
                    <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong>{{ $errors->first('contacto') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif
            </div>
            <div class="col-sm-8 col-lg-8">
                <label class="form-label">Sitio web</label>
                <input type="text" class="form-control" placeholder="Ejemplo: https://www.cftsanagustin.cl/" id="sitioweb" name="sitioweb" value="{{ old('sitioweb') ?? @$institucion->inst_url_web }}">
                @if($errors->has('sitioweb'))
                    <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong>{{ $errors->first('sitioweb') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif
            </div>

            <div class="col-sm-2 col-lg-2"></div>
            <div class="col-sm-8 col-lg-8 text-center">
                <div class="mb-2">
                    <label for="">Logo oficial</label>
                    @if(isset($institucion->inst_logo))
                        <div class="row text-center">
                            <div class="col-sm-9 col-lg-9">
                                <input class="form-control" type="file" id="logo" name="logo" accept=".png, .jpg, .jpeg" width="100" style="display: none;" onchange="document.getElementById('img-logo-nuevo').src = window.URL.createObjectURL(this.files[0])">
                                <img id="img-logo-nuevo" class="mt-2" src="" alt="" width="200">
                            </div>
                            <div class="col-sm-3 col-lg-3">
                                <button type="button" id="btn-cancelar-logo" class="btn btn-light" style="display: none;">Cancelar</button>
                            </div>
                        </div>
                        <img id="img-logo" src="{{ asset('public/'.$institucion->inst_logo.'?nocache='.time()) }}" alt="" width="200">
                        <button type="button" id="btn-cambiar-logo" class="btn btn-light">Cambiar logo</button>
                    @else
                        <input class="form-control" type="file" id="logo" name="logo" accept=".png, .jpg, .jpeg" onchange="document.getElementById('img-logo').src = window.URL.createObjectURL(this.files[0])">
                        <img id="img-logo" class="mt-2" src="" alt="" width="200">
                    @endif
                    @if($errors->has('logo'))
                        <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                            <strong>{{ $errors->first('logo') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-sm-2 col-lg-2"></div>

            <div class="col-12 text-end">
                @if(isset($institucion))
                    <button type="submit" class="btn btn-primary mb-0">Actualizar institución</button>
                    <a href="{{ route('instituciones.show', $institucion->inst_codigo) }}" class="btn btn-danger mb-0">Cancelar</a>
                @else
                    <button type="submit" class="btn btn-primary mb-0">Crear institución</button>
                    <a href="{{ route('instituciones.index') }}" class="btn btn-danger mb-0">Cancelar</a>
                @endif
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
