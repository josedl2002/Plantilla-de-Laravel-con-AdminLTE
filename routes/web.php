<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Index as AdminDashboard;
use App\Livewire\Admin\Product\Index as ProductList;
use App\Livewire\Admin\Product\Form as ProductForm;
use App\Livewire\Admin\User\Index as UserList;
use App\Livewire\Admin\Profile\Index as UserProfile;
use App\Livewire\Admin\Ui\Index as UiComponents;
use App\Livewire\Admin\Role\Index as RoleList;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Rutas protegidas (requieren autenticación + verificación de email)
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Dashboard principal
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');

    // Productos - CRUD completo
    Route::get('/admin/productos', ProductList::class)->name('admin.products');
    Route::get('/admin/productos/crear', ProductForm::class)->name('admin.products.create');
    Route::get('/admin/productos/{product}/editar', ProductForm::class)->name('admin.products.edit');

    // Usuarios
    Route::get('/admin/usuarios', UserList::class)->name('admin.users');

    // Roles
    Route::get('/admin/roles', RoleList::class)->name('admin.roles');

    // Perfil de usuario
    Route::get('/admin/perfil', UserProfile::class)->name('admin.profile');

    // Componentes UI (demo)
    Route::get('/admin/componentes', UiComponents::class)->name('admin.ui');

});
