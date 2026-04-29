<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Str;
class TagsController extends Controller
{
public function view()
{
    $tags=Tag::all();
    return view('articles.tags',compact('tags'));
}

public function viewtag(Tag $tag)
{
return view('articles.tagsview',compact('tag'));
}

public function edittag(Tag $tag)
{
return view('articles.edittag',compact('tag'));
}

public function updatetag(Request $request ,Tag $tag)
{
 $data = [
        'name' => $request->name,
        'slug' => Str::slug($request->name),
    ];


$tag->update($data);
return redirect()->route('tags.home');




}

public function deletetag(Tag $tag)
{
    $tag->delete();
    return redirect()->route('tags.home');
}

public function createtag()
{
return view('articles.addtag');
}

public function addtag(Request $request)
{
 $data = [
        'name' => $request->name,
        'slug' => Str::slug($request->name),
    ];

    Tag::create($data);

    return redirect()->route('tags.home');

}

}
