{{-- resources/views/admin/user/show.blade.php --}}
@extends('admin.adminLayout.master')

@section('meta')
<title>{{ $title ?? 'User Details' }} - {{ env('APP_NAME') }}</title>
@endsection

@section('style')
{{-- keep it Bootstrap-only; no custom CSS required --}}
@endsection

@section('main')
<div class="card layout-top-spacing">
    <div class="card-body">
        {{-- Header --}}
        <div class="d-flex align-items-center mb-4">
            @php
            if (preg_match('/^data:image\/(\w+);base64,/', $user->image ?? '')) {
            $user_image = $user->image;
            } else {
            $user_image = $user->image ? asset($user->image) : asset('images/avatar.png');
            }
            @endphp
            <img src="{{ $user_image }}" class="rounded me-3" style="width:80px;height:80px;object-fit:cover;">
            <div>
                <h4 class="mb-1">{{ $user->name }}</h4>
                <div class="text-muted small">
                    <span class="me-3">Phone: {{ $user->phone ?? '—' }}</span>
                    <span class="me-3">Email: {{ $user->email ?? '—' }}</span>
                    <span class="me-3">Username: {{ $user->username ?? '—' }}</span>
                    <span class="me-3">Country: {{ optional($user->country)->name ?? '—' }}</span>
                    <span class="me-3">Balance: {{ currency($user->balance ?? 0) }}</span>
                </div>
            </div>
            <div class="ms-auto">
                {!! $user->status() !!}
            </div>
        </div>


        <div class="card mb-3 border-0">
            <div class="card-body py-2">
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <a href="{{ route('user.addbalance', $user->id) }}"
                        class="btn btn-outline-primary">
                        <i class="fa fa-dollar me-1"></i> Add Balance
                    </a>

                    @if($user->status == 0)
                    <a href="{{ route('user.status', $user->id) }}"
                        class="btn btn-success">
                        <i class="fa fa-check me-1"></i> Activate
                    </a>
                    @else
                    <a href="{{ route('user.status', $user->id) }}"
                        class="btn btn-danger">
                        <i class="fa fa-times me-1"></i> Deactivate
                    </a>
                    @endif

                    @if($user->is_blocked == 0)
                    <a href="{{ route('user.block', $user->id) }}"
                        class="btn btn-warning">
                        <i class="fa fa-ban me-1"></i> Block
                    </a>
                    @else
                    <a href="{{ route('user.block', $user->id) }}"
                        class="btn btn-secondary">
                        <i class="fa fa-unlock me-1"></i> Unblock
                    </a>
                    @endif

                    <button type="button"
                        class="btn btn-outline-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#confirmDeleteUser">
                        <i class="fa fa-trash me-1"></i> Delete
                    </button>

                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmDeleteUser" tabindex="-1" aria-labelledby="confirmDeleteUserLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteUserLabel">Delete user?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        This action cannot be undone. Are you sure you want to delete <strong>{{ $user->name }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger">
                            <i class="fa fa-trash me-1"></i> Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>



        {{-- Tabs --}}
        @php
        $tab = $activeTab ?? 'profile';
        @endphp
        <ul class="nav nav-tabs" id="userTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab==='profile'?'active':'' }}" href="{{ route('admin.users.show', ['user'=>$user->id,'tab'=>'profile']) }}">Profile</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab==='deposits'?'active':'' }}" href="{{ route('admin.users.show', ['user'=>$user->id,'tab'=>'deposits']) }}">Deposits</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab==='mobile_withdraw'?'active':'' }}" href="{{ route('admin.users.show', ['user'=>$user->id,'tab'=>'mobile_withdraw']) }}">Withdraw by Mobile Banking</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab==='bank_withdraw'?'active':'' }}" href="{{ route('admin.users.show', ['user'=>$user->id,'tab'=>'bank_withdraw']) }}">Withdraw by Bank</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab==='remittance'?'active':'' }}"
                    href="{{ route('admin.users.show', ['user'=>$user->id,'tab'=>'remittance']) }}">
                    Remittance
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $tab==='recharge'?'active':'' }}" href="{{ route('admin.users.show', ['user'=>$user->id,'tab'=>'recharge']) }}">Mobile Recharges</a>
            </li>
        </ul>

        <div class="tab-content pt-3">

            {{-- Profile tab --}}
            @if($tab==='profile')
            <div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="list-group">
                            <div class="list-group-item"><strong>Employee ID:</strong> {{ $user->employee_id ?? '—' }}</div>
                            <div class="list-group-item"><strong>Address:</strong> {{ $user->address ?? '—' }}</div>
                            <div class="list-group-item"><strong>Location:</strong> {{ optional($user->country)->name ?? '—' }}</div>
                            <div class="list-group-item"><strong>Joined:</strong> {{ $user->created_at?->format('d M Y, h:i A') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Deposits tab --}}
            @if($tab==='deposits')
            <form method="GET" action="{{ route('admin.users.show', $user->id) }}" class="row g-2 align-items-center mb-3">
                <input type="hidden" name="tab" value="deposits">
                <div class="col">
                    <input type="search" class="form-control" name="topup_q" value="{{ $qTopup }}" placeholder="Search (gateway/transaction/amount/type/mobile/account)">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary">Search</button>
                    <a class="btn btn-outline-secondary" href="{{ route('admin.users.show',['user'=>$user->id,'tab'=>'deposits']) }}">Reset</a>
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
                            <th>Mobile/Account</th>
                            <th class="text-end">Amount</th>
                            <th class="text-end">Commission</th>
                            <th>Status</th>
                            <th>Action</th>
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
                            <td class="text-end">{{ number_format((float)($t->commision	 ?? 0), 2) }}</td>
                            <td>{!! $t->status() !!}</td>
                            <td class="text-center">
                                @if($t->status == 0)
                                <a class="btn btn-small btn-success btn-circle mb-2"
                                    href="{{ route('topup.approve',$t->id) }}"
                                    onclick="return confirm('Are you sure you want to approve this topup?')">
                                    <i class="fa fa-check"></i>
                                </a>

                                <a class="btn btn-small btn-danger btn-circle mb-2"
                                    href="{{ route('topup.reject',$t->id) }}"
                                    onclick="return confirm('Are you sure you want to reject this topup?')">
                                    <i class="fa fa-times"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No deposits found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $topups->onEachSide(1)->appends(['tab'=>'deposits','topup_q'=>$qTopup])->links('pagination::bootstrap-5') }}
            </div>
            @endif

            {{-- Mobile Banking tab --}}
            @if($tab==='mobile_withdraw')
            <form method="GET" action="{{ route('admin.users.show', $user->id) }}" class="row g-2 align-items-center mb-3">
                <input type="hidden" name="tab" value="mobile_withdraw">
                <div class="col">
                    <input type="search" class="form-control" name="mb_q" value="{{ $qMb }}" placeholder="Search (operator/mobile/type/transaction/amount)">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary">Search</button>
                    <a class="btn btn-outline-secondary" href="{{ route('admin.users.show',['user'=>$user->id,'tab'=>'mobile_withdraw']) }}">Reset</a>
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
                            <th>Action</th>
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
                            <td>
                            <td class="text-center">
                                @if(@$mw->status == 0)
                                <a class="btn btn-small btn-success btn-circle mb-2" href="{{ route('mobilebankinglist.approve', $mw->id) }}" onclick="return confirmAction('approve')">
                                    <i class="fa fa-check"></i>
                                </a>
                                <a class="btn btn-small btn-danger btn-circle mb-2" href="{{ route('mobilebankinglist.reject', $mw->id) }}" onclick="return confirmAction('reject')">
                                    <i class="fa fa-times"></i>
                                </a>
                                @endif
                            </td>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No mobile banking records found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $mobileWithdraws->onEachSide(1)->appends(['tab'=>'mobile_withdraw','mb_q'=>$qMb])->links('pagination::bootstrap-5') }}
            </div>
            @endif

            {{-- Bank Transfers tab --}}
            @if($tab==='bank_withdraw')
            <form method="GET" action="{{ route('admin.users.show', $user->id) }}" class="row g-2 align-items-center mb-3">
                <input type="hidden" name="tab" value="bank_withdraw">
                <div class="col">
                    <input type="search" class="form-control" name="bank_q" value="{{ $qBank }}" placeholder="Search (bank/operator/transaction/number/branch/holder/mobile/amount)">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary">Search</button>
                    <a class="btn btn-outline-secondary" href="{{ route('admin.users.show',['user'=>$user->id,'tab'=>'bank_withdraw']) }}">Reset</a>
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
                            <th>Action</th>
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
                            <td class="text-center">
                                @if(@$bp->status == 0)
                                <a class="btn btn-small btn-success btn-circle mb-2"
                                    href="{{ route('bankpay.approve', $bp->id) }}"
                                    onclick="return confirmAction('approve')">
                                    <i class="fa fa-check"></i>
                                </a>

                                <a class="btn btn-small btn-danger btn-circle mb-2"
                                    href="{{ route('bankpay.reject', $bp->id) }}"
                                    onclick="return confirmAction('reject')">
                                    <i class="fa fa-times"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">No bank transfers found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $bankPays->onEachSide(1)->appends(['tab'=>'bank_withdraw','bank_q'=>$qBank])->links('pagination::bootstrap-5') }}
            </div>
            @endif

            {{-- Remittance tab --}}
            @if($tab==='remittance')
            <form method="GET" action="{{ route('admin.users.show', $user->id) }}" class="row g-2 align-items-center mb-3">
                <input type="hidden" name="tab" value="remittance">
                <div class="col">
                    <input type="search" class="form-control" name="remit_q" value="{{ $qRemit }}"
                        placeholder="Search (transaction/operator/account/branch/holder/amount)">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary">Search</button>
                    <a class="btn btn-outline-secondary"
                        href="{{ route('admin.users.show',['user'=>$user->id,'tab'=>'remittance']) }}">Reset</a>
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
                            <th class="text-center">Action</th>
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
                            <td class="text-center">
                                @if((int)$r->status === 0)
                                <a class="btn btn-small btn-success btn-circle mb-2"
                                    href="{{ route('remittance.approve', $r->id) }}"
                                    onclick="return confirm('Approve this remittance?')">
                                    <i class="fa fa-check"></i>
                                </a>
                                <a class="btn btn-small btn-danger btn-circle mb-2"
                                    href="{{ route('remittance.reject', $r->id) }}"
                                    onclick="return confirm('Reject this remittance?')">
                                    <i class="fa fa-times"></i>
                                </a>
                                @endif
                            </td>
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
                {{ $remittances->onEachSide(1)->appends([
                    'tab'=>'remittance',
                    'remit_q'=>$qRemit
                ])->links('pagination::bootstrap-5') }}
            </div>
            @endif


            {{-- Mobile Recharges tab --}}
            @if($tab==='recharge')
            <form method="GET" action="{{ route('admin.users.show', $user->id) }}" class="row g-2 align-items-center mb-3">
                <input type="hidden" name="tab" value="recharge">
                <div class="col">
                    <input type="search" class="form-control" name="rc_q" value="{{ $qRc }}" placeholder="Search (operator/type/mobile/amount)">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary">Search</button>
                    <a class="btn btn-outline-secondary" href="{{ route('admin.users.show',['user'=>$user->id,'tab'=>'recharge']) }}">Reset</a>
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
                            <th>Action</th>
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
                            <td class="text-center">
                                @if(@$mr->status == 0)
                                <a class="btn btn-small btn-success btn-circle  mb-2" href="{{ route('recharge.approve',$mr->id) }}"> <i class="fa fa-check"></i> </a>
                                <a class="btn btn-small btn-danger btn-circle  mb-2" href="{{ route('recharge.reject',$mr->id) }}"><i class="fa fa-times"></i></a>
                                @endif
                                <a class="btn btn-small btn-danger btn-circle  mb-2" href="{{ route('recharge.delete',$mr->id) }}"><i class="bx bx-trash"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No mobile recharges found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $mobileRecharges->onEachSide(1)->appends(['tab'=>'recharge','rc_q'=>$qRc])->links('pagination::bootstrap-5') }}
            </div>
            @endif

        </div>
    </div>
</div>
@endsection

@section('script')
@endsection