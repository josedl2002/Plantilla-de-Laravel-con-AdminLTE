<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//**Route::get('/iniciar-sesion', function () {
//**     return view('admin.login');
//*})->name('login');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.admin');
    })->name('dashboard');
    Route::get('/inicio', function(){
        return view('Prueba.index');
    })->name('inicio');
});
