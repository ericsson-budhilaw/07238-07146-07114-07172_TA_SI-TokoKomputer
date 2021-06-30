<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use App\Models\detail_invoices;
use App\Models\invoices;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Checkout extends Component
{
    public $itemModel;
    public $name;
    public $telp;
    public $email;

    public $address;
    public $city;
    public $state;
    public $postalcode;
    public $addressText;

    protected $total;
    protected $content;
    protected $listeners = [ 'orderProceed' ];

    public function mount()
    {
        $user = Auth::user();

        if(is_null($user->telp))
        {
            session()->flash('error', 'Silahkan isi nomor telepon pada profile anda terlebih dahulu');
            return redirect()->route('user.home', 'profile');
        }

        $this->name = $user->name;
        $this->email = $user->email;
        $this->telp = $user->telp;

        if(is_null($user->address))
        {
            session()->flash('error', 'Anda belum mengisi alamat pada akun anda.');
            return redirect()->route('user.home', 'address');
        }

        // Address
        $address = $user->address;
        $this->city = $address->city;
        $this->state = $address->state;
        $this->postalcode = $address->postalcode;
        $this->addressText = $address->address;

        $this->itemModel = new Item();
        $this->updateCart();
        if($this->content->count() == 0)
        {
            return redirect()->route('toko');
        }
    }

    public function render()
    {
        return view('livewire.checkout', [
            'content' => $this->content,
            'total' => $this->total
        ])->layout('components.layout', [
            'mainCSS' => 'container mx-auto py-16'
        ]);
    }

    public function orderProceed($payload)
    {
        if(is_null($payload['noted'])) $payload['noted'] = null;

        $content    = $payload['content'];

        $createInvoice = [
            'dateNow' => Carbon::now(),
            'note' => $payload['noted'],
            'total' => $payload['total']
        ];

        if(count($content) > 0)
        {
            DB::transaction(function () use($createInvoice, $content) {
                // 1. Create invoice
                $invoice = invoices::create([
                    'order_date' => $createInvoice['dateNow'],
                    'remarks' => $createInvoice['note'],
                    'status_payment' => 0,
                    'total' => $createInvoice['total']
                ]);

                // 2. Create detail_invoices
                foreach ($content as $id => $item)
                {
                    $detail_invoice = detail_invoices::create([
                        'id_items' => $id,
                        'id_invoices' => $invoice->id,
                        'id_users' => Auth::user()->id,
                        'name' => $item['name'],
                        'quantity' => $item['quantity'],
                        'subtotal' => $item['price'] * $item['quantity']
                    ]);
                }
                session()->flash('success', "Pesanan anda kami terima, mohon menunggu proses.");
                return redirect()->route('thankyou', $invoice->id);
            });
        }
    }

    /**
     * Convert price to use rupiah format
     *
     * @param $price
     */
    public function format($price)
    {
        return $this->itemModel->format_uang($price);
    }

    /**
     * Rerenders the cart items and total price on the browser.
     *
     * @return void
     */
    public function updateCart(): void
    {
        $this->total = Cart::total();
        $this->content = Cart::content();
    }
}
