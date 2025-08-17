@extends('admin.adminLayout.master')
@section('meta')

<title>{{ isset($title)?$title:'welcome' }} - {{ env('APP_NAME') }}</title>




@endsection
@section('style')




@endsection
@section('main')

<div class=" card row layout-top-spacing">

    <div class="row justify-content-center">
   
        <div class="col-xl-6 col-lg-6 col-sm-12  layout-spacing">
                <h5 class="text-center" > Name : {{ @$user->name }}</h5>
                <h5 class="text-center" >Mobile :{{ @$user->phone }}</h5>
                <h6 class="text-center" >Balance :{{ currency(@$user->balance) }}</h6>
                <form action="{{ route('user.addbalance',$user->id) }}" method="post">
                    @csrf
                        <input class="form-control m-5" type="number" name="amount" placeholder="Enter Amount" />
                        <button class="btn btn-success" > Add Balance</button>
                </form>
          
        </div>

    </div>



</div>


@endsection
@section('script')


<script type="text/javascript">
    let table = new DataTable('#user');
 
</script>

@endsection