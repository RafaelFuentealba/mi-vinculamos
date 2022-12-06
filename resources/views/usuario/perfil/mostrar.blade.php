@extends('temas.baseusuario')

@section('contenido-principal')

<!-- Complementos CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('public/vendor/dropzone/dist/dropzone.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/vendor/glightbox-master/dist/css/glightbox.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/vendor/choices.js/public/assets/styles/choices.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/vendor/flatpickr/dist/flatpickr.min.css') }}">

<div class="col-lg-8 vstack gap-4">
    @if(Session::has('actualizarUsuario'))
        <div class="alert alert-success alert-dismissible fade show mt-0 mb-2 text-center" role="alert">
            <strong>{{ Session::get('actualizarUsuario') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="card">
        <div class="h-200px rounded-top" style="background-image:url({{ asset('public/'.$institucion->inst_logo.'?nocache='.time()) }}); background-position: center; background-size: cover; background-repeat: no-repeat;">
        </div>
        
        <div class="card-body py-0">
            <div class="d-sm-flex align-items-start text-center text-sm-start">
                <div>
                    <div class="avatar avatar-xxl mt-n5 mb-3">
                        <img class="avatar-img rounded-circle border border-white border-3" src="{{ asset('public/'.$usuario->usvi_foto.'?nocache='.time()) }}" alt="">
                    </div>
                </div>
                
                <div class="ms-sm-4 mt-sm-3">
                    <h1 class="mb-0 h5">{{ $usuario->usvi_nombre . ' ' . $usuario->usvi_apellido }}
                        @if ($usuario->usvi_vigente == 'S')
                            <i class="bi bi-person-check-fill text-success small" title="Usuario habilitado"></i>
                        @else
                            <i class="bi bi-person-x-fill text-danger small" title="Usuario deshabilitado"></i>    
                        @endif
                    </h1>
                    <p> {{ $usuario->usvi_vins == '' ? '0' : $usuario->usvi_vins }} VINS</p>
                </div>
                
                <div class="d-flex mt-3 justify-content-center ms-sm-auto">
                    <a href="{{ route('perfil.edit') }}"  class="btn btn-danger-soft me-2" type="button"> <i class="bi bi-pencil-fill pe-1"></i> Editar perfil </a>
                    <div class="dropdown">
                        <button class="icon-md btn btn-light" type="button" id="profileAction2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileAction2">
                            <li><a class="dropdown-item" href="javascript:void(0);"> <i class="bi bi-file-earmark-pdf fa-fw pe-2"></i>Guardar perfil como PDF</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);"> <i class="bi bi-gear fa-fw pe-2"></i>Configuraciones de perfil</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <ul class="list-inline mb-0 text-center text-sm-start mt-3 mt-sm-0">
                <li class="list-inline-item"><i class="bi bi-briefcase"></i>
                    @if ($usuario->usvi_ocupacion == '')
                        Ocupación no definido 
                    @else
                        {{ $usuario->usvi_ocupacion }}
                    @endif
                </li>
                <li class="list-inline-item"><i class="bi bi-geo-alt"></i>
                    @if ($usuario->usvi_comuna == '')
                        Ciudad no definido
                    @else
                        {{ $usuario->usvi_comuna }}
                    @endif
                </li>
                <li class="list-inline-item"><i class="bi bi-calendar2-plus"></i> Creado en 
                    @if ($usuario->usvi_creado == '')
                        no definido
                    @else
                        <?php
                            setlocale(LC_TIME, 'spanish');
                            $fecha = ucwords(strftime('%b %d, %Y', strtotime(Session::get('usuario.usvi_creado'))));
                            echo $fecha;
                        ?>
                    @endif
                </li>
            </ul>
        </div>
        
        <div class="card-footer mt-3 pt-2 pb-0">
            <ul
                class="nav nav-bottom-line align-items-center justify-content-center justify-content-md-start mb-0 border-0">
                <li class="nav-item">
                    @if (Route::is('publicaciones.index'))
                        <a class="nav-link active" href="{{ route('publicaciones.index') }}"> Publicaciones </a> 
                    @else
                        <a class="nav-link" href="{{ route('publicaciones.index') }}"> Publicaciones </a>
                    @endif
                </li>
                <li class="nav-item">
                    @if (Route::is('eventos.index'))
                        <a class="nav-link active" href="{{ route('eventos.index') }}"> Eventos </a> 
                    @else
                        <a class="nav-link" href="{{ route('eventos.index') }}"> Eventos </a>
                    @endif
                </li>
                <li class="nav-item">
                    @if (Route::is('financiamientos.index'))
                        <a class="nav-link active" href="{{ route('financiamientos.index') }}"> Financiamientos </a> 
                    @else
                        <a class="nav-link" href="{{ route('financiamientos.index') }}"> Financiamientos </a>
                    @endif
                </li>
                <li class="nav-item">
                    @if (Route::is('cursos.index'))
                        <a class="nav-link active" href="{{ route('cursos.index') }}"> Cursos </a> 
                    @else
                        <a class="nav-link" href="{{ route('cursos.index') }}"> Cursos </a>
                    @endif
                </li>
                <li class="nav-item">
                    @if (Route::is('contactos.index'))
                        <a class="nav-link active" href="{{ route('contactos.index') }}"> Contactos <span class="badge bg-success bg-opacity-10 text-success small"> 230</span> </a> 
                    @else
                        <a class="nav-link" href="{{ route('contactos.index') }}"> Contactos <span class="badge bg-success bg-opacity-10 text-success small"> 230</span> </a>
                    @endif
                </li>
                <!--<li class="nav-item">
                    @if (Route::is('instituciones.show'))
                        <a class="nav-link active" href="{{ route('instituciones.show', Session::get('usuario.inst_codigo')) }}"> Institución </a> 
                    @else
                        <a class="nav-link" href="{{ route('instituciones.show', Session::get('usuario.inst_codigo')) }}"> Institución </a>
                    @endif
                </li>-->
            </ul>
        </div>
    </div>

    @yield('contenido-perfil')
</div>


<div class="col-lg-4">

    <div class="row g-4">

        <div class="col-md-6 col-lg-12">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h5 class="card-title">Presentación</h5>
                </div>
                <div class="card-body position-relative pt-0">
                    @if ($usuario->usvi_presentacion == '')
                        <p>No definido</p>                        
                    @else
                        <p>{{ $usuario->usvi_presentacion }}</p>
                    @endif
                    <ul class="list-unstyled mt-3 mb-0">
                        <li class="mb-2"> <i class="bi bi-calendar-date fa-fw pe-1"></i> Cumpleaños: <strong>
                            @if ($usuario->usvi_nacimiento == '')
                                No definido
                            @else
                                <?php
                                    $fecha = ucwords(strftime('%d %B', strtotime($usuario->usvi_nacimiento)));
                                    echo $fecha;
                                ?>                                
                            @endif
                            </strong> </li>
                        <li class="mb-2"> <i class="bi bi-telephone fa-fw pe-1"></i> Teléfono: <strong>
                            @if ($usuario->usvi_telefono == '')
                                No definido
                            @else
                                {{ $usuario->usvi_telefono }}
                            @endif
                        </strong></li>
                        <li class="mb-2"> <i class="bi bi-envelope fa-fw pe-1"></i> Email: <strong>
                            @if ($usuario->usvi_email == '')
                                No definido
                            @else
                                {{ $usuario->usvi_email }}
                            @endif
                        </strong></li>
                        <li class="mb-2"> <i class="bi bi-geo-alt fa-fw pe-1"></i> Ubicación: <strong>
                            @if ($usuario->usvi_comuna != '' && $usuario->usvi_provincia != '' && $usuario->usvi_region != '')
                                {{ $usuario->usvi_comuna.', '.$usuario->usvi_provincia.', '.$usuario->usvi_region }}
                            @else
                                No definido
                            @endif
                        </strong></li>
                        <li class="mb-2"> <i class="bi bi-mortarboard fa-fw pe-1"></i> Profesión: <strong>
                            @if ($usuario->usvi_profesion == '')
                                No definido
                            @else
                                {{ $usuario->usvi_profesion }}
                            @endif
                        </strong></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-12">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h5 class="card-title">Intereses</h5>
                </div>
                <div class="card-body position-relative pt-0">
                    @if ($usuario->usvi_intereses == '')
                        <p>No definido</p>                        
                    @else
                        <p>{{ $usuario->usvi_intereses }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-12">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h5 class="card-title">Habilidades</h5>
                </div>
                <div class="card-body position-relative pt-0">
                    @if ($usuario->usvi_intereses == '')
                        <p>No definido</p>                        
                    @else
                        <p>{{ $usuario->usvi_intereses }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between border-0">
                    <h5 class="card-title">Actividad reciente</h5>
                </div>
                <div class="card-body position-relative pt-0">
                    <div class="d-flex">
                        <div class="avatar me-3">
                            <a href="javascript:void(0);"> <img class="avatar-img rounded-circle" src="{{ asset('public/images/logo/08.svg') }}" alt="">
                            </a>
                        </div>
                        <div>
                            <h6 class="card-title mb-0"><a href="javascript:void(0);"> Apple Computer, Inc. </a></h6>
                            <p class="small">May 2015 – Present Employment Duration 8 mos <a class="btn btn-primary-soft btn-xs ms-2" href="#!">Edit </a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-12">
            <div class="card">
                <div class="card-header d-sm-flex justify-content-between align-items-center border-0">
                    <h5 class="card-title">Contactos <span class="badge bg-success bg-opacity-10 text-success">230</span>
                    </h5>
                    <a class="btn btn-primary-soft btn-sm" href="javascript:void(0);"> Ver todo</a>
                </div>
                <div class="card-body position-relative pt-0">
                    <div class="row g-3">

                        <div class="col-6">
                            <div class="card shadow-none text-center h-100">
                                <div class="card-body p-2 pb-0">
                                    <div class="avatar avatar-story avatar-xl">
                                        <a href="#!"><img class="avatar-img rounded-circle" src="{{ asset('public/images/avatar/02.jpg') }}" alt=""></a>
                                    </div>
                                    <h6 class="card-title mb-1 mt-3"> <a href="#!"> Amanda Reed </a></h6>
                                    <p class="mb-0 small lh-sm">16 mutual connections</p>
                                </div>
                                <div class="card-footer p-2 border-0">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Send message"> <i
                                            class="bi bi-chat-left-text"></i> </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Remove friend"> <i class="bi bi-person-x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="card shadow-none text-center h-100">
                                <div class="card-body p-2 pb-0">
                                    <div class="avatar avatar-xl">
                                        <a href="#!"><img class="avatar-img rounded-circle" src="{{ asset('public/images/avatar/03.jpg') }}" alt=""></a>
                                    </div>
                                    <h6 class="card-title mb-1 mt-3"> <a href="#!"> Samuel Bishop </a></h6>
                                    <p class="mb-0 small lh-sm">22 mutual connections</p>
                                </div>
                                <div class="card-footer p-2 border-0">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Send message"> <i
                                            class="bi bi-chat-left-text"></i> </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Remove friend"> <i class="bi bi-person-x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="card shadow-none text-center h-100">
                                <div class="card-body p-2 pb-0">
                                    <div class="avatar avatar-xl">
                                        <a href="#!"><img class="avatar-img rounded-circle" src="{{ asset('public/images/avatar/04.jpg') }}" alt=""></a>
                                    </div>
                                    <h6 class="card-title mb-1 mt-3"> <a href="#"> Bryan Knight </a></h6>
                                    <p class="mb-0 small lh-sm">1 mutual connection</p>
                                </div>
                                <div class="card-footer p-2 border-0">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Send message"> <i
                                            class="bi bi-chat-left-text"></i> </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Remove friend"> <i class="bi bi-person-x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="card shadow-none text-center h-100">
                                <div class="card-body p-2 pb-0">
                                    <div class="avatar avatar-xl">
                                        <a href="#!"><img class="avatar-img rounded-circle" src="{{ asset('public/images/avatar/05.jpg') }}" alt=""></a>
                                    </div>
                                    <h6 class="card-title mb-1 mt-3"> <a href="#!"> Amanda Reed </a></h6>
                                    <p class="mb-0 small lh-sm">15 mutual connections</p>
                                </div>
                                <div class="card-footer p-2 border-0">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Send message"> <i
                                            class="bi bi-chat-left-text"></i> </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Remove friend"> <i class="bi bi-person-x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Dependencias JS -->
<script src="{{ asset('public/vendor/dropzone/dist/dropzone.js') }}"></script>
<script src="{{ asset('public/vendor/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<script src="{{ asset('public/vendor/glightbox-master/dist/js/glightbox.min.js') }}"></script>
<script src="{{ asset('public/vendor/flatpickr/dist/flatpickr.min.js') }}"></script>

@endsection