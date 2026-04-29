<x-app-layout>
    <div class="p-1">

        <h1 class="font-bold text-3xl mb-4">Categories</h1>
            <a href="{{ route('categories.create') }}"
           style="background:green;color:white;padding:10px;border-radius:5px;display:inline-block;margin-bottom:15px;">
            Add Category
        </a>
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table border="5" width="100%" cellpadding="10" style="background:white;border-collapse:collapse;">

                <thead class=" bg-info">
                    <tr>
                        <th class="p-3 text-center">ID</th>
                        <th class="p-3 text-center">Name</th>
                        <th class="p-3 text-center">Slug</th>
                        <th class="p-3">Actions</th>
                        <th class="p-3 text-center">Created_at</th>
                        <th class="p-3 text-center">Updated_at</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $category)
                    <tr class="border-t hover:bg-gray-50">

                        <td class="p-3 text-center">{{ $category->id }}</td>
                        <td class="p-3 text-center font-medium">{{ $category->name }}</td>
                        <td class="p-3 text-center">{{ $category->slug }}</td>
                        

                        <td class="p-3">
                            <div class="flex justify-center gap-2">

                                <!-- View -->
                               <button 
    onclick="window.location='{{ route('categories.viewcategory',$category) }}'"
    class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">
    View
</button>

<!-- Edit -->

<button 
    onclick="window.location='{{ route('categories.edit',$category) }}'"
    class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">
    Edit
</button>


<!-- Delete -->



    <button
    type="button"
    onclick="openDeleteModal('{{ route('categories.delete', $category) }}')"
    class=" bg-gray-500 hover:bg-red-600 text-white px-3 py-1 rounded">
    Delete
</button>



                            </div>
                        </td>
                        <td class=" text-center">{{ $category->created_at }}</td>
                        <td class=" text-center">{{ $category->updated_at }}</td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
 <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    
    <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center">

        <h2 class="text-lg font-bold mb-4">Confirm Deletion</h2>
        <p class="mb-6 text-gray-600">Are you sure you want to delete this article?</p>

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