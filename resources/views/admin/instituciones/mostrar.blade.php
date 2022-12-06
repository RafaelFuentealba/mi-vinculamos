@extends('temas.paneladmin')

@section('contenido-administracion')
<div class="col-lg-8 vstack gap-4">

    @if(Session::has('actualizarInstitucion'))
        <div class="alert alert-success alert-dismissible fade show mt-0 mb-2 text-center" role="alert">
            <strong>{{ Session::get('actualizarInstitucion') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @if(Session::has('errorInstitucion'))
        <div class="alert alert-danger alert-dismissible fade show mt-0 mb-2 text-center" role="alert">
            <strong>{{ Session::get('errorInstitucion') }}</strong>
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
                        <img class="avatar-img rounded-circle border border-white border-3" src="{{ asset('public/'.$institucion->inst_logo.'?nocache='.time()) }}" alt="">
                    </div>
                </div>
                <div class="ms-sm-4 mt-sm-3">
                    <h1 class="mb-0 h5">{{ $institucion->inst_nombre }}
                        @if($institucion->inst_vigente == 'S')
                            <i class="bi bi-cloud-check-fill text-success small" title="Institución habilitada"></i>
                        @else
                            <i class="bi bi-cloud-slash-fill text-danger small" title="Institución deshabilitada"></i>
                        @endif
                    </h1>
                    <p>{{ $contadorUsuarios }} usuarios</p>
                </div>
                <div class="d-flex mt-3 justify-content-center ms-sm-auto">
                    <a class="btn btn-danger-soft me-2" type="button" href="{{ route('instituciones.edit', $institucion->inst_codigo) }}">
                        <i class="bi bi-pencil-fill pe-1"></i>
                        Editar institucion
                    </a>
                    <div class="dropdown">
                        <button class="icon-md btn btn-light" type="button" id="profileAction2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileAction2">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);"> <i class="bi bi-file-earmark-pdf fa-fw pe-2"></i>Guardar como PDF</a></li>
                            <li>
                            </li>
                            <li>
                                @if ($institucion->inst_vigente == 'N')
                                    <form action="{{ route('instituciones.enable', $institucion->inst_codigo) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            <i class="bi bi-cloud-check-fill fa-fw pe-2"></i>
                                            Habilitar institución
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('instituciones.disable', $institucion->inst_codigo) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            <i class="bi bi-cloud-slash-fill fa-fw pe-2"></i>
                                            Deshabilitar institución
                                        </button>
                                    </form>
                                @endif
                            <li>
                                <form action="{{ route('instituciones.destroy', $institucion->inst_codigo) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="bi bi-trash fa-fw pe-2"></i>
                                        Eliminar institución
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="list-inline mb-0 text-center text-sm-start mt-3 mt-sm-0">
                <li class="list-inline-item"><i class="bi bi-geo-alt"></i> {{ $institucion->inst_comuna }}, {{ $institucion->inst_pais }}</li>
                <li class="list-inline-item"><i class="bi bi-calendar2-plus"></i> Creado en
                    <?php
                        setlocale(LC_TIME, 'spanish');
                        $fecha = ucwords(strftime('%b %d, %Y', strtotime($institucion->inst_creado)));
                        echo $fecha;
                    ?>
                </li>
            </ul>
        </div>
        <div class="card-footer mt-3 pt-2 pb-0">
            <ul class="nav nav-bottom-line align-items-center justify-content-center justify-content-md-start mb-0 border-0">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" id="nav-institucion-informacion"> Información </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" id="nav-institucion-usuarios"> Usuarios <span class="badge bg-success bg-opacity-10 text-success small"> {{ $contadorUsuarios }}</span> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" id="nav-institucion-actividad">Actividad</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="card" id="admin-institucion-informacion">
        <div class="card-header border-0 pb-0">
            <h5 class="card-title"> Perfil de institución</h5>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-sm-6">
                    <div class="d-flex align-items-center rounded border px-3 py-2">
                        <p class="mb-0">
                            <i class="bi bi-translate fa-fw me-2"></i> Nombre: <strong> {{ $institucion->inst_nombre }} </strong>
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center rounded border px-3 py-2">
                        <p class="mb-0">
                            <i class="bi bi-card-list fa-fw me-2"></i> Tipo: <strong>
                                @if ($institucion->inst_tipo == 'universidad')
                                    Universidad
                                @endif
                                @if ($institucion->inst_tipo == 'ip')
                                    Instituto Profesional
                                @endif
                                @if ($institucion->inst_tipo == 'cft')
                                    Centro de Formación Técnica
                                @endif
                            </strong>
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center rounded border px-3 py-2">
                        <p class="mb-0">
                            <i class="bi bi-geo-alt fa-fw me-2"></i> Dirección: <strong> {{ $institucion->inst_direccion }} </strong>
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center rounded border px-3 py-2">
                        <p class="mb-0">
                            <i class="bi bi-building fa-fw me-2"></i> Casa Central:
                            <strong>
                                {{ $institucion->inst_comuna }}, {{ $institucion->inst_provincia }},
                                {{ $institucion->inst_region }}, {{ $institucion->inst_pais }}
                            </strong>
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center rounded border px-3 py-2">
                        <p class="mb-0">
                            <i class="bi bi-telephone fa-fw me-2"></i> Contacto: <strong> {{ $institucion->inst_contacto }} </strong>
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center rounded border px-3 py-2">
                        <p class="mb-0">
                            <i class="bi bi-globe fa-fw me-2"></i> Sitio web:
                            <strong>
                                <a href="{{ $institucion->inst_url_web }}" target="_blank" style="color: inherit;"> {{ $institucion->inst_url_web }}</a>
                            </strong>
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center rounded border px-3 py-2">
                        <p class="mb-0">
                            <i class="bi bi-calendar2-plus fa-fw me-2"></i> Creado:
                            <strong>
                                <?php
                                    setlocale(LC_TIME, 'spanish');
                                    $fecha = ucwords(strftime('%B %d, %Y', strtotime($institucion->inst_creado)));
                                    echo $fecha;
                                ?>
                            </strong>
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center rounded border px-3 py-2">
                        <p class="mb-0">
                            <i class="bi bi-calendar2-check fa-fw me-2"></i> Actualizado:
                            <strong>
                                <?php
                                    setlocale(LC_TIME, 'spanish');
                                    $fecha = ucwords(strftime('%B %d, %Y', strtotime($institucion->inst_actualizado)));
                                    echo $fecha;
                                ?>
                            </strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card" id="admin-institucion-usuarios">
        <div class="card-header d-sm-flex justify-content-between border-0 pb-0">
            <h5 class="card-title">Listado de usuarios</h5>
        </div>
        <div class="card-body">
            <div class="row g-4">
                @forelse($usuarios as $usuario)
                    <div class="col-sm-6 col-lg-4">
                        <div class="d-flex align-items-center position-relative">
                            <div class="avatar">
                                <img class="avatar-img" src="{{ asset('public/'.$usuario->usvi_foto) }}" alt="">
                            </div>
                            <div class="ms-2">
                                <h6 class="mb-0">
                                    <a class="stretched-link" href="#"> {{ $usuario->usvi_nombre }} {{ $usuario->usvi_apellido }} </a>
                                </h6>
                                <i class="bi bi-calendar2-plus fa-fw small mb-0"></i><strong class="small mb-0"> Anexado:
                                    <?php
                                        setlocale(LC_TIME, 'spanish');
                                        $fecha = ucwords(strftime('%B %d, %Y', strtotime($usuario->usvi_creado)));
                                        echo $fecha;
                                    ?>
                                </strong>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2 text-center" role="alert">
                        <strong>No existen usuarios asociados a {{ $institucion->inst_nombre }}</strong>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="card" id="admin-institucion-actividad">
        <div class="card-header border-0 pb-0">
            <h5 class="card-title"> Actividad reciente</h5>
        </div>
        <div class="card-body">
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <div class="avatar text-center">
                            <img class="avatar-img rounded-circle" src="assets/images/avatar/07.jpg" alt="">
                        </div>
                    </div>
                    <div class="timeline-content">
                        <div class="d-sm-flex justify-content-between">
                            <div>
                                <p class="small mb-0"><b>Sam Lanson</b> update a playlist on webestica.</p>
                                <p class="small mb-0"><i class="bi bi-unlock-fill pe-1"></i>Public</p>
                            </div>
                            <p class="small ms-sm-3 mt-2 mt-sm-0 text-nowrap">Just now</p>
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-icon">
                        <div class="avatar text-center">
                            <img class="avatar-img rounded-circle" src="assets/images/avatar/01.jpg" alt="">
                        </div>
                    </div>
                    <div class="timeline-content">
                        <div class="d-sm-flex justify-content-between">
                            <div>
                                <p class="small mb-0"><b>Billy Vasquez</b> save a <a href="#!">link.</a> </p>
                                <p class="small mb-0"><i class="bi bi-lock-fill pe-1"></i>only me</p>
                            </div>
                            <p class="small ms-sm-3 mt-2 mt-sm-0">2min</p>
                        </div>
                    </div>
                </div>
                <!-- Timeline item END -->

                <!-- Timeline item START -->
                <div class="timeline-item align-items-center">
                    <!-- Timeline icon -->
                    <div class="timeline-icon">
                        <div class="avatar text-center">
                            <div class="avatar-img rounded-circle bg-success"><span
                                    class="text-white position-absolute top-50 start-50 translate-middle fw-bold">SM</span>
                            </div>
                        </div>
                    </div>
                    <!-- Timeline content -->
                    <div class="timeline-content">
                        <div class="d-sm-flex justify-content-between">
                            <div>
                                <p class="small mb-0"> <b>Sam Lanson</b> liked <b> Frances Guerrero's </b> add comment.
                                </p>
                                <p class="small mb-0">This is the best picture I have come across today.... </p>
                            </div>
                            <p class="small mb-0 ms-sm-3">1hr</p>
                        </div>
                    </div>
                </div>
                <!-- Timeline item END -->

                <!-- Timeline item START -->
                <div class="timeline-item align-items-center">
                    <!-- Timeline icon -->
                    <div class="timeline-icon">
                        <div class="avatar text-center">
                            <img class="avatar-img rounded-circle" src="assets/images/avatar/02.jpg" alt="">
                        </div>
                    </div>
                    <!-- Timeline content -->
                    <div class="timeline-content">
                        <div class="d-sm-flex justify-content-between">
                            <div>
                                <p class="small mb-0"><b>Judy Nguyen</b> likes <b>Jacqueline Miller</b> Photos. </p>
                                <p class="mb-0">✌️👌👍</p>
                            </div>
                            <p class="small ms-sm-3 mt-2 mt-sm-0">4hr</p>
                        </div>
                    </div>
                </div>
                <!-- Timeline item END -->

                <!-- Timeline item START -->
                <div class="timeline-item">
                    <!-- Timeline icon -->
                    <div class="timeline-icon">
                        <div class="avatar text-center">
                            <img class="avatar-img rounded-circle" src="assets/images/avatar/03.jpg" alt="">
                        </div>
                    </div>
                    <!-- Timeline content -->
                    <div class="timeline-content">
                        <div class="d-sm-flex justify-content-between">
                            <div>
                                <p class="small mb-0"><b>Larry Lawson</b> </p>
                                <p class="small mb-2">Replied to your comment on Blogzine blog theme</p>
                                <small class="bg-light rounded p-2 d-block">
                                    Yes, I am so excited to see it live. 👍
                                </small>
                            </div>
                            <p class="small ms-sm-3 mt-2 mt-sm-0">10hr</p>
                        </div>
                    </div>
                </div>
                <!-- Timeline item END -->

            </div>
        </div>
        <!-- Card body END -->
        <!-- Card footer START -->
        <div class="card-footer border-0 py-3 text-center position-relative d-grid pt-0">
            <!-- Load more button START -->
            <a href="#!" role="button" class="btn btn-sm btn-loader btn-primary-soft" data-bs-toggle="button"
                aria-pressed="true">
                <span class="load-text"> Load more activity </span>
                <div class="load-icon">
                    <div class="spinner-grow spinner-grow-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </a>
            <!-- Load more button END -->
        </div>
        <!-- Card footer END -->
    </div>
    <!-- Activity feed END -->

</div>

@endsection
