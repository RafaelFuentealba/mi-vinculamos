@extends('temas.paneladmin')

@section('contenido-administracion')

<div class="col-md-8 col-lg-6 vstack gap-4">
    <div class="card">
        <div class="card-header border-0 pb-0">
            @if(isset($puntuacion))
                <h1 class="h4 card-title mb-4">Editar puntuación VINS</h1>
            @else
                <h1 class="h4 card-title mb-4">Crear puntuación VINS</h1>
            @endif
        </div>
        <div class="card-body">
            @if(isset($puntuacion))
                <form class="row g-3" action="{{ route('vins.update', $puntuacion->pvin_codigo) }}" method="POST">
                    @method('PUT')
                    @csrf
            @else
                <form class="row g-3" action="{{ route('vins.store') }}" method="POST">
                    @csrf
            @endif

            @if(Session::has('errorPuntuacion'))
                <div class="alert alert-danger alert-dismissible fade show mt-2 mb-2 text-center" role="alert">
                    <strong>{{ Session::get('errorPuntuacion') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            <div class="col-12">
                <label class="form-label">Nombre de la puntuación</label>
                <input type="text" class="form-control" placeholder="Ejemplo: Puntuación de financiamientos" id="nombre" name="nombre" value="{{ old('nombre') ?? @$puntuacion->pvin_nombre }}">
                @if($errors->has('nombre'))
                    <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong>{{ $errors->first('nombre') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif
            </div>
            <div class="col-sm-6 col-lg-6">
                <label class="form-label">Tabla de referencia</label>
                @if (isset($puntuacion))
                    <input type="text" class="form-control" id="tabla" name="tabla" value="{{ $puntuacion->pvin_tabla_referencia }}" disabled>
                @else
                    <?php $tablasPuntuaciones = []; ?>
                    @if(isset($tablasRegistradas))
                        <?php
                        foreach ($tablasRegistradas as $tabla) {
                            array_push($tablasPuntuaciones, $tabla->pvin_tabla_referencia);
                        }
                        ?>
                    @endif
                        <select class="form-select js-choice" id="tabla" name="tabla">
                            <option value="" selected disabled> Seleccione... </option>
                            @if (!in_array('publicaciones', $tablasPuntuaciones))
                                <option value="publicaciones" {{ old('tabla') == 'publicaciones' ? 'selected' : '' }}> Publicaciones </option>
                            @endif
                            @if (!in_array('eventos', $tablasPuntuaciones))
                                <option value="eventos" {{ old('tabla') == 'eventos' ? 'selected' : '' }}> Eventos </option>                            
                            @endif
                            @if (!in_array('financiamientos', $tablasPuntuaciones))
                                <option value="financiamientos" {{ old('tabla') == 'financiamientos' ? 'selected' : '' }}> Financiamientos </option>
                            @endif
                            @if (!in_array('cursos', $tablasPuntuaciones))
                                <option value="cursos" {{ old('tabla') == 'cursos' ? 'selected' : '' }}> Cursos </option>
                            @endif
                        </select>
                    
                    @if($errors->has('tabla'))
                        <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                            <strong>{{ $errors->first('tabla') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif
                @endif
            </div>
            <div class="col-sm-6 col-lg-6">
                <label class="form-label">Valor puntuación</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ old('cantidad') ?? @$puntuacion->pvin_cantidad }}" min="0" step="1">
                @if($errors->has('cantidad'))
                    <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong>{{ $errors->first('cantidad') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif
            </div>
            <div class="col-12">
                <label class="form-label">Descripción de puntuación</label>
                <textarea class="form-control" rows="5" placeholder="Ejemplo: Puntaje asignado por compartir fuentes de financiamiento." id="descripcion" name="descripcion">{{ old('descripcion') ?? @$puntuacion->pvin_tabla_descripcion }}</textarea>
                @if($errors->has('descripcion'))
                    <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong>{{ $errors->first('descripcion') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif
            </div>

            <div class="col-12 text-end">
                @if(isset($puntuacion))
                    <button type="submit" class="btn btn-primary mb-0">Actualizar puntaje</button>
                @else
                    <button type="submit" class="btn btn-primary mb-0">Crear puntaje</button>
                @endif
                <a href="{{ route('vins.index') }}" class="btn btn-danger mb-0">Cancelar</a>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
