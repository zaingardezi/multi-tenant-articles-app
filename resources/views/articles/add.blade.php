@extends('layouts.app')

@section('content')

<style>
    h2 {
        text-align: center;
    }

    input, textarea {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box; /* IMPORTANT FIX */
    }

    textarea {
        height: 120px;
        resize: none;
    }

    button {
        width: 100%;
        padding: 10px;
        background: #3490dc;
        color: white;
        border: none;
        border-radius: 5px;
    }

    button:hover {
        background: #2779bd;
    }
</style>

<div style="max-width: 600px; margin: 40px auto; padding: 20px;">

    <h2>Create Article</h2>

    <form action="{{ route('articles.add') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="Title" placeholder="Enter Title" value="{{ old('Title') }}">
        @error('Title')
            <div style="color:red">{{ $message }}</div>
        @enderror

        <textarea name="Text" placeholder="Write your article...">{{ old('Text') }}</textarea>
        @error('Text')
            <div style="color:red">{{ $message }}</div>
        @enderror

        <input type="file" name="Image">
        @error('Image')
            <div style="color:red">{{ $message }}</div>
        @enderror

        <button type="submit">Publish Article</button>

    </form>

</div>

@endsection