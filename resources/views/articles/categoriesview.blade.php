<x-app-layout>
    <div class="p-6">

        <h1 class="text-xl font-bold mb-4">Category Details</h1>
        <div class="col-md-12" style=" display: flex; flex-direction: row;">
            <div class="col-md-4">

            </div>
        <div class="bg-white shadow rounded-lg col-md-8 p-5">
            <p><strong>ID:</strong>{{ $category->id }}</p>
            <p><strong>Title:</strong> {{ $category->name}}</p>
            <p><strong>Slug:</strong> {{ $category->slug }}</p>
           
            <button class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded mt-2" onclick="window.location='{{ route('categories.home') }}'">Back to Categories</button>
        </div>
         </div>
         </div>
    
</x-app-layout>