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
@endcan()
@can('delete users')
<!-- Delete -->
<form action="{{ route('users.delete',$user) }}" method="POST">
    @csrf
    @method('DELETE')

    <button 
        type="submit"
        class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">
        Delete
    </button>
</form>
@endcan

                            </div>
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</x-app-layout>