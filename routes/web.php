<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
  //  return view('welcome');
//});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/', function () { return view('admin'); });

Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');
Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('usuarios.index')->middleware('auth','can:usuarios.index');
Route::get('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('usuarios.create')->middleware('auth','can:usuarios.create');
Route::post('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'store'])->name('usuarios.store')->middleware('auth','can:usuarios.store');
Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('usuarios.show')->middleware('auth','can:usuarios.show');
Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('usuarios.edit')->middleware('auth');
Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('usuarios.update')->middleware('auth');
Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('usuarios.destroy')->middleware('auth');

Route::get('/registro', [App\Http\Controllers\UsuarioController::class, 'registro'])->name('admin.index');
Route::post('/registro', [App\Http\Controllers\UsuarioController::class, 'registro_create'])->name('registro');

Route::get('/admin/mi_unidad', [App\Http\Controllers\CarpetaController::class, 'index'])->name('mi_unidad.index')->middleware('auth');
Route::post('/admin/mi_unidad', [App\Http\Controllers\CarpetaController::class, 'store'])->name('mi_unidad.store')->middleware('auth');
Route::get('/admin/mi_unidad/carpeta/{id}', [App\Http\Controllers\CarpetaController::class, 'show'])->name('mi_unidad.carpeta')->middleware('auth');
Route::put('/admin/mi_unidad/carpeta', [App\Http\Controllers\CarpetaController::class, 'update_subcarpeta'])->name('mi_unidad.carpeta.update_subcarpeta')->middleware('auth');
Route::put('/admin/mi_unidad/color', [App\Http\Controllers\CarpetaController::class, 'update_subcarpeta_color'])->name('mi_unidad.carpeta.update_subcarpeta_color')->middleware('auth');
Route::get('/admin/mi_unidad/carpeta', [App\Http\Controllers\CarpetaController::class, 'crear_subcarpeta'])->name('mi_unidad.carpeta.crear_subcarpeta')->middleware('auth');
Route::put('/admin/mi_unidad', [App\Http\Controllers\CarpetaController::class, 'update'])->name('mi_unidad.update')->middleware('auth');
Route::put('/admin/mi_unidad/color', [App\Http\Controllers\CarpetaController::class, 'update_color'])->name('mi_unidad.update_color')->middleware('auth');

//ruta eliminar carpetas
Route::delete('/admin/mi_unidad/eliminar_carpeta/{id}', [App\Http\Controllers\CarpetaController::class, 'destroy'])->name('carpeta.destroy')->middleware('auth');

//ruta eliminar subcarpetas
Route::delete('/admin/mi_unidad/eliminar_subcarpeta/{id}', [App\Http\Controllers\CarpetaController::class, 'destroy_subcarpeta'])->name('carpeta.destroy.sub_carpeta')->middleware('auth');

//Rutas para los archivos

Route::post('/admin/mi_unidad/carpeta/upload', [App\Http\Controllers\ArchivoController::class, 'upload'])->name('mi_unidad.archivo.upload')->middleware('auth');

//Ruta para eliminar archivos
Route::delete('/admin/mi_unidad/carpeta', [App\Http\Controllers\ArchivoController::class, 'eliminar_archivo'])->name('mi_unidad.archivo.eliminar_archivo')->middleware('auth');

//ruta para cambiar archivos de privada  a pública
Route::post('/admin/mi_unidad/carpeta/privado', [App\Http\Controllers\ArchivoController::class, 'privado_a_publico'])->name('mi_unidad.archivo.privado.publico')->middleware('auth');

//ruta para cambiar archivos de pública  a privada
Route::post('/admin/mi_unidad/carpeta/publico', [App\Http\Controllers\ArchivoController::class, 'publico_a_privado'])->name('mi_unidad.archivo.publico.privado')->middleware('auth');

//Ruta para mostrar archivos privados
Route::get('storage/{carpeta}/{archivo}',function ($carpeta,$archivo){
    if (Auth::check()) {
      $path = storage_path('app'.DIRECTORY_SEPARATOR.$carpeta.DIRECTORY_SEPARATOR.$archivo);
      return response()->file($path);
    }else {
      abort(403,'No tienen permiso para acceder a este archivo');
    }  
})->name('mostrar.archivo.privados');


Route::get('/admin/mi_unidad/restaurar_carpeta/{id}', [App\Http\Controllers\CarpetaController::class, 'restaurarCarpeta'])->name('carpeta.restaurar.carpeta')->middleware('auth');

Route::get('/admin/mi_unidad/restaurar_subcarpeta/{id}', [App\Http\Controllers\CarpetaController::class, 'restaurarSubcarpeta'])->name('carpeta.restaurar.sub_carpeta')->middleware('auth');