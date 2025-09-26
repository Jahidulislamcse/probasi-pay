<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@extends('admin.layout.master')

@section('meta')
<title>Transaction History - {{ env('APP_NAME') }}</title>
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
    body,
    .small-font,
    .small-font * {
        font-size: 12px !important;
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

    .nav-tabs .nav-item .btn-toggle {
        font-size: 0.875rem;
        padding: 10px 20px;
        height: 50px;
        border-radius: 25px;
        transition: background-color 0.3s ease, color 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 767px) {
        .nav-tabs .nav-item .btn-toggle {
            font-size: 0.5rem;
            padding: 8px 15px;
            height: 50px;
            border-radius: 20px;
        }

        .mbl {
            font-size: 0.5rem;
        }
    }

    .nav-tabs .nav-item .btn-toggle[data-bs-target="#depositsTab"] {
        background-color: #3498db;
        color: #fff;
    }

    .nav-tabs .nav-item .btn-toggle[data-bs-target="#mobileWithdrawTab"] {
        background-color: #2ecc71;
        color: #fff;
    }

    .nav-tabs .nav-item .btn-toggle[data-bs-target="#bankWithdrawTab"] {
        background-color: #e67e22;
        color: #fff;
    }

    .nav-tabs .nav-item .btn-toggle[data-bs-target="#remittanceTab"] {
        background-color: #f39c12;
        color: #fff;
    }

    .nav-tabs .nav-item .btn-toggle[data-bs-target="#rechargeTab"] {
        background-color: #9b59b6;
        color: #fff;
    }

    .nav-tabs .nav-item .btn-toggle.active {
        color: #fff;
        border-color: #16a085;
    }

    .nav-tabs .nav-item .btn-toggle:hover {
        opacity: 0.8;
    }
</style>
@endsection

@section('main')
<div class="app-header st1">
    <div class="tf-container">
        <div class="tf-topbar d-flex justify-content-center align-items-center">
            <a href="{{ route('admin.index') }}" class="back-btn"><i class="icon-left white_color"></i></a>
            <h3 class="white_color">আপনার লেনদেন সমূহ</h3>
        </div>
    </div>
</div>

<div class="card layout-top-spacing mt-2 small-font">
    <div class="card-body">
        {{-- Header --}}
        <div class="d-flex align-items-center mb-4">
            <img src="{{ auth()->user()->image ? asset(auth()->user()->image) : asset('images/avatar.png') }}" class="rounded me-3" style="width:80px;height:80px;object-fit:cover;">
            <div>
                <h4 class="mb-1">{{ auth()->user()->name }}</h4>
                <div class="text-muted small">
                    <span class="me-3">Balance: {{ currency(auth()->user()->balance ?? 0) }}</span>
                </div>
            </div>
            <div class="ms-auto">
                {!! auth()->user()->status() !!}
            </div>
        </div>

        <ul class="nav nav-tabs mb-4" id="userTabs" role="tablist">
            <li class="nav-item mx-1" role="presentation">
                <button class="btn btn-toggle {{ $tab === 'deposits' ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#depositsTab">জমা</button>
            </li>
            <li class="nav-item mx-1" role="presentation">
                <button class="btn btn-toggle {{ $tab === 'mobile_withdraw' ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#mobileWithdrawTab">উত্তোলন/মোবাইল</button>
            </li>
            <li class="nav-item mx-1" role="presentation">
                <button class="btn btn-toggle {{ $tab === 'bank_withdraw' ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#bankWithdrawTab">উত্তোলন/ব্যাংক</button>
            </li>
            <li class="nav-item mx-1" role="presentation">
                <button class="btn btn-toggle {{ $tab === 'remittance' ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#remittanceTab">রেমিটেন্স</button>
            </li>
            <li class="nav-item mx-1" role="presentation">
                <button class="btn btn-toggle {{ $tab === 'recharge' ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#rechargeTab">মোবাইল রিচার্জ</button>
            </li>
        </ul>

        @php
        $tab = $tab ?? 'deposits';
        @endphp

        <div class="mbl collapse {{ $tab === 'deposits' || $tab === null ? 'show' : '' }}" id="depositsTab">
            <form method="GET" action="{{ route('history') }}" class="row g-2 align-items-center mb-3">
                <input type="hidden" name="tab" value="deposits">
                <div class="col">
                    <input type="search" class="form-control" name="topup_q" value="{{ $qTopup }}" placeholder="Search (gateway/transaction/amount/type/mobile/account)">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary">Search</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Gateway</th>
                            <th>Type</th>
                            <th>Transaction</th>
                            <th>Pin</th>
                            <th class="text-end">Amount</th>
                            <th class="text-end">Commission</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topups as $t)
                        <tr>
                            <td>{{ $topups->firstItem() + $loop->index }}</td>
                            <td>{{ $t->created_at?->format('d M Y, h:i A') }}</td>
                            <td>{{ optional($t->gateway)->name ?? 'N/A' }}</td>
                            <td>{{ $t->type ?? 'N/A' }}</td>
                            <td>{{ $t->transaction_id ?? '—' }}</td>
                            <td>{{ $t->mobile ?: $t->account ?: 'N/A' }}</td>
                            <td class="text-end">{{ number_format((float)($t->amount ?? 0), 2) }}</td>
                            <td class="text-end">{{ number_format((float)($t->commision ?? 0), 2) }}</td>
                            <td>{!! $t->status() !!}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">No deposits found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $topups->onEachSide(1)->appends(['tab'=>'deposits','topup_q'=>$qTopup])->links('pagination::bootstrap-5') }}
            </div>
        </div>

        {{-- Mobile Withdraw Section --}}
        <div class="mbl collapse {{ $tab === 'mobile_withdraw' ? 'show' : '' }}" id="mobileWithdrawTab">
            <form method="GET" action="{{ route('history') }}" class="row g-2 align-items-center mb-3">
                <input type="hidden" name="tab" value="mobile_withdraw">
                <div class="col">
                    <input type="search" class="form-control" name="mb_q" value="{{ $qMb }}" placeholder="Search (operator/mobile/type/transaction/amount)">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary">Search</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Operator</th>
                            <th>Type</th>
                            <th>Transaction</th>
                            <th>Mobile</th>
                            <th class="text-end">Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mobileWithdraws as $mw)
                        <tr>
                            <td>{{ $mobileWithdraws->firstItem() + $loop->index }}</td>
                            <td>{{ $mw->created_at?->format('d M Y, h:i A') }}</td>
                            <td>{{ $mw->operator ?? 'N/A' }}</td>
                            <td>{{ $mw->type ?? 'N/A' }}</td>
                            <td>{{ $mw->transaction_id ?? '—' }}</td>
                            <td>{{ $mw->mobile ?? 'N/A' }}</td>
                            <td class="text-end">{{ number_format((float)($mw->amount ?? 0), 2) }}</td>
                            <td>{!! $mw->status() !!}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No mobile withdrawals found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $mobileWithdraws->onEachSide(1)->appends(['tab'=>'mobile_withdraw','mb_q'=>$qMb])->links('pagination::bootstrap-5') }}
            </div>
        </div>

        {{-- Bank Withdraw Section --}}
        <div class="mbl collapse {{ $tab === 'bank_withdraw' ? 'show' : '' }}" id="bankWithdrawTab">
            <form method="GET" action="{{ route('history') }}" class="row g-2 align-items-center mb-3">
                <input type="hidden" name="tab" value="bank_withdraw">
                <div class="col">
                    <input type="search" class="form-control" name="bank_q" value="{{ $qBank }}" placeholder="Search (bank/operator/transaction/number/branch/holder/mobile/amount)">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary">Search</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Bank/Operator</th>
                            <th>Transaction</th>
                            <th>Account/Number</th>
                            <th>Branch</th>
                            <th>Account Holder</th>
                            <th class="text-end">Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bankPays as $bp)
                        <tr>
                            <td>{{ $bankPays->firstItem() + $loop->index }}</td>
                            <td>{{ $bp->created_at?->format('d M Y, h:i A') }}</td>
                            <td>{{ $bp->operator ?? 'N/A' }}</td>
                            <td>{{ $bp->transaction_id ?? '—' }}</td>
                            <td>{{ $bp->number ?? $bp->mobile ?? 'N/A' }}</td>
                            <td>{{ $bp->branch ?? 'N/A' }}</td>
                            <td>{{ $bp->achold ?? 'N/A' }}</td>
                            <td class="text-end">{{ number_format((float)($bp->amount ?? 0), 2) }}</td>
                            <td>{!! $bp->status() !!}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">No bank withdrawals found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $bankPays->onEachSide(1)->appends(['tab'=>'bank_withdraw','bank_q'=>$qBank])->links('pagination::bootstrap-5') }}
            </div>
        </div>

        {{-- Remittance Section --}}
        <div class="mbl collapse {{ $tab === 'remittance' ? 'show' : '' }}" id="remittanceTab">
            <form method="GET" action="{{ route('history') }}" class="row g-2 align-items-center mb-3">
                <input type="hidden" name="tab" value="remittance">
                <div class="col">
                    <input type="search" class="form-control" name="remit_q" value="{{ $qRemit }}" placeholder="Search (transaction/operator/account/branch/holder/amount)">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary">Search</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Operator</th>
                            <th>Transaction</th>
                            <th>Account</th>
                            <th>Branch</th>
                            <th>Account Holder</th>
                            <th class="text-end">Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($remittances as $r)
                        <tr>
                            <td>{{ $remittances->firstItem() + $loop->index }}</td>
                            <td>{{ $r->created_at?->format('d M Y, h:i A') }}</td>
                            <td>{{ $r->operator ?? 'N/A' }}</td>
                            <td>{{ $r->transaction_id ?? '—' }}</td>
                            <td>{{ $r->account ?? 'N/A' }}</td>
                            <td>{{ $r->branch ?? 'N/A' }}</td>
                            <td>{{ $r->achold ?? 'N/A' }}</td>
                            <td class="text-end">{{ number_format((float)($r->amount ?? 0), 2) }}</td>
                            <td>{!! $r->status() !!}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">No remittance records found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $remittances->onEachSide(1)->appends(['tab'=>'remittance','remit_q'=>$qRemit])->links('pagination::bootstrap-5') }}
            </div>
        </div>

        {{-- Mobile Recharges Section --}}
        <div class="mbl collapse {{ $tab === 'recharge' ? 'show' : '' }}" id="rechargeTab">
            <form method="GET" action="{{ route('history') }}" class="row g-2 align-items-center mb-3">
                <input type="hidden" name="tab" value="recharge">
                <div class="col">
                    <input type="search" class="form-control" name="rc_q" value="{{ $qRc }}" placeholder="Search (operator/type/mobile/amount)">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary">Search</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Operator</th>
                            <th>Type</th>
                            <th>Mobile</th>
                            <th class="text-end">Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mobileRecharges as $mr)
                        <tr>
                            <td>{{ $mobileRecharges->firstItem() + $loop->index }}</td>
                            <td>{{ $mr->created_at?->format('d M Y, h:i A') }}</td>
                            <td>{{ $mr->operator ?? 'N/A' }}</td>
                            <td>{{ $mr->type ?? 'N/A' }}</td>
                            <td>{{ $mr->mobile ?? 'N/A' }}</td>
                            <td class="text-end">{{ number_format((float)($mr->amount ?? 0), 2) }}</td>
                            <td>{!! $mr->status() !!}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No mobile recharges found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $mobileRecharges->onEachSide(1)->appends(['tab'=>'recharge','rc_q'=>$qRc])->links('pagination::bootstrap-5') }}
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Ensure the Deposits section is open on load
                const depositTabButton = document.querySelector('.nav-tabs .btn-toggle[data-bs-target="#depositsTab"]');
                if (!document.querySelector('.collapse.show')) {
                    const depositTab = document.querySelector('#depositsTab');
                    const collapseInstance = new bootstrap.Collapse(depositTab, {
                        toggle: true
                    });
                    depositTabButton.classList.add('active'); // Make sure the button is marked as active
                }
            });

            document.querySelectorAll('.nav-tabs .btn').forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-bs-target');
                    const target = document.querySelector(targetId);

                    // Remove active class from all buttons
                    document.querySelectorAll('.nav-tabs .btn').forEach(btn => btn.classList.remove('active'));

                    // Add active class to the clicked button
                    this.classList.add('active');

                    document.querySelectorAll('.collapse').forEach(collapse => {
                        if (collapse !== target) {
                            const collapseInstance = new bootstrap.Collapse(collapse, {
                                toggle: false
                            });
                            collapseInstance.hide();
                        }
                    });

                    const collapseInstance = new bootstrap.Collapse(target);
                    collapseInstance.toggle();
                });
            });
        </script>
    </div>
</div>
@endsection

@section('script')
@endsection
