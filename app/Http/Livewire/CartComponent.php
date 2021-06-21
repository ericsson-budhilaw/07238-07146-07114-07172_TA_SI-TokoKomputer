<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CartComponent extends Component
{
    protected $total;
    protected $content;

    protected $listeners = [
        'productAddedToCart' => 'updateCart'
    ];

    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->updateCart();
    }

    /**
     * Renders the component on the browser.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.cart-component', [
            'total' => $this->total,
            'content' => $this->content
        ]);
    }

    /**
     * Clear the cart content.
     *
     * @return void
     */
    public function clearCart(): void
    {
        Cart::clear();
        $this->updateCart();
    }

    public function updateCartItem(string $id, string $action): void
    {
        Cart::update();
        $this->updateCart();
    }

    public function updateCart(): void
    {
        $this->total = Cart::total();
        $this->content = Cart::content();
    }
}
