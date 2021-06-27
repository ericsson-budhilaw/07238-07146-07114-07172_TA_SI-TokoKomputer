<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class Forgot extends Component
{
    public $email;
    public $status;

    protected $rules = [
        'email' => 'required|email',
    ];

    public function login()
    {
        return redirect()->route('login');
    }

    public function resetPass()
    {
        $this->validate();
        $status = Password::sendResetLink([
            'email' => $this->email
        ]);

        if($status == 'passwords.token' || $status == 'passwords.user' || $status == 'passwords.throttled')
        {
            session()->flash('error', __($status));
        }
        else
        {
            session()->flash('success', __($status));
        }
    }

    public function render()
    {
        return view('livewire.forgot')->layout('components.layout', [
            'divCSS' => 'flex justify-center content-center items-center',
            'mainCSS' => 'container mx-auto py-32'
        ]);
    }
}
