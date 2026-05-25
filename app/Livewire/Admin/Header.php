<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Header extends Component
{
    public $unreadMessages = 3;
    public $notifications = 15;

    public function toggleSidebar()
    {
        $this->dispatch('toggleSidebar');
    }

    public function toggleFullscreen()
    {
        $this->dispatch('toggleFullscreen');
    }

    public function render()
    {
        return view('livewire.admin.header');
    }
}
