<x-app-layout>
    <div class="p-6">

        <h1 class="text-xl font-bold mb-4">Article Details</h1>
        <div class="col-md-12" style=" display: flex; flex-direction: row;">
            <div class="col-md-4">

            </div>
        <div class="bg-white shadow rounded-lg col-md-8 p-5">
            <p><strong>ID:</strong>{{ $article->id }}</p>
            <p><strong>Title:</strong> {{ $article->Title }}</p>
            <p><strong>Short Description:</strong> {{ $article->ShowDescription }}</p>
            <p><strong>Text:</strong> {{ $article->Text }}</p>
            <p><strong>Author:</strong>{{ $article->authors->pluck('name')->implode(', ')}}</p>
            <p><strong>Tag:</strong>{{ $article->tags->pluck('name')->implode(', ') }}</p>
            <p><strong>Category:</strong>{{ $article->categories->pluck('name')->implode(', ') }}</p>

            <p><Strong>Image:</Strong>
                                @if(Str::startsWith($article->Image, 'http'))
    <img src="{{ $article->Image }}" width="300">
@else
    <img src="{{ tenant_asset($article->Image) }}" width="300">
@endif
</p>
            <button class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded mt-2" onclick="window.location='{{ route('articles.home') }}'">Back to Articles</button>
        </div>
         </div>
         </div>
    
</x-app-layout>