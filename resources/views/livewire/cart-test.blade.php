<div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-end">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="modal-content py-4 text-left px-6 h-full bg-white shadow-lg z-50 overflow-y-auto">
        @if($content->count() > 0)
            <h3>{{ $content->count() }} Produk</h3>
            <h4>ada di keranjang anda</h4>
        @else
            <h3>{{ $content->count() }} Produk</h3>
            <h4>tidak ada produk di keranjang</h4>
        @endif
    </div>
</div>
