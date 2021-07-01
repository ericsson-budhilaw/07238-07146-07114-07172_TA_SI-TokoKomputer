<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $confirming;
    public $itemModel;
    public $num = 1;

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

    public function kill($id)
    {
        $this->confirming = $id;
    }

    public function addProduct()
    {
        return redirect()->route('product.add');
    }

    public function editProduct($id)
    {
        return redirect()->route('product.edit', $id);
    }

    public function deleteProduct($id)
    {
        Item::destroy($id);
        session()->flash('success', 'Berhasil menghapus data');
        return redirect()->route('user.home', 'product');
    }
}
