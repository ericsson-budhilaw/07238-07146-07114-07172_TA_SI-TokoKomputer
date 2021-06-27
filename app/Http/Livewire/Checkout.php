<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Checkout extends Component
{
    public $total;
    public $content;
    public $itemModel;

    public $name;
    public $telp;
    public $email;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->telp = $user->telepon;

        $this->itemModel = new Item();
        $this->updateCart();
        if($this->content->count() == 0)
        {
            return redirect()->route('toko');
        }
    }

    public function render()
    {
        return view('livewire.checkout', [
            'total' => $this->total,
            'content' => $this->content
        ])->layout('components.layout', [
            'mainCSS' => 'container mx-auto py-28'
        ]);
    }

    /**
     * Rerenders the cart items and total price on the browser.
     *
     * @return void
     */
    public function updateCart(): void
    {
        $this->total = Cart::total();
        $this->content = Cart::content();
    }
}
