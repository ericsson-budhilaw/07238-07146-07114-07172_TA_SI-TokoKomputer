<?php

namespace App\Http\Livewire;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        return view('livewire.about')->layout('components.layout', [
            'divCSS' => 'flex justify-center content-center items-center',
            'mainCSS' => 'min-h-screen container mx-auto py-28'
        ]);
    }
}
