<?php

namespace App\Livewire;

use Livewire\Component;

class Videojuegos extends Component
{
    public $videojuegos;
    public function render()
    {
        return view('livewire.videojuegos');
    }

    public function mount()
    {
        $this->videojuegos;
    }
}
