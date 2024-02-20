<?php

use App\Http\Controllers\DetailTugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TugasController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/data', [TugasController::class, 'data'])->name('tugas.data');
Route::get('/todolist', [TugasController::class, 'index'])->name('tugas.index');
Route::post('/todolist', [TugasController::class, 'store'])->name('tugas.store');
Route::put('/todoliststatus/{id_tugas}', [TugasController::class, 'updateStatus'])->name('tugas.updatestatus');
Route::put('/todolist/{id_tugas}', [TugasController::class, 'update'])->name('tugas.update');
Route::delete('/todolist/{id_tugas}', [TugasController::class, 'destroy'])->name('tugas.delete');
Route::get('/todolist/{id_tugas}', [TugasController::class, 'show'])->name('tugas.show');

Route::put('/detail-tugas/{id_detail_tugas}', [DetailTugasController::class, 'update'])->name('detail.update');
Route::post('/detail-tugas', [DetailTugasController::class, 'store'])->name('detail.store');
Route::delete('/detail-tugas/{id_detail_tugas}', [DetailTugasController::class, 'destroy'])->name('detail.delete');

require __DIR__.'/auth.php';
