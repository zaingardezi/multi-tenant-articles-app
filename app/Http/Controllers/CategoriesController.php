<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CategoriesController extends Controller
{
public function view()
{
    $categories=Category::all();
    return view('articles.categories',compact('categories'));
}

public function viewcategory(Category $category)
{
return view('articles.categoriesview',compact('category'));
}

public function editcategory(Category $category)
{
return view('articles.editcategory',compact('category'));
}

public function updatecategory(Request $request ,Category $category)
{
    $data=[
        'name'=>$request->name,
        'slug'=>Str::slug($request->name)
    ];
$category->update($data);
return redirect()->route('categories.home');
}

public function deletecategory(Category $category)
{
    $category->delete();
    return redirect()->route('categories.home');
}

public function createcategory()
{
return view('articles.addcategory');
}

public function addcategory(Request $request)
{
  $data = [
        'name' => $request->name,
        'slug' => Str::slug($request->name),
    ];

    Category::create($data);

    return redirect()->route('categories.home');
}

}
