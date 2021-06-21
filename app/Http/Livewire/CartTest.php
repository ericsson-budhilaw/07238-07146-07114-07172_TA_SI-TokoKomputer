<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use Livewire\Component;

class CartTest extends Component
{
    protected $total;
    protected $content;

    public function mount(): void
    {
        $this->updateCart();
    }

    public function render()
    {
        return view('livewire.cart-test', [
            'total' => $this->total,
            'content' => $this->content,
        ]);
    }

    public function updateCart(): void
    {
        $this->total = Cart::total();
        $this->content = Cart::content();
    }
}
