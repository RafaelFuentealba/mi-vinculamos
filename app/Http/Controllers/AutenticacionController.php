<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class AutenticacionController extends Controller {
    
    public function ingresar() {
        return view('auth.ingresar');
    }

    public function validarIngreso(Request $request) {
        $request->validate(
            [
                'usuario' => 'required',
                'clave' => 'required'
            ],
            [
                'usuario.required' => 'El nombre de usuario es requerido',
                'clave.required' => 'La contraseña es requerida'
            ]
        );

        $usuario = Usuarios::where('usvi_codigo', $request->usuario)->first();
        if (!$usuario) {
            return redirect()->back()->with('errorUsuario', 'El usuario no está registrado');
        }
        
        $validarClave = Hash::check($request->clave, $usuario['usvi_clave']);
        if (!$validarClave) {
            return redirect()->back()->with('errorClave', 'La contraseña es incorrecta')->withInput();
        }

        $request->session()->put('usuario', $usuario);
        return redirect()->to('/');
    }

    public function registrar() {
        return view('auth.registrar');
    }

    public function guardarRegistro(Request $request) {
        $usuario = Usuarios::create([
            'inst_codigo' => $request->institucion,
            'usvi_codigo' => $request->usuario,
            'usvi_nombre' => $request->nombre,
            'usvi_apellido' => $request->apellido,
            'usvi_email' => $request->email,
            'usvi_clave' => Hash::make($request->clave),
            'usvi_creado' => Carbon::now()->toDateTimeString(),
            'usvi_actualizado' => Carbon::now()->toDateTimeString(),
            'usvi_vigente' => 'S'
        ]);

        if ($usuario) {
            return redirect()->to('ingresar');
        }

        return redirect()->back()->with('errorRegistro', 'Ocurrió un error durante el registro');
    }

    public function cerrarSesion() {
        if (Session::has('usuario')) {
            Session::forget('usuario');
            return redirect()->to('ingresar?acceso=out')->with('sesionFinalizada', 'Sesión finalizada');
        }
        
        return redirect()->back();
    }

}
