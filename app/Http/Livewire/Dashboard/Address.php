<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Addresses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Address extends Component
{
    public $user;
    public $city;
    public $state;
    public $zip;
    public $address;

    protected $rules = [
        'city' => 'required',
        'state' => 'required|',
        'zip' => 'required'
    ];

    protected $listeners = [
        'changeProceed' => 'changeAddress'
    ];

    public function mount()
    {
        $this->user = Auth::user();

        if(!is_null($this->user->address))
        {
            $address = $this->user->address;
            $this->city = $address->city;
            $this->state = $address->state;
            $this->zip = $address->postalcode;
            $this->address = $address->address;
        }
    }

    public function changeAddress($address)
    {
        $this->emit('alert_remove');

        if(empty($address))
        {
            session()->flash('error', 'Kolom alamat wajib diisi!');
            return;
        }

        $this->validate();

        $user = $this->user;

        if(is_null($user->address))
        {
            $user->address()->create([
                'city' => $this->city,
                'state' => $this->state,
                'postalcode' => $this->zip,
                'address' => $address
            ]);
        }
        else
        {
            $user->address()->update([
                'city' => $this->city,
                'state' => $this->state,
                'postalcode' => $this->zip,
                'address' => $address
            ]);
        }

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
