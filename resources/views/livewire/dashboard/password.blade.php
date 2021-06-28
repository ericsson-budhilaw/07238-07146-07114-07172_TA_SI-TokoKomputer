<div>
    {{-- Change Password --}}
    <div class="tab-pane divide-y-2 divide-gray-400" id="password" wire:key="address-pane">
        <h1 class="font-bold text-2xl text-gray-600">
            <i class="fas fa-address-card"></i>
            Ganti Password
        </h1>
        <hr />

        <form wire:submit.prevent="changePass">
            @csrf

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
                <label for="email" class="block text-gray-700 font-bold text-xl mb-2">E-mail</label>
                <input type="text" wire:model.lazy="email"
                       class="@error('name') border-2 border-red-500 @enderror
                           w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                       placeholder="Masukkan E-mail Anda">
                @error('email')
                    <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="my-4">
                <label for="oldPassword" class="block text-gray-700 font-bold text-xl mb-2">Password Lama</label>
                <input type="password" wire:model.lazy="oldPassword"
                       class="@error('state') border-2 border-red-500 @enderror
                           w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                       placeholder="Masukkan Password Lama Anda">
                @error('oldPassword')
                    <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="my-4">
                <label for="password" class="block text-gray-700 font-bold text-xl mb-2">Password Baru</label>
                <input type="password" wire:model.lazy="password"
                       class="@error('zip') border-2 border-red-500 @enderror
                           w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                       placeholder="Masukkan Password Baru Anda">
                @error('password')
                    <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="my-4">
                <label for="password_confirmation" class="block text-gray-700 font-bold text-xl mb-2">Password Konfirmasi</label>
                <input type="password" wire:model.lazy="password_confirmation" name="password_confirmation"
                       class="@error('zip') border-2 border-red-500 @enderror
                           w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                       placeholder="Masukkan Password Konfirmasi">
                @error('password_confirmation')
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
