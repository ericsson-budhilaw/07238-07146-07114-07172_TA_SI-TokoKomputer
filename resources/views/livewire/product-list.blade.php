<div>
    {{ $name }}
    <div class="grid grid-cols-4 gap-4">
        <div class="items col-span-3">
            <div class="item-inner grid grid-cols-1 md:grid-cols-4">
                @foreach($items as $item)
                    <div class="item-{{ $item->id }} p-4">
                        <img src="{{ asset($item->thumbnail)  }}"alt="{{ $item->name }}" class="item-thumbnail p-4 shadow">
                        <div class="product-info my-4 text-center">
                            <h1 class="text-xl font-bold tracking-tight">{{ $item->name }}</h1>
                            <p class="text-xl font-bold text-blue-600">{{ $this->format_uang($item->price)  }}</p>
                            <button wire:click="addToCart({{ $item->id }}, '{{ $item->name }}', '{{ $item->price }}', 1)"
                                    class="my-4 py-2 px-4 mx-auto rounded bg-blue-400 text-gray-200 hover:bg-blue-500">
                                Beli Sekarang <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $items->links()  }}
        </div>
        <div class="sidebar pt-4">
            <div class="search-widget bg-gray-300 p-4 mb-4">
                <h1 class="text-2xl font-bold text-gray-500 font-sans mb-4 border-b-4">Cari Produk</h1>
                <input type="text" name="search" wire:model.lazy="search" class="w-full focus:outline-none"
                       placeholder="Ketik nama produk dan tekan enter..."/>
                <button wire:click="resetSearch"
                        class="px-4 py-2 mt-4 border-2 border-gray-500 bg-gray-400 hover:bg-gray-300">Reset</button>
            </div>

            <livewire:cart-component>
        </div>
    </div>
</div>
