<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/kos', 'kos')->name('kos');
Route::view('/peta', 'peta')->name('peta');
Route::view('/berita', 'berita')->name('berita');
Route::get('/login', function () {return view('login');});
Route::get('/add-kosan', function () {return view('addKosan');})->name('addKosan');
Route::get('/add-berita', function () {return view('addBerita');})->name('addBerita');
Route::get('/test', function () {return view('test');});
Route::view('/admin', 'adminBoard')->name('adminBoard');
