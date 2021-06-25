<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="item-{{ $item->id }}">
        <img src="{{ asset($item->thumbnail)  }}" alt="{{ $item->name }}" class="item-thumbnail p-4 shadow">
        <div class="product-info my-4 text-center">
            <h1 class="text-xl font-bold tracking-tight">
                <a href="{{ route('product.single', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
            </h1>
            <p class="text-xl font-bold text-blue-600">{{ $this->itemModel->format_uang($item->price)  }}</p>
            <button wire:click="addToCart({{ $item->id }}, '{{ $item->thumbnail }}', '{{ $item->name }}', '{{ $item->price }}', '{{ $item->stok }}', 1)"
                    class="my-4 py-2 px-4 mx-auto rounded bg-blue-400 text-gray-200 hover:bg-blue-500">
                Beli Sekarang <i class="fas fa-shopping-cart"></i>
            </button>
        </div>
    </div>
</div>
