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

    <h2>Create User</h2>

    <form action="{{ route('users.add') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="name" placeholder="Enter Name" value="{{ old('name') }}">
        @error('name')
            <div style="color:red">{{ $message }}</div>
        @enderror
         
        <input type="email" name="email" placeholder="Enter Email: " value="{{ old('email') }}">
        @error('email')
            <div style="color:red">{{ $message }}</div>
        @enderror
         
        <input type="number" name="phone" placeholder="Enter Phone:" value="{{ old('phone') }}">
        @error('phone')
            <div style="color:red">{{ $message }}</div>
        @enderror
         
        <input type="text" name="gender" placeholder="Enter Gender: " value="{{ old('gender') }}">
        @error('gender')
            <div style="color:red">{{ $message }}</div>
        @enderror
        
        <input type="number" name="age" placeholder="Enter Age:" value="{{ old('age') }}">
        @error('age')
            <div style="color:red">{{ $message }}</div>
        @enderror
        

       
        <button type="submit" style="background:orange; color:white; padding: 10px; border: radius 5%;">Add User</button>


    </form>
       <button onClick="window.location='{{route('users.homepage')}}'" type="submit" style="background:gold; margin-top:10px ;color:white; padding: 10px; border: radius 5%;">Back to Users Homepage</button>

</div>

@endsection