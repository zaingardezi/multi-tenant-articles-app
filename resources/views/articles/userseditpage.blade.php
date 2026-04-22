<x-app-layout>
    <div class="p-6">

        <h1 class="text-xl font-bold mb-4">Edit User</h1>

        <div class="bg-white shadow rounded-lg p-4">
            <form action="{{ route('users.update',$user) }}" method="post">
            @csrf
            @method('put')
                
            <div style="display: flex; flex-direction: row;">
            <div>
            <label for="id">ID:</label>
            <input type="text" disabled name="id" id="id" value="{{ $user->id }}">
            </div>
            <div class="ml-4">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}">
            </div>
            <div class="ml-4">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}">
            </div>
            <div class="ml-4">
            <label for="phone">Phone:</label>
            <input type="number" name="phone" id="phone" value="{{ $user->phone }}">
            </div>
            <div class="ml-4">
            <label for="age">Age:</label>
            <input type="number" name="age" id="age" value="{{ $user->age }}">
            </div>
            <div class="ml-2 mt-4">
                
                

                <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">
                  Update User
                </button>
                
                  
                
               
            </div>
          
        </div>
</form>
    </div>
</x-app-layout>