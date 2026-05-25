<?php

namespace App\Livewire\Admin\Profile;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

#[Layout('layouts.admin')]
class Index extends Component
{
    // Datos del perfil
    public $name;
    public $email;

    // Datos para cambiar contraseña
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    /**
     * Carga los datos del usuario autenticado
     */
    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    /**
     * Actualiza la información del perfil
     */
    public function updateProfile()
    {
        $user = auth()->user();

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Perfil actualizado correctamente.');
    }

    /**
     * Cambia la contraseña del usuario
     */
    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        auth()->user()->update([
            'password' => Hash::make($this->new_password),
        ]);

        // Limpia los campos
        $this->current_password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';

        session()->flash('message', 'Contraseña cambiada correctamente.');
    }

    public function render()
    {
        return view('livewire.admin.profile.index');
    }
}
