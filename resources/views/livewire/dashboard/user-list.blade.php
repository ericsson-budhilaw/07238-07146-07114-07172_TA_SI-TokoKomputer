<div>
    {{-- User List --}}
    <div class="tab-pane divide-y-2 divide-gray-400" id="users" wire:key="userlist-pane">
        <h1 class="font-bold text-2xl text-gray-600">
            <i class="fas fa-users"></i>
            Daftar Pengguna
        </h1>
        <hr />

        <div class="table-data flex-col md:overflow-hidden overflow-auto">
            <table class="table-auto my-4 text-center">
                <thead>
                    <tr>
                        <th class="border-2 border-gray-500 px-4 py-2">No.</th>
                        <th class="border-2 border-gray-500 px-4 py-2">Name</th>
                        <th class="border-2 border-gray-500 px-4 py-2">E-mail</th>
                        <th class="border-2 border-gray-500 px-4 py-2">Status</th>
                        <th class="border-2 border-gray-500 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="{{ ($num % 2) ? 'bg-gray-300' : '' }}">
                            <td class="border-2 border-gray-500 px-4 py-2">{{ $num++ }}</td>
                            <td class="border-2 border-gray-500 px-4 py-2">{{ $user->name }}</td>
                            <td class="border-2 border-gray-500 px-4 py-2">{{ $user->email }}</td>
                            <td class="border-2 border-gray-500 px-4 py-2">
                                @if($user->isAdmin == 1)
                                    <span class="text-green-500 font-bold text-base">Admin</span>
                                @else
                                    <span class="text-gray-500 font-bold text-base">Customer</span>
                                @endif
                            </td>
                            <td class="border-2 border-gray-500 px-4 py-2">
                                <button class="bg-yellow-500 text-gray-100 px-4 py-2"
                                        wire:click="edit({{ $user->id }})">Edit</button>
                                @if($confirming == $user->id)
                                    <button class="bg-red-500 text-gray-100 px-4 py-2"
                                            wire:click="deleteProduct({{ $user->id }})">Sure ?</button>
                                @else
                                    <button class="bg-red-500 text-gray-100 px-4 py-2"
                                            wire:click="kill({{ $user->id }})">Delete</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="add-button my-4">
                <button type="submit"
                        class="bg-green-600 py-2 px-4 text-gray-100 hover:bg-green-900"
                        wire:click="addAdmin">Tambahkan</button>
            </div>
        </div>

        <div class="py-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
