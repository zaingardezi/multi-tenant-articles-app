<x-app-layout>
    <div style="padding:5px;">
        <h1 class="font-bold text-3xl mb-4">Articles</h1>
        @can('create articles')
        <a href="{{ route('articles.create') }}"
           style="background:green;color:white;padding:10px;border-radius:5px;display:inline-block;margin-bottom:15px;">
            Add Article
        </a>
        @endcan
 <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table border="5" width="100%" cellpadding="10" style="background:white;border-collapse:collapse;">
            <thead class="bg-gray-200">
    <tr class="border-b-4 border-black">
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
            <th>Actions</th>
                <th>Created_at</th>
                <th>Updated_at</th>
    </tr>
</thead>
        
            

            
            @foreach($articles as $article)
            <tr>
                <td class="text-center">{{ $article->id }}</td>
                <td class="text-center">{{ $article->Title }}</td>
                <td class="text-center">{{ $article->ShowDescription }}</td>
                <td>
                    @if(Str::startsWith($article->Image, 'http'))
    <img src="{{ $article->Image }}" width="300">
@else
    <img src="{{ tenant_asset($article->Image) }}" width="300">
@endif
                </td>
            <td>
                <div style="display: flex; flex-direction: row;">
                @can('view articles')   
                <button onclick="window.location='{{ route('articles.view',$article) }}'" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">View</button>
                @endcan    
                @can('edit articles')
                <button onclick="window.location='{{ route('articles.edit',$article) }}'" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">Edit</button>
                @endcan    
                @can('delete articles')
                 <button
    type="button"
    onclick="openDeleteModal('{{ route('articles.delete', $article) }}')"
    class=" bg-gray-500 hover:bg-red-600 text-white px-3 py-1 rounded">
    Delete
</button>
                    @endcan
                </div>
            </td>
            <td>{{ $article->created_at }}</td>
            <td>{{ $article->updated_at }}</td>

            </tr>
            @endforeach
        </table>
    </div>
    </div>
    <!-- Delete Modal -->
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