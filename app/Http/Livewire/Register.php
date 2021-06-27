<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:6'
    ];

    public function login()
    {
        return redirect()->route('login');
    }

    public function register()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.register')->layout('components.layout', [
            'divCSS' => 'flex justify-center content-center items-center',
            'mainCSS' => 'container mx-auto py-28'
        ]);
    }
}
