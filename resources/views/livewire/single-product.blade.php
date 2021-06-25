<div>
    {{-- Single Product Page --}}
    <div class="grid grid-cols-2 gap-2 mb-16">
        <div class="thumbnail flex justify-center items-center p-4">
            <img src="{{ asset($product->thumbnail)  }}" alt="{{ $product->name }}"
                 class="thumbnail" height="655" width="513">
        </div>

        <div class="product-info my-4 text-left">
            <h1 class="text-3xl font-bold tracking-tight mt-8">{{ $product->name }}</h1>
            <p class="text-2xl font-bold text-blue-600 my-4">{{ $this->itemModel->format_uang($product->price)  }}</p>
            <p class="text-base tracking-wide mb-4">{{ $product->description }}</p>
            <p class="text-base text-green-500">Stok: {{ $product->stok }}</p>

            <div class="custom-number-input h-10 w-32 my-4">
                <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                    <button data-action="decrement" class=" bg-gray-300 text-gray-600 hover:text-gray-700
                            hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none"
                            wire:click="bulkPurchase('minus')>
                        <span class="m-auto text-2xl font-thin">−</span>
                    </button>

                    <input type="number" class="outline-none focus:outline-none text-center w-full bg-gray-300
                    font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex
                    items-center text-gray-700 border-0 focus:border-opacity-0"
                           name="custom-input-number" wire:model="quantity">

                    <button data-action="increment" class="bg-gray-300 text-gray-600 hover:text-gray-700
                            hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer"
                            wire:click="bulkPurchase('plus')>
                        <span class="m-auto text-2xl font-thin">+</span>
                    </button>
                </div>
            </div>

            <button wire:click="addToCart({{ $product->id }}, '{{ $product->thumbnail }}', '{{ $product->name }}', '{{ $product->price }}', '{{ $product->stok }}', '{{ $quantity }}')"
                    class="my-4 py-2 px-4 mx-auto rounded bg-blue-400 text-gray-200 hover:bg-blue-500 w-96">
                Beli Sekarang <i class="fas fa-shopping-cart"></i>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-4 gap-3">
        @foreach($related as $item)
            <livewire:product :item="$item" :wire:key="$item->id" />
        @endforeach
    </div>
</div>
