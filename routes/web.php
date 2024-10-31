<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CorteController;
use App\Http\Controllers\BarberController;
use App\Http\Controllers\ClienteController;
//use App\Http\Controllers\ChartController;
use App\Http\Controllers\SummariesController;
use App\Http\Controllers\Select2SearchController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\CompraPromocionController;




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

Route::get('/register', function () {
    return view('register');
});


Route::get('/dashboard', [CorteController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::resource('gastos', GastoController::class);

Route::get('/photos/create', [PhotoController::class , 'create'])->name('photo.create');
Route::post('/photos', [PhotoController::class, 'store'])->name('photo.store');
Route::get('/photos', [PhotoController::class, 'index'])->name('photo.index');
Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');

Route::get('/turnos', [TurnoController::class, 'index'])->name('turnos.index');
Route::get('/turnos/create', [TurnoController::class, 'create'])->name('turnos.create');
Route::get('/turnos/{turno}/edit', [TurnoController::class, 'edit'])->name('turnos.edit');
Route::put('/turnos/{turno}', [TurnoController::class, 'update'])->name('turnos.update');

Route::post('/turnos', [TurnoController::class, 'store'])->name('turnos.store');
Route::delete('/turnos/{turno}', [TurnoController::class, 'destroy'])->name('turnos.destroy');
Route::get('/turnos/api', [TurnoController::class, 'calendarioTurnos']);
Route::get('/turnos/api/hoy', [TurnoController::class, 'turnosDeHoy']);


// Rutas para promociones
Route::resource('promociones', PromocionController::class);
Route::put('promociones/{promocion}', [PromocionController::class, 'update'])->name('promociones.update');


// Ruta para comprar una promoción
Route::post('/cortes-con-promocion', [CorteController::class, 'compraPromocion'])->name('cortes.compraPromocion');

// Ver los usuarios y las promociones en json
Route::get('/promociones-usuarios/{id}', [CompraPromocionController::class, 'promociones'])->name('promociones-usuarios');
// actualizar el value de la promocion
Route::post('/actualizar-promocion/{cliente_id}', [CompraPromocionController::class, 'actualizarPromocion']);



Route::get('/cortes', [CorteController::class, 'list'])->middleware(['auth'])->name('corte.list');


Route::get('corte.store',[CorteController::class,'store'])->name('corte.store');
Route::get('corte/{id}',[CorteController::class,'edit'])->name('corte.edit');
Route::patch('/corte/{id}', [CorteController::class,'update'])->name('corte.update');
Route::get('corte/{id}/destroy',[CorteController::class,'destroy'])->name('corte.destroy');



Route::get('borrados/',[CorteController::class,'delete'])->name('corte.delete');
Route::get('borrados/{id}', [CorteController::class,'restore'])->name('restore.delete');

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

Route::get('/resumen',[SummariesController::class,'index'])->middleware(['auth'])->name('resumen');



//Route::get('/chart',[ChartController::class,'index']);


Route::get('/autocomplete', [Select2SearchController::class, 'dataAjax']);




require __DIR__.'/auth.php';