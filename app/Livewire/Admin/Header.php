<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Header extends Component
{
    public $unreadMessages = 3;
    public $notifications = 15;
    public $user = [
        'name' => 'Alexander Pierce',
        'image' => 'assets/img/user2-160x160.jpg',
        'role' => 'Web Developer',
        'since' => 'Nov. 2023'
    ];

    public function toggleSidebar()
    {
        $this->emit('toggleSidebar');
    }

    public function toggleFullscreen()
    {
        $this->dispatchBrowserEvent('toggleFullscreen');
    }

    public function render()
    {
        return view('livewire.admin.header');
    }
}
