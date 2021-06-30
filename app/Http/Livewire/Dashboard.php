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
        $adminList = ['product', 'userlist', 'orderlist'];
        $userList = ['profile', 'changePass', 'address', 'history'];
        if(!in_array($active, $adminList) && !in_array($active, $userList)) return redirect()->route('home');

        if(in_array($active, $adminList) || in_array($active, $userList))
        {
            $check = User::where('id', Auth::user()->id)->first()->isAdmin;
            if(in_array($active, $adminList) && $check == 0)
            {
                return redirect()->route('user.home', 'profile');
            }

            if($check == 1)
            {
                $this->isAdmin  = true;
                $this->column   = "grid-cols-6";
            }

            if($active == 'history' && $check == 1)
            {
                return redirect()->route('user.home', 'profile');
            }
        }
        else
        {
            return redirect()->route('home');
        }
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
