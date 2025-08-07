<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class Prueba extends Component
{
    public $name = '';
    public $price = '';
    public $description = '';

    protected $rules = [
        'name' => 'required|min:3',
        'price' => 'required|numeric|min:0.01',
        'description' => 'nullable|string|max:500',
    ];

    
    public function submit()
    {
        $this->validate();
        try {
            // Depuración: Verifica los datos antes de guardar
            Log::debug('Datos recibidos:', [
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description
            ]);
            
            $product = Product::create([
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description
            ]);
            
            // Verificación explícita de que se creó el registro
            if (!$product->exists) {
                throw new \Exception('No se pudo crear el registro en la base de datos');
            }
            
            $this->reset();
            session()->flash('success', '¡Producto registrado correctamente!');
            
        } catch (\Exception $e) {
            Log::error('Error al guardar producto: '.$e->getMessage());
            session()->flash('error', 'Error: '.$e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.prueba')->layout('layouts.app');
    }
}
