<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\detail_invoices;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class History extends Component
{

    use WithPagination;

    protected $details;

    public function render()
    {
        $details = detail_invoices::where('id_users', Auth::user()->id)->get();
        $details = $details->unique('id_invoices');
        return view('livewire.dashboard.history', [
            'details' => $this->paginate($details, 8)
        ]);
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function showDetail($id)
    {
        return redirect()->route('thankyou', $id);
    }
}
