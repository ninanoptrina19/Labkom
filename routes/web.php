<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LaboratoriumController;
// use App\Http\Controllers\Jadwal;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();




Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dosen', [DosenController::class, 'index'])->name('data_dosens.index');
Route::get('/data_dosens/create', [DosenController::class, 'create'])->name('data_dosens.create');
Route::post('/data_dosens', [DosenController::class, 'store'])->name('data_dosens.store');
Route::get('/data_dosens/edit/{id}', [DosenController::class, 'edit'])->name('data_dosens.edit');
Route::put('/data_dosens/update/{id}', [DosenController::class, 'update'])->name('data_dosens.update');
Route::delete('/data_dosens/destroy/{id}', [DosenController::class, 'destroy'])->name('data_dosens.destroy');

Route::get('/laboratorium', [LaboratoriumController::class, 'index'])->name('data_laboratorium.index');
Route::get('/data_laboratorium/create', [LaboratoriumController::class, 'create'])->name('data_laboratorium.create');
Route::post('/data_laboratorium', [LaboratoriumController::class, 'store'])->name('data_laboratorium.store');
Route::get('/data_laboratorium/edit/{id}', [LaboratoriumController::class, 'edit'])->name('data_laboratorium.edit');
Route::put('/data_laboratorium/update/{id}', [LaboratoriumController::class, 'update'])->name('data_laboratorium.update');
Route::delete('/data_laboratorium/destroy/{id}', [LaboratoriumController::class, 'destroy'])->name('data_laboratorium.destroy');

// Route::get('/jadwal', [JadwalController::class, 'index'])->name('data_jadwal.index');
// Route::get('/data_jadwal/create', [JadwalController::class, 'create'])->name('data_jadwal.create');
// Route::post('/data_jadwal', [JadwalController::class, 'store'])->name('data_jadwal.store');
// Route::get('/data_jadwal/edit/{id}', [JadwalController::class, 'edit'])->name('data_jadwal.edit');
// Route::put('/data_jadwal/update/{id}', [JadwalController::class, 'update'])->name('data_jadwal.update');
// Route::delete('/data_jadwal/destroy/{id}', [JadwalController::class, 'destroy'])->name('data_jadwal.destroy');

