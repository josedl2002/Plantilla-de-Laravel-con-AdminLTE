<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\Prueba;
use App\Livewire\Admin\Index;

Route::get('/counter', Counter::class);
Route::get('/', function () {
    return view('welcome');
});

//**Route::get('/iniciar-sesion', function () {
    //**     return view('admin.login');
    //*})->name('login');
Route::get('/prueba', Prueba::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.admin');
    })->name('dashboard');
    Route::get('/prueba', Prueba::class);
    Route::get('/admin/dashboard', Index::class);
//**    Route::get('/inicio', function(){
//**         return view('Prueba.index');
//** */    })->name('inicio');

});
