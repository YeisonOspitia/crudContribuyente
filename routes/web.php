<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContribuyenteController;

Route::get('/',[ContribuyenteController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
Route::get('/crear',[ContribuyenteController::class, 'create'])->middleware(['auth', 'verified'])->name('contribuyentes.create');
Route::get('/mostrar',[ContribuyenteController::class, 'show'])->middleware(['auth', 'verified'])->name('contribuyentes.show');
Route::get('/editar',[ContribuyenteController::class, 'edit'])->middleware(['auth', 'verified'])->name('contribuyentes.edit');
Route::get('/actualizar',[ContribuyenteController::class, 'update'])->middleware(['auth', 'verified'])->name('contribuyentes.update');
Route::get('/eliminar',[ContribuyenteController::class, 'destroy'])->middleware(['auth', 'verified'])->name('contribuyentes.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
