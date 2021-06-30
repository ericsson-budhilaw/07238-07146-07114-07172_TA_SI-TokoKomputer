<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\detail_invoices;
use App\Models\invoices;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class OrderList extends Component
{

    use WithPagination;

    protected $orders;
    protected $details;

    public function mount()
    {

    }

    public function render()
    {
        $orders = invoices::all();
        return view('livewire.dashboard.order-list', [
            'orders' => $this->paginate($orders, 8)
        ]);
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function ubahStatus($id)
    {
        $order = invoices::where('id', $id)->firstOrFail();
        if($order->status_payment == 0)
        {
            $order->status_payment = 1;
            $order->save();
            session()->flash('success', "Pembayaran berhasil di verifikasi!");
            return redirect()->route('user.home', 'orderlist');
        }
        else
        {
            $order->status_payment = 0;
            $order->save();
            session()->flash('success', "Pembayaran telah dibatalkan!");
            return redirect()->route('user.home', 'orderlist');
        }
    }

    public function showDetail($id)
    {
        return redirect()->route('thankyou', $id);
    }
}
