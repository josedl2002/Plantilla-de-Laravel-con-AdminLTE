<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Footer extends Component
{
        public $year;
    
    public function mount()
    {
        $this->year = date('Y');
    }

    public function render()
    {
        return view('livewire.admin.footer');
    }
}
