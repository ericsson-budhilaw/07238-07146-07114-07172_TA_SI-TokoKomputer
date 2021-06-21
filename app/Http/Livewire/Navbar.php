<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Navbar extends Component
{
    public $total;

    protected $listeners = [
        'updateCount' => 'updateCount'
    ];

    public function mount()
    {
        $this->updateCount();
    }

    public function render()
    {
        return view('livewire.navbar');
    }

    public function checkCart()
    {
        $this->emit('productAddedToCart', 'show');
    }

    public function updateCount()
    {
        $this->total = count(Cart::content());
    }
}
