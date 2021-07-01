<div>
    {{-- Product List --}}
    <div class="tab-pane divide-y-2 divide-gray-400" id="users" wire:key="product-pane">
        <h1 class="font-bold text-2xl text-gray-600">
            <i class="fas fa-clipboard-list"></i>
            Daftar Produk
        </h1>
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

        <div class="table-data flex-col md:overflow-hidden overflow-auto">
            <table class="table-auto my-4">
                <thead>
                <tr>
                    <th class="border-2 border-gray-500 px-4 py-2">No.</th>
                    <th class="border-2 border-gray-500 px-4 py-2">Name</th>
                    <th class="border-2 border-gray-500 px-4 py-2">Stok</th>
                    <th class="border-2 border-gray-500 px-4 py-2">Price</th>
                    <th class="border-2 border-gray-500 px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr class="{{ ($num % 2) ? 'bg-gray-300' : '' }}">
                        <td class="border-2 border-gray-500 px-4 py-2">{{ $num++ }}</td>
                        <td class="border-2 border-gray-500 px-4 py-2">{{ $item->name }}</td>
                        <td class="border-2 border-gray-500 px-4 py-2">{{ $item->stok }}</td>
                        <td class="border-2 border-gray-500 px-4 py-2">{{ $itemModel->format_uang($item->price) }}</td>
                        <td class="border-2 border-gray-500 px-4 py-2">
                            <button class="bg-yellow-500 text-gray-100 px-4 py-2"
                                    wire:click="editProduct({{ $item->id }})">Edit</button>
                            @if($confirming == $item->id)
                                <button class="bg-red-500 text-gray-100 px-4 py-2"
                                        wire:click="deleteProduct({{ $item->id }})">Sure ?</button>
                            @else
                                <button class="bg-red-500 text-gray-100 px-4 py-2"
                                        wire:click="kill({{ $item->id }})">Delete</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="add-button my-4">
                <button type="submit"
                        class="bg-green-600 py-2 px-4 text-gray-100 hover:bg-green-900"
                        wire:click="addProduct">Tambahkan</button>
            </div>
        </div>

        <div class="py-4">
            {{ $items->links() }}
        </div>
    </div>
</div>
