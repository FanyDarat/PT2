<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;

Route::view('/', 'home')->name('home');
Route::view('/kos', 'kos')->name('kos');
Route::view('/peta', 'peta')->name('peta');
Route::view('/berita', 'berita')->name('berita');
Route::get('/login', function () {return view('login');});
Route::get('/add-kosan', function () {return view('addKosan');});
Route::resource('berita', BeritaController::class);
Route::get('/test', function () {return view('test');});
