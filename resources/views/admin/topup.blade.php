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
        font-size: 15px;
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
        padding: 10px;
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

    .quick-btn{
        padding: 10px 20px;
        margin-top: 20px;
        margin-bottom: 20px;
        color: white;
        font-size: 15px;
        border-radius: 5px;
        cursor: pointer;
    }
    @media (max-width: 600px) {
        .quick-btn{
            font-size: 12px;
             padding: 5px 10px;
        }
    }
</style>

@endsection
@section('main')

@php
$country = country();
@endphp

<!-- preloade -->


<div class="app-header st1">
    <div class="tf-container">
        <div class="tf-topbar d-flex justify-content-center align-items-center">
            <a href="{{ route('admin.index') }}" class="back-btn"><i class="icon-left white_color"></i></a>
            <h3 class="white_color">মোবাইল অ্যাড ফান্ড</h3>
        </div>
    </div>
</div>

<div class="topup-content" style="
    margin-top: 10px;
    text-align: center;
">

    @if($country)
    <span style="

            background: #067fab;
            padding: 5px 0;
            border-radius: 10px;
            font-size: 11px;
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
</div>

<div class="text-center" style="margin: 30px;">
    <div style="display: inline-block; margin-right: 10px;">
        <span class="quick-btn" style="
            background: #16a085;" data-bs-toggle="modal" data-bs-target="#depositRulesModal">
            ম্যানুয়াল এড ব্যালেন্স

        </span>
    </div>

    <div style="display: inline-block;">
        <span class="quick-btn" style="
            background: #e67e22;" data-bs-toggle="modal" data-bs-target="#topupsModal">
            পূর্বের রিকোয়েস্ট
        </span>
    </div>
</div>




@php $content = App\Models\Section::where('key','topup')->first(); @endphp

<div class="modal fade" id="depositRulesModal" tabindex="-1" aria-labelledby="depositRulesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Your content section -->
                <div style="padding:20px">
                    <div class="account-grid" style="margin-top:10px;margin-bottom:25px; padding: 0 10px;">
                        @foreach ($accounts as $data)
                        <label class="account-item">
                            <strong>{{ $data->name }}</strong>
                            <span style="font-size: 14px; font-weight: bold;">
                                {!! $data->details !!}
                            </span>
                        </label>
                        @endforeach
                    </div>

                    <p>
                        আপনার যদি কোন কারনে {{ @$country->name }} ব্যাংক একাউন্ট না থাকে সেক্ষেত্রে আপনি শর্ত সাপেক্ষে উপরে দেওয়া কোম্পানির বিকাশের মাধ্যমে অ্যাপে ব্যালেন্স নিতে পারবেন।
                        এক্ষেত্রে আপনি উপরে দেওয়া কোম্পানির বিকাশে {{ @$country->name }} থেকে বর্তমানে প্রতি {{ @$country->currency }} যে হুন্ডি রেট পান সেই রেটে টাকা পাঠাবেন।
                        টাকা পাঠানোর পর কোম্পানির হেল্পলাইনে পিন এবং এমাউন্ট জানায়ে দিলে আপনাকে কোম্পানীর রেট অনুযায়ী ব্যালেন্স দিয়ে দেওয়া হবে।
                        বিষয়টা আরো সহজভাবে বুঝার জন্য ধরে নিন {{ @$country->name }} থেকে হুন্ডি মাধ্যমে আপনি যদি কোম্পানির বিকাশে ১০০ {{ @$country->currency }} ২৮ টাকা রেট হিসেবে ২৮০০ টাকা পাঠান
                        তাহলে আপনি অ্যাপে ব্যালেন্স পাবেন প্রতি {{ @$country->currency }} কোম্পানীর রেট {{ @$country->rate }} টাকা হিসেবে মোট ২৮০০ টাকা৷
                    </p>

                    <p class="text-center" style="color:#067fab;margin-top:20px">বিকাশের মাধ্যমে ডিপোজিটের শর্তসমূহ:</p>

                    <p style="color:black; font-size: 17px; text-align: justify;">
                        বিকাশের মাধ্যমে ডিপোজিটের শর্তসমূহ:
                        <br>👉 ডিপোজিটের ক্ষেত্রে শুধুমাত্র হুন্ডি এজেন্টদের মাধ্যমে কোম্পানীর বিকাশে টাকা পাঠাতে হবে|
                        <br>👉 অ্যাপ থেকে কোম্পানির বিকাশে ডিপোজিট গ্রহনযোগ্য নয়|
                        <br>👉 যতক্ষন হেল্পলাইনে পিন এবং এমাউন্ট জানাবেন না ততক্ষন ব্যালেন্স এড হবেনা|
                        <br>👉 অটো এড ব্যালেন্সের ক্ষেত্রে সর্বনিম্ন ৩০,০০০/= টাকা ডিপোজিট করতে হবে|
                        <br>👉 বিকাশের মাধ্যমে একমাসে সর্বোচ্চ ২.৫ লক্ষ টাকার ব্যালেন্স নিতে পারবেন| এর উপর হলে ব্যাংকের মাধ্যমে নিতে হবে
                    </p>

                    {!! @$content->value !!}
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
                                            <th>Transaction ID</th>
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
                                            <td>{{ $list->transaction_id }}</td>
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

<div style="padding:20px;">
    <form class=" tf-form" method="post">
        @csrf
        <p style="text-align: center; font-size: 28px;">এড ব্যালেন্স</p>
        <p style="margin-top: 10px;">
            @php
                $guide = \App\Models\Guide::first();
            @endphp
            @if(!empty($guide->mobile_deposit))
                {!! $guide->mobile_deposit !!}
            @endif
        </p>

        <div class="account-grid" style="margin-top: 10px; margin-bottom: 25px;">
            @foreach ($accounts as $data)
            <label class="account-item">
                <strong><input type="radio" name="account_id" value="{{ $data->id }}" style="margin-bottom: 8px;"> {{ $data->name }}</strong>
                <span style="font-size: 14px; font-weight: bold;">
                    {!! $data->details !!}
                </span>
            </label>
            @endforeach
        </div>
        <input type="hidden" name="type" value="Mobile pay">

        <div class="tf-form">
            <div class="form-group input-field input-money">
                <label for="">পিন</label>
                <input name="pin" type="text" placeholder="123456" required>
                <span class="icon-clear"></span>
                <small>যে নাম্বার থেকে টাকা পাঠিয়েছেন তার শেষের 4 টা ডিজিট লিখুন</small>
            </div>
        </div>

        <div class="tf-form">
            <div class="group-input input-field input-money">
                <label for="">টাকার পরিমাণ</label>
                <input name="amount" type="number" value="" required class="search-field value_input st1">
                <span class="icon-clear"></span>
                <small>বাংলাদেশি টাকায় যত টাকা কোম্পানীর নাম্বারে পাঠিয়েছেন সেটি লিখুন</small>
            </div>
        </div>
        <button type="submit" name="submit" class="tf-btn accent small">কনফার্ম পেমেন্ট</button>
    </form>
</div>

@endsection
@section('script')
@endsection