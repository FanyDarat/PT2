<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;

Route::view('/', 'home')->name('home');
Route::view('/kos', 'kos')->name('kos');
Route::view('/test', 'test')->name('test');
Route::view('/berita', 'berita')->name('berita');
Route::get('/peta', [MapController::class, 'index'])->name('peta');