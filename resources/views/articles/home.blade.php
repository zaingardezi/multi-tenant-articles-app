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
    <img src="{{ asset('storage/' . $article->Image) }}" width="300">
@endif
                </td>
            <td>
                <div style="display: flex; flex-direction: row;">
                @can('view articles')   
                <button onclick="window.location='{{ route('articles.view',$article) }}'" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">View</button>
                @endcan    
                @can('edit articles')
                <button onclick="window.location='{{ route('articles.edit',$article) }}'" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">Edit</buttvon>
                @endcan    
                @can('delete articles')
                    <form action="{{ route('articles.delete',$article) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded" type="submit">Delete</button>
                    </form>
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
</x-app-layout>