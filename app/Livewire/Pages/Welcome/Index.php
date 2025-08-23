<?php

namespace App\Livewire\Pages\Welcome;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.welcome.index')->layout('components.layouts.home');
    }
}
