@extends('admin.adminLayout.master')
@section('meta')
<title>{{ isset($title)?$title:'Users' }} - {{ @siteInfo()->company_name }}</title>
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/dataTable.css') }}">
@endsection

@section('main')


<div class="row" style="overflow: scroll;">
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">

                <div class="d-flex justify-content-between mb-3">
                    <form method="GET" action="{{ route('user.list') }}" class="d-flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="form-control" placeholder="Search users...">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>Balance</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lists as $list)
                        <tr>
                            <td><img src="{{ preg_match('/^data:image/', @$list->image) ? $list->image : asset(@$list->image) }}"
                                    width="50" height="50"></td>
                            <td>{{ $list->name }}</td>
                            <td>{{ $list->phone }}</td>
                            <td>{{ optional($list->country)->name }}</td>
                            <td>{{ currency($list->balance) }}</td>
                            <td>{!! $list->status() !!}</td>
                            <td>
                                <a href="{{ route('admin.users.show', $list->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No users found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $lists->links('pagination::bootstrap-5') }}
                </div>


            </div>
        </div>
    </div>
</div>



@endsection
@section('script')


<script type="text/javascript">
    let table = new DataTable('#user');
</script>

@endsection