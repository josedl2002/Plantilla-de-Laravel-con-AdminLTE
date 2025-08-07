<?php

namespace App\Livewire\Admin;
use App\Models\User;

use Livewire\Component;

class Index extends Component
{
    // Datos para las tarjetas de estadísticas
    public $stats = [
        'orders' => 150,
        'bounce_rate' => 53,
        'users' => 44,
        'visitors' => 65
    ];

    // Datos para el chat
    public $messages = [
        [
            'type' => 'incoming',
            'name' => 'Alexander Pierce',
            'time' => '23 Jan 2:00 pm',
            'text' => "Is this template really for free? That's unbelievable!",
            'image' => 'assets/img/user1-128x128.jpg'
        ],
        [
            'type' => 'outgoing',
            'name' => 'Sarah Bullock',
            'time' => '23 Jan 2:05 pm',
            'text' => "You better believe it!",
            'image' => 'assets/img/user3-128x128.jpg'
        ]
    ];

    public $contacts = [
        [
            'name' => 'Count Dracula',
            'time' => '2/28/2023',
            'text' => 'How have you been? I was...',
            'image' => 'assets/img/user1-128x128.jpg'
        ]
    ];

    public $newMessage = '';

    // Estado del sidebar
    public $sidebarOpen = true;

    // Enviar mensaje en el chat
    public function sendMessage()
    {
        if (!empty($this->newMessage)) {
            $this->messages[] = [
                'type' => 'outgoing',
                'name' => 'You',
                'time' => now()->format('d M h:i a'),
                'text' => $this->newMessage,
                'image' => auth()->user()->avatar ?? 'assets/img/user2-160x160.jpg'
            ];
            
            $this->newMessage = '';
            $this->dispatchBrowserEvent('scroll-chat-bottom');
        }
    }

    // Alternar estado del sidebar
    public function toggleSidebar()
    {
        $this->sidebarOpen = !$this->sidebarOpen;
        $this->dispatchBrowserEvent('sidebar-toggled');
    }

    public function render()
    {
        return view('livewire.admin.index')->layout('livewire.admin.sidebar');
    }
}
