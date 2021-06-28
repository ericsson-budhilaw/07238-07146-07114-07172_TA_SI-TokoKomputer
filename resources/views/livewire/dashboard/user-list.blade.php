<div>
    {{-- User List --}}
    <div class="tab-pane divide-y-2 divide-gray-400" id="users" wire:key="userlist-pane">
        <h1 class="font-bold text-2xl text-gray-600">
            <i class="fas fa-users"></i>
            Daftar Pengguna
        </h1>
        <hr />

        <div class="table-data flex justify-center items-center">
            <table class="table-auto my-4 text-center">
            <thead>
                <tr>
                    <th class="border-2 border-gray-500 px-4 py-2">Name</th>
                    <th class="border-2 border-gray-500 px-4 py-2">E-mail</th>
                    <th class="border-2 border-gray-500 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="{{ ($num % 2) ? 'bg-gray-300' : '' }}">
                        <td class="border-2 border-gray-500 px-4 py-2">{{ $user->name }}</td>
                        <td class="border-2 border-gray-500 px-4 py-2">{{ $user->email }}</td>
                        <td class="border-2 border-gray-500 px-4 py-2">
                            <button class="bg-yellow-500 text-gray-100 px-4 py-2"
                                    wire:click="edit({{ $user->id }})">Edit</button>
                            <button class="bg-red-500 text-gray-100 px-4 py-2">Delete</button>
                        </td>
                        @php($num++)
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        {{ $users->links() }}
    </div>
</div>
