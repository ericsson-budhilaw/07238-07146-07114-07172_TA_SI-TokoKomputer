<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Checkout extends Component
{
    public function render()
    {
        return view('livewire.checkout')->layout('components.layout', [
            'mainCSS' => 'container mx-auto py-28'
        ]);
    }
}
