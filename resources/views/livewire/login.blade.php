<div>
    <div class="my-4 px-4 md:px-0 grid grid-cols-1 md:grid-cols-3 flex justify-center content-center">
        <div></div>
        <div class="flex flex-col justify-center border-gray-400 border-2 rounded shadow p-4">
            <h5 class="text-center items-center"><i class="fa fa-user-circle"></i> LOGIN</h5>
            <hr />

            @if(session()->has('error'))
                <div class="text-white text-base bg-red-600 w-full py-2 px-4 my-4" id="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form wire:submit.prevent="login">
                <div class="my-4">
                    <label for="username" class="block text-gray-700 font-bold text-xl mb-2">E-mail / Username</label>
                    <input type="text" wire:model.lazy="email"
                           class="@error('email') border-2 border-red-500 @enderror
                               w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                           placeholder="Masukan Email atau Username">
                    @error('email')
                        <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="my-4">
                    <label for="password" class="block text-gray-700 font-bold text-xl mb-2">Password</label>
                    <input type="password" wire:model.lazy="password"
                           class="@error('password') border-2 border-red-500 @enderror
                               w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                           placeholder="*********">
                    @error('password')
                        <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-500 font-bold">
                        <input class="mr-2 leading-tight focus:outline-none" type="checkbox" wire:model="rememberMe">
                        <span class="text-sm">Ingat saya</span>
                    </label>
                </div>
                <div class="px-2">
                    <p>
                        Belum punya akun ? silahkan
                        <a href="#" class="text-blue-500 hover:text-blue-700" wire:click="register">daftar disini.</a>
                    </p>
                </div>
                <div class="px-2">
                    <a href="#" class="text-blue-500 hover:text-blue-700" wire:click="forgotPassword">Lupa Password</a>
                </div>
                <div class="mt-4">
                    <button type="submit"
                            class="bg-blue-600 py-2 px-4 text-gray-100 hover:bg-blue-900 w-full">Login</button>
                </div>
            </form>
        </div>
        <div></div>
    </div>
</div>
