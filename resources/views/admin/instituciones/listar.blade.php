@extends('temas.paneladmin')

@section('contenido-administracion')

<div class="col-md-8 col-lg-6 vstack gap-4">
    <div class="card">
        <div class="card-header border-0 pb-0">
            <div class="row g-2">
                <div class="col-lg-3">
                    <h1 class="h4 card-title mb-lg-0">Instituciones</h1>
                </div>
                <div class="col-sm-6 col-lg-3 ms-lg-auto"></div>
                <div class="col-sm-6 col-lg-3">
                    <a class="btn btn-primary-soft ms-auto w-100" href="{{ route('instituciones.create') }}">
                        <i class="fa-solid fa-plus pe-1"></i> Nueva institución
                    </a>
                </div>
            </div>
            
            @if(Session::has('registrarInstitucion'))
                <div class="alert alert-success alert-dismissible fade show mt-2 mb-0 text-center" role="alert">
                    <strong>{{ Session::get('registrarInstitucion') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            @if(Session::has('eliminarInstitucion'))
                <div class="alert alert-success alert-dismissible fade show mt-2 mb-0 text-center" role="alert">
                    <strong>{{ Session::get('eliminarInstitucion') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif
        </div>

        <div class="card-body">
            <div class="tab-content mb-0 pb-0">
                <div class="tab-pane fade show active">
                    <div class="row g-4">
                        @forelse ($instituciones as $institucion)
                            <div class="col-sm-6 col-lg-4">
                                <div class="card">
                                    <div class="h-80px rounded-top" style="background-image:url({{ asset('public/'.$institucion->inst_logo.'?nocache='.time()) }}); background-position: center; background-size: cover; background-repeat: no-repeat;">
                                    </div>
                                    <div class="card-body text-center pt-0">
                                        <div class="avatar avatar-lg mt-n5 mb-3">
                                            <a href="{{ route('instituciones.show', $institucion->inst_codigo) }}">
                                                <img class="avatar-img rounded-circle border border-white border-3 bg-white" src="{{ asset('public/'.$institucion->inst_logo.'?nocache='.time()) }}" alt="">
                                            </a>
                                        </div>
                                        <h5 class="mb-0">
                                            <a href="{{ route('instituciones.show', $institucion->inst_codigo) }}">{{ $institucion->inst_nombre }}</a>
                                            @if ($institucion->inst_vigente == 'S')
                                                <i class="bi bi-cloud-check-fill text-success small" title="Institución habilitada"></i>
                                            @else
                                                <i class="bi bi-cloud-slash-fill text-danger small" title="Institución deshabilitada"></i>
                                            @endif
                                        </h5>
                                        <small> <i class="bi bi-geo-alt"></i> {{ $institucion->inst_comuna=='' && $institucion->inst_pais=='' ? 'Ubicación no definida' : $institucion->inst_comuna.', '.$institucion->inst_pais}} </small>
                                        <div class="hstack gap-2 gap-xl-3 justify-content-center mt-3">
                                            <div>
                                                <h6 class="mb-0">
                                                    @php
                                                        $contadorUsuarios = 0;
                                                    @endphp
                                                    @foreach ($usuarios as $miembro)
                                                        @if ($miembro->inst_codigo == $institucion->inst_codigo)
                                                            @php
                                                                $contadorUsuarios++;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    {{ $contadorUsuarios }}
                                                </h6>
                                                <small>Usuarios</small>
                                            </div>
                                            <div class="vr"></div>
                                            <div>
                                                <h6 class="mb-0">20</h6>
                                                <small>Visitas</small>
                                            </div>
                                        </div>
                                        <ul
                                            class="avatar-group list-unstyled align-items-center justify-content-center mb-0 mt-3">
                                            <li class="avatar avatar-xs">
                                                <img class="avatar-img rounded-circle" src="{{ asset('public/'.$institucion->inst_logo.'?nocache='.time()) }}" alt="avatar">
                                            </li>
                                            <li class="avatar avatar-xs">
                                                <img class="avatar-img rounded-circle" src="{{ asset('public/'.$institucion->inst_logo.'?nocache='.time()) }}" alt="avatar">
                                            </li>
                                            <li class="avatar avatar-xs">
                                                <img class="avatar-img rounded-circle" src="{{ asset('public/'.$institucion->inst_logo.'?nocache='.time()) }}" alt="avatar">
                                            </li>
                                            <li class="avatar avatar-xs">
                                                <img class="avatar-img rounded-circle" src="{{ asset('public/'.$institucion->inst_logo.'?nocache='.time()) }}" alt="avatar">
                                            </li>
                                            <li class="avatar avatar-xs">
                                                <div class="avatar-img rounded-circle bg-primary">
                                                    <span class="smaller text-white position-absolute top-50 start-50 translate-middle">+22</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2 text-center" role="alert">
                                <strong>No existen instituciones registradas.</strong>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
