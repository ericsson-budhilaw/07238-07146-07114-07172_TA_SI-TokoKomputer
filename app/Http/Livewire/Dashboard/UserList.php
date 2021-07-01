<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use withPagination;

    public $num = 1;
    public $confirming;

    protected $users;

    public function render()
    {
        $users = User::paginate(5);
        return view('livewire.dashboard.user-list', [
            'users' => $users
        ]);
    }

    public function kill($id)
    {
        $this->confirming = $id;
    }

    public function edit($id)
    {
        return redirect()->route('user.changepass', ['id' => $id]);
    }

    public function addAdmin()
    {
        return redirect()->route('admin.add');
    }

    public function deleteProduct($id)
    {
        User::destroy($id);
        session()->flash('success', 'Berhasil menghapus data pengguna');
        return redirect()->route('user.home', 'userlist');
    }
}
