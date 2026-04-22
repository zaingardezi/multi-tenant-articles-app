<x-app-layout>
    <div class="p-6">

        <h1 class="text-xl font-bold mb-4">Article Details</h1>
 
        <div class="bg-white shadow rounded-lg col-md-8 p-5">
   <form action="{{ route('articles.update',$article)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mt-4" style="display: flex; flex-direction: row; justify-content: center; align-items: center; text-align: center;">
                <label>Title:</label>
                <input type="text" name="Title" value="{{ $article->Title }}">
            </div>
           <div class="mt-4" style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                <label>ShowDescription:</label>
                <textarea name="ShowDescription" style="height:60px; resize:none;">{{ $article->ShowDescription }}</textarea>
            </div>
            <div class="mt-4" style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                <label>Text:</label>
                <textarea name="Text">{{ $article->Text }}</textarea>
            </div>

            <div class="mt-4" style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                <input type="file" name="Image" class="btnaddpic">
            </div>
             <div class="mt-4" style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                                @if(Str::startsWith($article->Image, 'http'))
    <img src="{{ $article->Image }}" width="300">
@else
    <img src="{{ asset('storage/' . $article->Image) }}" width="300">
@endif
            </div>
            <div class="mt-4" style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
            <button type="submit" class="btnupdate" style="background:orange; color:white; border-radius: 5%; padding:10px;">Update Article</button>
</div>
        </form>
      </div>
        
    
</x-app-layout>