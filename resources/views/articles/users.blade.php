<x-app-layout>
    <div class="p-1">

        <h1 class="font-bold text-3xl mb-4">Users</h1>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table border="5" width="100%" cellpadding="10" style="background:white;border-collapse:collapse;">

                <thead class=" bg-info">
                    <tr>
                        <th class="p-3 text-center">ID</th>
                        <th class="p-3 text-center">Name</th>
                        <th class="p-3 text-center">Email</th>
                        <th class="p-3 text-center">Phone</th>
                        <th class="p-3 text-center">Age</th>
                        <th class="p-3 text-center">Role</th>
                        <th class="p-3 text-center">Actions</th>
                        <th class="p-3 text-center">Created_at</th>
                        <th class="p-3 text-center">Updated_at</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                    <tr class="border-t hover:bg-gray-50">

                        <td class="p-3 text-center">{{ $user->id }}</td>
                        <td class="p-3 text-center font-medium">{{ $user->name }}</td>
                        <td class="p-3 text-center">{{ $user->email }}</td>
                        <td class="p-3 text-center">{{ $user->phone }}</td>
                        <td class="p-3 text-center">{{ $user->age }}</td>
                        <td class="p-3 text-center"> {{ ucfirst($user->roles->first()?->name ?? 'No Role') }}</td>


                        <td class="p-3">
                            <div class="flex justify-center gap-2">

                                <!-- View -->
                               <button 
    onclick="window.location='{{ route('users.view',$user) }}'"
    class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">
    View
</button>

<!-- Edit -->
@can('edit users')
<button 
    onclick="window.location='{{ route('users.edit',$user) }}'"
    class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">
    Edit
</button>
@endcan
@can('delete users')
<!-- Delete -->

<button
    type="button"
    onclick="openDeleteModal('{{ route('users.delete', $user) }}')"
    class=" bg-gray-500 hover:bg-red-600 text-white px-3 py-1 rounded">
    Delete
</button>
@endcan

                            </div>
                        </td>
                        <td class=" text-center">{{ $user->created_at }}</td>
                        <td class=" text-center">{{ $user->updated_at }}</td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    
    <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center">

        <h2 class="text-lg font-bold mb-4">Confirm Deletion</h2>
        <p class="mb-6 text-gray-600">Are you sure you want to delete this User?</p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('delete')

            <div class="flex justify-center gap-4">

                <button type="button"
                        onclick="closeDeleteModal()"
                        class="bg-gray-400 hover: bg-gray-500 text-white px-4 py-2 rounded">
                    Cancel
                </button>

                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                    Yes, Delete
                </button>

            </div>

        </form>

    </div>
</div>
</x-app-layout>



<script>
    function openDeleteModal(actionUrl) {
        document.getElementById('deleteForm').action = actionUrl;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>