<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('tugas.read', 'tugas.read')
    ->middleware(['auth', 'verified'])
    ->name('tugas.read');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
