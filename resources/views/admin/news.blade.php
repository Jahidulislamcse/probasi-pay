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
            <h3>প্রবসী নিউজ</h3>
        </div>
    </div>
</div>
<div class="mt-1 box-settings-profile style1">
<div style="padding-bottom:56.25%; position:relative; display:block; width: 100%;height:100;" >
<iframe src="https://probashbarta.com/" width="100%" height="1024" style="border:none;" scrolling="yes">
</iframe>
</div>
</div>

       
@endsection


@section('script')






@endsection