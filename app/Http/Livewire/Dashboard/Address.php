<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Addresses;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Address extends Component
{
    public $user;
    public $city;
    public $state;
    public $zip;
    public $address;

    public function mount()
    {
        $this->user = Auth::user();
        $address = $this->user->address;
        $this->city = $address->city;
        $this->state = $address->state;
        $this->zip = $address->postalcode;
        $this->address = $address->address;
    }

    public function changeAddress()
    {
        $user = $this->user;

        $user->address()->update([
            'city' => $this->city,
            'state' => $this->state,
            'postalcode' => $this->zip,
            'address' => $this->address
        ]);

        session()->flash('success', "Data berhasil diubah");
        $this->emit('alert_remove');
    }

    public function render()
    {
        return view('livewire.dashboard.address')->layout('components.layout', [
            'divCSS' => 'flex justify-center content-center items-center',
            'mainCSS' => 'container mx-auto py-32'
        ]);;
    }
}
