<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Redirector;

class CartComponent extends Component
{
    protected $total;
    protected $content;
    public $cart;

    protected $listeners = [
        'productAddedToCart' => 'updateCart',
        'clearCart' => 'clearCart'
    ];

    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->cart = 'modal opacity-0 pointer-events-none';
        $this->updateCart($this->cart);
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
            'content' => $this->content,
            'cart' => $this->cart
        ]);
    }

    /**
     * Proceed checkout
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkout(): Redirector
    {
        return redirect()->route('user.checkout');
    }

    /**
     * Removes a cart item by id.
     *
     * @param string $id
     * @return void
     */
    public function removeFromCart(string $id): void
    {
        Cart::remove($id);
        $this->updateCart();
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

    /**
     * Updates a cart item.
     *
     * @param string $id
     * @param string $action
     * @return void
     */
    public function updateCartItem(string $id, string $action): void
    {
        Cart::update($id, $action);
        $this->updateCart();
    }

    /**
     * Rerenders the cart items and total price on the browser.
     *
     * @return void
     */
    public function updateCart($cart = ''): void
    {
        if ($cart == 'show')
        {
            $this->cart = 'modal opacity-100 pointer-events-auto';
        }
        $this->total = Cart::total();
        $this->content = Cart::content();
        $this->emitTo('navbar', 'updateCount');
    }
}
