<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;

class CartService
{
    const MINIMUM_QUANTITY = 1;
    const DEFAULT_INSTANCE = 'cart';

    protected $session;
    protected $instance;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function format_uang($angka){
        $hasil = "Rp." . number_format($angka,0, ',' , '.');
        return $hasil;
    }

    /**
     * Adds a new item to the cart.
     *
     * @param $id
     * @param $name
     * @param $price
     * @param $quantity
     * @param array $options
     * @return void
     */
    public function add($id, $thumbnail, $name, $price, $stok, $quantity, $options = []): void
    {
        $cartItem   = $this->createCartItem($thumbnail, $name, $price, $stok, $quantity, $options);

        $content    = $this->getContent();

        // If the quantity more than the stok, then set the quantity variable same as the stok
        // Prevent order over stok
        if($quantity > $stok) $quantity = $stok;

        if ($content->has($id)) {
            $quantityCart = $content->get($id)->get('quantity');
            $stokCart = $content->get($id)->get('stok');
            $total = $stokCart - $quantityCart;

            if($total == 0 && $quantity > 0)
            {
                $this->session->put(self::DEFAULT_INSTANCE, $content);
                return;
            }

            $cartItem->put('quantity', $content->get($id)->get('quantity') + $quantity);
        }

        $content->put($id, $cartItem);

        $this->session->put(self::DEFAULT_INSTANCE, $content);
    }

    /**
     * Updates the quantity of a cart item.
     *
     * @param string $id
     * @param string $action
     * @return void
     */
    public function update(string $id, string $action): void
    {
        $content = $this->getContent();

        if ($content->has($id)) {
            $cartItem = $content->get($id);
            $stok = $content->get($id)->get('stok');

            switch ($action) {
                case 'plus':
                    $updatedQuantity = $content->get($id)->get('quantity') + 1;
                    if($updatedQuantity > $stok)
                    {
                        $updatedQuantity = $stok;
                    }
                    $cartItem->put('quantity', $updatedQuantity);
                    break;
                case 'minus':
                    $updatedQuantity = $content->get($id)->get('quantity') - 1;

                    if ($updatedQuantity < self::MINIMUM_QUANTITY) {
                        $updatedQuantity = self::MINIMUM_QUANTITY;
                    }

                    $cartItem->put('quantity', $updatedQuantity);
                    break;
            }

            $content->put($id, $cartItem);

            $this->session->put(self::DEFAULT_INSTANCE, $content);
        }
    }

    /**
     * Removes an item from the cart.
     *
     * @param string $id
     * @return void
     */
    public function remove(string $id): void
    {
        $content = $this->getContent();

        if ($content->has($id)) {
            $this->session->put(self::DEFAULT_INSTANCE, $content->except($id));
        }
    }

    /**
     * Clear the cart.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->session->forget(self::DEFAULT_INSTANCE);
    }

    /**
     * Returns the content of the cart.
     *
     * @return Collection
     */
    public function content(): Collection
    {
        return is_null($this->session->get(self::DEFAULT_INSTANCE)) ? collect([]) : $this->session->get(self::DEFAULT_INSTANCE);
    }

    /**
     * Returns total price of the items in the cart.
     */
    public function total()
    {
        $content    = $this->getContent();

        $total      = $content->reduce(function ($total, $item) {
            return $total += $item->get('price') * $item->get('quantity');
        });

        return $total;
    }

    /**
     * Returns the content of the cart
     *
     * @return Collection
     */
    protected function getContent(): Collection
    {
        return $this->session->has(self::DEFAULT_INSTANCE) ? $this->session->get(self::DEFAULT_INSTANCE) : collect([]);
    }

    /**
     * Create a new cart item from given inputs.
     *
     * @param string $name
     * @param string $price
     * @param string $quantity
     * @param array $options
     * @return Collection
     */
    protected function createCartItem(string $thumbnail, string $name, string $price, string $stok, string $quantity, array $options): Collection
    {
        $price      = floatval($price);
        $quantity   = intval($quantity);

        if ($quantity < self::MINIMUM_QUANTITY) {
            $quantity = self::MINIMUM_QUANTITY;
        }

        return collect([
            'thumbnail' => $thumbnail,
            'name' => $name,
            'price' => $price,
            'stok' => $stok,
            'quantity' => $quantity,
            'options' => $options
        ]);
    }
}
