<div class="">
    @if(session()->has('error'))
        <div class="text-white text-base bg-red-600 w-full py-2 px-4 my-4" id="alert">
            {{ session('error') }}
        </div>
    @elseif(session()->has('success'))
        <div class="text-white text-base bg-green-600 w-full py-2 px-4 my-4" id="alert">
            {{ session('success') }}
        </div>
    @endif

    <h4 class="text-gray-600 mb-4">Terima kasih. Pesanan anda kami terima!</h4>
    <div class="order-details px-4 bg-gray-300 divide-y divide-gray-400">
        <div class="order-number py-4">
            <p class="text-sm text-gray-600 mb-2">Nomor Pesanan / ID Pesanan</p>
            <p class="text-xl font-bold">{{ $invoice->id }}</p>
        </div>
        <div class="order-date py-4">
            <p class="text-sm text-gray-600 mb-2">Tanggal Pesanan</p>
            <p class="text-xl font-bold">{{ date('d F Y', strtotime($invoice->order_date)) }}</p>
        </div>
        <div class="order-email py-4">
            <p class="text-sm text-gray-600 mb-2">Total Pesanan</p>
            <p class="text-xl font-bold">{{ $this->format($invoice->total) }}</p>
        </div>
        <div class="order-email py-4">
            <p class="text-sm text-gray-600 mb-2">Metode Pembayaran</p>
            <p class="text-xl font-bold">Transfer Bank</p>
        </div>

        <div class="order-email py-4">
            <p class="text-sm text-gray-600 mb-2">E-mail Pemesan</p>
            <p class="text-xl font-bold">{{ $user->email }}</p>
        </div>
    </div>

    <h4 class="text-gray-600 mt-8 mb-4 text-xl font-bold">Rincian Pesanan:</h4>
    <table class="table-fixed w-full">
        <thead>
            <tr>
                <th class="w-1/2 font-bold text-sm text-left uppercase border-b-2 border-t-2 py-2">Produk</th>
                <th class="w-1/2  font-bold text-sm text-left uppercase border-b-2 border-t-2 py-2">Total</th>
            </tr>
        </thead>
        <tbody>
            <td>
                @foreach($details as $detail)
                    <div class="product-list py-2 text-sm border-b-2">
                        {{ $detail->name }}
                        <span class="font-bold text-sm ml-2">x{{ $detail->quantity }}</span>
                    </div>
                @endforeach
                <div class="text-right py-2 border-b-2">
                    <span class="font-bold text-sm mr-8">Metode Pembayaran</span>
                </div>
                <div class="text-right py-2 border-b-2">
                    <span class="font-bold text-sm mr-8">Total</span>
                </div>
            </td>
            <td>
                @foreach($details as $detail)
                    <div class="product-list py-2 text-sm border-b-2">
                        {{ $this->format($detail->subtotal) }}
                    </div>
                @endforeach
                <div class="py-2 border-b-2">
                    <span class="font-bold text-sm mr-8">Bank Transfer</span>
                </div>
                <div class="py-2 py-2 border-b-2">
                    <span class="text-sm">{{ $this->format($invoice->total) }}</span>
                </div>
            </td>
        </tbody>
    </table>
{{--    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">--}}
{{--        <div class="product-list">--}}
{{--            <h4 class="font-bold text-sm uppercase border-t-2 py-2">Produk</h4>--}}
{{--            <div class="border-b-2">--}}
{{--                @foreach($details as $detail)--}}
{{--                    <p class="text-sm border-t-2 py-2">--}}
{{--                        {{ $detail->name }}--}}
{{--                        <span class="font-bold text-sm ml-2">x{{ $detail->quantity }}</span>--}}
{{--                    </p>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="product-pricing">--}}
{{--            <h4 class="font-bold text-sm uppercase border-t-2 border-b-2 py-2">Total</h4>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
