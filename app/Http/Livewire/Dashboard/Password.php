<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Redirector;

class Password extends Component
{
    public $email;
    public $oldPassword;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'email' => 'required|email',
        'oldPassword' => 'required',
        'password' => 'required|min:6|confirmed'
    ];

    public function mount()
    {
        $this->email = Auth::user()->email;
    }

    public function changePass()
    {
        $this->validate();
        $this->emit('alert_remove');

        $user = User::where('email', $this->email)->firstOrFail();
        $pass = Hash::check($this->oldPassword, $user->password);
        if($user && $pass)
        {
            $user->forceFill([
                'password' => Hash::make($this->password)
            ])->setRememberToken(Str::random(60));
            $user->save();
            $this->logout();
        }
        else if($pass === FALSE)
        {
            session()->flash('error', 'Password lama salah!');
        }
        else
        {
            session()->flash('error', 'Gagal ubah Password');
        }
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

    public function render()
    {
        return view('livewire.dashboard.password');
    }
}
