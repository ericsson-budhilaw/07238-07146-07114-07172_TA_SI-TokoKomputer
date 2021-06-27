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
        @elseif($active == 'profile')
            {{-- Profile --}}
            <div class="tab-pane" id="profile" wire:key="profile-pane">
                <h1>Profil</h1>
            </div>
        @elseif($active == 'changePass')
            {{-- Change Password --}}
            <div class="tab-pane" id="password" wire:key="password-pane">
                <h1>Password</h1>
            </div>
        @elseif($active == 'address')
            {{-- Address List --}}
            <div class="tab-pane" id="password" wire:key="address-pane">
                <h1>Alamat</h1>
            </div>
        @endif

    </div>
</div>
