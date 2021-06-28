<div>
    {{-- Address List --}}
    <div class="tab-pane divide-y-2 divide-gray-400" id="password" wire:key="address-pane">
        <h1 class="font-bold text-2xl text-gray-600">
            <i class="fas fa-address-card"></i>
            Alamat
        </h1>
        <hr />

        <form wire:submit.prevent="changeAddress">

            @if(session()->has('error'))
                <div class="text-white text-base bg-red-600 w-full py-2 px-4 my-4" id="alert">
                    {{ session('error') }}
                </div>
            @elseif(session()->has('success'))
                <div class="text-white text-base bg-green-600 w-full py-2 px-4 my-4" id="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div wire:loading.delay class="text-white bg-gray-400 w-full py-2 px-4 my-4">Loading...</div>
            <div class="my-4">
                <label for="city" class="block text-gray-700 font-bold text-xl mb-2">Kota</label>
                <input type="text" wire:model.lazy="city"
                       class="@error('name') border-2 border-red-500 @enderror
                           w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                       placeholder="Kota">
                @error('city')
                    <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="my-4">
                <label for="state" class="block text-gray-700 font-bold text-xl mb-2">Provinsi</label>
                <input type="text" wire:model.lazy="state"
                       class="@error('state') border-2 border-red-500 @enderror
                           w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                       placeholder="Provinsi">
                @error('state')
                    <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="my-4">
                <label for="zip" class="block text-gray-700 font-bold text-xl mb-2">Kode Pos</label>
                <input type="text" wire:model.lazy="zip"
                       class="@error('zip') border-2 border-red-500 @enderror
                           w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                       placeholder="Kode Pos">
                @error('zip')
                    <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="my-4">
                <label for="address" class="block text-gray-700 font-bold text-xl mb-2">Alamat</label>
                <textarea name="address"
                          class="w-full min-h-[100px] max-h-[300px] h-28 appearance-none block w-full
                                    bg-gray-300 border border-grey-lighter py-4 px-4 focus:outline-none
                                    focus:border-purple-500 focus:bg-white"
                          placeholder="Masukkan Alamat Anda">{{ $address }}</textarea>
                @error('address')
                    <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="mt-4">
                <button type="submit"
                        class="bg-blue-600 py-2 px-4 text-gray-100 hover:bg-blue-900">Ubah</button>
            </div>
        </form>
    </div>
</div>
