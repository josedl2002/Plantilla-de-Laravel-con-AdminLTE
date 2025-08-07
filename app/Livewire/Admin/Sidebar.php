<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Sidebar extends Component
{
    // Usa el mismo nombre en la propiedad que en la vista (todo minúsculas)
    public $activemenu = 'dashboard';
    public $collapsedmenus = [
        'dashboard' => false,
        'widgets' => true,
        'layouts' => true,
        'ui' => true,
        'forms' => true,
        'tables' => true,
        'auth' => true,
        'docs' => true
    ];

    protected $listeners = ['toggleSidebar' => 'toggle', 'setActiveMenu' => 'setActive'];

    public function toggle()
    {
        $this->dispatch('toggleSidebar'); // Livewire 3 usa dispatch()
    }

    public function toggleMenu($menu)
    {
        $this->collapsedmenus[$menu] = !$this->collapsedmenus[$menu];
        $this->dispatch('menuToggled');
    }

    public function setActive($menu)
    {
        $this->activemenu = $menu; // Actualiza la propiedad con el mismo nombre
    }
    
    public function render()
    {
            return view('livewire.admin.sidebar', [
        'activemenu' => $this->activemenu,
        'collapsedmenus' => $this->collapsedmenus
    ]); 
    }
}