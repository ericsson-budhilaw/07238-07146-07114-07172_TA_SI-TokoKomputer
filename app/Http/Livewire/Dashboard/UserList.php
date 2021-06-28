<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use withPagination;

    public $num = 0;

    protected $users;

    public function render()
    {
        $users = User::where('isAdmin', 0)->paginate(2);
        return view('livewire.dashboard.user-list', [
            'users' => $users
        ]);
    }

    public function edit($id)
    {
        return redirect()->route('user.changepass', ['id' => $id]);
    }
}
