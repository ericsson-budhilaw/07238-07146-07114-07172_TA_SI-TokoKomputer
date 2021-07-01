<div>
    <div class="my-4 px-4 md:px-0 grid grid-cols-1 md:grid-cols-3 flex justify-center content-center">
        <div></div>
        <div class="flex flex-col justify-center border-gray-400 border-2 rounded shadow p-4">
            <h5 class="text-center items-center"><i class="fa fa-user-circle"></i> Add Produk</h5>
            <hr />

            @if(session()->has('error'))
                <div class="text-white text-base bg-red-600 w-full py-2 px-4 my-4" id="alert">
                    {{ session('error') }}
                </div>
            @elseif(session()->has('success'))
                <div class="text-white text-base bg-green-600 w-full py-2 px-4 my-4" id="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form class="mt-8" wire:submit.prevent="updateProduct">

                <div wire:loading.delay class="text-white bg-gray-400 w-full py-2 px-4 my-4">Loading...</div>

                <div class="px-4 text-center">
                    @if(!is_null($thumbnail))
                        <div class="preview my-4 flex justify-center items-center">
                            <img class="h-64 w-64 object-cover" src="{{ $thumbnail }}" alt="{{ $title }}">
                        </div>
                    @endif

                    <div class="upload-button mb-4">
                        <label class="cursor-pointer mt-6">
                            <span class="mt-2 text-base leading-normal px-4 py-2 bg-blue-500 text-white text-sm rounded-full" >Upload Foto</span>
                            <input type='file' class="hidden" wire:change="$emit('upload_thumbnail')" />
                        </label>
                        @error('thumbnail')
                        <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="my-4">
                    <label for="title" class="block text-gray-700 font-bold text-xl mb-2">Judul Produk</label>
                    <input type="text" wire:model.lazy="title"
                           class="@error('title') border-2 border-red-500 @enderror
                               w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                           placeholder="Masukkan Judul Produk">
                    @error('title')
                    <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="my-4">
                    <label for="description" class="block text-gray-700 font-bold text-xl mb-2">Deskripsi</label>
                    <textarea name="description" id="descriptionText" wire:model.lazy="description"
                              class="w-full min-h-[100px] max-h-[300px] h-28 appearance-none block w-full
                                    bg-gray-300 border border-grey-lighter py-4 px-4 focus:outline-none
                                    focus:border-purple-500 focus:bg-white"
                              placeholder="Masukkan Deskripsi Produk">{{ $description }}</textarea>
                    @error('description')
                    <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="my-4">
                    <label for="price" class="block text-gray-700 font-bold text-xl mb-2">Harga</label>
                    <input type="number" wire:model.lazy="price"
                           class="@error('price') border-2 border-red-500 @enderror
                               w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                           placeholder="Masukkan Harga Barang">
                    @error('price')
                    <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="my-4">
                    <label for="stok" class="block text-gray-700 font-bold text-xl mb-2">Stok</label>
                    <input type="number" wire:model.lazy="stok"
                           class="@error('stok') border-2 border-red-500 @enderror
                               w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                           placeholder="Masukkan Stok Barang">
                    @error('stok')
                    <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit"
                            class="bg-blue-600 py-2 px-4 text-gray-100 hover:bg-blue-900 w-full">Tambahkan</button>
                </div>
            </form>
        </div>
        <div></div>
    </div>
</div>
