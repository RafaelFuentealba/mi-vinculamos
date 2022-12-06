<?php

namespace App\Http\Controllers;

use App\Models\LogVins;
use App\Models\Vins;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VinsController extends Controller {
    public function index() {
        return view('admin.vins.listar', [
            'vins' => Vins::orderBy('pvin_creado', 'desc')->get()
        ]);
    }

    public function create() {
        $pvinGuardado = Vins::select('pvin_tabla_referencia')->get();
        return view('admin.vins.formulario', ['tablasRegistradas' => $pvinGuardado]);
    }

    public function store(Request $request) {
        $validacion = $request->validate([
            'nombre' => 'required|max:255',
            'tabla' => 'required|max:255',
            'cantidad' => 'required|integer',
            'descripcion' => 'required|max:255'
        ],
        [
            'nombre.required' => 'El nombre de la puntuación es requerido',
            'nombre.max' => 'El nombre de la puntuación excede los 255 caracteres',
            'tabla.required' => 'La tabla de referencia es requerida',
            'tabla.max' => 'La tabla de referencia excede los 255 caracteres',
            'cantidad.required' => 'La puntuación es requerida',
            'cantidad.integer' => 'La puntuación debe ser de tipo entero sin decimales',
            'descripcion.required' => 'La descripción es requerida',
            'descripcion.max' => 'La descripción excede los 255 caracteres'
        ]);
        if (!$validacion) return redirect()->back()->withErrors($validacion)->withInput();
        
        $pvinCrear = Vins::insertGetId([
            'pvin_nombre' => $request->nombre,
            'pvin_tabla_referencia' => $request->tabla,
            'pvin_tabla_descripcion' => $request->descripcion,
            'pvin_cantidad' => $request->cantidad,
            'pvin_creado' => Carbon::now()->toDateTimeString(),
            'pvin_actualizado' => Carbon::now()->toDateTimeString(),
            'pvin_vigente' => 'S'
        ], 'pvin_codigo');
        if (!$pvinCrear) return redirect()->back()->with('errorPuntuacion', 'Ocurrió un error durante el registro de la puntuación, inténtelo más tarde.')->withInput();
        
        $pvinGuardado = Vins::where('pvin_codigo', $pvinCrear)->first();
        $pvinCrearLog = LogVins::insert([
            'pvin_codigo' => $pvinGuardado->pvin_codigo,
            'pvin_nombre' => $pvinGuardado->pvin_nombre,
            'pvin_tabla_referencia' => $pvinGuardado->pvin_tabla_referencia,
            'pvin_tabla_descripcion' => $pvinGuardado->pvin_tabla_descripcion,
            'pvin_cantidad' => $pvinGuardado->pvin_cantidad,
            'pvin_creado' => $pvinGuardado->pvin_creado,
            'pvin_actualizado' => $pvinGuardado->pvin_actualizado,
            'pvin_vigente' => $pvinGuardado->pvin_vigente,
            'log_codigo' => 1,
            'log_institucion_mod' => Session::get('usuario')->inst_codigo,
            'log_usuario_mod' => Session::get('usuario')->usvi_codigo,
            'log_fecha_mod' => Carbon::now()->toDateTimeString()
        ]);

        if (!$pvinCrear && !$pvinCrearLog) return redirect()->back()->with('errorPuntuacion', 'Ocurrió un error durante el registro de la puntuación, inténtelo más tarde.')->withInput();
        return redirect()->route('vins.index')->with('registrarPuntuacion', 'La puntuación fue registrada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vins  $vins
     * @return \Illuminate\Http\Response
     */
    public function show(Vins $vins)
    {
        //
    }

    public function edit($pvin_codigo) {
        return view('admin.vins.formulario', [
            'puntuacion' => Vins::where('pvin_codigo', $pvin_codigo)->first()
        ]);
    }

    public function update(Request $request, $pvin_codigo) {
        $validacion = $request->validate([
            'nombre' => 'required|max:255',
            'cantidad' => 'required|integer',
            'descripcion' => 'required|max:255'
        ],
        [
            'nombre.required' => 'El nombre de la puntuación es requerido',
            'nombre.max' => 'El nombre de la puntuación excede los 255 caracteres',
            'cantidad.required' => 'La puntuación es requerida',
            'cantidad.integer' => 'La puntuación debe ser de tipo entero sin decimales',
            'descripcion.required' => 'La descripción es requerida',
            'descripcion.max' => 'La descripción excede los 255 caracteres'
        ]);
        if (!$validacion) return redirect()->back()->withErrors($validacion)->withInput();

        $pvinActualizar = Vins::where('pvin_codigo', $pvin_codigo)->update([
            'pvin_nombre' => $request->nombre,
            'pvin_tabla_descripcion' => $request->descripcion,
            'pvin_cantidad' => $request->cantidad,
            'pvin_actualizado' => Carbon::now()->toDateTimeString()
        ]);
        if (!$pvinActualizar) return redirect()->back()->with('errorPuntuacion', 'Ocurrió un error durante la actualización de la puntuación, inténtelo más tarde.')->withInput();

        $pvinActualizado = Vins::where('pvin_codigo', $pvin_codigo)->first();
        $pvinCrearLog = LogVins::insert([
            'pvin_codigo' => $pvinActualizado->pvin_codigo,
            'pvin_nombre' => $pvinActualizado->pvin_nombre,
            'pvin_tabla_referencia' => $pvinActualizado->pvin_tabla_referencia,
            'pvin_tabla_descripcion' => $pvinActualizado->pvin_tabla_descripcion,
            'pvin_cantidad' => $pvinActualizado->pvin_cantidad,
            'pvin_creado' => $pvinActualizado->pvin_creado,
            'pvin_actualizado' => $pvinActualizado->pvin_actualizado,
            'pvin_vigente' => $pvinActualizado->pvin_vigente,
            'log_codigo' => 3,
            'log_institucion_mod' => Session::get('usuario')->inst_codigo,
            'log_usuario_mod' => Session::get('usuario')->usvi_codigo,
            'log_fecha_mod' => Carbon::now()->toDateTimeString()
        ]);
        if (!$pvinActualizar && !$pvinCrearLog) return redirect()->back()->with('errorPuntuacion', 'Ocurrió un error durante la actualización de la puntuación, inténtelo más tarde.')->withInput();
        else return redirect()->route('vins.index')->with('actualizarPuntuacion', 'La puntuación fue actualizada correctamente.');
    }

    public function destroy($pvin_codigo) {        
        $pvinGuardado = Vins::where('pvin_codigo', $pvin_codigo)->first();
        $pvinEliminar = Vins::where('pvin_codigo', $pvin_codigo)->delete();
        if (!$pvinEliminar) return redirect()->back()->with('errorPuntuacion', 'Ocurrió un error al eliminar la puntuación, inténtelo más tarde.');

        $pvinCrearLog = LogVins::insert([
            'pvin_codigo' => $pvinGuardado->pvin_codigo,
            'pvin_nombre' => $pvinGuardado->pvin_nombre,
            'pvin_tabla_referencia' => $pvinGuardado->pvin_tabla_referencia,
            'pvin_tabla_descripcion' => $pvinGuardado->pvin_tabla_descripcion,
            'pvin_cantidad' => $pvinGuardado->pvin_cantidad,
            'pvin_creado' => $pvinGuardado->pvin_creado,
            'pvin_actualizado' => $pvinGuardado->pvin_actualizado,
            'pvin_vigente' => $pvinGuardado->pvin_vigente,
            'log_codigo' => 4,
            'log_institucion_mod' => Session::get('usuario')->inst_codigo,
            'log_usuario_mod' => Session::get('usuario')->usvi_codigo,
            'log_fecha_mod' => Carbon::now()->toDateTimeString()
        ]);

        if (!$pvinEliminar && !$pvinCrearLog) return redirect()->back()->with('errorPuntuacion', 'Ocurrió un error al eliminar la puntuación, inténtelo más tarde.');
        return redirect()->route('vins.index')->with('actualizarPuntuacion', 'La puntuación fue eliminada correctamente.');
    }

    public function enable($pvin_codigo) {
        $pvinActualizar = Vins::where('pvin_codigo', $pvin_codigo)->update([
            'pvin_vigente' => 'S',
            'pvin_actualizado' => Carbon::now()->toDateTimeString()
        ]);
        if (!$pvinActualizar) return redirect()->back()->with('errorPuntuacion', 'Ocurrió un error al habilitar esta puntuación, inténtelo más tarde.');

        $pvinActualizado = Vins::where('pvin_codigo', $pvin_codigo)->first();
        $pvinCrearLog = LogVins::insert([
            'pvin_codigo' => $pvinActualizado->pvin_codigo,
            'pvin_nombre' => $pvinActualizado->pvin_nombre,
            'pvin_tabla_referencia' => $pvinActualizado->pvin_tabla_referencia,
            'pvin_tabla_descripcion' => $pvinActualizado->pvin_tabla_descripcion,
            'pvin_cantidad' => $pvinActualizado->pvin_cantidad,
            'pvin_creado' => $pvinActualizado->pvin_creado,
            'pvin_actualizado' => $pvinActualizado->pvin_actualizado,
            'pvin_vigente' => $pvinActualizado->pvin_vigente,
            'log_codigo' => 3,
            'log_institucion_mod' => Session::get('usuario')->inst_codigo,
            'log_usuario_mod' => Session::get('usuario')->usvi_codigo,
            'log_fecha_mod' => Carbon::now()->toDateTimeString()
        ]);
        if (!$pvinActualizar && !$pvinCrearLog) return redirect()->back()->with('errorPuntuacion', 'Ocurrió un error al habilitar esta puntuación, inténtelo más tarde.');
        else return redirect()->route('vins.index')->with('actualizarPuntuacion', 'La puntuación fue habilitada correctamente.');
    }

    public function disable($pvin_codigo) {
        $pvinActualizar = Vins::where('pvin_codigo', $pvin_codigo)->update([
            'pvin_vigente' => 'N',
            'pvin_actualizado' => Carbon::now()->toDateTimeString()
        ]);
        if (!$pvinActualizar) return redirect()->back()->with('errorPuntuacion', 'Ocurrió un error al deshabilitar esta puntuación, inténtelo más tarde.');

        $pvinActualizado = Vins::where('pvin_codigo', $pvin_codigo)->first();
        $pvinCrearLog = LogVins::insert([
            'pvin_codigo' => $pvinActualizado->pvin_codigo,
            'pvin_nombre' => $pvinActualizado->pvin_nombre,
            'pvin_tabla_referencia' => $pvinActualizado->pvin_tabla_referencia,
            'pvin_tabla_descripcion' => $pvinActualizado->pvin_tabla_descripcion,
            'pvin_cantidad' => $pvinActualizado->pvin_cantidad,
            'pvin_creado' => $pvinActualizado->pvin_creado,
            'pvin_actualizado' => $pvinActualizado->pvin_actualizado,
            'pvin_vigente' => $pvinActualizado->pvin_vigente,
            'log_codigo' => 3,
            'log_institucion_mod' => Session::get('usuario')->inst_codigo,
            'log_usuario_mod' => Session::get('usuario')->usvi_codigo,
            'log_fecha_mod' => Carbon::now()->toDateTimeString()
        ]);
        if (!$pvinActualizar && !$pvinCrearLog) return redirect()->back()->with('errorPuntuacion', 'Ocurrió un error al deshabilitar esta puntuación, inténtelo más tarde.');
        else return redirect()->route('vins.index')->with('actualizarPuntuacion', 'La puntuación fue deshabilitada correctamente.');
    }
}
