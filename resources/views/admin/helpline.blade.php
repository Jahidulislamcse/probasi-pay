@extends('admin.layout.master')
@section('meta')


<link rel="canonical" href="{{ route('admin.index') }}" />



@endsection
@section('style')




@endsection
@section('main')

       <!-- preloade -->
       <div class="preload preload-container">
        <div class="preload-logo">
          <div class="spinner"></div>
        </div>
      </div>
    <!-- /preload -->
    <div class="header">
        <div class="tf-container">
            <div class="tf-statusbar d-flex justify-content-center align-items-center">
                <a href="{{  route('admin.index') }}" class="back-btn"> <i class="icon-left"></i> </a>
                <h3>হেল্প লাইন <h3>
            </div>
        </div>
    </div>
    <div class="mt-1 box-settings-profile style1">
   <div style=" display: flex;
  justify-content: center;
  align-items: center;" >
<a aria-label="Chat on WhatsApp" href="https://wa.me/8801942823152"> <img alt="Chat on WhatsApp" src="{{ asset('frontend/whatsapp-bt.gif')}}" />
</a>
</div>
</div>
       
@endsection


@section('script')






@endsection