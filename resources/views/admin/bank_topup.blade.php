<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

@extends('admin.layout.master')
@section('meta')
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

    p {
        font-size: 17px;
        line-height: 25px;
        text-align: justify;
        font-weight: normal;
    }

    label {
        margin-top: 5px;
        margin-bottom: 5px;
        color: #2f2e2e;
        font-size: 18px;
    }

    .account-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    @media (min-width: 992px) {
        .account-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .account-item {
        background: #ffd3d3;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 5px;
        color: #067fab;
        font-size: 16px;
        line-height: 20px;
        border-radius: 8px;
        cursor: pointer;
        text-align: center;
    }

    .custom-scroll-section {
        max-height: 300px;
        overflow-y: auto;
        overflow-x: auto;
        padding-right: 10px;
    }
</style>
@endsection
@section('main')
<div class="preload preload-container">
    <div class="preload-logo">
        <div class="spinner"></div>
    </div>
</div>
@php
$country = country();

@endphp

<div class="app-header st1">
    <div class="tf-container">
        <div class="tf-topbar d-flex justify-content-center align-items-center">
            <a href="{{  route('admin.index')  }}" class="back-btn"><i class="icon-left white_color"></i></a>
            <h3 class="white_color">ব্যাংক অ্যাড ফান্ড</h3>
        </div>
    </div>
</div>

<div class=" topup-content" style="margin-top: 60px; text-align: center; margin-bottom: 50px;">

    @if($country)
    <span style="
            background: #067fab;
            padding: 5px 0;
            border-radius: 10px;
            font-size: 15px;
            font-weight: normal;
            display: block;
            margin-bottom: 20px;"
        class="white_color text-center">
        @if($rate)
        আজকের রেট: {{ $country->name }} {{ enToBnNumber(1) }} {{ $country->currency }} = {{ enToBnNumber(number_format($rate, 2)) }} টাকা
        @else
        Rate not found
        @endif
    </span>
    @endif
    <div style="padding:20px">
        <p> 
            @php
                $guide = \App\Models\Guide::first();
            @endphp
             @if(!empty($guide->bank_deposit))
                {!! $guide->bank_deposit !!}
            @endif
        </p>
    </div>

    <div class="text-center" style="margin: 30px;">
        <div style="display: inline-block; margin-right: 10px;">
            <span style="
            background: #f39c12;
            padding: 10px 20px;
            margin-top: 20px;
            margin-bottom: 20px;
            color: white;
            font-size: 15px;
            border-radius: 5px;
            cursor: pointer;
            " data-bs-toggle="modal" data-bs-target="#exampleModal">
                সাবমিট রিসিট
        </div>

        <div style="display: inline-block;">
            <span style="
            background: #16a085;
            padding: 10px 20px;
            margin-top: 20px;
            margin-bottom: 20px;
            color: white;
            font-size: 15px;
            border-radius: 5px;
            cursor: pointer;
            " data-bs-toggle="modal" data-bs-target="#topupsModal">
                পূর্বের রিকোয়েস্ট
            </span>
        </div>
        <div style="display: inline-block; margin-left: 10px">
            <a href="https://wa.me/8801942823152" style="
                background: #1a3637;
                padding: 10px 20px;
                margin-top:20px;
                margin-bottom:20px;
                color: white;
                font-size: 15px;
                line-height: 5;
                border-radius: 5px;">হেল্পলাইন</a>
        </div>
    </div>

</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mt-1 style1">
                    <div style="position:relative; display:block; width:100%; height:100%;">
                        <form method="post" enctype="multipart/form-data">
                            @csrf
                            <div style="padding:15px;"></div>

                            <div class="account-grid" style="margin-top:10px;margin-bottom:25px;">
                                @foreach ($accounts as $data)
                                <label class="account-item">
                                    <strong>
                                        <input type="radio" name="account_id" value="{{ $data->id }}" style="margin-bottom: 8px; font-size:10px;">
                                        {{ $data->name }}
                                    </strong>
                                    <span style="font-size: 10px; font-weight: bold;">
                                        {!! $data->details !!}
                                    </span>
                                </label>
                                @endforeach
                            </div>

                            <label> আপনার ব্যাংক ট্রান্সফার স্লিপের ছবি আপলোড করুন:</label>
                            <input style="display:none;" value="Bank Add pay" type="text" name="type">
                            <input type="file" name="file">

                            @php $content = App\Models\Section::where('key','topup bank')->first(); @endphp
                            <div style="padding:10px">
                                {!! @$content->value !!}
                            </div>

                            <div class="tf-form">
                                <div class="group-input input-field input-money">
                                    <label for="">টাকার পরিমাণ</label>
                                    <input name="amount" type="number" required class="search-field value_input st1">
                                    <span class="icon-clear"></span>
                                    <small>বাংলাদেশি টাকায় যত টাকা কোম্পানীর নাম্বারে পাঠিয়েছেন সেটি লিখুন</small>
                                </div>
                            </div>

                            <div style="padding:15px;"></div>
                            <input class="tf-btn accent large" type="submit" name="submit" value="কনফার্ম করুন">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="topupsModal" tabindex="-1" aria-labelledby="topupsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="topupsModalLabel">Topup History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row custom-scroll-section">
                    <div class="col-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">

                                <table id="table" class="table table-striped table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Gateway</th>
                                            <th>Phone</th>
                                            <th>Amount</th>
                                            <th>Commission</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lists as $list)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($list->created_at)->format('d-m-Y') }}</td>
                                            <td>{{ optional($list->gateway)->name ?? 'N/A' }}</td>
                                            <td>{{ $list->mobile }}</td>
                                            <td>{{ number_format($list->amount, 2) }}</td>
                                            <td>{{ number_format($list->commision, 2) }}</td>
                                            <td>{!! $list->status() !!}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
@endsection