@extends('admin.layout.master')
@section('meta')


<link rel="canonical" href="{{ route('admin.index') }}" />



@endsection
@section('style')

<style>
  @php
        $colors = \App\Models\ColorSetting::first();
    @endphp
    .app-header {
        background-color: {{ $colors->header_color ?? '#067fab' }};
    }
    body {
        background-color: {{ $colors->body_color ?? '#067fab' }};
    }
        h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'SolaimanLipi', 'Noto Sans Bengali', sans-serif !important;
        font-weight: 400;
        color: {{ $colors->headings_color ?? '#ffffff' }};
    }
    label {
      color: {{ $colors->label_color ?? '#ffffff' }};   
    }
    p {
      color: {{ $colors->paragraph_color ?? '#ffffff' }};   
    }
</style>


@endsection
@section('main')


<div class="app-header st1">
  <div class="tf-container">
    <div class="tf-topbar d-flex justify-content-center align-items-center">
      <a href="{{ route('admin.index') }}" class="back-btn"><i class="icon-left white_color"></i></a>
      <h3 class="white_color">টিউটোরিয়াল</h3>
    </div>
  </div>
</div>
<div class="mt-3 register-section">
  <div class="tf-container">

    <div class="group-cb mt-5">
      <button type="button" class="tf-btn accent small mt-1" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">কিভাবে ব্যাল্যান্স অ্যাড করবেন <i class="fa fa-youtube-play" style="font-size:25px;color:white"></i></button>
    </div>
    <div class="group-cb mt-5">
      <button type="button" class="tf-btn accent small mt-1" data-bs-toggle="modal" data-bs-target="#exampleModalCenter1">কিভাবে ব্যাংক ট্রান্সফার করবেন
        <i class="fa fa-youtube-play" style="font-size:25px;color:white"></i>
      </button>
    </div>
    <div class="group-cb mt-5">
      <button type="button" class="tf-btn accent small mt-1" data-bs-toggle="modal" data-bs-target="#exampleModalCenter2">কিভাবে বিকাশ নগদে টাকা পাঠাবো
        <i class="fa fa-youtube-play" style="font-size:25px;color:white"></i>
      </button>
    </div>


  </div>
</div>



<div class="modal fade" id="exampleModalCenter">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">কিভাবে ব্যাল্যান্স অ্যাড করব</h5>
        <button class="btn-close" data-bs-dismiss="modal">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <div class="modal-body">
        <p>
          @php
              $guide = \App\Models\Guide::first();
          @endphp
          @if(!empty($guide->how_to_balance_add))
              {!! $guide->how_to_balance_add !!}
          @endif
        </p>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalCenter1">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">কিভাবে ব্যাংক ট্রান্সফার করবেন</h5>
        <button class="btn-close" data-bs-dismiss="modal">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <div class="modal-body">
        <p>
          @php
              $guide = \App\Models\Guide::first();
          @endphp
          @if(!empty($guide->how_to_bank_transfer))
              {!! $guide->how_to_bank_transfer !!}
          @endif
        </p>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalCenter2">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">কিভাবে বিকাশ নগদে টাকা পাঠাবো</h5>
        <button class="btn-close" data-bs-dismiss="modal">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <div class="modal-body">
        <p> @php
              $guide = \App\Models\Guide::first();
          @endphp
          @if(!empty($guide->how_to_mobile_banking))
              {!! $guide->how_to_mobile_banking !!}
          @endif
        </p>
      </div>

    </div>
  </div>
</div>

@endsection


@section('script')






@endsection