@extends('admin.layout.master')
@section('meta')


<link rel="canonical" href="{{ route('admin.index') }}" />



@endsection
@section('style')




@endsection
@section('main')

<div class="app-header st1">
  <div class="tf-container">
    <div class="tf-topbar d-flex justify-content-center align-items-center">
      <a href="{{ route('admin.index') }}" class="back-btn"><i class="icon-left white_color"></i></a>
      <h3 class="white_color">প্রবসী নিউজ</h3>
    </div>
  </div>
</div>
<div class="mt-1 box-settings-profile style1">
  <div style="padding-bottom:56.25%; position:relative; display:block; width: 100%;height:100;">
    <iframe src="https://probashbarta.com/" width="100%" height="1024" style="border:none;" scrolling="yes">
    </iframe>
  </div>
</div>


@endsection


@section('script')






@endsection