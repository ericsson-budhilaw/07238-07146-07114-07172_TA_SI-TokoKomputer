<div class="container mx-auto px-8 md:px-0">
    <h1 class="text-2xl font-bold text-gray-400 font-sans py-2 my-12 border-b-4">Pilihan Kami</h1>
    <div class="items grid grid-cols-1 md:grid-cols-4 gap-8 mt-4">
        @foreach($items as $item)
            <div class="item-{{ $item->id }}">
                <img src="{{ asset($item->thumbnail)  }}" alt="{{ $item->name }}" class="item-thumbnail p-4 shadow">
                <div class="product-info my-4 text-center">
                    <h1 class="text-xl font-bold tracking-tight">{{ $item->name }}</h1>
                    <p class="text-xl font-bold text-blue-600">{{ $this->format_uang($item->price)  }}</p>
                    <button class="my-4 py-2 px-4 mx-auto rounded bg-blue-400 text-gray-200 hover:bg-blue-500">Beli Sekarang <i class="fas fa-shopping-cart"></i></button>
                </div>
            </div>
        @endforeach
    </div>
    <button class="text-center w-full rounded bg-gray-200 mt-4 p-2 text-gray-400 hover:bg-gray-300 focus:outline-none">
        <a href="{{ route('toko') }}">Lihat lainnya</a>
    </button>
</div>
