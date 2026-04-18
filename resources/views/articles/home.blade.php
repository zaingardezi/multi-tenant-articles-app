@extends('layouts.app')

@section('content')


        <h1>Articles</h1>

        <button onclick="window.location='{{ route('articles.create') }}'" class="btn-edit" style="margin-bottom: 10px;">Add Article</button>

    
     <table border="1" width="100%" cellpadding="10">
        <tr>        
            <th>ID</th>
            <th>Title</th>
            <th>Text</th>
            <th>Image</th>
            <th>Actions</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            
        </tr>
         @foreach($articles as $article)
        <tr>
            <td>{{$article->id}}</td>
           <td>{{$article->Title}}</td>
           <td>{{ $article->Text}}</td>
           <td>
            <img src="{{ asset('storage/' . $article->Image) }}" width="80">
           </td>
       <td>
    <div style="display: flex; gap: 10px; align-items: center;">
        
        <button onclick="window.location='{{ route('articles.edit', $article) }}'" class="btn-edit">Edit</button>

        <form action="{{ route('articles.delete', $article) }}" method="post" style="margin: 0;">
            @csrf
            @method('delete')    
            <button type="submit" class="btn-delete">Delete</button>
        </form>

    </div>
</td>
           <td>{{ $article->created_at }}</td>
           <td>{{ $article->updated_at }}</td>

        </tr>
         @endforeach

     </table>

@endsection





   

</body>
</html>
