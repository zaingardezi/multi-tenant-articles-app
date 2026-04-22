<x-app-layout>
    <div class="p-6">

        <h1 class="text-xl font-bold mb-4">User Details</h1>
        <div class="col-md-12" style=" display: flex; flex-direction: row;">
            <div class="col-md-4">

            </div>
        <div class="bg-white shadow rounded-lg col-md-8 p-5">
            <p><strong>ID:</strong>{{ $user->id }}</p>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Phone:</strong> {{ $user->phone }}</p>
            <p><strong>Age:</strong> {{ $user->age }}</p>
            <button class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded mt-2" onclick="window.location='{{ route('users.homepage') }}'">Back to Users</button>
        </div>
         </div>
         </div>
    
</x-app-layout>