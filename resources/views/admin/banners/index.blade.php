@extends('admin.adminLayout.master')

@section('meta')
<title>{{ isset($title)?$title:'Banners' }} - {{ env('APP_NAME') }}</title>
@endsection

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .modal-content {
        border-radius: 10px;
    }

    .btn-custom {
        background-color: #007bff;
        color: white;
    }

    .btn-custom:hover {
        background-color: #0056b3;
    }

    .table th, .table td {
        text-align: center;
    }

    .table img {
        border-radius: 5px;
    }

    .btn-action {
        border-radius: 5px;
        padding: 5px 10px;
    }

    .btn-edit {
        background-color: #ffc107;
        color: #fff;
    }

    .btn-delete {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-action:hover {
        opacity: 0.8;
    }
</style>
@endsection

@section('main')
<div class="container mt-4">
    <h1 class="mb-4">Manage Banners</h1>
    <button class="btn btn-custom mb-3" data-bs-toggle="modal" data-bs-target="#uploadModal">Upload Banner</button>

<table id="user" class="display table table-striped table-bordered">
    <thead>
        <tr>
            <th>SL.</th>
            <th>Title</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($banners as $index => $banner)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $banner->title }}</td>
            <td>
                <img src="{{ asset($banner->image) }}" class="img-thumbnail" style="width: 150px; height: 50px;">
            </td>
            <td>
                <button class="btn btn-info btn-action viewDescription" data-description="{{ $banner->description }}" data-bs-toggle="modal" data-bs-target="#viewDescriptionModal">Description</button>
                <button class="btn btn-edit btn-action editBanner" data-id="{{ $banner->id }}" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" style="display:inline;" class="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete btn-action" onclick="return confirmDelete()">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="viewDescriptionModal" tabindex="-1" aria-labelledby="viewDescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDescriptionModalLabel">Banner Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="bannerDescription"></p>
            </div>
        </div>
    </div>
</div>


<!-- Modal for uploading new banner -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Banner Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required onchange="previewImage()">
                    </div>
                    <div class="mb-3">
                        <img id="imagePreview" src="#" alt="Image Preview" style="display: none; width: 300px; height: auto;">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-custom w-100">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal for editing banner -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="editTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="editImage" class="form-label">Banner Image</label>
                        <input type="file" class="form-control" id="editImage" name="image" accept="image/*" onchange="previewEditImage()">
                    </div>
                    <div class="mb-3">
                        <img id="editImagePreview" src="#" alt="Image Preview" style="display: none; width: 300px; height: auto;">
                    </div>
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editDescription" name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-custom w-100">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')

<script>
    function previewImage() {
        var file = document.getElementById('image').files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.src = reader.result;
            imagePreview.style.display = 'block'; // Show the image preview
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.style.display = 'none'; // Hide the preview if no image is selected
        }
    }

    function previewEditImage() {
        var file = document.getElementById('editImage').files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            var imagePreview = document.getElementById('editImagePreview');
            imagePreview.src = reader.result;
            imagePreview.style.display = 'block'; // Show the image preview
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            var imagePreview = document.getElementById('editImagePreview');
            imagePreview.style.display = 'none'; // Hide the preview if no image is selected
        }
    }

</script>

<script type="text/javascript">
    let table = new DataTable('#user');

    $('.editBanner').on('click', function() {
        let bannerId = $(this).data('id');
        $.ajax({
            url: '/admin/banners/' + bannerId + '/edit',
            method: 'GET',
            success: function(data) {
                $('#editTitle').val(data.title);
                $('#editDescription').val(data.description);  // Populate the description field
                $('#editForm').attr('action', '/admin/banners/' + bannerId);
            }
        });
    });
</script>


<script type="text/javascript">
    $('.viewDescription').on('click', function() {
        var description = $(this).data('description');

        $('#bannerDescription').text(description);
    });
</script>

<script type="text/javascript">
    function confirmDelete() {
        return confirm("Are you sure you want to delete this banner?");
    }
</script>

@endsection
