<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Redirector;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required'
    ];

    public function mount()
    {
        if(Auth::check())
        {
            if(User::isAdmin()) return redirect()->route('user.home');
            return redirect()->route('home');
        }
    }

    public function login(): Redirector
    {
        $this->validate();

        if(Auth::attempt(['email' => $this->email, 'password' => $this->password]))
        {
            if(User::isAdmin()) return redirect()->route('user.home');
            return redirect()->route('home');
        }
    }

    public function render(): View
    {
        return view('livewire.login')->layout('components.layout', [
            'divCSS' => 'flex justify-center content-center items-center',
            'mainCSS' => 'container mx-auto py-28'
        ]);
    }
}
