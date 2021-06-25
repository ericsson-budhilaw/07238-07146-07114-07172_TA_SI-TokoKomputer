<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Navbar extends Component
{
    public $total;
    public $route;

    protected $listeners = [
        'updateCount' => 'updateCount'
    ];

    public function mount()
    {
        $this->route = Route::currentRouteName();
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

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('admin.login');
    }
}
