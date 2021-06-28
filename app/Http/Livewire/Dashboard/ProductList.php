<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $itemModel;
    public $num = 0;

    protected $items;

    public function mount()
    {
        $this->itemModel = new Item();
    }

    public function render()
    {
        $items = Item::orderBy('created_at', 'asc')->paginate(8);
        return view('livewire.dashboard.product-list', [
            'items' => $items
        ]);
    }
}
