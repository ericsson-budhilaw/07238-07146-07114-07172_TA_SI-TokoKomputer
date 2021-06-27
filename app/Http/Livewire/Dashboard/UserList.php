<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
    public $users;
    public $num = 0;

    public function mount()
    {
        $this->users = User::where('isAdmin', 0)->get();
    }

    public function render()
    {
        return view('livewire.dashboard.user-list');
    }

    public function edit($id)
    {
        return redirect()->route('user.changepass', ['id' => $id]);
    }
}
