<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;

class RandomProducts extends Component
{
    public $items;

    function format_uang($angka){
        $hasil = "Rp." . number_format($angka,0, ',' , '.');
        return $hasil;
    }

    public function mount()
    {
        $this->items  = Item::orderBy('created_at')->inRandomOrder()->get();
    }

    public function render()
    {
        return view('livewire.random-products');
    }
}
