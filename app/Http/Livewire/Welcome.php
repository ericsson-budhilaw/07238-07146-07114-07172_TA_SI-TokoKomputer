<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;

class Welcome extends Component
{
    const LIMIT_PRODUCT = 4;

    public $latest;
    public $random;

    public function mount()
    {
        $this->random   = Item::orderBy('created_at')->inRandomOrder()->limit(self::LIMIT_PRODUCT)->get();
        $this->latest   = Item::orderBy('created_at')->limit(self::LIMIT_PRODUCT)->get();
    }

    public function render()
    {
        return view('livewire.welcome')->layout('components.layout');
    }
}
