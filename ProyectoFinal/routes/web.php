<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\RutaController;

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

//Front-end
Route::get('/', [AppController::class, 'index'])->name('home');
Route::get('noticias', [AppController::class, 'noticias'])->name('noticias');
Route::get('noticia/{slug}', [AppController::class, 'noticia'])->name('noticia');
Route::get('otros-contenidos', [AppController::class, 'otroscontenidos'])->name('otros-contenidos');
Route::get('rutas', [AppController::class, 'rutas'])->name('rutas');
Route::get('ruta/{slug}', [AppController::class, 'ruta'])->name('ruta');

//Back-end de usuarios
Route::get('admin', [AdminController::class, 'index'])->name('admin');
Route::get('admin/usuarios', [UsuarioController::class, 'index'])->middleware('role:usuarios');
Route::get('admin/usuarios/crear', [UsuarioController::class, 'crear'])->middleware('role:usuarios');
Route::post('admin/usuarios/guardar', [UsuarioController::class, 'guardar'])->middleware('role:usuarios');
Route::get('admin/usuarios/editar/{id}', [UsuarioController::class, 'editar'])->middleware('role:usuarios');
Route::post('admin/usuarios/actualizar/{id}', [UsuarioController::class, 'actualizar'])->middleware('role:usuarios');
Route::get('admin/usuarios/activar/{id}', [UsuarioController::class, 'activar'])->middleware('role:usuarios');
Route::get('admin/usuarios/borrar/{id}', [UsuarioController::class, 'borrar'])->middleware('role:usuarios');

//Back-end de noticias
Route::get('admin', [AdminController::class, 'index'])->name('admin');
Route::get('admin/noticias', [NoticiaController::class, 'index'])->middleware('role:noticias');
Route::get('admin/noticias/crear', [NoticiaController::class, 'crear'])->middleware('role:noticias');
Route::post('admin/noticias/guardar', [NoticiaController::class, 'guardar'])->middleware('role:noticias');
Route::get('admin/noticias/editar/{id}', [NoticiaController::class, 'editar'])->middleware('role:noticias');
Route::post('admin/noticias/actualizar/{id}', [NoticiaController::class, 'actualizar'])->middleware('role:noticias');
Route::get('admin/noticias/activar/{id}', [NoticiaController::class, 'activar'])->middleware('role:noticias');
Route::get('admin/noticias/home/{id}', [NoticiaController::class, 'home'])->middleware('role:noticias');
Route::get('admin/noticias/borrar/{id}', [NoticiaController::class, 'borrar'])->middleware('role:noticias');

//Back-end de Rutas
Route::get('admin', [AdminController::class, 'index'])->name('admin');
Route::get('admin/rutas', [RutaController::class, 'index'])->middleware('role:rutas');
Route::get('admin/rutas/crear', [RutaController::class, 'crear'])->middleware('role:rutas');
Route::post('admin/rutas/guardar', [RutaController::class, 'guardar'])->middleware('role:rutas');
Route::get('admin/rutas/editar/{id}', [RutaController::class, 'editar'])->middleware('role:rutas');
Route::post('admin/rutas/actualizar/{id}', [RutaController::class, 'actualizar'])->middleware('role:rutas');
Route::get('admin/rutas/activar/{id}', [RutaController::class, 'activar'])->middleware('role:rutas');
Route::get('admin/rutas/home/{id}', [RutaController::class, 'home'])->middleware('role:rutas');
Route::get('admin/rutas/borrar/{id}', [RutaController::class, 'borrar'])->middleware('role:rutas');

//Auth
Route::get('acceder', [AuthController::class, 'acceder'])->name('acceder');
Route::post('autenticar', [AuthController::class, 'autenticar'])->name('autenticar');
Route::get('registro', [AuthController::class, 'registro'])->name('registro');
Route::post('registrarse', [AuthController::class, 'registrarse'])->name('registrarse');
Route::post('salir', [AuthController::class, 'salir'])->name('salir');

//Ruta por defecto (si no encuentra otra antes)
Route::any('{query}', function() { return redirect('/'); })->where('query', '.*');
