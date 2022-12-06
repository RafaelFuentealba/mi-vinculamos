<?php

namespace App\Http\Controllers;

use App\Models\Instituciones;
use App\Models\LogInstituciones;
use Illuminate\Http\Request;
use App\Models\Usuarios;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class InstitucionesController extends Controller {
    public function index() {
        return view('admin.instituciones.listar', [
            'instituciones' => Instituciones::orderBy('inst_creado', 'desc')->get(),
            'usuarios' => Usuarios::get()
        ]);
    }

    public function create() {
        return view('admin.instituciones.formulario');
    }

    public function store(Request $request) {
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
        if (File::exists(public_path($rutaLogo))) File::delete(public_path($rutaLogo));
        $archivo->move(public_path('images/instituciones'), $nombreLogo);
        
        $instCrear = Instituciones::insert([
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
        if (!$instCrear) return redirect()->back()->with('errorInstitucion', 'Ocurrió un error durante el registro de la institución, inténtelo más tarde.')->withInput();

        $instGuardado = Instituciones::where('inst_codigo', $request->codigo)->orderBy('inst_actualizado', 'desc')->first();
        $instCrearLog = LogInstituciones::insert([
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
        
        if (!$instCrear && !$instCrearLog) return redirect()->back()->with('errorInstitucion', 'Ocurrió un error durante el registro de la institución, inténtelo más tarde.')->withInput();
        return redirect()->route('instituciones.index')->with('registrarInstitucion', 'La institución fue registrada correctamente.');
    }

    public function show($inst_codigo) {
        return view('admin.instituciones.mostrar', [
            'institucion' => Instituciones::where('inst_codigo', $inst_codigo)->first(),
            'contadorUsuarios' => Usuarios::where('inst_codigo', $inst_codigo)->get()->count(),
            'usuarios' => Usuarios::where('inst_codigo', $inst_codigo)->orderBy('usvi_creado', 'DESC')->get()
        ]);
    }

    public function edit($inst_codigo) {
        return view('admin.instituciones.formulario', [
            'institucion' => Instituciones::where('inst_codigo', $inst_codigo)->first()
        ]);
    }

    public function update(Request $request, $inst_codigo) {
        $validacion = $request->validate([
            'tipo' => 'required|max:100',
            'nombre' => 'required|max:100',
            'direccion' => 'required|max:100',
            'pais' => 'required|max:100',
            'region' => 'required|max:100',
            'provincia' => 'required|max:100',
            'comuna' => 'required|max:100',
            'contacto' => 'required|max:50',
            'sitioweb' => 'required|max:255',
        ],
        [
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
        ]);

        if (!$validacion) return redirect()->back()->withErrors($validacion)->withInput();
        if (!$request->file('logo')) {
            $instActualizar = Instituciones::where('inst_codigo', $inst_codigo)->update([
                'inst_tipo' => $request->tipo,
                'inst_nombre' => $request->nombre,
                'inst_direccion' => $request->direccion,
                'inst_pais' => $request->pais,
                'inst_region' => $request->region,
                'inst_provincia' => $request->provincia,
                'inst_comuna' => $request->comuna,
                'inst_contacto' => $request->contacto,
                'inst_url_web' => $request->sitioweb,
                'inst_actualizado' => Carbon::now()->toDateTimeString(),
            ]);
        } else {
            $validacionLogo = $request->validate([
                'logo' => 'required|image|mimes:jpg,jpeg,png|max:500' /** maximo 500 KB */
            ],
            [
                'logo.required' => 'El logo es requerido',
                'logo.image' => 'El logo debe ser un archivo de tipo imagen',
                'logo.mimes' => 'El logo debe ser una imagen en formato .png, .jpg, .jpeg',
                'logo.max' => 'El logo debe pesar 500 KB como tamaño máximo'
            ]);
            if (!$validacionLogo) return redirect()->back()->withErrors($validacionLogo)->withInput();

            $archivo = $request->file('logo');
            $extensionLogo = $request->file('logo')->extension();
            $nombreLogo = $inst_codigo.'.'.$extensionLogo; /** nombre de logo es el código de la institución + la extensión del archivo */
            $rutaLogo = 'images/instituciones/'.$nombreLogo;
            if (File::exists(public_path($rutaLogo))) File::delete(public_path($rutaLogo));
            $archivo->move(public_path('images/instituciones'), $nombreLogo);

            $instActualizar = Instituciones::where('inst_codigo', $inst_codigo)->update([
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
                'inst_actualizado' => Carbon::now()->toDateTimeString(),
            ]);
        }
        
        if (!$instActualizar) return redirect()->back()->with('errorInstitucion', 'Ocurrió un error durante la actualización de la institución, inténtelo más tarde.')->withInput();
        
        $instActualizado = Instituciones::where('inst_codigo', $inst_codigo)->first();
        $instCrearLog = LogInstituciones::insert([
            'inst_codigo' => $instActualizado->inst_codigo,
            'inst_tipo' => $instActualizado->inst_tipo,
            'inst_nombre' => $instActualizado->inst_nombre,
            'inst_direccion' => $instActualizado->inst_direccion,
            'inst_pais' => $instActualizado->inst_pais,
            'inst_region' => $instActualizado->inst_region,
            'inst_provincia' => $instActualizado->inst_provincia,
            'inst_comuna' => $instActualizado->inst_comuna,
            'inst_contacto' => $instActualizado->inst_contacto,
            'inst_url_web' => $instActualizado->inst_url_web,
            'inst_logo' => $instActualizado->inst_logo,
            'inst_creado' => $instActualizado->inst_creado,
            'inst_actualizado' => $instActualizado->inst_actualizado,
            'inst_vigente' => $instActualizado->inst_vigente,
            'log_codigo' => 3,
            'log_institucion_mod' => Session::get('usuario')->inst_codigo,
            'log_usuario_mod' => Session::get('usuario')->usvi_codigo,
            'log_fecha_mod' => Carbon::now()->toDateTimeString()
        ]);
        if (!$instActualizar && !$instCrearLog) return redirect()->back()->with('errorInstitucion', 'Ocurrió un error durante la actualización de la institución, inténtelo más tarde.')->withInput();
        return redirect()->route('instituciones.show', $inst_codigo)->with('actualizarInstitucion', 'La institución fue actualizada correctamente.');
    }

    public function destroy($inst_codigo) {
        $usuariosInstitucion = Usuarios::where('inst_codigo', $inst_codigo)->get()->count();
        if ($usuariosInstitucion > 0) return redirect()->back()->with('errorInstitucion', 'No se puede eliminar la institución porque posee usuarios anexados.');
        
        $instGuardado = Instituciones::where('inst_codigo', $inst_codigo)->first();
        if (File::exists(public_path($instGuardado->inst_logo))) File::delete(public_path($instGuardado->inst_logo));
        
        $instEliminar = Instituciones::where('inst_codigo', $inst_codigo)->delete();
        if (!$instEliminar) return redirect()->back()->with('errorInstitucion', 'Ocurrió un error al eliminar la institución, inténtelo más tarde.');

        $instCrearLog = LogInstituciones::insert([
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
            'log_codigo' => 4,
            'log_institucion_mod' => Session::get('usuario')->inst_codigo,
            'log_usuario_mod' => Session::get('usuario')->usvi_codigo,
            'log_fecha_mod' => Carbon::now()->toDateTimeString()
        ]);

        if (!$instEliminar && !$instCrearLog) return redirect()->back()->with('errorInstitucion', 'Ocurrió un error al eliminar la institución, inténtelo más tarde.');
        return redirect()->route('instituciones.index')->with('eliminarInstitucion', 'La institución fue eliminada correctamente.');
    }

    public function enable($inst_codigo) {
        $instActualizar = Instituciones::where('inst_codigo', $inst_codigo)->update([
            'inst_vigente' => 'S',
            'inst_actualizado' => Carbon::now()->toDateTimeString()
        ]);
        if (!$instActualizar) return redirect()->back()->with('errorInstitucion', 'Ocurrió un error al habilitar la institución, inténtelo más tarde.');

        $instGuardado = Instituciones::where('inst_codigo', $inst_codigo)->first();
        $instCrearLog = LogInstituciones::insert([
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
            'log_codigo' => 3,
            'log_institucion_mod' => Session::get('usuario')->inst_codigo,
            'log_usuario_mod' => Session::get('usuario')->usvi_codigo,
            'log_fecha_mod' => Carbon::now()->toDateTimeString()
        ]);

        if (!$instActualizar && !$instCrearLog) return redirect()->back()->with('errorInstitucion', 'Ocurrió un error al habilitar la institución, inténtelo más tarde.');
        return redirect()->route('instituciones.show', $inst_codigo)->with('actualizarInstitucion', 'La institución fue habilitada correctamente.');
    }

    public function disable($inst_codigo) {
        $usuariosInstitucion = Usuarios::where('inst_codigo', $inst_codigo)->get()->count();
        if ($usuariosInstitucion > 0) return redirect()->back()->with('errorInstitucion', 'No se puede deshabilitar la institución porque posee usuarios anexados.');

        $instActualizar = Instituciones::where('inst_codigo', $inst_codigo)->update([
            'inst_vigente' => 'N',
            'inst_actualizado' => Carbon::now()->toDateTimeString()
        ]);
        if (!$instActualizar) return redirect()->back()->with('errorInstitucion', 'Ocurrió un error al deshabilitar la institución, inténtelo más tarde.');

        $instGuardado = Instituciones::where('inst_codigo', $inst_codigo)->first();
        $instCrearLog = LogInstituciones::insert([
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
            'log_codigo' => 3,
            'log_institucion_mod' => Session::get('usuario')->inst_codigo,
            'log_usuario_mod' => Session::get('usuario')->usvi_codigo,
            'log_fecha_mod' => Carbon::now()->toDateTimeString()
        ]);

        if (!$instActualizar && !$instCrearLog) return redirect()->back()->with('errorInstitucion', 'Ocurrió un error al deshabilitar la institución, inténtelo más tarde.');
        return redirect()->route('instituciones.show', $inst_codigo)->with('actualizarInstitucion', 'La institución fue deshabilitada correctamente.');
    }
}
