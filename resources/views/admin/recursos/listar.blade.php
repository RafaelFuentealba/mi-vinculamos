@extends('temas.paneladmin')

@section('contenido-administracion')

<div class="col-md-8 col-lg-6 vstack gap-4">
    <div class="card">
        <div class="card-header border-0 pb-0">
            <div class="row g-2">
                <div class="col-lg-6">
                    <h1 class="h4 card-title mb-lg-0">Tipos de recursos</h1>
                </div>
                <div class="col-sm-3 col-lg-3 ms-lg-auto"></div>
                <div class="col-sm-3 col-lg-3">
                    <a class="btn btn-primary-soft ms-auto w-100" href="{{ route('recursos.create') }}">
                        <i class="fa-solid fa-plus pe-1"></i> Nuevo recurso
                    </a>
                </div>
            </div>
            
            @if(Session::has('registrarTipoRecurso'))
                <div class="alert alert-success alert-dismissible fade show mt-2 mb-0 text-center" role="alert">
                    <strong>{{ Session::get('registrarTipoRecurso') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            @if(Session::has('actualizarTipoRecurso'))
                <div class="alert alert-success alert-dismissible fade show mt-2 mb-0 text-center" role="alert">
                    <strong>{{ Session::get('actualizarTipoRecurso') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            @if(Session::has('errorTipoRecurso'))
                <div class="alert alert-success alert-dismissible fade show mt-2 mb-0 text-center" role="alert">
                    <strong>{{ Session::get('errorTipoRecurso') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif
        </div>

        <div class="card-body">
            <div class="tab-content mb-0 pb-0">
                <div class="tab-pane fade show active">
                    <div class="row g-4">
                        @forelse ($recursos as $puntuacion)
                        <div class="col-sm-6 col-lg-6">
                            <div class="d-sm-flex align-items-center rounded border px-3 py-2">
                                <div class="mt-2 mt-sm-0">
                                    <h5 class="mb-1">
                                        {{ $puntuacion->pvin_nombre }} 
                                        @if ($puntuacion->pvin_vigente == 'S')
                                            <i class="bi bi-cloud-check-fill text-success small" title="Puntuación vigente"></i>
                                        @else
                                            <i class="bi bi-cloud-slash-fill text-danger small" title="Puntuación no vigente"></i>
                                        @endif
                                    </h5>
                                    <small> {{ $puntuacion->pvin_tabla_descripcion }} </small>
                                    <ul class="nav nav-stack small">
                                        <li class="nav-item">
                                            <i class="bi bi-table"></i> {{ $puntuacion->pvin_tabla_referencia }}
                                        </li>
                                        <li class="nav-item">
                                            <i class="bi bi-coin"></i> {{ $puntuacion->pvin_cantidad }}
                                        </li>
                                        <li class="nav-item">
                                            <i class="bi bi-calendar-check"></i>
                                            <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $fecha = ucwords(strftime('%b %d, %Y', strtotime($puntuacion->pvin_creado)));
                                                echo $fecha;
                                            ?>
                                        </li>
                                    </ul>
                                </div>
                                <div class="d-flex ms-auto pe-1">
                                    <div class="dropdown">
                                        <button class="icon-md btn btn-secondary-soft" type="button" id="profileAction" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileAction">
                                            <li><a class="dropdown-item" href="{{ route('vins.edit', $puntuacion->pvin_codigo) }}"> <i class="bi bi-pencil-fill fa-fw pe-2"></i>Editar</a></li>
                                            <li>
                                                @if ($puntuacion->pvin_vigente == 'N')
                                                    <form action="{{ route('vins.enable', $puntuacion->pvin_codigo) }}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <button class="dropdown-item" type="submit">
                                                            <i class="bi bi-check-lg fa-fw pe-2"></i>
                                                            Habilitar
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('vins.disable', $puntuacion->pvin_codigo) }}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <button class="dropdown-item" type="submit">
                                                            <i class="bi bi-x-lg fa-fw pe-2"></i>
                                                            Deshabilitar
                                                        </button>
                                                    </form>
                                                @endif
                                            </li>
                                            <li>
                                                <form action="{{ route('vins.destroy', $puntuacion->pvin_codigo) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="dropdown-item" type="submit">
                                                        <i class="bi bi-trash fa-fw pe-2"></i>
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2 text-center" role="alert">
                                <strong>No existen recursos definidos.</strong>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
