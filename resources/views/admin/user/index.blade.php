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
            
                                <td><img src="{{ $user_image }}" style="    width: 150px;height: 150px;"></td>
                                <td>{!! @$list->name !!}</td>
                                <td>{{ @$list->phone }} </td>
                                <td>{{ @$list->country->name }} </td>
                                <td>{{ currency(@$list->balance) }} </td>
                                <td>{!! @$list->status() !!}</td>
                                <td class="text-center">
                                     <a class="btn btn-small btn-info   mb-2" href="{{ route('user.addbalance',$list->id) }}"><i class="fa fa-dollar"></i> Add Balance</a>
                                    @if($list->status == 0)
                                    <a class="btn btn-small btn-success   mb-2" href="{{ route('user.status',$list->id) }}"> <i class="fa fa-check"> </i>Approved </a>
                                    @else
                                    <a class="btn btn-small btn-danger   mb-2" href="{{ route('user.status',$list->id) }}"><i class="fa fa-times"></i> Deactive</a>
                                    @endif
                                    <a class="btn btn-small btn-danger   mb-2" href="{{ route('user.delete',$list->id) }}"><i class="fa fa-times"></i> Delete</a>
                                  
                                    
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


@endsection
@section('script')


<script type="text/javascript">
    let table = new DataTable('#user');
 
</script>

@endsection