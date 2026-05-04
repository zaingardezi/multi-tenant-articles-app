<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Article;
class StoreArticleRequest extends FormRequest
{

   public function authorize()
{
    return auth()->check() && auth()->user()->can('create', Article::class);
}

public function rules()
{
    return [
        'Title' => 'required|string|max:255',
        'ShowDescription' => 'required|string|max:255',
        'Text' => 'required|string',
        'Image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'author_ids' => 'required|array|min:1',
        'author_ids.*' => 'exists:authors,id',
        'tag_ids' => 'required|array|min:1',
        'tag_ids.*' => 'exists:tags,id',
        'category_ids' => 'required|array|min:1',
        'category_ids.*' => 'exists:categories,id',
    ];
}
}
