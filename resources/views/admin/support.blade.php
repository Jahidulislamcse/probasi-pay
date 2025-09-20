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
            <a href="{{  route('admin.index')  }}" class="back-btn"><i class="icon-left white_color"></i></a>
            <h3 class="white_color">ঋণ নিন</h3>
        </div>
    </div>
</div>

<div class="topup-content" style="margin-top: 60px; text-align: center; margin-bottom: 50px;">
    <span style=" background: #067fab;padding: 10px 25px; border-radius: 10px; font-size: 18px; font-weight: normal;  display: block;  margin: 10px;" class="white_color text-center">দুঃখিত আপনি এই সেবাটির জন্য এখন উপযুক্ত না।</span>
    <div style="padding:20px">
        <p >
            @php
                $guide = \App\Models\Guide::first();
            @endphp
             @if(!empty($guide->loan))
                {!! $guide->loan !!}
            @endif
        </p>

        <p style=" text-align: center;
            margin: 20px 5px;
            font-size: 14px;">আর তথ্য জানতে নিচের হেল্পলাইন বাটনে ক্লিক করে হেল্প সেন্টারে যোগাযোগ করুন
            <br>
            <a href="https://wa.me/8801942823152" style="
                background: #1a3637;
                padding: 10px 20px;
                margin-top:20px;
                margin-bottom:20px;
                color: white;
                font-size: 15px;
                line-height: 5;
                border-radius: 5px;">হেল্পলাইন
            </a> <br>
        </p>
    </div>
</div>

@endsection

@section('script')
    <script src="https://cdn.tiny.cloud/1/g4ey3kcg0n64dzmmh0maa5ubocx61oj7sgbkeiy16qsu5cqp/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection