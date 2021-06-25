<section class="hero">
    <div class="mx-auto py-5 container grid gap-4 grid-cols-1 md:grid-cols-2">
        <div class="mx-auto">
            <img src="{{ asset("storage/RTX3090-ASUS.png") }}" alt="ASUS ROG RTX 3090" width="555" height="485" />
        </div>
        <div class="pt-24 antialiased font-sans text-center md:text-left">
            <p class="mb-8 text-4xl font-bold text-gray-900">ASUS ROG RTX 3090</p>
            <p class="text-2xl font-bold tracking-wide text-gray-700">Performa terbaik, suhu yang terjaga</p>
            <p class="mb-8 text-2xl font-bold tracking-wide text-gray-700">Semua permainan dapat ditaklukan</p>
            <div class="price-tag grid gap-2 grid-cols-2 md:w-1/2 p-8">
                <p class="text-1xl text-center p-4 bg-blue-600 text-gray-300 shadow">Rp.16.999.000</p>
                <button class="text-sm md:text-1xl text-center tracking-wider bg-gray-300 shadow hover:bg-gray-200">BELI SEKARANG <i class="fas fa-shopping-cart"></i></button>
            </div>
        </div>
    </div>
</section>

{{-- Latest Product --}}
<div class="container mx-auto px-8 md:px-0">
    <h1 class="text-2xl font-bold text-gray-400 font-sans py-2 my-12 border-b-4">Produk Terbaru</h1>
    <div class="items grid grid-cols-1 md:grid-cols-4 gap-8 mt-4">
        @foreach($latest as $item)
            <livewire:product :item="$item" :wire:key="$item->id" />
        @endforeach
    </div>
    <button class="text-center w-full rounded bg-gray-200 mt-4 p-2 text-gray-400 hover:bg-gray-300 focus:outline-none">
        <a href="{{ route('toko') }}">Lihat lainnya</a>
    </button>
</div>

{{-- Random Product --}}
<div class="container mx-auto px-8 md:px-0">
    <h1 class="text-2xl font-bold text-gray-400 font-sans py-2 my-12 border-b-4">Pilihan Kami</h1>
    <div class="items grid grid-cols-1 md:grid-cols-4 gap-8 mt-4">
        @foreach($random as $item)
            <livewire:product :item="$item" :wire:key="$item->id" />
        @endforeach
    </div>
    <button class="text-center w-full rounded bg-gray-200 mt-4 p-2 text-gray-400 hover:bg-gray-300 focus:outline-none">
        <a href="{{ route('toko') }}">Lihat lainnya</a>
    </button>
</div>
