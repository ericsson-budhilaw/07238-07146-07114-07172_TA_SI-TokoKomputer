<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Livewire\Component;

class SingleProduct extends Component
{
    public $product;
    public $itemModel;
    public $quantity;
    public $related;

    public function mount(Request $request, $slug)
    {
        $this->itemModel = new Item();
        $this->product = Item::where('slug', $slug)->first();
        $this->quantity = $this->product->stok;
        $this->related = Item::orderBy('created_at')->inRandomOrder()->limit(4)->get();
    }

    public function render()
    {
        return view('livewire.single-product')->layout('components.layout', [
            'mainCSS' => 'container mx-auto py-10'
        ]);
    }

    /**
     * Add to cart product
     *
     * @param int $id
     * @param string $thumbnail
     * @param string $name
     * @param string $price
     * @param string $stok
     * @param string $quantity
     */
    public function addToCart(int $id, string $thumbnail, string $name, string $price, string $stok, string $quantity): void
    {
        if($quantity > $stok)
        {
            $quantity = $stok;
            $this->quantity = $stok;
        }
        Cart::add($id, $thumbnail, $name, $price, $stok, $quantity);
        $this->emit('productAddedToCart', 'show');
    }

    /**
     * Updates a cart item.
     *
     * @param string $id
     * @param string $action
     * @return void
     */
    public function bulkPurchase(string $action): void
    {
        switch ($action) {
            case 'plus':
                $this->quantity += 1;
                break;
            case 'minus':
                $this->quantity -= 1;
                if($this->quantity < 1)
                {
                    $this->quantity = 1;
                }
                break;
        }
    }
}
