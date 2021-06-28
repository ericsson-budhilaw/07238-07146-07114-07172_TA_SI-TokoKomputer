<?php

namespace App\Http\Livewire\Verif;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notice extends Component
{
    public function mount()
    {
        $this->emit('alert_remove');
        $user = User::where('email', Auth::user()->email)->firstOrFail();
        if(!is_null($user->email_verified_at))
        {
            return redirect()->route('user.home', 'profile');
        }
    }

    public function render()
    {
        return view('livewire.verif.notice')->layout('components.layout', [
            'divCSS' => 'flex justify-center content-center items-center',
            'mainCSS' => 'container mx-auto py-32'
        ]);
    }
}
