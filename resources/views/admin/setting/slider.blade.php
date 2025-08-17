@extends('admin.adminLayout.master')
@section('meta')

<title>{{ isset($title)?$title:'welcome' }} - {{ @siteInfo()->company_name }}</title>


@endsection
@section('style')




@endsection
@section('main')
<div class="card">
    <div class="card-header">
        <div class="breadcrumb-header">
            <h5>{{ __("Slider") }}</h5>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <form
                    action="@if(empty(@$data)) {{ route('slider') }} @else {{ route('slider.edit',$data->id) }}  @endif"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @if($errors->any())
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    @endif
                    <div class="row">
                        <div class="col-md-12">
                          

                            <div class="form-group">
                                <label> {{ __("Image") }} <span style="color:red">*</span></label>
                                <input type="file" name="image" class="form-control" id="image"    >
                                    @if (@$data->image)
                                        <img src="{{ asset(@$data->image) }}" height="50px" width="50px" alt="">
                                    @endif

                            </div>


                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __("Save") }}
                                </button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <table id="myTable" class="table table-striped table-bordered ">
                    <thead>
                        <tr>

                            <th style="text-align: center;">{{ __("Image") }}</th>
                            <th style="text-align: center;">{{ __("Action") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list as $li)
                        <tr>

                            <td style="text-align: center; "> <img src="{{ asset(@$li->image) }}" alt="" width="50px" height="50px" > </td>
                            <td style="text-align: center;">


                                <a href="{{ route('slider.edit',$li->id) }}" style="margin: 15px" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-pen-tool">
                                        <path d="M12 19l7-7 3 3-7 7-3-3z"></path>
                                        <path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path>
                                        <path d="M2 2l7.586 7.586"></path>
                                        <circle cx="11" cy="11" r="2"></circle>
                                    </svg>
                                </a>
                                <span data="{{ route('slider.delete',$li->id) }}" class="delete-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-trash-2 table-cancel">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </span>


                            </td>
                        </tr>
                        @endforeach
                        </tr>
                        </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>




@endsection
@section('script')
<script>
    let table = new DataTable('#myTable');
</script>

<!-- These plugins only need for the run this page -->
<script src="{{ asset('admin/js/apexcharts.min.js') }} "></script>
<script src="{{ asset('admin/js/dashboard-custom.js') }} "></script>


@endsection