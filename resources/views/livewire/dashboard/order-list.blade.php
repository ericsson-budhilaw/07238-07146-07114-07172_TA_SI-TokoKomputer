<div>
    {{-- Order List --}}
    <div class="tab-pane divide-y-2 divide-gray-400" id="users" wire:key="orderlist-pane">

        @if(session()->has('error'))
            <div class="text-white text-base bg-red-600 w-full py-2 px-4 my-4" id="alert">
                {{ session('error') }}
            </div>
        @elseif(session()->has('success'))
            <div class="text-white text-base bg-green-600 w-full py-2 px-4 my-4" id="alert">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="font-bold text-2xl text-gray-600">
            <i class="fas fa-clipboard-list"></i>
            Order History
        </h1>
        <hr />

        <div class="table-data flex-col md:overflow-hidden overflow-auto">
            <table class="table-auto my-4">
                <thead>
                <tr>
                    <th class="border-2 border-gray-500 px-4 py-2">Nomor Pesanan</th>
                    <th class="border-2 border-gray-500 px-4 py-2">Tanggal Pemesanan</th>
                    <th class="border-2 border-gray-500 px-4 py-2">Status Pembayaran</th>
                    <th class="border-2 border-gray-500 px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody class="text-center">
                @foreach($orders as $order)
                    <td class="border-2 border-gray-500 px-4 py-2">{{ $order->id }}</td>
                    <td class="border-2 border-gray-500 px-4 py-2">{{ date('d F Y', strtotime($order->created_at)) }}</td>
                    <td class="border-2 border-gray-500 px-4 py-2">
                        @if($order->status_payment == 0)
                            <span class="text-red-600 font-bold text-sm">Belum dibayar</span>
                        @else
                            <span class="text-green-600 font-bold text-sm">Lunas</span>
                        @endif
                    </td>
                    <td class="border-2 border-gray-500 px-4 py-2">
                        <button class="bg-green-500 text-white-500 px-4 py-2 rounded" wire:click="showDetail({{ $order->id }})">
                            Detail
                        </button>
                        <button class="bg-green-500 text-white-500 px-4 py-2 rounded" wire:click="ubahStatus({{ $order->id }})">
                            Ubah
                        </button>
                    </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="py-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>
