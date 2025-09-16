@extends('admin.adminLayout.master')

@section('meta')
<title>{{ isset($title) ? $title : 'Update Colors' }} - {{ @siteInfo()->company_name }}</title>
@endsection

@section('style')
<style>
    .color-form {
        max-width: 1300px;
        margin: 0 auto;
        background-color: #f8f9fa;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .color-form h2 {
        font-size: 24px;
        margin-bottom: 20px;
        text-align: left;
    }

    .color-form .form-group {
        margin-bottom: 20px;
    }

    .color-form label {
        font-weight: bold;
    }

    .color-preview {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid #ddd;
        margin-right: 10px;
        margin-left: 10px;
        display: inline-block;
    }

    .color-form input[type="color"] {
        width: 100%;
        height: 40px;
        padding: 0;
        border: none;
        border-radius: 5px;
    }

    .color-form input[type="text"] {
        width: 100%;
        padding: 5px;
        border-radius: 5px;
        border: 1px solid #ddd;
        font-size: 16px;
    }

    .color-form button {
        width: 10%;
        padding: 1px;
        font-size: 16px;
        background-color: #1a3637;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .color-form button:hover {
        background-color: #0056b3;
    }

    .alert {
        margin-bottom: 20px;
    }

    .form-group {
        display: flex;
        align-items: center;
    }
</style>
@endsection

@section('main')
<div class="color-form">
    <h2>Update Site Colors</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.colors.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Body Color Section -->
        <div class="form-group">
            <label for="body_color">Body Color:</label>
            <div style="display: flex; align-items: center;">
                <div class="color-preview" style="background-color: {{ $colors->body_color }};"></div>
                <input type="text" name="body_color" value="{{ old('body_color', $colors->body_color) }}" placeholder="Enter color code (e.g., #ffffff)">
            </div>
        </div>

        <!-- Header Color Section -->
        <div class="form-group">
            <label for="header_color">Header Color:</label>
            <div style="display: flex; align-items: center;">
                <div class="color-preview" style="background-color: {{ $colors->header_color }};"></div>
                <input type="text" name="header_color" value="{{ old('header_color', $colors->header_color) }}" placeholder="Enter color code (e.g., #ff3130)">
            </div>
        </div>

        <!-- Footer Color Section -->
        <div class="form-group">
            <label for="footer_color">Footer Color:</label>
            <div style="display: flex; align-items: center;">
                <div class="color-preview" style="background-color: {{ $colors->footer_color }};"></div>
                <input type="text" name="footer_color" value="{{ old('footer_color', $colors->footer_color) }}" placeholder="Enter color code (e.g., #333333)">
            </div>
        </div>

        <!-- Headings Color Section -->
        <div class="form-group">
            <label for="headings_color">Headings Color:</label>
            <div style="display: flex; align-items: center;">
                <div class="color-preview" style="background-color: {{ $colors->headings_color }};"></div>
                <input type="text" name="headings_color" value="{{ old('headings_color', $colors->headings_color) }}" placeholder="Enter color code (e.g., #000000)">
            </div>
        </div>

        <div class="form-group">
            <label for="label_color">Labels Color:</label>
            <div style="display: flex; align-items: center;">
                <div class="color-preview" style="background-color: {{ $colors->label_color }};"></div>
                <input type="text" name="label_color" value="{{ old('label_color', $colors->label_color) }}" placeholder="Enter color code (e.g., #000000)">
            </div>
        </div>

        <div class="form-group">
            <label for="paragraph_color">Paragraph Color:</label>
            <div style="display: flex; align-items: center;">
                <div class="color-preview" style="background-color: {{ $colors->paragraph_color }};"></div>
                <input type="text" name="paragraph_color" value="{{ old('paragraph_color', $colors->paragraph_color) }}" placeholder="Enter color code (e.g., #000000)">
            </div>
        </div>

        <button type="submit">Save Colors</button>
    </form>
</div>
@endsection

@section('script')
<script>
</script>
@endsection