@extends('admin.layout.master')
@section('meta')

<link rel="canonical" href="{{ route('admin.index') }}" />

@section('style')
<style>
    @php
        $colors = \App\Models\ColorSetting::first();
    @endphp
    .app-header {
        background-color: {{ $colors->header_color ?? '#ff3130' }};
    }
    body {
        background-color: {{ $colors->body_color ?? '#ff3130' }};
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
            <a href="{{  route('admin.index')  }}" class="back-btn"><i class="icon-left white_color"></i></a>
            <h3 class="white_color">হেল্প লাইন</h3>
        </div>
    </div>
</div>
<div class="mt-1 box-settings-profile style1">
    <div style=" display: flex;
  justify-content: center;
  align-items: center;">
        <a aria-label="Chat on WhatsApp" href="https://wa.me/8801942823152"> <img alt="Chat on WhatsApp" src="{{ asset('frontend/whatsapp-bt.gif')}}" />
        </a>
    </div>
</div>

@endsection

@section('script')

@endsection
