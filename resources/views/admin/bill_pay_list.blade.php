@extends('admin.adminLayout.master')
@section('meta')

<title>{{ isset($title)?$title:'welcome' }} - {{ @siteInfo()->company_name }}</title>



@endsection
@section('style')




@endsection
@section('main')



<div class="row" style="overflow: scroll;">
   
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">

                <table id="table" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                          
                            <th>Date</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Information</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lists as $list)
                        <tr>
        
                            <td>{!! Illuminate\Support\Carbon::parse(@$list->created_at)->format('d-m-Y') !!}</td>
                            <td>{{ @$list->user->name }}</td>
                            <td>{{ @$list->amount }} </td>
                            <td>{{ @$list->operator }} <br> Bill No:  {{ $list->mobile }} </td>
                            <td>{!! @$list->status() !!}</td>
                            <td class="text-center">
                                @if(@$list->status == 0)
                                    <a class="btn btn-small btn-success btn-circle  mb-2" href="{{ route('billpay.approve',$list->id) }}"> <i class="fa fa-check"></i> </a>
                                    <a class="btn btn-small btn-danger btn-circle  mb-2" href="{{ route('billpay.reject',$list->id) }}"><i class="fa fa-times"></i></a>
                                @endif
                                <a class="btn btn-small btn-danger btn-circle  mb-2" href="{{ route('billpay.delete',$list->id) }}"><i class="bx bx-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>





@endsection
@section('script')
<script type="text/javascript">
    let table = new DataTable('#table',{order:false});
 
</script>




@endsection