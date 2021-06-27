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
    public $rememberMe = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required'
    ];

    /**
     * Lifecycle mount
     */
    public function mount()
    {
        if(Auth::check())
        {
            if(User::isAdmin()) return redirect()->route('user.home');
            return redirect()->route('home');
        }
    }

    /**
     * Login method
     */
    public function login()
    {
        $this->validate();

        if(Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->rememberMe))
        {
            if(User::isAdmin()) return redirect()->route('user.home');
            return redirect()->route('home');
        }

        session()->flash('error', 'E-mail atau Password salah');
        $this->password = '';
        $this->emit('alert_remove');
    }

    /**
     * Redirect to register page
     */
    public function register()
    {
        return redirect()->route('register');
    }

    /**
     * Redirect to forgot password page.
     */
    public function forgotPassword()
    {
        return redirect()->route('password.request');
    }

    /**
     * Render the component
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.login')->layout('components.layout', [
            'divCSS' => 'flex justify-center content-center items-center',
            'mainCSS' => 'container mx-auto py-28'
        ]);
    }
}
