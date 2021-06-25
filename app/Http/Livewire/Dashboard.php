<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Redirector;

class Dashboard extends Component
{
    public $user;
    public $message;

    public function mount()
    {
        if(!User::isAdmin())
        {
            return redirect()->route('login');
        }
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.dashboard')->layout('components.layout', [
            'divCSS' => 'flex justify-center content-center items-center',
            'mainCSS' => 'min-h-screen container mx-auto py-28'
        ]);
    }
}
