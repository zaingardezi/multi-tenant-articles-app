<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class AuthorsController extends Controller
{
public function view()
{
    $authors=Author::all();
    return view('articles.authors',compact('authors'));
}

public function viewauthor(Author $author)
{
return view('articles.authorsview',compact('author'));
}

public function editauthor(Author $author)
{
return view('articles.editauthor',compact('author'));
}

public function updateauthor(Request $request ,Author $author)
{
    $data=[
        'name'=> $request->name,
        'slug'=> Str::slug($request->name)
    ];

$author->update($data);
return redirect()->route('authors.home');
}

public function deleteauthor(Author $author)
{
    $author->delete();
    return redirect()->route('authors.home');
}

public function createauthor()
{
return view('articles.addauthor');
}

public function addauthor(Request $request)
{
  $data = [
        'name' => $request->name,
        'slug' => Str::slug($request->name),
    ];

    Author::create($data);

    return redirect()->route('authors.home');
}

}
