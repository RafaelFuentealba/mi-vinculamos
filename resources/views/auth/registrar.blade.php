@extends('temas.authbase')

@section('auth-content')
<div class="container">
    <div class="row justify-content-center align-items-center vh-100 py-5">
        <div class="col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
            <div class="card card-body text-center p-4 p-sm-5">

                <h1 class="mb-2">Registro</h1>

                <form class="mt-sm-4" method="POST" action="{{ route('auth.registrar') }}">
                    @csrf

                    @if(Session::has('errorRegistro'))
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            <strong>{{ Session::get('errorRegistro') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="mb-3 input-group-lg">
                        <input type="text" class="form-control" placeholder="Código de institucion" id="institucion" name="institucion">
                    </div>

                    <div class="mb-3 input-group-lg">
                        <input type="text" class="form-control" placeholder="Nombre de usuario" id="usuario" name="usuario">
                    </div>

                    <div class="mb-3 input-group-lg">
                        <input type="text" class="form-control" placeholder="Nombre" id="nombre" name="nombre">
                    </div>

                    <div class="mb-3 input-group-lg">
                        <input type="text" class="form-control" placeholder="Apellido" id="apellido" name="apellido">
                    </div>

                    <div class="mb-3 input-group-lg">
                        <input type="email" class="form-control" placeholder="Correo electrónico" id="email" name="email">
                    </div>

                    <div class="mb-3 position-relative">
                        <div class="input-group input-group-lg">
                            <input class="form-control fakepassword" type="password" placeholder="Contraseña" id="clave" name="clave">
                            <span class="input-group-text p-0">
                                <i class="fakepasswordicon fa-solid fa-eye-slash cursor-pointer p-2 w-40px"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3 position-relative">
                        <div class="input-group input-group-lg">
                            <input class="form-control fakepassword" type="password" placeholder="Repetir contraseña" id="repetir-clave" name="repetir-clave">
                            <span class="input-group-text p-0">
                                <i class="fakepasswordicon fa-solid fa-eye-slash cursor-pointer p-2 w-40px"></i>
                            </span>
                        </div>
                    </div>

                    <div class="d-grid"><button type="submit" class="btn btn-lg btn-primary">Registrar</button></div>
                    <div class="d-grid mt-2"><a href="{{ route('ingresar.formulario') }}">¿Ya tienes una cuenta?</a></div>

                    <p class="mb-0 mt-3">©2022
                        <a target="_blank" href="https://www.webestica.com/">Webestica.</a> Todos los derechos reservados
                    </p>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
