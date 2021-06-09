<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $message;

    public function search()
    {
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
