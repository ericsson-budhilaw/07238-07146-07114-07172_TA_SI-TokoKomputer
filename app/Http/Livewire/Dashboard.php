<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Redirector;

class Dashboard extends Component
{
    public $user;
    public $message;
    public $active;

    public $column  = 'grid-cols-4';
    public $isAdmin = false;

    public function mount($active)
    {
        $this->active = $active;
        if(User::isAdmin())
        {
            $this->isAdmin  = true;
            $this->column   = "grid-cols-6";
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
