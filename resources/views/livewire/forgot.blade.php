<div>
    <div class="my-4 px-4 md:px-0 grid grid-cols-1 md:grid-cols-3 flex justify-center content-center">
        <div></div>
        <div class="flex flex-col justify-center border-gray-400 border-2 rounded shadow p-4">
            <h5 class="text-center items-center"><i class="fa fa-user-circle"></i> Lupa Password</h5>
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

            <form wire:submit.prevent="resetPass">
                <div wire:loading.delay class="text-white bg-gray-400 w-full py-2 px-4 my-4">Loading...</div>
                <div class="my-4">
                    <label for="username" class="block text-gray-700 font-bold text-xl mb-2">E-mail</label>
                    <input type="text" wire:model.lazy="email" name="email"
                           class="@error('email') border-2 border-red-500 @enderror
                               w-full bg-gray-300 focus:outline-none focus:border-purple-500 focus:bg-white"
                           placeholder="Masukan Email Anda">
                    @error('email')
                        <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div>
                    <p>
                        Sudah punya akun ? silahkan
                        <a href="#" class="text-blue-500 hover:text-blue-700" wire:click="login">masuk.</a>
                    </p>
                </div>
                <div class="mt-4">
                    <button type="submit"
                            class="bg-blue-600 py-2 px-4 text-gray-100 hover:bg-blue-900 w-full">Reset Password</button>
                </div>
            </form>
        </div>
        <div></div>
    </div>
</div>
