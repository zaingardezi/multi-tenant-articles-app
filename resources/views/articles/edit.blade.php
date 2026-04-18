@extends('layouts.app')

@section('content')

<style>
    html, body {
        margin: 0;
        overflow-x: hidden;
    }

    h1 {
        text-align: center;
    }

    .edit-wrapper {
        max-width: 600px;
        margin: 10px auto;
        padding: 10px;
    }

    .edit-box {
        padding: 20px;
        border-radius: 10px;
    }

    input, textarea {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    textarea {
        height: 200px;
        resize: none;
    }

    img {
        width: 250px;
        height: auto;
        object-fit: cover;
        display: block;
        margin: 10px auto;
        border-radius: 10px;
    }

    .btnupdate {
        display: block;
        width: 200px;
        margin: 20px auto;
        padding: 10px;
        text-align: center;
        background: #f03737;
        color: white;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }

    .btnupdate:hover {
        background: #8b0b12;
    }

    .btnaddpic {
        width: 100%;
        padding: 10px;
        background: #a7a7a7;
        color: white;
        border-radius: 5px;
    }
</style>

<div class="edit-wrapper">

    <h1>Edit Article</h1>

    <div class="edit-box">

        <form action="{{ route('articles.update',$article)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label>Title:</label>
                <input type="text" name="Title" value="{{ $article->Title }}">
            </div>

            <div>
                <label>Text:</label>
                <textarea name="Text">{{ $article->Text }}</textarea>
            </div>

            <div>
                <input type="file" name="Image" class="btnaddpic">
            </div>

            <img src="{{ asset('storage/' . $article->Image) }}">

            <button type="submit" class="btnupdate">Update Article</button>

        </form>

    </div>

</div>

@endsection