@extends('temas.authbase')

@section('auth-content')
<div class="container">
    <div class="row justify-content-center align-items-center vh-100 py-5">
        <div class="col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
            <div class="card card-body text-center p-4 p-sm-5">

                <h1 class="mb-2">Iniciar sesión</h1>

                <form class="mt-sm-4" method="POST" action="{{ route('auth.ingresar') }}">

                    @csrf

                    @if(Session::has('errorUsuario'))
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            <strong>{{ Session::get('errorUsuario') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif

                    @if(Session::has('errorClave'))
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            <strong>{{ Session::get('errorClave') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif

                    @if(Session::has('sesionFinalizada'))
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            <strong>{{ Session::get('sesionFinalizada') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif

                    <div class="mb-3 input-group-lg">
                        <input type="text" class="form-control" placeholder="Nombre de usuario" id="usuario" name="usuario" value="{{ old('usuario') }}">
                    </div>
                    @if($errors->has('usuario'))
                        <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
                            <strong>{{ $errors->first('usuario') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif

                    <div class="mb-3 position-relative">
                        <div class="input-group input-group-lg">
                            <input class="form-control fakepassword" type="password" placeholder="Contraseña" id="clave" name="clave">
                            <span class="input-group-text p-0">
                                <i class="fakepasswordicon fa-solid fa-eye-slash cursor-pointer p-2 w-40px"></i>
                            </span>
                        </div>
                    </div>
                    @if($errors->has('clave'))
                        <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
                            <strong>{{ $errors->first('clave') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif

                    <div class="d-grid"><button type="submit" class="btn btn-lg btn-primary">Ingresar</button></div>
                    <div class="d-grid mt-2">
                        <!--<a href="{{ route('registrar.formulario') }}">¿No tienes una cuenta?</a>
                            <a href="">¿Olvidaste tu contraseña?</a>-->
                    </div>

                    <!-- Copyright -->
                    <p class="mb-0 mt-3">©2022 <a target="_blank" href="https://www.webestica.com/">Webestica.</a> Todos
                        los derechos reservados</p>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
