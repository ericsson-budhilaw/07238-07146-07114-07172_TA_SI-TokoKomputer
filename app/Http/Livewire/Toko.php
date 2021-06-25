<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class Toko extends Component
{
    use WithPagination;

    public $term;
    public $sorting = 0;

    protected $items;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetSearch()
    {
        $this->reset();
        $this->sortProducts($this->sorting, '');
    }

    public function render()
    {
        $this->sortProducts($this->sorting, $this->term);

        return view('livewire.toko', [
            'items' => $this->items
        ])->layout('components.layout',  ['mainCSS' => 'container mx-auto py-6']);
    }

    public function addToCart(int $id, string $thumbnail, string $name, string $price, string $quantity): void
    {
        Cart::add($id, $thumbnail, $name, $price, $quantity);
        $this->emit('productAddedToCart', 'show');
    }

    public function sortProducts($value, $term)
    {
        if (!empty($term))
        {
            $this->updatingSearch();
        }

        switch ($value) {
            case 'termurah':
                $this->value = $value;
                $this->items = Item::search($this->term)->orderBy('price', 'asc')->paginate(8);
                break;
            case 'terbaru':
                $this->value = $value;
                $this->items = Item::search($this->term)->orderBy('created_at', 'asc')->paginate(8);
                break;
            case '0':
                $this->items = Item::search($this->term)->paginate(8);
                break;
            default:
                $this->items = Item::search($this->term)->paginate(8);
        }
    }
}
