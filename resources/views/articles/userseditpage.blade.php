<x-app-layout>
    <div class="p-6">

        <h1 class="text-xl font-bold mb-4">Edit User</h1>

        <div class="bg-white shadow rounded-lg p-4">
            <form action="{{ route('users.update',$user) }}" method="post">
            @csrf
            @method('put')
                
            <div style="display: flex; flex-direction: row; flex-wrap: wrap; gap: 10px;">
            <div>
                <label for="id">ID:</label>
                <input type="text" disabled name="id" id="id" value="{{ $user->id }}">
            </div>

            <div class="ml-4">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}">
            </div>

            @can('edit users')
                <div class="ml-4">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}">
                </div>
            @else
                <div class="ml-4">
                    <label for="email">Email:</label>
                    <input type="email" disabled name="email" id="email" value="{{ $user->email }}">
                </div>
            @endcan

            <div class="ml-4">
                <label for="phone">Phone:</label>
                <input type="number" name="phone" id="phone" value="{{ $user->phone }}">
            </div>

            <div class="ml-4">
                <label for="age">Age:</label>
                <input type="number" name="age" id="age" value="{{ $user->age }}">
            </div>

            {{-- Role dropdown — only visible to superadmin --}}
            @role('superadmin')
            <div class="ml-4">
                <label for="role">Role:</label>
                <select name="role" id="role" style="padding:6px; border-radius:6px; border:1px solid #ccc;">
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}"
                            {{ $userRole === $role->name ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endrole

            <div class="ml-2 mt-4">
                <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">
                    Update User
                </button>
            </div>

            </div>
            </form>
        </div>
    </div>
</x-app-layout>