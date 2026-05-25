<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Product;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    // Buscador en tiempo real
    public $search = '';

    // Campo por el que se ordena
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // Escucha eventos para refrescar la tabla
    protected $listeners = ['productSaved' => '$refresh'];

    /**
     * Resetea la paginación al buscar
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Ordena por un campo, alternando dirección
     */
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    /**
     * Elimina un producto
     */
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        session()->flash('message', 'Producto eliminado correctamente.');
    }

    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.product.index', [
            'products' => $products,
        ]);
    }
}
