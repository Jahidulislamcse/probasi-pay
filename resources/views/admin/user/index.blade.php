@extends('admin.adminLayout.master')
@section('meta')

<title>{{ isset($title)?$title:'welcome' }} - {{ env('APP_NAME') }}</title>

@endsection
@section('style')

@endsection
@section('main')

<div class=" card row layout-top-spacing">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">

                    <table id="user" class="table dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>phone</th>
                                <th>country</th>
                                <th>balance</th>
                                <th>Status</th>
                                <th>Action</th>
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

                                <td><img src="{{ $user_image }}" style="    width: 50px;height: 50px;"></td>
                                <td>{!! @$list->name !!}</td>
                                <td>{{ @$list->phone }} </td>
                                <td>{{ @$list->country->name }} </td>
                                <td>{{ currency(@$list->balance) }} </td>
                                <td>{!! @$list->status() !!}</td>
                                <td class="text-center">
                                    <a class="btn btn-small btn-primary mb-2" href="{{ route('admin.users.show', $list->id) }}">
                                        <i class="fa fa-eye"></i> View More
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="mt-2 mb-5" >
    {{ $lists->links('pagination::bootstrap-5') }}
</div>


@endsection
@section('script')


<script type="text/javascript">
    let table = new DataTable('#user');
</script>

@endsection
