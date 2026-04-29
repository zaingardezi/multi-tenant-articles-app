<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    body {
        background: #f8fafc;
        font-family: Arial, sans-serif;
    }

    .article-container {
        max-width: 900px;
        margin: 40px auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .article-title {
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 25px;
        color: #1f2937;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #374151;
    }

    input[type="text"],
    textarea,
    select {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        font-size: 15px;
        transition: 0.3s;
        box-sizing: border-box;
    }

    input[type="text"]:focus,
    textarea:focus,
    select:focus {
        border-color: #2563eb;
        outline: none;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }

    textarea {
        min-height: 140px;
        resize: vertical;
    }

    input[type="file"] {
        border: none;
        padding: 0;
    }

    .error-text {
        color: #dc2626;
        font-size: 14px;
        margin-top: 6px;
    }

    .pill-group {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 10px;
    }

    .pill-item {
        background: #f3f4f6;
        border-radius: 999px;
        padding: 8px 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: 0.2s;
    }

    .pill-item:hover {
        background: #e5e7eb;
    }

    .pill-item input {
        margin: 0;
        width: auto;
    }

    .submit-btn {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(37, 99, 235, 0.25);
    }

    .select2-container--default .select2-selection--multiple {
        border: 1px solid #d1d5db !important;
        border-radius: 10px !important;
        padding: 6px !important;
        min-height: 48px;
    }
</style>

<div class="article-container">

    <h2 class="article-title">Create Article</h2>

    <form action="{{ route('articles.add') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Title</label>
            <input type="text" name="Title" placeholder="Enter Title" value="{{ old('Title') }}">
            @error('Title') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Description</label>
            <input type="text" name="ShowDescription" placeholder="Enter Description" value="{{ old('ShowDescription') }}">
            @error('ShowDescription') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Article Content</label>
            <textarea name="Text" placeholder="Write your article...">{{ old('Text') }}</textarea>
            @error('Text') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Upload Image</label>
            <input type="file" name="Image">
            @error('Image') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Authors</label>
            <select name="author_ids[]" multiple class="select2">
                @foreach($authors as $author)
                    <option value="{{ $author->id }}"
                        {{ in_array($author->id, old('author_ids', [])) ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
            @error('author_ids') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Tags</label>
            <div class="pill-group">
                @foreach($tags as $tag)
                    <label class="pill-item">
                        <input type="checkbox" name="tag_ids[]" value="{{ $tag->id }}"
                            {{ in_array($tag->id, old('tag_ids', [])) ? 'checked' : '' }}>
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
            @error('tag_ids') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Categories</label>
            <div class="pill-group">
                @foreach($categories as $category)
                    <label class="pill-item">
                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}"
                            {{ in_array($category->id, old('category_ids', [])) ? 'checked' : '' }}>
                        {{ $category->name }}
                    </label>
                @endforeach
            </div>
            @error('category_ids') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="submit-btn">Publish Article</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select Authors",
            allowClear: true,
            width: '100%'
        });
    });
</script>