<?php

namespace App\Http\Controllers;

use App\Models\Instituciones;
use App\Models\LogUsuarios;
use App\Models\Usuarios;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use ReturnTypeWillChange;

class UsuariosController extends Controller{
    public function index() {
        return view('admin.usuarios.listar', [
            'instituciones' => Instituciones::select('inst_codigo', 'inst_nombre')->where('inst_vigente', 'S')->get(),
            'usuariosActivos' => Usuarios::where('usvi_vigente', 'S')->orderBy('inst_codigo')->get(),
            'usuariosInactivos' => Usuarios::where('usvi_vigente', 'N')->orderBy('inst_codigo')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show($inst_codigo, $usvi_codigo) {
        return view('admin.usuarios.mostrar', [
            'institucion' => Instituciones::where('inst_codigo', $inst_codigo)->first(),
            'usuario' => Usuarios::where(['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->first()
        ]);
    }

    public function edit($inst_codigo, $usvi_codigo) {
        return view('admin.usuarios.formulario', [
            'usuario' => Usuarios::where(['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->first()
        ]);
    }

    public function update(Request $request, $inst_codigo, $usvi_codigo) {
        $usviGuardado = Usuarios::where(['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->first();
        $validacion = $request->validate([
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',
            'email' => 'required|max:100',
            'telefono' => 'required|max:100',
            'nacimiento' => 'required|date_format:Y-m-d',
            'direccion' => 'required|max:100',
            'comuna' => 'required|max:100',
            'provincia' => 'required|max:100',
            'region' => 'required|max:100',
            'pais' => 'required|max:100',
            'profesion' => 'max:255',
            'ocupacion' => 'max:255',
            'presentacion' => 'max:255',
            'intereses' => 'max:65535',
            'habilidades' => 'max:65535',
        ],
        [
            'nombre.required' => 'El nombre es requerido',
            'nombre.max' => 'El nombre excede los 100 caracteres',
            'apellido.required' => 'El apellido es requerido',
            'apellido.max' => 'El apellido excede los 100 caracteres',
            'email.required' => 'El email es requerido',
            'email.max' => 'El email excede los 100 caracteres',
            'telefono.required' => 'El teléfono de contacto es requerido',
            'telefono.max' => 'El teléfono de contacto excede los 100 caracteres',
            'nacimiento.required' => 'La fecha de nacimiento es requerida',
            'nacimiento.date_format' => 'La fecha debe estar en formato yyyy-mm-dd',
            'direccion.required' => 'La dirección es requerida',
            'direccion.max' => 'La dirección excede los 100 caracteres',
            'comuna.required' => 'La comuna es requerida',
            'comuna.max' => 'La comuna excede los 100 caracteres',
            'provincia.required' => 'La provincia es requerida',
            'provincia.max' => 'La provincia excede los 100 caracteres',
            'region.required' => 'La región es requerida',
            'region.max' => 'La región excede los 100 caracteres',
            'pais.required' => 'El país es requerido',
            'pais.max' => 'El país excede los 100 caracteres',  
            'profesion.max' => 'La profesión excede los 255 caracteres',
            'ocupacion.max' => 'La ocupación excede los 255 caracteres',
            'presentacion.max' => 'La presentación excede los 255 caracteres',
            'intereses.max' => 'Los intereses exceden los 65535 caracteres',
            'habilidades.max' => 'Las habilidades exceden los 65535 caracteres',
        ]);

        if (!$validacion) return redirect()->back()->withErrors($validacion)->withInput();
        if (!$request->file('foto')) {
            $usviActualizar = Usuarios::where(['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->update([
                'usvi_nombre' => $request->nombre,
                'usvi_apellido' => $request->apellido,
                'usvi_email' => $request->email,
                'usvi_telefono' => $request->telefono,
                'usvi_nacimiento' => $request->nacimiento,
                'usvi_direccion' => $request->direccion,
                'usvi_comuna' => $request->comuna,
                'usvi_provincia' => $request->provincia,
                'usvi_region' => $request->region,
                'usvi_pais' => $request->pais,
                'usvi_profesion' => $request->profesion,
                'usvi_ocupacion' => $request->ocupacion,
                'usvi_presentacion' => $request->presentacion,
                'usvi_intereses' => $request->intereses,
                'usvi_habilidades' => $request->habilidades,
                'usvi_actualizado' => Carbon::now()->toDateTimeString()
            ]);
        } else {
            $validacionFoto = $request->validate([
                'foto' => 'required|image|mimes:jpg,jpeg,png|max:500' /** maximo 500 KB */
            ],
            [
                'foto.required' => 'La imagen de perfil es requerida',
                'foto.image' => 'El archivo debe ser de tipo imagen',
                'foto.mimes' => 'El archivo debe ser una imagen en formato .png, .jpg, .jpeg',
                'foto.max' => 'El archivo debe pesar 500 KB como tamaño máximo'
            ]);
            if (!$validacionFoto) return redirect()->back()->withErrors($validacionFoto)->withInput();
            
            $archivo = $request->file('foto');
            $extensionFoto = $request->file('foto')->extension();
            $nombreFoto = $usviGuardado->inst_codigo.'_'.$usviGuardado->usvi_codigo.'.'.$extensionFoto; /** nombre de foto es el código de la institución + nombre de usuario + extensión del archivo */
            $rutaFoto = 'images/usuarios/'.$nombreFoto;
            if (File::exists(public_path($rutaFoto))) File::delete(public_path($rutaFoto));
            $archivo->move(public_path('images/usuarios'), $nombreFoto);
            
            $usviActualizar = Usuarios::where(['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->update([
                'usvi_nombre' => $request->nombre,
                'usvi_apellido' => $request->apellido,
                'usvi_email' => $request->email,
                'usvi_telefono' => $request->telefono,
                'usvi_nacimiento' => $request->nacimiento,
                'usvi_direccion' => $request->direccion,
                'usvi_comuna' => $request->comuna,
                'usvi_provincia' => $request->provincia,
                'usvi_region' => $request->region,
                'usvi_pais' => $request->pais,
                'usvi_foto' => $rutaFoto,
                'usvi_profesion' => $request->profesion,
                'usvi_ocupacion' => $request->ocupacion,
                'usvi_presentacion' => $request->presentacion,
                'usvi_intereses' => $request->intereses,
                'usvi_habilidades' => $request->habilidades,
                'usvi_actualizado' => Carbon::now()->toDateTimeString()
            ]);
        }

        if (!$usviActualizar) return redirect()->back()->with('errorUsuario', 'Ocurrió un error durante la actualización del usuario, inténtelo más tarde.')->withInput();

        $usviActualizado = Usuarios::where(['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->first();
        $usviCrearLog = LogUsuarios::insert([
            'inst_codigo' => $usviActualizado->inst_codigo,
            'usvi_codigo' => $usviActualizado->usvi_codigo,
            'usvi_permisos' => $usviActualizado->usvi_permisos,
            'usvi_superadmin' => $usviActualizado->usvi_superadmin,
            'usvi_nombre' => $usviActualizado->usvi_nombre,
            'usvi_apellido' => $usviActualizado->usvi_apellido,
            'usvi_email' => $usviActualizado->usvi_email,
            'usvi_telefono' => $usviActualizado->usvi_telefono,
            'usvi_clave' => $usviActualizado->usvi_clave,
            'usvi_nacimiento' => $usviActualizado->usvi_nacimiento,
            'usvi_direccion' => $usviActualizado->usvi_direccion,
            'usvi_comuna' => $usviActualizado->usvi_comuna,
            'usvi_provincia' => $usviActualizado->usvi_provincia,
            'usvi_region' => $usviActualizado->usvi_region,
            'usvi_pais' => $usviActualizado->usvi_pais,
            'usvi_foto' => $usviActualizado->usvi_foto,
            'usvi_profesion' => $usviActualizado->usvi_profesion,
            'usvi_ocupacion' => $usviActualizado->usvi_ocupacion,
            'usvi_presentacion' => $usviActualizado->usvi_presentacion,
            'usvi_intereses' => $usviActualizado->usvi_intereses,
            'usvi_habilidades' => $usviActualizado->usvi_habilidades,
            'usvi_vins' => $usviActualizado->usvi_vins,
            'usvi_creado' => $usviActualizado->usvi_creado,
            'usvi_actualizado' => $usviActualizado->usvi_actualizado,
            'usvi_vigente' => $usviActualizado->usvi_vigente,
            'log_codigo' => 3,
            'log_institucion_mod' => Session::get('usuario')->inst_codigo,
            'log_usuario_mod' => Session::get('usuario')->usvi_codigo,
            'log_fecha_mod' => Carbon::now()->toDateTimeString()
        ]);
        if (!$usviActualizar && !$usviCrearLog) return redirect()->back()->with('errorUsuario', 'Ocurrió un error durante la actualización del usuario, inténtelo más tarde.')->withInput();
        return redirect()->route('usuarios.show', ['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->with('actualizarUsuario', 'El usuario fue actualizado correctamente.');
    }

    public function destroy(Usuarios $usuarios) {
        //
    }

    public function enable($inst_codigo, $usvi_codigo) {
        $usviActualizar = Usuarios::where(['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->update([
            'usvi_vigente' => 'S',
            'usvi_actualizado' => Carbon::now()->toDateTimeString()
        ]);
        if (!$usviActualizar) return redirect()->back()->with('errorUsuario', 'Ocurrió un error al habilitar este usuario');

        $usviGuardado = Usuarios::where(['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->first();    
        $usviCrearLog = LogUsuarios::insert([
            'inst_codigo' => $usviGuardado->inst_codigo,
            'usvi_codigo' => $usviGuardado->usvi_codigo,
            'usvi_permisos' => $usviGuardado->usvi_permisos,
            'usvi_superadmin' => $usviGuardado->usvi_superadmin,
            'usvi_nombre' => $usviGuardado->usvi_nombre,
            'usvi_apellido' => $usviGuardado->usvi_apellido,
            'usvi_email' => $usviGuardado->usvi_email,
            'usvi_telefono' => $usviGuardado->usvi_telefono,
            'usvi_clave' => $usviGuardado->usvi_clave,
            'usvi_nacimiento' => $usviGuardado->usvi_nacimiento,
            'usvi_direccion' => $usviGuardado->usvi_direccion,
            'usvi_comuna' => $usviGuardado->usvi_comuna,
            'usvi_provincia' => $usviGuardado->usvi_provincia,
            'usvi_region' => $usviGuardado->usvi_region,
            'usvi_pais' => $usviGuardado->usvi_pais,
            'usvi_foto' => $usviGuardado->usvi_foto,
            'usvi_profesion' => $usviGuardado->usvi_profesion,
            'usvi_ocupacion' => $usviGuardado->usvi_ocupacion,
            'usvi_presentacion' => $usviGuardado->usvi_presentacion,
            'usvi_intereses' => $usviGuardado->usvi_intereses,
            'usvi_habilidades' => $usviGuardado->usvi_habilidades,
            'usvi_vins' => $usviGuardado->usvi_vins,
            'usvi_creado' => $usviGuardado->usvi_creado,
            'usvi_actualizado' => $usviGuardado->usvi_actualizado,
            'usvi_vigente' => $usviGuardado->usvi_vigente,
            'log_codigo' => 3,
            'log_institucion_mod' => Session::get('usuario')->inst_codigo,
            'log_usuario_mod' => Session::get('usuario')->usvi_codigo,
            'log_fecha_mod' => Carbon::now()->toDateTimeString()
        ]);

        if (!$usviActualizar && !$usviCrearLog) return redirect()->back()->with('errorUsuario', 'Ocurrió un error al habilitar este usuario, inténtelo más tarde.');
        return redirect()->route('usuarios.show', ['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->with('actualizarUsuario', 'El usuario fue habilitado correctamente.');
    }

    public function disable($inst_codigo, $usvi_codigo) {
        $usviActualizar = Usuarios::where(['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->update([
            'usvi_vigente' => 'N',
            'usvi_actualizado' => Carbon::now()->toDateTimeString()
        ]);
        if (!$usviActualizar) return redirect()->back()->with('errorUsuario', 'Ocurrió un error al deshabilitar este usuario');

        $usviGuardado = Usuarios::where(['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->first();    
        $usviCrearLog = LogUsuarios::insert([
            'inst_codigo' => $usviGuardado->inst_codigo,
            'usvi_codigo' => $usviGuardado->usvi_codigo,
            'usvi_permisos' => $usviGuardado->usvi_permisos,
            'usvi_superadmin' => $usviGuardado->usvi_superadmin,
            'usvi_nombre' => $usviGuardado->usvi_nombre,
            'usvi_apellido' => $usviGuardado->usvi_apellido,
            'usvi_email' => $usviGuardado->usvi_email,
            'usvi_telefono' => $usviGuardado->usvi_telefono,
            'usvi_clave' => $usviGuardado->usvi_clave,
            'usvi_nacimiento' => $usviGuardado->usvi_nacimiento,
            'usvi_direccion' => $usviGuardado->usvi_direccion,
            'usvi_comuna' => $usviGuardado->usvi_comuna,
            'usvi_provincia' => $usviGuardado->usvi_provincia,
            'usvi_region' => $usviGuardado->usvi_region,
            'usvi_pais' => $usviGuardado->usvi_pais,
            'usvi_foto' => $usviGuardado->usvi_foto,
            'usvi_profesion' => $usviGuardado->usvi_profesion,
            'usvi_ocupacion' => $usviGuardado->usvi_ocupacion,
            'usvi_presentacion' => $usviGuardado->usvi_presentacion,
            'usvi_intereses' => $usviGuardado->usvi_intereses,
            'usvi_habilidades' => $usviGuardado->usvi_habilidades,
            'usvi_vins' => $usviGuardado->usvi_vins,
            'usvi_creado' => $usviGuardado->usvi_creado,
            'usvi_actualizado' => $usviGuardado->usvi_actualizado,
            'usvi_vigente' => $usviGuardado->usvi_vigente,
            'log_codigo' => 3,
            'log_institucion_mod' => Session::get('usuario')->inst_codigo,
            'log_usuario_mod' => Session::get('usuario')->usvi_codigo,
            'log_fecha_mod' => Carbon::now()->toDateTimeString()
        ]);

        if (!$usviActualizar && !$usviCrearLog) return redirect()->back()->with('errorUsuario', 'Ocurrió un error al deshabilitar este usuario, inténtelo más tarde.');
        return redirect()->route('usuarios.show', ['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->with('actualizarUsuario', 'El usuario fue deshabilitado correctamente.');
    }

    public function enableAdmin($inst_codigo, $usvi_codigo) {
        $usviActualizar = Usuarios::where(['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->update([
            'usvi_superadmin' => 'S',
            'usvi_actualizado' => Carbon::now()->toDateTimeString()
        ]);
        if (!$usviActualizar) return redirect()->back()->with('errorUsuario', 'Ocurrió un error al habilitar este usuario como administrador, inténtelo más tarde.');

        $usviGuardado = Usuarios::where(['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->first();    
        $usviCrearLog = LogUsuarios::insert([
            'inst_codigo' => $usviGuardado->inst_codigo,
            'usvi_codigo' => $usviGuardado->usvi_codigo,
            'usvi_permisos' => $usviGuardado->usvi_permisos,
            'usvi_superadmin' => $usviGuardado->usvi_superadmin,
            'usvi_nombre' => $usviGuardado->usvi_nombre,
            'usvi_apellido' => $usviGuardado->usvi_apellido,
            'usvi_email' => $usviGuardado->usvi_email,
            'usvi_telefono' => $usviGuardado->usvi_telefono,
            'usvi_clave' => $usviGuardado->usvi_clave,
            'usvi_nacimiento' => $usviGuardado->usvi_nacimiento,
            'usvi_direccion' => $usviGuardado->usvi_direccion,
            'usvi_comuna' => $usviGuardado->usvi_comuna,
            'usvi_provincia' => $usviGuardado->usvi_provincia,
            'usvi_region' => $usviGuardado->usvi_region,
            'usvi_pais' => $usviGuardado->usvi_pais,
            'usvi_foto' => $usviGuardado->usvi_foto,
            'usvi_profesion' => $usviGuardado->usvi_profesion,
            'usvi_ocupacion' => $usviGuardado->usvi_ocupacion,
            'usvi_presentacion' => $usviGuardado->usvi_presentacion,
            'usvi_intereses' => $usviGuardado->usvi_intereses,
            'usvi_habilidades' => $usviGuardado->usvi_habilidades,
            'usvi_vins' => $usviGuardado->usvi_vins,
            'usvi_creado' => $usviGuardado->usvi_creado,
            'usvi_actualizado' => $usviGuardado->usvi_actualizado,
            'usvi_vigente' => $usviGuardado->usvi_vigente,
            'log_codigo' => 3,
            'log_institucion_mod' => Session::get('usuario')->inst_codigo,
            'log_usuario_mod' => Session::get('usuario')->usvi_codigo,
            'log_fecha_mod' => Carbon::now()->toDateTimeString()
        ]);

        if (!$usviActualizar && !$usviCrearLog) return redirect()->back()->with('errorUsuario', 'Ocurrió un error al habilitar este usuario como administrador, inténtelo más tarde.');
        return redirect()->route('usuarios.show', ['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->with('actualizarUsuario', 'El usuario fue habilitado como administrador.');
    }

    public function disableAdmin($inst_codigo, $usvi_codigo) {
        $usviActualizar = Usuarios::where(['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->update([
            'usvi_superadmin' => 'N',
            'usvi_actualizado' => Carbon::now()->toDateTimeString()
        ]);
        if (!$usviActualizar) return redirect()->back()->with('errorUsuario', 'Ocurrió un error al deshabilitar este usuario como administrador, inténtelo más tarde.');

        $usviGuardado = Usuarios::where(['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->first();    
        $usviCrearLog = LogUsuarios::insert([
            'inst_codigo' => $usviGuardado->inst_codigo,
            'usvi_codigo' => $usviGuardado->usvi_codigo,
            'usvi_permisos' => $usviGuardado->usvi_permisos,
            'usvi_superadmin' => $usviGuardado->usvi_superadmin,
            'usvi_nombre' => $usviGuardado->usvi_nombre,
            'usvi_apellido' => $usviGuardado->usvi_apellido,
            'usvi_email' => $usviGuardado->usvi_email,
            'usvi_telefono' => $usviGuardado->usvi_telefono,
            'usvi_clave' => $usviGuardado->usvi_clave,
            'usvi_nacimiento' => $usviGuardado->usvi_nacimiento,
            'usvi_direccion' => $usviGuardado->usvi_direccion,
            'usvi_comuna' => $usviGuardado->usvi_comuna,
            'usvi_provincia' => $usviGuardado->usvi_provincia,
            'usvi_region' => $usviGuardado->usvi_region,
            'usvi_pais' => $usviGuardado->usvi_pais,
            'usvi_foto' => $usviGuardado->usvi_foto,
            'usvi_profesion' => $usviGuardado->usvi_profesion,
            'usvi_ocupacion' => $usviGuardado->usvi_ocupacion,
            'usvi_presentacion' => $usviGuardado->usvi_presentacion,
            'usvi_intereses' => $usviGuardado->usvi_intereses,
            'usvi_habilidades' => $usviGuardado->usvi_habilidades,
            'usvi_vins' => $usviGuardado->usvi_vins,
            'usvi_creado' => $usviGuardado->usvi_creado,
            'usvi_actualizado' => $usviGuardado->usvi_actualizado,
            'usvi_vigente' => $usviGuardado->usvi_vigente,
            'log_codigo' => 3,
            'log_institucion_mod' => Session::get('usuario')->inst_codigo,
            'log_usuario_mod' => Session::get('usuario')->usvi_codigo,
            'log_fecha_mod' => Carbon::now()->toDateTimeString()
        ]);

        if (!$usviActualizar && !$usviCrearLog) return redirect()->back()->with('errorUsuario', 'Ocurrió un error al deshabilitar este usuario como administrador, inténtelo más tarde.');
        return redirect()->route('usuarios.show', ['inst_codigo' => $inst_codigo, 'usvi_codigo' => $usvi_codigo])->with('actualizarUsuario', 'El usuario fue deshabilitado como administrador.');
    }

    public function inicio() {
        return view('usuario.inicio');
    }

    public function vinculamos() {
        return view('vinculamos');
    }

    public function normativas() {
        return view('normativas');
    }
}
