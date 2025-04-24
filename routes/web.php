<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/kos', 'kos')->name('kos');
Route::view('/peta', 'peta')->name('peta');
Route::view('/berita', 'berita')->name('berita');
