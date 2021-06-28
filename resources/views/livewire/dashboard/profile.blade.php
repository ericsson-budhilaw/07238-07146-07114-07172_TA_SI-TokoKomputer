<div>
    {{-- Change Password --}}
    <div class="tab-pane divide-y-2 divide-gray-400" id="password" wire:key="profil-pane">
        <h1 class="font-bold text-2xl text-gray-600">
            <i class="fas fa-address-card"></i>
            Edit Profil
        </h1>
        <hr />

        <form wire:submit.prevent="EditProfile">
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

            <div class="px-4 text-center">
                <div class="preview my-4 flex justify-center items-center">
                    <img class="h-24 w-24 rounded-full object-cover" src="{{ $photo }}" alt="{{ $name }}">
                </div>

                <div class="upload-button mb-4">
                    <label class="cursor-pointer mt-6">
                        <span class="mt-2 text-base leading-normal px-4 py-2 bg-blue-500 text-white text-sm rounded-full" >Select Avatar</span>
                        <input type='file' class="hidden" wire:change="$emit('single_file_choosed')" />
                    </label>
                    @error('photo')
                        <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="my-4">
                <label for="name" class="block text-gray-700 font-bold text-xl mb-2">Nama</label>
                <input type="text" wire:model.lazy="name"
                       class="@error('name') border-2 border-red-500 @enderror
                           w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                       placeholder="Masukkan Nama Anda">
                @error('name')
                    <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="my-4">
                <label for="email" class="block text-gray-700 font-bold text-xl mb-2">E-mail</label>
                <input type="text" wire:model.lazy="email"
                       class="@error('email') border-2 border-red-500 @enderror
                           w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                       placeholder="Masukkan E-mail">
                @error('email')
                    <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="my-4">
                <label for="telepon" class="block text-gray-700 font-bold text-xl mb-2">Nomor Telepon</label>
                <input type="text" wire:model.lazy="telepon"
                       class="@error('telepon') border-2 border-red-500 @enderror
                           w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                       placeholder="Masukkan Nomor Telepon">
                @error('telepon')
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

<script>

</script>
