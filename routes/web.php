<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CorteController;
use App\Http\Controllers\BarberController;
use App\Http\Controllers\ClienteController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [CorteController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('corte.store',[CorteController::class,'store'])->name('corte.store');




Route::get('/barber', [BarberController::class, 'index'])->middleware(['auth'])->name('barber');
Route::get('barber.store',[BarberController::class,'store'])->name('barber.store');
Route::get('barber/{id}',[BarberController::class,'edit'])->name('barber.edit');
Route::patch('/barber/{id}', [BarberController::class,'update'])->name('barber.update');
Route::get('barber/{id}/destroy',[BarberController::class,'destroy'])->name('barber.destroy');

Route::get('/cliente', [ClienteController::class, 'index'])->middleware(['auth'])->name('cliente');
Route::get('cliente.store',[ClienteController::class,'store'])->name('cliente.store');
Route::get('cliente/{id}',[ClienteController::class,'edit'])->name('cliente.edit');
Route::patch('/cliente/{id}', [ClienteController::class,'update'])->name('cliente.update');
Route::get('cliente/{id}/destroy',[ClienteController::class,'destroy'])->name('cliente.destroy');




//Route::resource('/dashboard', CorteController::class);

require __DIR__.'/auth.php';
