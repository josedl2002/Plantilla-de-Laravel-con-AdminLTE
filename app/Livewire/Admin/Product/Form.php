<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Product;

#[Layout('layouts.admin')]
class Form extends Component
{
    // Datos del formulario
    public $product_id;
    public $name;
    public $price;
    public $description;

    // Indica si estamos editando o creando
    public $isEditing = false;

    // Título de la página
    public $title = 'Crear Producto';

    /**
     * Reglas de validación
     */
    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'price' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Mensajes de error personalizados
     */
    protected $messages = [
        'name.required' => 'El nombre del producto es obligatorio.',
        'name.min' => 'El nombre debe tener al menos 3 caracteres.',
        'price.required' => 'El precio es obligatorio.',
        'price.numeric' => 'El precio debe ser un número.',
        'price.min' => 'El precio debe ser mayor a 0.',
    ];

    /**
     * Si se recibe un ID, cargamos el producto para editar
     */
    public function mount($product = null)
    {
        if ($product) {
            $this->product_id = $product->id;
            $this->name = $product->name;
            $this->price = $product->price;
            $this->description = $product->description;
            $this->isEditing = true;
            $this->title = 'Editar Producto';
        }
    }

    /**
     * Guarda o actualiza el producto
     */
    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $product = Product::findOrFail($this->product_id);
            $product->update([
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
            ]);
            session()->flash('message', 'Producto actualizado correctamente.');
        } else {
            Product::create([
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
            ]);
            session()->flash('message', 'Producto creado correctamente.');
        }

        // Redirige al listado
        return redirect()->route('admin.products');
    }

    public function render()
    {
        return view('livewire.admin.product.form');
    }
}
