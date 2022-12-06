@extends('temas.paneladmin')

@section('contenido-administracion')

<div class="col-md-8 col-lg-6 vstack gap-4">
    <div class="card">
        <div class="card-header border-0 pb-0">
            <div class="row g-2">
                <div class="col-lg-2">
                    <h1 class="h4 card-title mb-lg-0">Usuarios</h1>
                </div>
                @if(sizeof($instituciones) > 0)
                    <div class="col-sm-6 col-lg-6 ms-lg-auto">
                        <select class="form-select js-choice choice-select-text-none" data-search-enabled="false" id="admin-select-institucion-usuarios">
                            <option value="" disabled selected>Seleccione...</option>
                            @foreach($instituciones as $institucion)
                                <option value="{{ $institucion->inst_codigo }}">{{ $institucion->inst_nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <div class="col-sm-6 col-lg-3">
                        <a class="btn btn-primary-soft ms-auto w-100" href="{{ route('instituciones.create') }}">
                            <i class="fa-solid fa-plus pe-1"></i> Crear institución
                        </a>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card-body">
            
            <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2 text-center" role="alert" id="admin-alert-institucion-usuarios">
                <strong>No ha seleccionado la institución.</strong>
            </div>
     
            @foreach ($instituciones as $institucion)
                <ul class="nav nav-tabs nav-bottom-line justify-content-center justify-content-md-start" id="admin-submenu-usuarios-{{ $institucion->inst_codigo }}" name="admin-submenu-usuarios">
                    <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="javascript:void(0);" id="nav-admin-usuarios-activos-{{ $institucion->inst_codigo }}" name="nav-admin-usuarios-activos"> Activos </a></li>
                    <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="javascript:void(0);" id="nav-admin-usuarios-inactivos-{{ $institucion->inst_codigo }}" name="nav-admin-usuarios-inactivos"> Inactivos </a></li>
                </ul> 

                <div class="tab-content mb-0 pb-0" id="content-usuarios-{{ $institucion->inst_codigo }}" name="content-usuarios">
                    <div class="tab-pane fade show" id="admin-usuarios-activos-{{ $institucion->inst_codigo }}" name="admin-usuarios-activos">
                        <div class="row g-4">
                            <?php
                                $cantidadActivos = 0;
                                foreach ($usuariosActivos as $usuario) {
                                    if ($usuario->inst_codigo == $institucion->inst_codigo) $cantidadActivos++;
                                }
                            ?>
                            @if ($cantidadActivos == 0)
                                <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                                    <strong>No existen usuarios activos en la institución.</strong>
                                </div>
                            @else
                                @foreach ($usuariosActivos as $usuario)   
                                    @if ($usuario->inst_codigo == $institucion->inst_codigo)
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="card">                                            
                                                <div class="card-body text-center pt-0">
                                                    <div class="avatar avatar-lg mt-2 mb-2">
                                                        <a href="{{ route('usuarios.show', ['inst_codigo' => $usuario->inst_codigo, 'usvi_codigo' => $usuario->usvi_codigo]) }}">
                                                            <img class="avatar-img rounded-circle border border-white border-3 bg-white" src="{{ asset('public/'.$usuario->usvi_foto.'?nocache='.time()) }}" alt="">
                                                        </a>
                                                    </div>
                                                    <h5 class="mb-0">
                                                        <a href="{{ route('usuarios.show', ['inst_codigo' => $usuario->inst_codigo, 'usvi_codigo' => $usuario->usvi_codigo]) }}">{{ $usuario->usvi_nombre }} {{ $usuario->usvi_apellido }}</a>
                                                        @if ($usuario->usvi_superadmin == 'S')
                                                            <i class="bi bi-person-fill-gear text-success small" title="Habilitado como administrador"></i>
                                                        @endif
                                                    </h5>
                                                    <small><i class="bi bi-geo-alt"></i> {{ $usuario->usvi_comuna=='' && $usuario->usvi_region=='' ? 'Ubicación no definida' : $usuario->usvi_comuna.', '.$usuario->usvi_region }} </small>
                                                    <div class="hstack gap-2 gap-xl-3 justify-content-center mt-3">
                                                        <div>
                                                            <h6 class="mb-0">32k</h6>
                                                            <small>Contactos</small>
                                                        </div>
                                                        <div class="vr"></div>
                                                        <div>
                                                            <h6 class="mb-0"> {{ $usuario->usvi_vins == '' ? '0' : $usuario->usvi_vins }} </h6>
                                                            <small>VINS</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>  
                                  
                    <div class="tab-pane fade show" id="admin-usuarios-inactivos-{{ $institucion->inst_codigo }}" name="admin-usuarios-inactivos">
                        <div class="row g-4">
                            <?php
                                $cantidadInactivos = 0;
                                foreach ($usuariosInactivos as $usuario) {
                                    if ($usuario->inst_codigo == $institucion->inst_codigo) $cantidadInactivos++;
                                }
                            ?>
                            @if ($cantidadInactivos == 0)
                                <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                                    <strong>No existen usuarios inactivos en la institución.</strong>
                                </div>
                            @else
                                @foreach ($usuariosInactivos as $usuario)                            
                                    @if ($usuario->inst_codigo == $institucion->inst_codigo)
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="card">                                            
                                                <div class="card-body text-center pt-0">
                                                    <div class="avatar avatar-lg mt-2 mb-2">
                                                        <a href="{{ route('usuarios.show', ['inst_codigo' => $usuario->inst_codigo, 'usvi_codigo' => $usuario->usvi_codigo]) }}">
                                                            <img class="avatar-img rounded-circle border border-white border-3 bg-white" src="{{ asset('public/'.$usuario->usvi_foto.'?nocache='.time()) }}" alt="">
                                                        </a>
                                                    </div>
                                                    <h5 class="mb-0">
                                                        <a href="{{ route('usuarios.show', ['inst_codigo' => $usuario->inst_codigo, 'usvi_codigo' => $usuario->usvi_codigo]) }}">{{ $usuario->usvi_nombre }} {{ $usuario->usvi_apellido }}</a>
                                                        @if ($usuario->usvi_superadmin == 'S')
                                                            <i class="bi bi-person-fill-gear text-success small" title="Habilitado como administrador"></i>
                                                        @endif
                                                    </h5>
                                                    <small> <i class="bi bi-geo-alt"></i> {{ $usuario->usvi_comuna=='' && $usuario->usvi_region=='' ? 'Ubicación no definida' : $usuario->usvi_comuna.', '.$usuario->usvi_region }} </small>
                                                    <div class="hstack gap-2 gap-xl-3 justify-content-center mt-3">
                                                        <div>
                                                            <h6 class="mb-0">32k</h6>
                                                            <small>Contactos</small>
                                                        </div>
                                                        <div class="vr"></div>
                                                        <div>
                                                            <h6 class="mb-0"> {{ $usuario->usvi_vins == '' ? '0' : $usuario->usvi_vins }} </h6>
                                                            <small>VINS</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
