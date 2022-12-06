<?php

use App\Http\Controllers\AdministradorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\ContactosController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\FinanciamientosController;
use App\Http\Controllers\InstitucionesController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PublicacionesController;
use App\Http\Controllers\RecursosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\VinsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', [UsuarioController::class, 'inicio'])->name('sistema.inicio')->middleware('verificar.usuario');
Route::get('ingresar', [AutenticacionController::class, 'ingresar'])->name('ingresar.formulario')->middleware('verificar.sesion');
Route::post('ingresar', [AutenticacionController::class, 'validarIngreso'])->name('auth.ingresar');
Route::get('registrar', [AutenticacionController::class, 'registrar'])->name('registrar.formulario')->middleware('verificar.sesion');
Route::post('registrar', [AutenticacionController::class, 'guardarRegistro'])->name('auth.registrar');
Route::get('salir', [AutenticacionController::class, 'cerrarSesion'])->name('auth.cerrar');

Route::middleware('verificar.usuario')->group(function() {
    Route::get('/', [UsuariosController::class, 'inicio'])->name('usuario.inicio');
    Route::get('vinculamos', [UsuariosController::class, 'vinculamos'])->name('usuario.vinculamos');
    Route::get('normativas', [UsuariosController::class, 'normativas'])->name('usuario.normativas');


    Route::get('administracion', [AdministradorController::class, 'inicio'])->name('admin.inicio');
    Route::resource('instituciones', InstitucionesController::class);
    Route::put('instituciones/{inst_codigo}/enable',[InstitucionesController::class, 'enable'])->name('instituciones.enable');
    Route::put('instituciones/{inst_codigo}/disable',[InstitucionesController::class, 'disable'])->name('instituciones.disable');
    Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
    Route::post('usuarios', [UsuariosController::class, 'usuariosInstitucion'])->name('usuarios.institucion.index');
    Route::get('usuarios/{inst_codigo}/{usvi_codigo}', [UsuariosController::class, 'show'])->name('usuarios.show');
    Route::get('usuarios/{inst_codigo}/{usvi_codigo}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');
    Route::put('usuarios/{inst_codigo}/{usvi_codigo}/edit', [UsuariosController::class, 'update'])->name('usuarios.update');
    Route::put('usuarios/{inst_codigo}/{usvi_codigo}/enable', [UsuariosController::class, 'enable'])->name('usuarios.enable');
    Route::put('usuarios/{inst_codigo}/{usvi_codigo}/disable', [UsuariosController::class, 'disable'])->name('usuarios.disable');
    Route::put('usuarios/{inst_codigo}/{usvi_codigo}/enableadmin', [UsuariosController::class, 'enableAdmin'])->name('usuarios.enable.admin');
    Route::put('usuarios/{inst_codigo}/{usvi_codigo}/disableadmin', [UsuariosController::class, 'disableAdmin'])->name('usuarios.disable.admin');
    Route::resource('vins', VinsController::class);
    Route::put('vins/{pvin_codigo}/enable', [VinsController::class, 'enable'])->name('vins.enable');
    Route::put('vins/{pvin_codigo}/disable', [VinsController::class, 'disable'])->name('vins.disable');
    Route::resource('recursos', RecursosController::class);
    
    Route::get('perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::get('perfil/editar', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('perfil/editar', [PerfilController::class, 'update'])->name('perfil.update');


    Route::resource('publicaciones', PublicacionesController::class);
    Route::resource('eventos', EventosController::class);
    Route::resource('financiamientos', FinanciamientosController::class);
    Route::resource('cursos', CursosController::class);
    Route::resource('contactos', ContactosController::class);


    //Route::get('perfil/evento/listar', [EventoController::class, 'inicio'])->name('usuario.listar.evento');


    //Route::get('perfil/financiamiento/listar', [FinanciamientoController::class, 'inicio'])->name('usuario.listar.financiamiento');


    //Route::get('perfil/curso/listar', [CursoController::class, 'inicio'])->name('usuario.listar.curso');


    //Route::get('perfil/contacto/listar', [ContactoController::class, 'inicio'])->name('usuario.listar.contacto');


    //Route::get('perfil/institucion/listar', [InstitucionController::class, 'inicio'])->name('usuario.listar.institucion');
});