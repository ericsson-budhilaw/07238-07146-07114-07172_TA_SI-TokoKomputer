<div class="">
    {{-- Checkout Page --}}
    <div class="grid grid-cols-2 gap-4">
        <div class="checkout-fields">
            <h3 class="text-xl font-bold text-gray-500">Detail Tagihan</h3>
            <hr />
            <form class="my-8">
                <div class="my-4">
                    <label for="name" class="block text-gray-700 font-bold text-xl mb-2">Nama Lengkap</label>
                    <input type="text" wire:model.lazy="name"
                           class="@error('name') border-2 border-red-500 @enderror
                               w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                           placeholder="Masukkan Nama Lengkap Anda">
                    @error('name')
                        <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="my-4">
                    <label for="telp" class="block text-gray-700 font-bold text-xl mb-2">Nomor Telepon</label>
                    <input type="text" wire:model.lazy="telp"
                           class="@error('telp') border-2 border-red-500 @enderror
                               w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                           placeholder="Masukkan Nomor Telepon Anda">
                    @error('telp')
                        <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="my-4">
                    <label for="email" class="block text-gray-700 font-bold text-xl mb-2">E-mail</label>
                    <input type="text" wire:model.lazy="email"
                           class="@error('email') border-2 border-red-500 @enderror
                               w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                           placeholder="Masukkan E-mail Anda">
                    @error('email')
                        <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="my-4">
                    <label for="address" class="block text-gray-700 font-bold text-xl mb-2">Alamat</label>
                    <textarea name="address"
                              class="w-full min-h-[100px] max-h-[300px] h-28 appearance-none block w-full
                                    bg-gray-300 border border-grey-lighter py-4 px-4 focus:outline-none
                                    focus:border-purple-500 focus:bg-white"
                              placeholder="Masukkan Alamat Anda"></textarea>
                    @error('address')
                        <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </form>
        </div>
        <div class="checkout-info">
            <h3 class="text-xl font-bold text-gray-500">Pesanan Anda</h3>
            <div class="product-info my-4">
                <h4 class="font-bold">Produk</h4>
                @if ($content->count() > 0)
                    @foreach ($content as $id => $item)
                        <div class="grid grid-cols-6 justify-items-stretch my-4">
                            <div class="col-start-1 col-end-1">
                                <img src="{{ asset($item->get('thumbnail'))  }}" alt="{{ $item->get('name') }}"
                                     class="p-4 shadow" width="80" height="120">
                            </div>
                            <div class="col-span-4">
                                <h2 class="text-base font-bold mb-1">{{ $item->get('name') }}</h2>
                                <span class="text-sm font-bold text-gray-600">{{ $item->get('quantity') }}x</span>
                            </div>
                            <div class="justify-self-end">
                                {{ $itemModel->format_uang($item->get('price')) }}
                            </div>
                        </div>
                    @endforeach
                @endif
                <hr />
                <div class="flex justify-between subtotal">
                    <h4 class="font-bold">Total</h4>
                    <span class="">{{ $total }}</span>
                </div>
                <div class="my-8">
                    <button class="w-full bg-green-500 hover:bg-green-600 text-white py-4">Proses Pesanan</button>
                </div>
            </div>
        </div>
    </div>
</div>
