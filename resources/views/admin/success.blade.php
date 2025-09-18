 @extends('admin.layout.master')
 @section('meta')
 @endsection
 @section('style')
 <style>
 
         body{
                 background-color: #ffffff;
         }
         h1, h2, h3, h4, h5, h6 {
           
            color: #000000;
        }
 
    
     ._failed{ border-bottom: solid 4px red !important; }
._failed i{  color:red !important;  }

._success {
    box-shadow: 0 15px 25px #00000019;
    padding: 45px;
    width: 100%;
    text-align: center;
    margin: 40px auto;
    border-bottom: solid 4px #28a745;
}

._success i {
    font-size: 80px;
    color: #28a745;
}

._success h2 {
    margin-bottom: 12px;
    font-size: 40px;
    font-weight: 500;
    line-height: 1.2;
    margin-top: 10px;
}

._success p {
    margin-bottom: 0px;
    font-size: 18px;
    color: #495057;
    font-weight: 500;
}
 </style>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 @endsection
 @section('main')




<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="message-box _success">
                    <h2>success </h2>
                     <i class="fa fa-check-circle" aria-hidden="true"></i>
                    
                  <h1 style=" padding: 10px 0px;font-weight: normal;">{{ $title }}</h1>
                    @foreach($data as $key=>$value)
                        <p>{{ $key }} : {{ $value }}  </p>
                    @endforeach

                <a href="{{ route('admin.index') }}" style="
    background: #067fab;
    color: #fff;
    font-size: 20px;
    padding: 6px 30px;
    border-radius: 10px;
    line-height: 5;
">ফিরে যান</a>
            </div> 
        </div> 
    </div> 
    
  
</div> 
 

 @endsection


 @section('script')
 @endsection
