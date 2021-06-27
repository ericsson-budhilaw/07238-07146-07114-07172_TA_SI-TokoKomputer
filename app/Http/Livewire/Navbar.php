<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\Redirector;

class Navbar extends Component
{
    public $total;
    public $route;

    protected $listeners = [
        'updateCount' => 'updateCount'
    ];

    /**
     * Assign currentRoute to $route
     * and updateCount
     *
     * @return void
     */
    public function mount(): void
    {
        $this->route = Route::currentRouteName();
        $this->updateCount();
    }

    /**
     * Render the navbar
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.navbar');
    }

    /**
     * Run Add To Cart function
     *
     * @return void
     */
    public function checkCart(): void
    {
        $this->emit('productAddedToCart', 'show');
    }

    /**
     * Update the count of the cart
     *
     * @return void
     */
    public function updateCount(): void
    {
        $this->total = count(Cart::content());
    }

    /**
     * Go to dashboard page
     *
     * @return Redirector
     */
    public function dashboard(): Redirector
    {
        return redirect()->route('user.home');
    }

    /**
     * Go to login page
     *
     * @return Redirector
     */
    public function login(): Redirector
    {
        return redirect()->route('login');
    }

    /**
     * Logout auth
     *
     * @return Redirector
     */
    public function logout(): Redirector
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }
}
