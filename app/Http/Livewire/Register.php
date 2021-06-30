<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $telepon;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:6',
        'telepon' => 'required|numeric'
    ];

    public function login()
    {
        return redirect()->route('login');
    }

    public function register()
    {
        $this->validate();
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->forceFill([
            'password' => Hash::make($this->password)
        ])->setRememberToken(Str::random(60));
        $user->telp = $this->telepon;
        $user->profile_photo_path = "storage/avatar.png";
        $user->save();

        event(new Registered($user));
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.register')->layout('components.layout', [
            'divCSS' => 'flex justify-center content-center items-center',
            'mainCSS' => 'container mx-auto py-28'
        ]);
    }
}
