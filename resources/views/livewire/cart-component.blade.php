<div>
    <div id="modal" class="{{ $cart }} fixed w-full h-full top-0 left-0 flex items-center justify-end block">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-content py-4 text-left px-4 h-full bg-white shadow-lg z-50 overflow-y-auto w-72">
            <div class="grid grid-cols-3 gap-0">
                <div class="text-left mb-4 col-span-2">
                        <h3 class="font-bold text-base">{{ $content->count() }} Produk</h3>
                        <p class="text-base text-gray-400">ada di keranjang anda</p>
                </div>
                <div class="close-button text-center">
                    <button class="text-3xl my-2 focus:outline-none"
                            wire:click="clearCart"><i class="fas fa-times"></i></button>
                </div>
            </div>
            @if ($content->count() > 0)
                @foreach ($content as $id => $item)
                    <div class="grid grid-cols-2 gap-2 my-4">
                        <div class="thumbnail mx-4">
                            <img src="{{ asset($item->get('thumbnail'))  }}" alt="{{ $item->get('name') }}"
                                 class="p-4 shadow" width="80" height="120">
                        </div>
                        <div class="product-details">
                            <h2 class="text-xs font-bold mb-2">{{ $item->get('name') }}</h2>
                            <div>
                                <button class="text-sm bg-gray-300 text-gray-400 px-2 py-1"
                                        wire:click="updateCartItem({{ $id }}, 'minus')"><i class="fas fa-minus"></i></button>
                                <span class="text-sm text-gray-600">{{ $item->get('quantity') }}x</span>
                                <button class="text-sm bg-gray-300 text-gray-400 px-2 py-1"
                                        wire:click="updateCartItem({{ $id }}, 'plus')"><i class="fas fa-plus"></i></button>
                                <button class="text-sm bg-red-500 text-gray-100 px-2 py-1"
                                        wire:click="removeFromCart({{ $id }})"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="absolute bottom-6">
                <span class="text-green-500 text-base">Subtotal: </span>
                <span class="text-gray-900 text-xl font-bold">{{ $total }}</span>
                <button wire:click="checkout"
                    class="bg-green-600 px-4 py-2 text-xl text-gray-100 w-64 md:w-full">Konfirmasi Pesanan</button>
            </div>
        </div>
    </div>
</div>
