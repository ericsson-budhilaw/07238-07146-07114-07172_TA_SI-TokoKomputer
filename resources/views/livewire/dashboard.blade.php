<div>
    <div class="tab-head grid {{ $column }} gap-3 text-center mt-4">
        @if($isAdmin)
            <div class="tab-pane py-2 px-4 border-2 border-b-0 border-gray-200 cursor-pointer
                 {{ ($active == 'product') ? 'bg-gray-300 text-gray-800' : 'bg-gray-400 text-gray-600' }}"
                 id="products"
                 wire:click="tab('product')">
                <h3>Product List</h3>
            </div>
            <div class="tab-pane py-2 px-4 border-2 border-b-0 border-gray-200 cursor-pointer
                 {{ ($active == 'userlist') ? 'bg-gray-300 text-gray-800' : 'bg-gray-400 text-gray-600' }}"
                 id="products"
                 wire:click="tab('userlist')">
                <h3>User List</h3>
            </div>
            <div class="tab-pane py-2 px-4 border-2 border-b-0 border-gray-200 cursor-pointer
                 {{ ($active == 'orderlist') ? 'bg-gray-300 text-gray-800' : 'bg-gray-400 text-gray-600' }}"
                 id="products"
                 wire:click="tab('orderlist')">
                <h3>Order List</h3>
            </div>
        @endif

        @if(!$isAdmin)
            <div class="tab-pane py-2 px-4 border-2 border-b-0 border-gray-200 cursor-pointer
             {{ ($active == 'history') ? 'bg-gray-300 text-gray-800' : 'bg-gray-400 text-gray-600' }}"
                 id="profile"
                 wire:click="tab('history')">
                <h3>Order History</h3>
            </div>
        @endif

        <div class="tab-pane py-2 px-4 border-2 border-b-0 border-gray-200 cursor-pointer
             {{ ($active == 'profile') ? 'bg-gray-300 text-gray-800' : 'bg-gray-400 text-gray-600' }}"
             id="profile"
             wire:click="tab('profile')">
            <h3>Profil</h3>
        </div>
        <div class="tab-pane py-2 px-4 border-2 border-b-0 border-gray-200 cursor-pointer
             {{ ($active == 'changePass') ? 'bg-gray-300 text-gray-800' : 'bg-gray-400 text-gray-600' }}"
             id="password"
             wire:click="tab('changePass')">
            <h3>Password</h3>
        </div>
        <div class="tab-pane py-2 px-4 border-2 border-b-0 border-gray-200 cursor-pointer
             {{ ($active == 'address') ? 'bg-gray-300 text-gray-800' : 'bg-gray-400 text-gray-600' }}"
             id="password"
             wire:click="tab('address')">
            <h3>Alamat</h3>
        </div>
    </div>

    <div class="tab-content bg-gray-200 p-4">

        @if($active == 'product')
            <livewire:dashboard.product-list />
        @elseif($active == 'userlist')
            <livewire:dashboard.user-list />
        @elseif($active == 'orderlist')
            <livewire:dashboard.order-list />
        @elseif($active == 'history')
            <livewire:dashboard.history />
        @elseif($active == 'profile')
            <livewire:dashboard.profile />
        @elseif($active == 'changePass')
            <livewire:dashboard.password />
        @elseif($active == 'address')
            <livewire:dashboard.address />
        @endif

    </div>
</div>
