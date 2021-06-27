<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class EditPass extends Component
{
    public $password;
    public $user;

    protected $rules = [
        'password' => 'required|min:6',
    ];

    public function mount(Request $request, $id)
    {
        $this->user = User::find($id);
    }

    public function edit()
    {
        $this->validate();
        $user = $this->user;
        $user->forceFill([ 'password' => Hash::make($this->password) ])->setRememberToken(Str::random(60));
        $user->save();
        session()->flash('success', 'Password berhasil diubah!');
    }

    public function render()
    {
        return view('livewire.auth.edit-pass')->layout('components.layout', [
            'divCSS' => 'flex justify-center content-center items-center',
            'mainCSS' => 'container mx-auto py-28'
        ]);
    }
}
