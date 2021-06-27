<div>
    <div class="my-4 px-4 md:px-0 grid grid-cols-1 md:grid-cols-3 flex justify-center content-center">
        <div></div>
        <div class="flex flex-col justify-center border-gray-400 border-2 rounded shadow p-4">
            <h5 class="text-2xl text-center items-center">Terima kasih telah mendaftar!</h5>
            <hr />
            <div class="my-12">
                {{ __('Silahkan cek email anda untuk melakukan langkah terakhir yaitu verifikasi akun email anda.') }}
            </div>

            @if(session()->has('success'))
                <div class="text-white text-base bg-green-600 w-full py-2 px-4 my-4" id="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-2">
                <form action="{{ route('verification.send') }}" method="post">
                    <div wire:loading.delay class="text-white bg-gray-400 w-full py-2 px-4 my-4">Loading...</div>
                    @csrf
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full">Kirim Ulang Email</button>
                </form>
                <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Log-out</button>
            </div>
        </div>
        <div></div>
    </div>
</div>
