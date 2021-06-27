<?php

namespace App\Http\Livewire;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Component;

class ResetPassword extends Component
{
    public $resetToken;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'resetToken' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:6'
    ];

    public function mount($token)
    {
        $this->resetToken = $token;
    }

    public function resetPass()
    {
        $this->validate();
        $status = Password::reset([
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->resetToken
            ], function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
            $user->save();
            event(new PasswordReset($user));
        });

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
        return view('livewire.reset-password')->layout('components.layout', [
            'divCSS' => 'flex justify-center content-center items-center',
            'mainCSS' => 'container mx-auto py-28'
        ]);
    }
}
