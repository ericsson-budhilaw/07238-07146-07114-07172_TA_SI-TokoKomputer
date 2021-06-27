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

    public $active  = 'profile';
    public $column  = 'grid-cols-3';
    public $isAdmin = false;

    public function mount()
    {
        if(User::isAdmin())
        {
            $this->active   = 'product';
            $this->isAdmin  = true;
            $this->column   = "grid-cols-5";
        }
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.dashboard')->layout('components.layout', [
            'divCSS' => 'flex justify-center content-center items-center',
            'mainCSS' => 'min-h-screen container mx-auto py-8'
        ]);
    }

    public function tab(string $action)
    {
        $this->active = $action;
    }
}
