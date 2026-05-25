<?php

namespace App\Livewire\Admin\Ui;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Index extends Component
{
    // Alertas
    public $alertMessage = '';
    public $alertType = 'success';

    // Offcanvas
    public $showOffcanvas = false;

    // Modal
    public $showModal = false;
    public $modalSize = 'modal-md';

    // Toast
    public $showToast = false;
    public $toastMessage = '';

    // Tabs
    public $activeTab = 'tab1';

    // Accordion
    public $accordionOpen = '1';

    public function openModal($size = 'modal-md')
    {
        $this->modalSize = $size;
        $this->dispatch('show-modal');
    }

    public function closeModal()
    {
        $this->dispatch('hide-modal');
    }

    public function showAlert($type)
    {
        $this->alertType = $type;
        $this->alertMessage = 'Alerta de ejemplo tipo: ' . $type;
    }

    public function toggleOffcanvas()
    {
        $this->showOffcanvas = !$this->showOffcanvas;
    }

    public function showToastMessage($msg)
    {
        $this->toastMessage = $msg;
        $type = str_contains($msg, 'error') ? 'danger'
              : (str_contains($msg, 'éxito') || str_contains($msg, 'exitosamente') ? 'success'
              : 'primary');
        $this->dispatch('show-toast', message: $msg, type: $type);
    }

    public function dismissToast()
    {
        $this->dispatch('hide-toast');
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.admin.ui.index');
    }
}
