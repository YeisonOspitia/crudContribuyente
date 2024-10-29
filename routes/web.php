<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContribuyenteController;
use App\Http\Controllers\UserController;


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/',[ContribuyenteController::class, 'index'])->name('home');
    Route::get('/crear',[ContribuyenteController::class, 'create'])->name('contribuyentes.create')->middleware('role:super admin');
    Route::get('/mostrar/{id}',[ContribuyenteController::class, 'show'])->name('contribuyentes.show');
    Route::get('/editar/{id}',[ContribuyenteController::class, 'edit'])->name('contribuyentes.edit')->middleware('role:super admin');   

    Route::put('/actualizar/{id}',[ContribuyenteController::class, 'update'])->name('contribuyentes.update')->middleware('role:super admin');
    Route::delete('/eliminar/{id}',[ContribuyenteController::class, 'destroy'])->name('contribuyentes.destroy')->middleware('role:super admin');
    Route::post('/crear',[ContribuyenteController::class, 'store'])->name('contribuyentes.store')->middleware('role:super admin');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'role:super admin'])->group(function () {
    Route::get('/usuarios',[UserController::class, 'index'])->name('usuarios');
    Route::get('/usuarios/crear',[UserController::class, 'create'])->name('usuarios.create');
    Route::get('/usuarios/mostrar/{id}',[UserController::class, 'show'])->name('usuarios.show');
    Route::get('/usuarios/editar/{id}',[UserController::class, 'edit'])->name('usuarios.edit');

    Route::put('/usuarios/actualizar/{id}',[UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/eliminar/{id}',[UserController::class, 'destroy'])->name('usuarios.destroy');
    Route::post('/usuarios/crear',[UserController::class, 'store'])->name('usuarios.store');
});

require __DIR__.'/auth.php';
