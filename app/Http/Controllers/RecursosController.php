<?php

namespace App\Http\Controllers;

use App\Models\Recursos;
use Illuminate\Http\Request;

class RecursosController extends Controller {
    public function index() {
        return view('admin.recursos.listar', [
            'recursos' => Recursos::orderBy('trec_creado', 'desc')->get()
        ]);
    }

    public function create() {
        return view('admin.recursos.formulario');
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
     * @param  \App\Models\TipoRecursos  $tipoRecursos
     * @return \Illuminate\Http\Response
     */
    public function show(Recursos $tipoRecursos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoRecursos  $tipoRecursos
     * @return \Illuminate\Http\Response
     */
    public function edit(Recursos $tipoRecursos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoRecursos  $tipoRecursos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recursos $tipoRecursos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoRecursos  $tipoRecursos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recursos $tipoRecursos)
    {
        //
    }
}
