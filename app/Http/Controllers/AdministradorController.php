<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Institucion;
use App\Models\LogInstitucion;
use App\Models\Usuario;
use Carbon\Carbon;

class AdministradorController extends Controller {

    public function inicio() {
        return view('admin.inicio');
    }

    public function listarInstituciones() {
        /*$instModelo = new Institucion();
        $usviModelo = new Usuario();
        $instituciones = $instModelo->get();
        $miembros = $usviModelo->get();
        return view('admin.instituciones.listar', ['instituciones' => $instituciones, 'miembros' => $miembros]);*/
    }

    public function crearInstitucion() {
        //return view('admin.instituciones.formulario');
    }

    public function guardarInstitucion(Request $request) {
        $validacion = $request->validate([
            'codigo' => 'required|max:100|unique:instituciones,inst_codigo',
            'tipo' => 'required|max:100',
            'nombre' => 'required|max:100',
            'direccion' => 'required|max:100',
            'pais' => 'required|max:100',
            'region' => 'required|max:100',
            'provincia' => 'required|max:100',
            'comuna' => 'required|max:100',
            'contacto' => 'required|max:50',
            'sitioweb' => 'required|max:255',
            'logo' => 'required|image|mimes:jpg,jpeg,png|max:500' /** maximo 500 KB */
        ],
        [
            'codigo.required' => 'El código de la institución es requerido',
            'codigo.max' => 'El código de la institución excede los 100 caracteres',
            'codigo.unique' => 'El código de institución ya existe',
            'tipo.required' => 'El tipo de institución es requerido',
            'tipo.max' => 'El tipo de institución excede los 100 caracteres',
            'nombre.required' => 'El nombre de la institución es requerido',
            'nombre.max' => 'El nombre de la institución excede los 100 caracteres',
            'direccion.required' => 'La dirección de la institución es requerida',
            'direccion.max' => 'La dirección de la institución excede los 100 caracteres',
            'pais.required' => 'El país es requerido',
            'pais.max' => 'El país excede los 100 caracteres',
            'region.required' => 'La región es requerida',
            'region.max' => 'La región excede los 100 caracteres',
            'provincia.required' => 'La provincia es requerida',
            'provincia.max' => 'La provincia excede los 100 caracteres',
            'comuna.required' => 'La comuna es requerida',
            'comuna.max' => 'La comuna excede los 100 caracteres',
            'contacto.required' => 'El contacto es requerido',
            'contacto.max' => 'El contacto excede los 50 caracteres',
            'sitioweb.required' => 'El sitio web es requerido',
            'sitioweb.max' => 'El sitio web excede los 255 caracteres',
            'logo.required' => 'El logo es requerido',
            'logo.image' => 'El logo debe ser un archivo de tipo imagen',
            'logo.mimes' => 'El logo debe ser una imagen en formato .png, .jpg, .jpeg',
            'logo.max' => 'El logo debe tener 500 KB como tamaño máximo'
        ]);

        if (!$validacion) return redirect()->back()->withErrors($validacion)->withInput();
        if (!$request->file('logo')) return redirect()->back()->with('errorLogo', 'El logo no se ha cargado correctamente, inténtelo más tarde.');

        $archivo = $request->file('logo');
        $extensionLogo = $request->file('logo')->extension();
        $nombreLogo = $request->codigo.'.'.$extensionLogo; /** nombre de logo es el código de la institución + la extensión del archivo */
        $rutaLogo = 'images/instituciones/'.$nombreLogo;
        if (file_exists(public_path().$rutaLogo)) {
            $archivo->delete(public_path('images/instituciones'), $nombreLogo);
        } else {
            $archivo->move(public_path('images/instituciones'), $nombreLogo);
        }
        
        $instModelo = Institucion::create([
            'inst_codigo' => $request->codigo,
            'inst_tipo' => $request->tipo,
            'inst_nombre' => $request->nombre,
            'inst_direccion' => $request->direccion,
            'inst_pais' => $request->pais,
            'inst_region' => $request->region,
            'inst_provincia' => $request->provincia,
            'inst_comuna' => $request->comuna,
            'inst_contacto' => $request->contacto,
            'inst_url_web' => $request->sitioweb,
            'inst_logo' => $rutaLogo,
            'inst_creado' => Carbon::now()->toDateTimeString(),
            'inst_actualizado' => Carbon::now()->toDateTimeString(),
            'inst_vigente' => 'S'
        ]);
        if (!$instModelo) return redirect()->back()->with('errorInstitucion', 'Ocurrió un error durante el registro de la institución')->withInput();

        $instGuardado = Institucion::where('inst_codigo', $request->codigo)->orderBy('inst_actualizado', 'desc')->first();
        if (empty($instGuardado)) return redirect()->back()->with('errorInstitucion', 'Ocurrió un error al consultar los datos de la institución')->withInput();

        $logInstModelo = LogInstitucion::create([
            'inst_codigo' => $instGuardado->inst_codigo,
            'inst_tipo' => $instGuardado->inst_tipo,
            'inst_nombre' => $instGuardado->inst_nombre,
            'inst_direccion' => $instGuardado->inst_direccion,
            'inst_pais' => $instGuardado->inst_pais,
            'inst_region' => $instGuardado->inst_region,
            'inst_provincia' => $instGuardado->inst_provincia,
            'inst_comuna' => $instGuardado->inst_comuna,
            'inst_contacto' => $instGuardado->inst_contacto,
            'inst_url_web' => $instGuardado->inst_url_web,
            'inst_logo' => $instGuardado->inst_logo,
            'inst_creado' => $instGuardado->inst_creado,
            'inst_actualizado' => $instGuardado->inst_actualizado,
            'inst_vigente' => $instGuardado->inst_vigente,
            'log_codigo' => 1,
            'log_institucion_mod' => Session::get('usuario')->inst_codigo,
            'log_usuario_mod' => Session::get('usuario')->usvi_codigo,
            'log_fecha_mod' => Carbon::now()->toDateTimeString()
        ]);
        if (!$logInstModelo) return redirect()->back()->with('errorInstitucion', 'Ocurrió un error durante la creación del registro')->withInput();
        return redirect()->route('admin.listar.instituciones')->with('registrarInstitucion', 'La institución fue registrada correctamente');
    }

    public function verInstitucion($inst_codigo) {
        return $inst_codigo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
