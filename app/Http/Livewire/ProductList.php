<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $search;
    public $name;

    public function format_uang($angka){
        $hasil = "Rp." . number_format($angka,0, ',' , '.');
        return $hasil;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetSearch()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.product-list', [
            'items' => Item::search($this->search)->paginate(8)
        ]);
    }

    public function addToCart(int $id, string $name, string $price, string $quantity): void
    {
        $this->name = $name;
    }
}
