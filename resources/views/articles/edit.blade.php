<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<x-app-layout>
<div class="p-6 flex justify-center">

    <div style="width: 800px; background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">

        <h1 style="text-align:center; font-size:22px; font-weight:bold; margin-bottom:20px;">
            Edit Article
        </h1>

        <form action="{{ route('articles.update',$article)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- TITLE -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:bold;">Title</label>
                <input type="text" name="Title"
                    value="{{ $article->Title }}"
                    style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
            </div>

            <!-- DESCRIPTION -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:bold;">Show Description</label>
                <textarea name="ShowDescription"
                    style="width:100%; height:70px; padding:10px; border:1px solid #ccc; border-radius:6px;">{{ $article->ShowDescription }}</textarea>
            </div>

            <!-- TEXT -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:bold;">Text</label>
                <textarea name="Text"
                    style="width:100%; height:120px; padding:10px; border:1px solid #ccc; border-radius:6px;">{{ $article->Text }}</textarea>
            </div>

            <!-- IMAGE -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:bold;">Image</label>
                <input type="file" name="Image">

                <div style="margin-top:10px;">
                    @if(Str::startsWith($article->Image, 'http'))
    <img src="{{ $article->Image }}" width="300">
@else
    <img src="{{ tenant_asset($article->Image) }}" width="300">
@endif
                </div>
            </div>

            <!-- AUTHORS -->
            <div style="margin-bottom:20px;">
                <label style="font-weight:bold;">Authors</label>

                <select name="author_ids[]" multiple class="select2" style="width:100%;">
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}"
                            {{ $article->authors->contains($author->id) ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- TAGS -->
            <div style="margin-bottom:20px;">
                <label style="font-weight:bold;">Tags</label>

                <div style="display:flex; flex-wrap:wrap; gap:10px; margin-top:10px;">
                    @foreach($tags as $tag)
                        <label style="display:flex; align-items:center; gap:5px; background:#f5f5f5; padding:5px 10px; border-radius:6px;">
                            <input type="checkbox" name="tag_ids[]" value="{{ $tag->id }}"
                                {{ $article->tags->contains($tag->id) ? 'checked' : '' }}>
                            {{ $tag->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- CATEGORIES -->
            <div style="margin-bottom:20px;">
                <label style="font-weight:bold;">Categories</label>

                <div style="display:flex; flex-wrap:wrap; gap:10px; margin-top:10px;">
                    @foreach($categories as $category)
                        <label style="display:flex; align-items:center; gap:5px; background:#f5f5f5; padding:5px 10px; border-radius:6px;">
                            <input type="checkbox" name="category_ids[]" value="{{ $category->id }}"
                                {{ $article->categories->contains($category->id) ? 'checked' : '' }}>
                            {{ $category->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- BUTTON -->
            <div style="text-align:center; margin-top:20px;">
                <button type="submit"
                    style="background:orange; color:white; padding:10px 20px; border:none; border-radius:6px;">
                    Update Article
                </button>
            </div>

        </form>

    </div>

</div>
</x-app-layout>

<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Select Authors",
        width: '100%'
    });
});
</script>