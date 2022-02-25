<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\UsuarioPeliculaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
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

Route::get('/', [PeliculaController::class,'ultimosRegistros']);

Auth::routes(['verify' => true]);
Route::resource('pelicula', PeliculaController::class);
Route::resource('serie', SerieController::class);


Route::get('datos',[PeliculaController::class,'database'])->name('pelicula.datos')->middleware('admin');
Route::get('datos/user',[UsuarioPeliculaController::class,'database'])->name('users.datos');
Route::get('search',[PeliculaController::class,'busqueda'])->name('pelicula.busqueda')->middleware('search');

Route::get('recuperar/{id}',[PeliculaController::class,'recuperarPelicula'])->name('pelicula.recuperar')->middleware('admin');

Route::get('recuperar/user/{id}',[UsuarioPeliculaController::class,'recuperarUsuario'])->name('user.recuperar')->middleware('admin');

Route::get('recuperar/serie/{id}',[SerieController::class,'recuperarSerie'])->name('user.recuperar')->middleware('admin');
Route::post('ver/pelicula',[PeliculaController::class,'addPeliculaVista'])->name('pelicula.vista')->middleware('verified');
Route::post('ver/serie',[SerieController::class,'addSerieVista'])->name('serie.vista')->middleware('verified');
Route::get('categoria/{categoria}/{ordenar}/{busqueda?}',[PeliculaController::class,'ordenar'])->middleware('oldurl');

Route::get('perfil',[UsuarioPeliculaController::class,'perfil'])->name('users.perfil');
Route::get('editar/{id}',[UsuarioPeliculaController::class,'editUser'])->name('users.edit')->middleware('bloquearEdit');
Route::put('update',[UsuarioPeliculaController::class,'userupdate'])->name('users.update');
Route::get('privilegios/{id}',[UsuarioPeliculaController::class,'darPrivilegios'])->name('users.privilegios')->middleware('admin');
Route::get('log',[LoginController::class,'index'])->name('users.login');
Route::get('email/aviso',[VerificationController::class,'index'])->name('verification.aviso');
Route::get('reset',[ResetPasswordController::class,'index'])->name('users.reset');
Route::resource('user',UsuarioPeliculaController::class);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
