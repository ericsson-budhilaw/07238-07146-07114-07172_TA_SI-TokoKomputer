<?php

namespace App\Http\Livewire\Verif;

use Livewire\Component;

class Notice extends Component
{
    public function render()
    {
        return view('livewire.verif.notice')->layout('components.layout', [
            'divCSS' => 'flex justify-center content-center items-center',
            'mainCSS' => 'container mx-auto py-32'
        ]);
    }
}
