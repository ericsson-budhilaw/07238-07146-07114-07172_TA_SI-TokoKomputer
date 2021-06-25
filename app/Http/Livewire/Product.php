<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use App\Models\Item;
use Livewire\Component;

class Product extends Component
{
    public $itemModel;
    public $item;

    public function mount()
    {
        $this->itemModel = new Item();
    }

    public function render()
    {
        return view('livewire.product');
    }

    public function addToCart(int $id, string $thumbnail, string $name, string $price, string $stok, string $quantity): void
    {
        Cart::add($id, $thumbnail, $name, $price, $stok, $quantity);
        $this->emit('productAddedToCart', 'show');
    }
}
