@extends('admin.adminLayout.master')

@section('meta')
<title>{{ isset($title) ? $title : 'Welcome' }} - {{ env('APP_NAME') }}</title>
@endsection

@section('style')
<!-- Bootstrap 5 DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<style>
    .card {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    }
    .card-header {
        border-bottom: none;
        border-radius: 0.75rem 0.75rem 0 0;
        background: #f8f9fa;
    }
    .card-header h5 {
        margin: 0;
        font-weight: 600;
    }
    table.dataTable thead th {
        background-color: #f8f9fa;
        color: #212529;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
    }
    table.dataTable tbody tr:hover {
        background-color: #f1f3f5;
    }
    .user-img {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #dee2e6;
    }
</style>
@endsection

@section('main')
<div class="row layout-top-spacing">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5>{{ $title }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="user" class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Country</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lists as $list)
                                @php
                                    if (preg_match('/^data:image\/(\w+);base64,/', @$list->image)) {
                                        $user_image = @$list->image;
                                    } else {
                                        $user_image = asset(@$list->image);
                                    }
                                @endphp
                                <tr>
                                    <td><img src="{{ $user_image }}" class="user-img"></td>
                                    <td class="fw-semibold">{!! @$list->name !!}</td>
                                    <td>{{ @$list->phone }}</td>
                                    <td>{{ @$list->country->name }}</td>
                                    <td>{{ currency(@$list->balance) }}</td>
                                    <td>{!! @$list->status() !!}</td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.users.show', $list->id) }}">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Laravel pagination -->
                <div class="mt-3 d-flex justify-content-center">
                    {{ $lists->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- DataTables with Bootstrap 5 -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
    let table = new DataTable('#user', {
        paging: false, // Laravel handles pagination
        info: false,
        searching: true
    });
</script>
@endsection
