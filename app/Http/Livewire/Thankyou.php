<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use App\Models\detail_invoices;
use App\Models\invoices;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Thankyou extends Component
{

    protected $invoice;
    protected $details;
    protected $detail;
    protected $user;

    public function mount($invoice_id)
    {
        if(is_null($invoice_id)) return redirect()->route('welcome');

        // Clear the cart
        if(session()->has('success')) $this->clearCart();

        $this->user = User::where('id', Auth::user()->id)->first();
        $realUser = $this->user->detail_invoices;
        $this->invoice = invoices::where('id', $invoice_id)->firstOrFail();
        $this->details = invoices::find($invoice_id)->detail_invoices;
//        $this->invoice  = invoices::with('detail_invoice')->find($invoice_id);
//        $this->detail   = detail_invoices::where('id_invoices', $invoice_id)->first();
//        $this->details   = detail_invoices::where('id_invoices', $invoice_id)->get();

        // Check auth
        if(is_null($realUser->where('id_invoices', $invoice_id))) return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.thankyou', [
            'user' => $this->user,
            'invoice' => $this->invoice,
            'details' => $this->details
        ])->layout('components.layout', [
            'mainCSS' => 'container mx-auto py-16'
        ]);
    }

    public function clearCart()
    {
        Cart::clear();
    }

    public function format($angka)
    {
        $hasil = "Rp." . number_format($angka,0, ',' , '.');
        return $hasil;
    }
}
