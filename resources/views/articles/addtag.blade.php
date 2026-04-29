<x-app-layout>

<style>
    .tag-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 75vh;
        background: #f8fafc;
        padding: 20px;
    }

    .tag-card {
        width: 100%;
        max-width: 500px;
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
        padding: 35px;
    }

    .tag-title {
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #374151;
    }

    .form-group input {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #d1d5db;
        border-radius: 12px;
        font-size: 15px;
        transition: 0.3s;
        box-sizing: border-box;
    }

    .form-group input:focus {
        border-color: #7c3aed;
        outline: none;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.15);
    }

    .error-text {
        color: #dc2626;
        font-size: 14px;
        margin-top: 6px;
    }

    .submit-btn {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
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
        box-shadow: 0 10px 20px rgba(124, 58, 237, 0.25);
    }
</style>

<div class="tag-wrapper">
    <div class="tag-card">

        <h2 class="tag-title">Create Tag</h2>

        <form action="{{ route('tags.add') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Tag Name</label>
                <input type="text" name="name" placeholder="Enter tag name" value="{{ old('name') }}">
                @error('name')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="submit-btn">Add Tag</button>
        </form>

    </div>
</div>

</x-app-layout>