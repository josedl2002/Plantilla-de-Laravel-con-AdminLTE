<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Index extends Component
{
    public $stats = [
        'orders' => 150,
        'bounce_rate' => 53,
        'users' => 44,
        'visitors' => 65
    ];

    public $messages = [
        [
            'type' => 'incoming',
            'name' => 'Alexander Pierce',
            'time' => '23 Jan 2:00 pm',
            'text' => "Is this template really for free? That's unbelievable!",
            'image' => 'adminlte/dist/assets/img/user1-128x128.jpg'
        ],
        [
            'type' => 'outgoing',
            'name' => 'Sarah Bullock',
            'time' => '23 Jan 2:05 pm',
            'text' => "You better believe it!",
            'image' => 'adminlte/dist/assets/img/user3-128x128.jpg'
        ]
    ];

    public $contacts = [
        [
            'name' => 'Count Dracula',
            'time' => '2/28/2023',
            'text' => 'How have you been? I was...',
            'image' => 'adminlte/dist/assets/img/user1-128x128.jpg'
        ]
    ];

    public $newMessage = '';

    public function sendMessage()
    {
        if (!empty($this->newMessage)) {
            $this->messages[] = [
                'type' => 'outgoing',
                'name' => auth()->user()->name,
                'time' => now()->format('d M h:i a'),
                'text' => $this->newMessage,
                'image' => 'adminlte/dist/assets/img/user2-160x160.jpg'
            ];

            $this->newMessage = '';
            $this->dispatch('scroll-chat-bottom');
        }
    }

    public function render()
    {
        return view('livewire.admin.index');
    }
}
