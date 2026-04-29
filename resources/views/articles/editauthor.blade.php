<x-app-layout>
    <div class="p-6">

        <h1 class="text-xl font-bold mb-4">Edit Author</h1>

        <div class="bg-white shadow rounded-lg p-2">
            <form action="{{ route('authors.update',$author) }}" method="post">
            @csrf
            @method('put')
                
            <div style="display: flex; flex-direction: row; justify-content: space-between;">
                <div style="display: flex; flex-direction:row; justify-content: start ;">
            <div>
            <label for="id">ID:</label>
            <input type="text" disabled name="id" id="id" value="{{ $author->id }}">
            </div>
            <div class="ml-4">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $author->name }}">
            </div>
           <div class="ml-4">
            <label for="slug">Slug:</label>
            <input type="text" disabled name="slug" id="slug" value="{{ $author->slug }}">
            </div>
</div>


    
            <div class="ml-2 mt-1">
                
                

                <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded">
                  Update Author
                </button>
                
                  
                
               
            </div>
          
        </div>
</form>
    </div>
</x-app-layout>