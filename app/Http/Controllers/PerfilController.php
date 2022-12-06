<?php

namespace App\Http\Controllers;

use App\Models\Instituciones;
use App\Models\LogUsuarios;
use Illuminate\Http\Request;
use App\Models\Usuarios;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


class PerfilController extends Controller {
    
    public function index() {
        $usuario = Session::get('usuario');
        return view('usuario.perfil.mostrar', [
            'institucion' => Instituciones::where('inst_codigo', $usuario->inst_codigo)->first(),
            'usuario' => Usuarios::where(['inst_codigo' => $usuario->inst_codigo, 'usvi_codigo' => $usuario->usvi_codigo])->first()
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit() {
        $usuario = Session::get('usuario');
        return view('usuario.perfil.formulario', [
            'usuario' => Usuarios::where(['inst_codigo' => $usuario->inst_codigo, 'usvi_codigo' => $usuario->usvi_codigo])->first()
        ]);
    }

    public function update(Request $request) {
        $usuario = Session::get('usuario');
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
            $usviActualizar = Usuarios::where(['inst_codigo' => $usuario->inst_codigo, 'usvi_codigo' => $usuario->usvi_codigo])->update([
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
            $nombreFoto = $usuario->inst_codigo.'_'.$usuario->usvi_codigo.'.'.$extensionFoto; /** nombre de foto es el código de la institución + nombre de usuario + extensión del archivo */
            $rutaFoto = 'images/usuarios/'.$nombreFoto;
            if (File::exists(public_path($rutaFoto))) File::delete(public_path($rutaFoto));
            $archivo->move(public_path('images/usuarios'), $nombreFoto);
            
            $usviActualizar = Usuarios::where(['inst_codigo' => $usuario->inst_codigo, 'usvi_codigo' => $usuario->usvi_codigo])->update([
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

        if (!$usviActualizar) return redirect()->back()->with('errorUsuario', 'Ocurrió un error durante la actualización del perfil, inténtelo más tarde.')->withInput();

        $usviActualizado = Usuarios::where(['inst_codigo' => $usuario->inst_codigo, 'usvi_codigo' => $usuario->usvi_codigo])->first();
        $usviCrearLog = LogUsuarios::insert([
            'inst_codigo' => $usviActualizado->inst_codigo,
            'usvi_codigo' => $usviActualizado->usvi_codigo,
            'usvi_id_perfil' => $usviActualizado->usvi_id_perfil,
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
        if (!$usviActualizar && !$usviCrearLog) return redirect()->back()->with('errorUsuario', 'Ocurrió un error durante la actualización del perfil, inténtelo más tarde.')->withInput();
        return redirect()->route('perfil.index')->with('actualizarUsuario', 'El perfil fue actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
