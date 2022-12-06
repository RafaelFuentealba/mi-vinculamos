<!-- inicio panel principal izquierdo -->
<div class="col-lg-3">

    <!-- inicio alternador de respuesta de filtro avanzado -->
    <div class="d-flex align-items-center d-lg-none">
        <button class="border-0 bg-transparent" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSideNavbar" aria-controls="offcanvasSideNavbar">
            <i class="btn btn-primary fw-bold fa-solid fa-sliders-h"></i>
            <span class="h6 mb-0 fw-bold d-lg-none ms-2">Mi perfil</span>
        </button>
    </div>
    <!-- fin alternador de respuesta de filtro avanzado -->

    <!-- inicio barra de navegación panel izquierdo -->
    <nav class="navbar navbar-expand-lg mx-0">
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSideNavbar">
            <!-- lienzo header -->
            <div class="offcanvas-header">
                <button type="button" class="btn-close text-reset ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <!-- lienzo body -->
            <div class="offcanvas-body d-block px-2 px-lg-0">
                <div class="card overflow-hidden">
                    <div class="h-50px" style="background-image:url(assets/images/bg/01.jpg); background-position: center; background-size: cover; background-repeat: no-repeat;">
                    </div>
                    <div class="card-body pt-0">
                        <div class="text-center">
                            <div class="avatar avatar-lg mt-n5 mb-3">
                                <a href="#!">
                                    <img class="avatar-img rounded border border-white border-3" src="{{ asset('public/images/avatar/07.jpg') }}" alt="">
                                </a>
                            </div>
                            <h5 class="mb-0"> <a href="javascript:void(0)">{{ $usuario->usvi_nombre }} {{ $usuario->usvi_apellido }}</a> </h5>
                            <small>
                                @if ($usuario->usvi_ocupacion == '')
                                    Ocupación no definido
                                @else
                                    {{ $usuario->usvi_ocupacion }}
                                @endif
                            </small>
                            <p class="mt-3">
                                @if ($usuario->usvi_presentacion == '')
                                    Presentación no definido
                                @else
                                    {{ $usuario->usvi_presentacion }}
                                @endif
                            </p>

                            <div class="hstack gap-2 gap-xl-3 justify-content-center">
                                <div style="margin-right:-5px;">
                                    <h6 class="mb-0"><a href="">256</a></h6>
                                    <small>Interacción</small>
                                </div>
                                <div class="vr"></div>
                                <div style="margin-left:-5px; margin-right:-5px;">
                                    <h6 class="mb-0"><a href="">2.5K</a></h6>
                                    <small>Colaboración</small>
                                </div>
                                <div class="vr"></div>
                                <div style="margin-left:-5px;">
                                    <h6 class="mb-0">
                                        <a href="javascript:void(0)">
                                            @if ($usuario->usvi_vins == '')
                                                0
                                            @else
                                                {{ $usuario->usvi_vins }}
                                            @endif
                                        </a>
                                    </h6>
                                    <small>VINS</small>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- inicio opciones de navegación panel izquierdo -->
                        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);">
                                    <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/icon/networking.png') }}" alt="">
                                    <span>Mi red</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);">
                                    <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/icon/completed-task.png') }}" alt="">
                                    <span>Mis iniciativas </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);">
                                    <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/icon/velocimetro.png') }}" alt="">
                                    <span>Mi INVI </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);">
                                    <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/icon/earth-globe.png') }}" alt="">
                                    <span>Mis ODS </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);">
                                    <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/icon/planner.png') }}" alt="">
                                    <span>Eventos </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);">
                                    <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/icon/profits.png') }}" alt="">
                                    <span>Financiamientos </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);">
                                    <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/icon/online-learning.png') }}" alt="">
                                    <span>Formación </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                @if(Route::is('usuario.vinculamos'))
                                    <a class="nav-link active"
                                        href="{{ route('usuario.vinculamos') }}">
                                        <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/logo_01.png') }}" alt="">
                                        <span>Vinculamos </span>
                                    </a>
                                @else
                                    <a class="nav-link" href="{{ route('usuario.vinculamos') }}">
                                        <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/logo_01.png') }}" alt="">
                                        <span>Vinculamos </span>
                                    </a>
                                @endif
                            </li>
                            <li class="nav-item">
                                @if(Route::is('usuario.normativas'))
                                    <a class="nav-link active" href="{{ route('usuario.normativas') }}">
                                        <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/icon/certificate.png') }}" alt="">
                                        <span>Normativas </span>
                                    </a>
                                @else
                                    <a class="nav-link" href="{{ route('usuario.normativas') }}">
                                        <img class="me-2 h-20px fa-fw" src="{{ asset('public/images/icon/certificate.png') }}" alt="">
                                        <span>Normativas </span>
                                    </a>
                                @endif
                            </li>
                        </ul>
                        <!-- fin opciones de navegación panel izquierdo -->
                    </div>
                    <div class="card-footer text-center py-2">
                        <a class="btn btn-link btn-sm" href="{{ route('perfil.index') }}">Ver Perfil </a>
                    </div>
                </div>

                <ul class="nav small mt-4 justify-content-center lh-1">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">Acerca de</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">Configuración</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="https://support.webestica.com/login">Soporte </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">Ayuda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">Privacidad & términos</a>
                    </li>
                </ul>
                <p class="small text-center mt-1">©2022
                    <a class="text-body" target="_blank" href="https://www.webestica.com/"> Webestica </a>
                </p>
            </div>
        </div>
    </nav>
    <!-- fin barra de navegación panel izquierdo -->
</div>
<!-- fin panel principal izquierdo -->
