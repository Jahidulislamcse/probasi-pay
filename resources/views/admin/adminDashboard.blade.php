@extends('admin.adminLayout.master')
@section('meta')

<title>{{ isset($title)?$title:'welcome' }} - {{ @siteInfo()->company_name }}</title>

@endsection
@section('style')

@endsection

@section('main')
<div class="content-wraper-area">
    <div class="dashboard-area">
        <div class="container">
            <div class="row g-4">
                <div class="col-sm-6 col-lg-3 col-xxl-3">
                    <div class="card ">
                        <div class="card-body" data-intro="New Orders">
                            <div
                                class="single-widget d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="widget-icon">
                                        <i class='bx bx-mouse-alt'></i>
                                    </div>
                                    <div class="widget-desc">
                                        <h5>@php
                                                $total = App\Models\Topup::where('status',1)->sum('amount') ;
                                                echo currency($total) ;
                                            @endphp
                                        </h5>
                                        <p class="mb-0">Total Topup</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 col-xxl-3">
                    <div class="card">
                        <div class="card-body" data-intro="New Customers">
                            <div
                                class="single-widget d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="widget-icon">
                                        <i class='bx bx-user-voice'></i>
                                    </div>
                                    <div class="widget-desc">
                                        <h5> @php
                                                $total = App\Models\User::count() ;
                                                echo $total ;
                                            @endphp
                                        </h5>
                                        <p class="mb-0">Total Customer</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 col-xxl-3">
                    <div class="card">
                        <div class="card-body" data-intro="Revenue">
                            <div
                                class="single-widget d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="widget-icon">
                                        <i class='bx bx-wallet'></i>
                                    </div>
                                    <div class="widget-desc">
                                        <h5> @php
                                            $total = App\Models\MobileRecharge::where('status',1)->sum('amount') + App\Models\MobileBanking::where('status',1)->sum('amount') +  App\Models\BillPay::where('status',1)->sum('amount') + App\Models\BankPay::where('status',1)->sum('amount')  ;

                                            echo currency($total) ;
                                        @endphp </h5>
                                        <p class="mb-0">Total Pay</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 col-xxl-3">
                    <div class="card">
                        <div class="card-body" data-intro="Growth">
                            <div
                                class="single-widget d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="widget-icon">
                                        <i class='bx bx-bar-chart-alt-2'></i>
                                    </div>
                                    <div class="widget-desc">
                                        <h5> @php
                                            $total = App\Models\MobileRecharge::where('status',0)->sum('amount') + App\Models\MobileBanking::where('status',0)->sum('amount') +  App\Models\BillPay::where('status',0)->sum('amount') + App\Models\BankPay::where('status',0)->sum('amount')  ;

                                            echo currency($total) ;
                                        @endphp </h5>
                                        <p class="mb-0">Total Pending Pay</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="revenue-card text-center">
                                <div class="offer-img"><img src="img/bg-img/offer.jpg" alt=""></div>
                                @php
                                    $total = App\Models\User::sum('balance') ;

                                @endphp

                                <h2>{{ currency($total) }}</h2>
                                <h5>Available Balance </h5>
                                <p>The total balance available across all users.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div
                                class="card-title mb-30 d-flex align-items-center justify-content-between">
                                <h6 class="mb-0">Pending Topup</h6>

                            </div>
                            <div class="chart-area">
                                <table id="table" class="table dt-table-hover" style="width:100%">
                                    <thead>
                                        <tr>

                                            <th>Date</th>
                                            <th>User</th>
                                            <th>Type</th>
                                            <th>Phone</th>
                                            <th>Amount</th>
                                            <th>Account</th>
                                            <th>Screenshot</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(App\Models\Topup::latest()->where('status',0)->get() as $list)
                                        <tr>

                                            <td>{!! Illuminate\Support\Carbon::parse(@$list->created_at)->format('d-m-Y') !!}</td>
                                            <td>{{ @$list->user->name }}</td>
                                            <td>{{ @$list->type }} </td>
                                            <td>{{ @$list->phone }} </td>
                                            <td>{{ @$list->amount }} </td>
                                            <td>{{ @$list->account }} </td>
                                            <td> @if(@$list->file) <a href="{{ asset(@$list->file) }}" target="_blank">view screenshot</a> @endif   </td>
                                            <td>{!! @$list->status() !!}</td>
                                            <td class="text-center">
                                                @if(@$list->status == 0)
                                                    <a class="btn btn-small btn-success btn-circle  mb-2" href="{{ route('topup.approve',$list->id) }}"> <i class="fa fa-check"></i> </a>
                                                    <a class="btn btn-small btn-danger btn-circle  mb-2" href="{{ route('topup.reject',$list->id) }}"><i class="fa fa-times"></i></a>
                                                @endif

                                            </td>
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
<script type="text/javascript">
    let table = new DataTable('#table');
</script>
@endsection
