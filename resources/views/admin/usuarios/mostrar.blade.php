@extends('temas.paneladmin')

@section('contenido-administracion')

<div class="col-lg-8 vstack gap-4">
    @if(Session::has('actualizarUsuario'))
        <div class="alert alert-success alert-dismissible fade show mt-0 mb-2 text-center" role="alert">
            <strong>{{ Session::get('actualizarUsuario') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @if(Session::has('errorUsuario'))
        <div class="alert alert-danger alert-dismissible fade show mt-2 mb-2 text-center" role="alert">
            <strong>{{ Session::get('errorUsuario') }}</strong>
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
                        @if ($usuario->usvi_superadmin == 'S')
                            <i class="bi bi-person-fill-gear text-success small" title="Habilitado como administrador"></i>
                        @endif
                    </h1>
                    <p> {{ $usuario->usvi_vins == '' ? '0' : $usuario->usvi_vins }} VINS</p>
                </div>
                
                <div class="d-flex mt-3 justify-content-center ms-sm-auto">
                    <a href="{{ route('usuarios.edit', ['inst_codigo' => $usuario->inst_codigo, 'usvi_codigo' => $usuario->usvi_codigo]) }}"  class="btn btn-danger-soft me-2" type="button"> <i class="bi bi-pencil-fill pe-1"></i> Editar perfil </a>
                    <div class="dropdown">
                        <button class="icon-md btn btn-light" type="button" id="profileAction2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileAction2">
                            <li><a class="dropdown-item" href="javascript:void(0);"> <i class="bi bi-file-earmark-pdf fa-fw pe-2"></i>Guardar perfil como PDF</a></li>
                            <li>
                                @if ($usuario->usvi_vigente == 'N')
                                    <form action="{{ route('usuarios.enable', ['inst_codigo' => $usuario->inst_codigo, 'usvi_codigo' => $usuario->usvi_codigo]) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            <i class="bi bi-person-check-fill fa-fw pe-2"></i>
                                            Habilitar usuario
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('usuarios.disable', ['inst_codigo' => $usuario->inst_codigo, 'usvi_codigo' => $usuario->usvi_codigo]) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            <i class="bi bi-person-x-fill fa-fw pe-2"></i>
                                            Deshabilitar usuario
                                        </button>
                                    </form>
                                @endif
                            </li>
                            <li>
                                @if ($usuario->usvi_superadmin == 'N')
                                    <form action="{{ route('usuarios.enable.admin', ['inst_codigo' => $usuario->inst_codigo, 'usvi_codigo' => $usuario->usvi_codigo]) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            <i class="bi bi-person-fill-gear fa-fw pe-2"></i>
                                            Habilitar como administrador
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('usuarios.disable.admin', ['inst_codigo' => $usuario->inst_codigo, 'usvi_codigo' => $usuario->usvi_codigo]) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            <i class="bi bi-person-fill-slash fa-fw pe-2"></i>
                                            Deshabilitar como administrador
                                        </button>
                                    </form>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <ul class="list-inline mb-0 text-center text-sm-start mt-3 mt-sm-0">
                <li class="list-inline-item"><i class="bi bi-briefcase"></i>
                    {{ $usuario->usvi_ocupacion == '' ? 'Ocupación no definido' : $usuario->usvi_ocupacion }}
                </li>
                <li class="list-inline-item"><i class="bi bi-geo-alt"></i>
                    {{ $usuario->usvi_comuna == '' ? 'Comuna no definido' : $usuario->usvi_comuna }}
                </li>
                <li class="list-inline-item"><i class="bi bi-calendar2-plus"></i> Creado en 
                    @if ($usuario->usvi_creado == '')
                        no definido
                    @else
                        <?php
                            setlocale(LC_TIME, 'spanish');
                            $fecha = ucwords(strftime('%b %d, %Y', strtotime($usuario->usvi_creado)));
                            echo $fecha;
                        ?>
                    @endif
                </li>
            </ul>
        </div>
        
        <div class="card-footer mt-3 pb-0">
            <ul class="nav nav-tabs nav-bottom-line justify-content-center justify-content-md-start mb-0">
                <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#informacion"> Información </a> </li>
                <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#publicaciones"> Publicaciones </a> </li>
                <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#eventos"> Eventos </a> </li>
                <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#financiamientos"> Financiamientos </a> </li>
                <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#cursos"> Cursos </a> </li>
                <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#contactos"> Contactos <span class="badge bg-success bg-opacity-10 text-success small"> 230</span> </a> </li>
            </ul>
        </div>
    </div>

    <div class="tab-content pt-0 pb-0 mb-0">

        <div class="tab-pane show active fade" id="informacion">
            <div class="card">
                <div class="card-body">
                    <div class="rounded border px-3 py-2 mb-3"> 
                        <div class="d-flex align-items-center justify-content-between">
                            <h6>Presentación</h6>
                        </div>
                        <p> {{ $usuario->usvi_presentacion == '' ? 'no definido' : $usuario->usvi_presentacion }} </p>
                    </div>
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center rounded border px-3 py-2"> 
                                <p class="mb-0">
                                    <i class="bi bi-envelope fa-fw me-2"></i> Email: <strong> {{ $usuario->usvi_email == '' ? 'no definido' : $usuario->usvi_email }} </strong>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center rounded border px-3 py-2"> 
                                <p class="mb-0">
                                    <i class="bi bi-telephone fa-fw me-2"></i> Teléfono: <strong> {{ $usuario->usvi_telefono == '' ? 'no definido' : $usuario->usvi_telefono }} </strong>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center rounded border px-3 py-2"> 
                                <p class="mb-0">
                                    <i class="bi bi-calendar-date fa-fw me-2"></i> Nacimiento:
                                    <strong>
                                        @if ($usuario->usvi_nacimiento == '')
                                            no definido
                                        @else
                                            <?php
                                                setlocale(LC_TIME, 'spanish');
                                                $fecha = ucwords(strftime('%B %d, %Y', strtotime($usuario->usvi_nacimiento)));
                                                echo $fecha;
                                            ?>
                                        @endif
                                    </strong>
                                </p>
                            </div>
                        </div>  
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center rounded border px-3 py-2"> 
                                <p class="mb-0">
                                    <i class="bi bi-house fa-fw me-2"></i> Dirección: <strong> {{ $usuario->usvi_direccion == '' ? 'no definido' : $usuario->usvi_direccion }} </strong>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center rounded border px-3 py-2"> 
                                <p class="mb-0">
                                    <i class="bi bi-geo-alt fa-fw me-2"></i> Ubicación: <strong> {{ ($usuario->usvi_comuna!='' && $usuario->usvi_provincia!='' && $usuario->usvi_region!='' && $usuario->usvi_pais!='') ? $usuario->usvi_comuna.', '.$usuario->usvi_provincia.', '.$usuario->usvi_region.', '.$usuario->usvi_pais : 'no definido' }} </strong>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center rounded border px-3 py-2"> 
                                <p class="mb-0">
                                    <i class="bi bi-mortarboard fa-fw me-2"></i> Profesión: <strong> {{ $usuario->usvi_profesion == '' ? 'no definido' : $usuario->usvi_profesion }} </strong>
                                </p>
                            </div>
                        </div>                        
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center rounded border px-3 py-2"> 
                                <p class="mb-0">
                                    <i class="bi bi-briefcase fa-fw me-2"></i> Ocupación: <strong> {{ $usuario->usvi_ocupacion == '' ? 'no definido' : $usuario->usvi_ocupacion }} </strong>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center rounded border px-3 py-2"> 
                                <p class="mb-0">
                                    <i class="bi bi-envelope fa-fw me-2"></i> Permisos Vinculamos: <strong> {{ $usuario->usvi_permisos == '' ? 'no definido' : $usuario->usvi_permisos }} </strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded border mt-3 px-3 py-2 mb-3"> 
                        <div class="d-flex align-items-center justify-content-between">
                            <h6>Intereses</h6>
                        </div>
                        <p> {{ $usuario->usvi_intereses == '' ? 'no definido' : $usuario->usvi_intereses }} </p>
                    </div>
                    <div class="rounded border px-3 py-2 mb-3"> 
                        <div class="d-flex align-items-center justify-content-between">
                            <h6>Habilidades</h6>
                        </div>
                        <p> {{ $usuario->usvi_habilidades == '' ? 'no definido' : $usuario->usvi_habilidades }} </p>
                    </div>
                    <div class="row g-4">
                        <div class="col-sm-4">
                            <div class="d-flex align-items-center rounded border px-3 py-2"> 
                                <p class="mb-0">
                                    <i class="bi bi-person-lines-fill fa-fw me-2"></i> Interacción: <strong> 656 </strong>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="d-flex align-items-center rounded border px-3 py-2"> 
                                <p class="mb-0">
                                    <i class="bi bi-people fa-fw me-2"></i> Colaboración: <strong> 46 </strong>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="d-flex align-items-center rounded border px-3 py-2"> 
                                <p class="mb-0">
                                    <i class="bi bi-coin fa-fw me-2"></i> VINS: <strong> {{ $usuario->usvi_vins == '' ? '0' : $usuario->usvi_vins }} </strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade show" id="publicaciones">
            
        </div>

        <div class="tab-pane fade show" id="eventos">
          
        </div>

        <div class="tab-pane fade show" id="financiamientos">
          
        </div>

        <div class="tab-pane fade show" id="cursos">
          
        </div>

        <div class="tab-pane fade show" id="contactos">
          
        </div>
    </div>
</div>

@endsection