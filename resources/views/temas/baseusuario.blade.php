<!DOCTYPE html>
<html lang="es">

<head>
    <title>Mi Vinculamos</title>

    <!-- meta etiquetas -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Webestica.com">
    <meta name="description" content="Bootstrap 5 based Social Media Network and Community Theme">
    <meta http-equiv="cache-control" content="timestamp" />
    

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('public/images/logo_01.png') }}">

    <!-- Fuentes Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">

    <!-- Complementos CSS inicio -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/vendor/OverlayScrollbars-master/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/vendor/tiny-slider/dist/tiny-slider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/vendor/choices.js/public/assets/styles/choices.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/vendor/glightbox-master/dist/css/glightbox.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/vendor/dropzone/dist/dropzone.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/vendor/flatpickr/dist/flatpickr.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/vendor/plyr/plyr.css') }}" />

    <!-- Temas CSS -->
    <link id="style-switch" rel="stylesheet" type="text/css" href="{{ asset('public/css/style.css') }}">

</head>

<body>

    <!-- inicio HEADER -->
    <header class="navbar-light fixed-top header-static bg-mode">

        <!-- inicio barra navegación -->
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- inicio logo -->
                <a class="navbar-brand" href="{{ route('usuario.inicio') }}">
                    <img class="light-mode-item navbar-brand-item" src="{{ asset('public/images/logo_01.png') }}" alt="logo">
                    <img class="dark-mode-item navbar-brand-item" src="{{ asset('public/images/logo.svg') }}" alt="logo">
                </a>
                <!-- fin logo -->

                <!-- inicio barra de navegación responsiva y plegable -->
                <button class="navbar-toggler ms-auto icon-md btn btn-light p-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-animation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
                <!-- fin barra de navegación responsiva y plegable -->

                <!-- inicio barra de navegación principal -->
                <div class="collapse navbar-collapse" id="navbarCollapse">

                    <!-- inicio barra de búsqueda -->
                    <div class="nav mt-3 mt-lg-0 flex-nowrap align-items-center px-4 px-lg-0">
                        <div class="nav-item w-100">
                            <form class="rounded position-relative">
                                <input class="form-control ps-5 bg-light" type="search" placeholder="Buscar..." aria-label="Search">
                                <button class="btn bg-transparent px-2 py-0 position-absolute top-50 start-0 translate-middle-y" type="submit"><i class="bi bi-search fs-5"> </i></button>
                            </form>
                        </div>
                    </div>
                    <!-- fin barra de búsqueda -->

                    <ul class="navbar-nav navbar-nav-scroll ms-auto">

                        <!--<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="homeMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Vinculamos</a>
						<ul class="dropdown-menu" aria-labelledby="homeMenu">
							<li> <a class="dropdown-item" href="javascript:void(0);">¿Cómo funciona?</a></li>
							<li class="dropdown-submenu dropend"> 
                <a class="dropdown-item dropdown-toggle" href="#!">¿Qué mide?</a>
								<ul class="dropdown-menu" data-bs-popper="none">
                  <li> <a class="dropdown-item" href="javascript:void(0);">Resultados</a></li>
                  <li> <a class="dropdown-item" href="javascript:void(0);">Impactos</a></li>
                  <li> <a class="dropdown-item" href="javascript:void(0);">ODS</a></li>
								  <li> <a class="dropdown-item" href="javascript:void(0);">Bidireccionalidad</a></li>
                  <li> <a class="dropdown-item" href="javascript:void(0);">Pertinencia</a></li>
								</ul>
							</li>
						</ul>
					</li>

          <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="pagesMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mi Red</a>
						<ul class="dropdown-menu" aria-labelledby="pagesMenu">
							<li> <a class="dropdown-item" href="javascript:void(0);">Contactos</a></li>
							<li> <a class="dropdown-item" href="javascript:void(0);">Instituciones</a></li>
              <li> <a class="dropdown-item" href="javascript:void(0);">Interacciones</a></li>
              <li> <a class="dropdown-item" href="javascript:void(0);">Colaboraciones</a></li>
              <li> <a class="dropdown-item" href="javascript:void(0);">VINS</a></li>
						</ul>
					</li>-->

                    </ul>
                </div>
                <!-- fin barra de navegación principal -->

                <!-- inicio navegación panel derecho -->
                <ul class="nav flex-nowrap align-items-center ms-sm-3 list-unstyled">
                    <li class="nav-item ms-2">
                        <a class="nav-link icon-md btn btn-light p-0" href="javascript:void(0);">
                            <i class="bi bi-house-fill fs-6"> </i>
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link icon-md btn btn-light p-0" href="javascript:void(0);">
                            <i class="bi bi-chat-left-text-fill fs-6"> </i>
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link icon-md btn btn-light p-0" href="javascript:void(0);">
                            <i class="bi bi-gear-fill fs-6"> </i>
                        </a>
                    </li>
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link icon-md btn btn-light p-0" href="#" id="notifDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                            <span class="badge-notif animation-blink"></span>
                            <i class="bi bi-bell-fill fs-6"> </i>
                        </a>
                        <div class="dropdown-menu dropdown-animation dropdown-menu-end dropdown-menu-size-md p-0 shadow-lg border-0" aria-labelledby="notifDropdown">
                        </div>
                    </li>

                    <li class="nav-item ms-2 dropdown">
                        <a class="nav-link btn icon-md p-0" href="#" id="profileDropdown" role="button"
                            data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img class="avatar-img rounded-2" src="{{ asset('public/images/avatar/07.jpg') }}" alt="">
                        </a>
                        <ul class="dropdown-menu dropdown-animation dropdown-menu-end pt-3 small me-md-n3"
                            aria-labelledby="profileDropdown">
                            <!-- Información del perfil -->
                            <li class="px-3">
                                <div class="d-flex align-items-center position-relative">
                                    <!-- Avatar -->
                                    <div class="avatar me-3">
                                        <img class="avatar-img rounded-circle" src="{{ asset('public/images/avatar/07.jpg') }}" alt="avatar">
                                    </div>
                                    <div>
                                        <a class="h6 stretched-link" href="javascript:void(0);">
                                            @if(Session::has('usuario'))
                                                {{ Session::get('usuario.usvi_nombre') . ' ' . Session::get('usuario.usvi_apellido') }}
                                            @endif
                                        </a>
                                        <p class="small m-0">Web Developer</p>
                                    </div>
                                </div>
                                <a class="dropdown-item btn btn-primary-soft btn-sm my-2 text-center" href="{{ route('perfil.index') }}">Ver perfil</a>
                            </li>
                            <!-- Enlaces -->
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);">
                                    <i class="bi bi-gear fa-fw me-2"></i>Configuración
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);">
                                    <i class="fa-fw bi bi-info-circle me-2"></i>Soporte
                                </a>
                            </li>
                            @if (Session::get('usuario.usvi_superadmin') == 'S')
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.inicio') }}">
                                    <i class="fa-fw bi bi-person-fill-gear me-2"></i>Administración
                                </a>
                            </li>
                            @endif
                            <li class="dropdown-divider"></li>
                            @if(Session::has('usuario'))
                                <li>
                                    <a class="dropdown-item bg-danger-soft-hover" href="{{ route('auth.cerrar') }}">
                                        <i class="bi bi-power fa-fw me-2"></i>
                                        Cerrar sesión
                                    </a>
                                </li>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <!-- inicio cambiar a modo oscuro -->
                            <li>
                                <div class="modeswitch-wrap" id="darkModeSwitch">
                                    <div class="modeswitch-item">
                                        <div class="modeswitch-icon"></div>
                                    </div>
                                    <span>Dark mode</span>
                                </div>
                            </li>
                            <!-- fin cambiar a modo oscuro -->
                        </ul>
                    </li>

                </ul>
                <!-- fin navegación panel derecho -->
            </div>
        </nav>
        <!-- fin barra de navegación -->
    </header>
    <!-- fin header -->

    <!-- **************** INICIO CONTENIDO PRINCIPAL **************** -->
    <main>

        <div class="container">
            <div class="row g-4">

                <!-- inicio panel izquierdo -->
                @yield('panel-izquierdo')
                <!-- fin panel izquierdo -->

                <!-- inicio contenido principal -->
                @yield('contenido-principal')
                <!-- fin contenido principal -->

            </div>
        </div>

    </main>
    <!-- **************** FIN CONTENIDO PRINCIPAL **************** -->


    <!-- ======================= librerías JS, complementos y archivos personalizados -->

    <!-- archivo JS Bootstrap -->
    <script src="{{ asset('public/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Complementos -->
    <script src="{{ asset('public/vendor/tiny-slider/dist/tiny-slider.js') }}"></script>
    <script src="{{ asset('public/vendor/OverlayScrollbars-master/js/OverlayScrollbars.min.js') }}"></script>
	<script src="{{ asset('public/vendor/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('public/vendor/glightbox-master/dist/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('public/vendor/flatpickr/dist/flatpickr.min.js') }}"></script>
    <script src="{{ asset('public/vendor/plyr/plyr.js') }}"></script>
    <script src="{{ asset('public/vendor/dropzone/dist/min/dropzone.min.js') }}"></script>
    
    <!-- Funciones base -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ asset('public/js/functions.js') }}"></script>
    <script src="{{ asset('public/js/admin/funciones_institucion.js') }}"></script>
    <script src="{{ asset('public/js/admin/funciones_usuarios.js') }}"></script>
    <script src="{{ asset('public/js/principal/funciones_usuarios.js') }}"></script>

</body>

</html>
