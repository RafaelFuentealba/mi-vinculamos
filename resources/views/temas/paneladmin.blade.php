@extends('temas.baseusuario')

@section('panel-izquierdo')

<div class="col-lg-3">

    <div class="d-flex align-items-center mb-4 d-lg-none">
        <button class="border-0 bg-transparent" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <i class="btn btn-primary fw-bold fa-solid fa-sliders"></i>
            <span class="h6 mb-0 fw-bold d-lg-none ms-2">Administración</span>
        </button>
    </div>

    <nav class="navbar navbar-light navbar-expand-lg mx-0">
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
            <div class="offcanvas-header">
                <button type="button" class="btn-close text-reset ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body p-0">
                <div class="card w-100">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-pills nav-pills-soft flex-column fw-bold gap-2 border-0">
                            <li class="nav-item">
                            @if (Route::is('instituciones.index') || Route::is('instituciones.create') || Route::is('instituciones.show') || Route::is('instituciones.edit'))
                                <a class="nav-link active d-flex mb-0" href="{{ route('instituciones.index') }}">
                                    <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/icon/university.png') }}" alt="">
                                    <span>Instituciones </span>
                                </a>
                            @else
                                <a class="nav-link d-flex mb-0" href="{{ route('instituciones.index') }}">
                                    <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/icon/university.png') }}" alt="">
                                    <span>Instituciones </span>
                                </a>
                            @endif
                            </li>
                            <li class="nav-item">
                            @if (Route::is('usuarios.index') || Route::is('usuarios.institucion.index') || Route::is('usuarios.show') || Route::is('usuarios.edit'))
                                <a class="nav-link active d-flex mb-0" href="{{ route('usuarios.index') }}">
                                    <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/icon/users.png') }}" alt="">
                                    <span>Usuarios </span>
                                </a>
                            @else
                                <a class="nav-link d-flex mb-0" href="{{ route('usuarios.index') }}">
                                    <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/icon/users.png') }}" alt="">
                                    <span>Usuarios </span>
                                </a>
                            @endif
                            </li>
                            <li class="nav-item">
                                @if (Route::is('vins.index') || Route::is('vins.create') || Route::is('vins.edit'))
                                    <a class="nav-link active d-flex mb-0" href="{{ route('vins.index') }}">
                                        <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/icon/vins.png') }}" alt="">
                                        <span>VINS </span>
                                    </a>
                                @else
                                    <a class="nav-link d-flex mb-0" href="{{ route('vins.index') }}">
                                        <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/icon/vins.png') }}" alt="">
                                        <span>VINS </span>
                                    </a>
                                @endif                                
                            </li>
                            <li class="nav-item">
                                @if (Route::is('recursos.index') || Route::is('recursos.create'))
                                    <a class="nav-link active d-flex mb-0" href="{{ route('recursos.index') }}">
                                        <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/icon/resources.png') }}" alt="">
                                        <span>Tipo de recursos </span>
                                    </a>
                                @else
                                    <a class="nav-link d-flex mb-0" href="{{ route('recursos.index') }}">
                                        <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/icon/resources.png') }}" alt="">
                                        <span>Tipo de recursos </span>
                                    </a>                                    
                                @endif
                                
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex mb-0" href="#nav-setting-tab-3">
                                    <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/icon/reactions.png') }}" alt="">
                                    <span>Tipo de reacciones </span>
                                </a>
                            </li>
                        </ul>

                    </div>
                    <div class="card-footer text-center py-2">
                        <a class="btn btn-link text-secondary btn-sm" href="javascript:void(0);">Ver mi perfil</a>
                    </div>
                </div>
            </div>

        </div>
    </nav>
</div>

@yield('contenido-administracion')
    
@endsection