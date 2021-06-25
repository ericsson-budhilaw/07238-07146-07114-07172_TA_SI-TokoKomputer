<div>
    <div class="relative w-64">
        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8
                        rounded leading-tight focus:outline-none focus:bg-gray-200 focus:border-gray-500 mb-4"
                        wire:model="sorting">
            <option value="0" selected disabled>-- Urut berdasarkan --</option>
            <option value="terbaru">Terbaru</option>
            <option value="termurah">Termurah</option>
        </select>
    </div>

    {{-- Products List --}}
    <div class="grid grid-cols-1 md:grid-cols-4 md:gap-4">
        <div class="items col-span-3">
            <div class="item-inner grid grid-cols-1 md:grid-cols-4 md:gap-3">
                @foreach($items as $item)
                    <livewire:product :item="$item" :wire:key="$item->id" />
                @endforeach
            </div>
            {{ $items->links()  }}
        </div>
        <div class="sidebar p-4 md:pt-4 text-center">
            <div class="search-widget bg-gray-300 p-4 mb-4">
                <h1 class="text-2xl font-bold text-gray-500 font-sans mb-4 border-b-4">Cari Produk</h1>
                <input type="text" name="search" wire:model.lazy="term" class="w-full focus:outline-none"
                       placeholder="Ketik nama produk dan tekan enter..."/>
                <button wire:click="resetSearch"
                        class="px-4 py-2 mt-4 border-2 border-gray-500 bg-gray-400 hover:bg-gray-300">Reset</button>
            </div>
        </div>
    </div>
</div>
