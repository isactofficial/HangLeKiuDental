<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApotekController;
use App\Http\Controllers\SettingsController;

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/apotek', [ApotekController::class, 'index'])->name('apotek.index');
Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
