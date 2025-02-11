<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TugasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Middleware auth 
Route::middleware(['auth', 'verified'])->group(function () {

    // Route daftar tugas
    Route::get('/tugas/read', [TugasController::class, 'read'])->name('tugas.read');

    // Route tambah tugas
    Route::get('/tugas/create', [TugasController::class, 'create'])->name('tugas.create');
    Route::post('/tugas', [TugasController::class, 'submit'])->name('tugas.submit');

    // Route update, delete, dan toggle status tugas
    Route::patch('/tugas/{id}', [TugasController::class, 'update'])->name('tugas.update');
    Route::delete('/tugas/{id}', [TugasController::class, 'delete'])->name('tugas.delete');
    Route::patch('/tugas/{id}/toggle-status', [TugasController::class, 'toggleStatus'])->name('tugas.toggleStatus');

    
    // Route sub-tugas
    Route::post('/tugas/{id}/subtugas', [TugasController::class, 'addSubTugas'])->name('subtugas.submit');
    Route::patch('/subtugas/{id}/toggle-status', [TugasController::class, 'toggleSubTugasStatus'])->name('subtugas.toggleStatus');

    // Route profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include route otentikasi Laravel
require __DIR__ . '/auth.php';
