<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

@extends('admin.layout.master')

@section('meta') @endsection
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
    .image-radio-group {
        display: inline-flex;
        flex-wrap: nowrap;
        gap: 4px;
        margin-bottom: 20px;
    }

    .image-radio {
        position: relative;
        width: 65px;
        background: #fff;
        border-radius: 5px;
    }

    .image-radio input[type="radio"] {
        display: none;
    }

    .image-radio img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border: 2px solid transparent;
        border-radius: 8px;
        cursor: pointer;
        transition: border .3s;
        padding: 5px;
        margin: 0 auto;
        display: block;
    }

    .image-radio input[type="radio"]:checked+img {
        border: 2px solid #067fab;
        background: #067fab;
    }

    .section-title {
        color: #000;
        font-weight: 700;
        margin: 12px 0 4px;
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 12px;
        margin-top: 4px;
    }
    .s-button {
        padding: 8px 15px; 
        font-size: 14px; 
        border: none; 
        width: 50%;
        border-radius: 20px; 
        background-color: #4CAF50; 
        color: white; 
        cursor: pointer; 
        transition: background-color 0.3s ease, transform 0.2s ease; 
    }

    .s-button:hover {
        background-color: #45a049; 
        color: #000;
    }

    .s-button:focus {
        outline: none; 
    }

</style>

<style>
    .toggle-btn {
        background-color: #fff;
        color: #000;
        border: 1px solid #067fab;
        padding: 8px 0;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .toggle-btn.active {
        background-color: #067fab;
        color: #fff;
    }

    .toggle-btn:not(.active):hover {
        background-color: #fff;
        color: #067fab;
    }
</style>

@endsection

@section('main')
<div class="preload preload-container">
    <div class="preload-logo">
        <div class="spinner"></div>
    </div>
</div>

<div class="app-header st1">
    <div class="tf-container">
        <div class="tf-topbar d-flex justify-content-center align-items-center">
            <a href="{{ route('admin.index') }}" class="back-btn"><i class="icon-left white_color"></i></a>
            <h3 class="white_color">রেমিটেন্স</h3>
        </div>
    </div>
</div>


<div class="card-secton topup-content mt-2">
    <form id="remitForm" class="tf-form" method="post">
        @csrf
        <div class="tf-container">
            <div class="tf-balance-box">

                <div class="section-title">অ্যাকাউন্ট নির্বাচন করুন</div>

                <div class="gap-4 btn-group mb-3" role="group" style="width:100%;">
                    <button type="button" id="toggleMobile" class="toggle-btn active" style="width:50%;">মোবাইল ব্যাংকিং</button>
                    <button type="button" id="toggleBank" class="toggle-btn" style="width:50%;">ব্যাংক অ্যাকাউন্ট</button>
                </div>

                @if($mobile_accounts->count())
                <div id="mobileSection" style="overflow-x:auto;">
                    <div class="image-radio-group">
                        @foreach ($mobile_accounts as $account)
                        <label class="image-radio">
                            <input type="radio" name="operator" value="{{ $account->name }}">
                            <img src="{{ asset($account->logo) }}" alt="{{ $account->name }}">
                            <p class="text-center" style="color:#000;">{{ $account->name }}</p>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($bank_accounts->count())
                <div id="bankSection" style="overflow-x:auto; display:none;">
                    <div class="image-radio-group">
                        @foreach ($bank_accounts as $account)
                        <label class="image-radio">
                            <input type="radio" name="operator" value="{{ $account->name }}">
                            <img src="{{ asset($account->logo) }}" alt="{{ $account->name }}">
                            <p class="text-center" style="color:#000;">{{ $account->name }}</p>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="tf-form">
                    <div class="group-input input-field input-money">
                        <label for="">টাকার পরিমাণ</label>
                        <input
                            name="amount"
                            type="number"
                            min="1"
                            step="1"
                            max="{{ min(auth()->user()->balance, 25000) }}"
                            data-balance="{{ auth()->user()->balance }}"
                            data-hardmax="25000"
                            required
                            value="{{ old('amount') }}"
                            class="search-field value_input st1 {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                            title="Max: {{ min(auth()->user()->balance, 25000) }}">
                        <span class="icon-clear"></span>
                    </div>

                    @error('amount')
                    <div class="invalid-feedback" style="display:block">{{ $message }}</div>
                    @enderror

                    <div id="amountWarning" class="invalid-feedback" style="display:none"></div>
                </div>


                <div class="tf-form">
                    <div class="group-input input-field input-money">
                        <label for="">অ্যাকাউন্ট / মোবাইল নম্বর</label>
                        <input name="account" type="number" placeholder="Account / Wallet Number" required>
                        <span class="icon-clear"></span>
                    </div>
                </div>

                <div class="tf-form">
                    <div class="group-input input-field input-money">
                        <label for="">ব্রাঞ্চ (ব্যাংকের ক্ষেত্রে)</label>
                        <input name="branch" type="text" placeholder="Branch (optional)">
                        <span class="icon-clear"></span>
                    </div>
                </div>

                <div class="tf-form">
                    <div class="group-input input-field input-money">
                        <label for="">রিসিভারের নাম</label>
                        <input name="achold" type="text" placeholder="Recipient Name" required>
                        <span class="icon-clear"></span>
                    </div>
                </div>

            </div>
            <span class="white_color text-center" style="padding:5px 0;border-radius:10px;font-size:18px;font-weight:normal;display:block; margin-bottom:15px;">
                @php
                    $guide = \App\Models\Guide::first();
                @endphp
                @if(!empty($guide->remittance))
                    {!! $guide->remittance !!}
                @endif
            </span>

            <h3 class="text-center" style="margin-top:30px;">
                ব্যবহারযোগ্য ব্যালেন্স: {{ currency(auth()->user()->balance) }} টাকা
            </h3>
        </div>

        <div class="text-center" style="margin:30px;">
            <span id="openRemitConfirm" class="small-button">এগিয়ে যান</span>
        </div>




        <div class="modal fade" id="remitConfirmModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bk-modal">
                    <div class="bk-header" style="display:flex;justify-content:center;align-items:center;gap:5px;">
                        <div class="bk-brand"><span class="bank-text">রেমিটেন্স</span></div>
                        <div class="bk-title">| টাকা পাঠান</div>
                    </div>

                    <div class="bk-body">
                        <div class="bk-summary">
                            <div class="bk-col">
                                <div class="bank-col-title">অ্যাকাউন্ট/ওয়ালেট</div>
                                <div class="bk-col-value" id="mAccount">—</div>
                            </div>
                            <div class="bk-sep"></div>
                            <div class="bk-col">
                                <div class="bank-col-title">এমাউন্ট</div>
                                <div class="bk-col-value" id="mAmount">—</div>
                            </div>
                        </div>

                        <div class="bk-summary">
                            <div class="bk-col">
                                <div class="bank-col-title">রিসিভারের নাম</div>
                                <div class="bk-col-value" id="mAchold">—</div>
                            </div>
                            <div class="bk-sep"></div>
                            <div class="bk-col">
                                <div class="bank-col-title">ব্রাঞ্চ</div>
                                <div class="bk-col-value" id="mBranch">—</div>
                            </div>
                        </div>

                        <div class="bk-summary">
                            <div class="bk-col">
                                <div class="bank-col-title">চ্যানেল</div>
                                <div class="bk-col-value" id="mOperator">—</div>
                            </div>
                        </div>

                        <label class="bk-label" for="pinInput">পিন</label>
                        <input id="pinInput" name="pin" type="password" class="form-control bk-input" placeholder="••••••" required>

                        <button type="submit" class="btn bank-btn mt-3">কনফার্ম</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="text-center" style="margin:30px; display:flex; gap:10px; justify-content:center;">
        <button type="button" class="s-button" data-bs-toggle="modal" data-bs-target="#remitHistoryModal">
            পূর্বের রেমিটেন্স
        </button>
    </div>


    <div class="modal fade" id="remitHistoryModal" tabindex="-1" aria-labelledby="remitHistoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="remitHistoryModalLabel">পূর্বের রেমিটেন্স অনুরোধসমূহ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row custom-scroll-section">
                        <div class="col-12">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-content widget-content-area">

                                    <div class="table-responsive">
                                        <table id="table" class="table table-striped table-hover w-100">
                                            <thead>
                                                <tr>
                                                    <th style="white-space:nowrap">তারিখ</th>
                                                    <th>ট্রানজেকশন আইডি</th>
                                                    <th>চ্যানেল</th>
                                                    <th class="text-end">এমাউন্ট</th>
                                                    <th>অ্যাকাউন্ট/ওয়ালেট</th>
                                                    <th>স্ট্যাটাস</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($remittances as $r)
                                                    @php
                                                        $statusText = match((int)$r->status) {
                                                            1 => 'Approved',
                                                            2 => 'Rejected',
                                                            default => 'Pending',
                                                        };
                                                        $badgeClass = match((int)$r->status) {
                                                            1 => 'bg-success',
                                                            2 => 'bg-danger',
                                                            default => 'bg-warning text-dark',
                                                        };
                                                    @endphp
                                                    <tr>
                                                        <td style="white-space:nowrap">{{ $r->created_at?->format('d M Y, h:i A') }}</td>
                                                        <td><code class="selectable">{{ $r->transaction_id }}</code></td>
                                                        <td>{{ $r->operator }}</td>
                                                        <td class="text-end">{{ number_format($r->amount, 2) }}</td>
                                                        <td>{{ $r->account }}</td>
                                                        <td><span class="badge {{ $badgeClass }}">{{ $statusText }}</span></td>
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
    </div>

</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.location.hash === '#remitHistoryModal') {
            const modal = new bootstrap.Modal(document.getElementById('remitHistoryModal'));
            modal.show();
        }

        document.querySelectorAll('#remitHistoryModal .pagination a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.href + '#remitHistoryModal';
                window.location.href = url;
            });
        });
    });
</script>
<script>
    document.getElementById('openRemitConfirm').addEventListener('click', function() {
        const form = document.getElementById('remitForm');
        const amount = form.elements['amount'].value.trim();
        const account = form.elements['account'].value.trim();
        const branch = form.elements['branch'].value.trim();
        const achold = form.elements['achold'].value.trim();
        const operatorEl = document.querySelector('input[name="operator"]:checked');
        const operator = operatorEl ? operatorEl.value : "Not selected";

        if (!amount || !account || !achold || operator === "Not selected") {
            form.reportValidity();
            return;
        }

        document.getElementById('mAccount').textContent = account;
        document.getElementById('mAmount').textContent = amount + ' টাকা';
        document.getElementById('mAchold').textContent = achold;
        document.getElementById('mBranch').textContent = branch || '—';
        document.getElementById('mOperator').textContent = operator;

        document.getElementById('pinInput').value = '';

        const modal = new bootstrap.Modal(document.getElementById('remitConfirmModal'));
        modal.show();
    });
</script>

<script>
    (function() {
        const form = document.getElementById('remitForm');
        const amountInput = form.elements['amount'];
        const warningEl = document.getElementById('amountWarning');
        const balance = parseFloat(amountInput.dataset.balance || '0');
        const hardMax = parseFloat(amountInput.dataset.hardmax || '25000');
        const limit = Math.min(balance, hardMax);

        function validateAmount(showBrowserValidity = false) {
            const raw = amountInput.value.trim();
            const v = raw === '' ? NaN : parseFloat(raw);
            let msg = '';

            if (isNaN(v) || v < 1) {
                msg = 'টাকার পরিমাণ অবশ্যই দিতে হবে এবং ন্যূনতম ১ হতে হবে।';
            } else if (v > hardMax) {
                msg = `টাকার পরিমাণ ${hardMax} এর বেশি হতে পারবে না।`;
            } else if (v > balance) {
                msg = 'টাকার পরিমাণ আপনার উপলব্ধ ব্যালেন্সের বেশি হতে পারবে না।';
            }

            // Visuals + (optional) browser validity
            if (msg) {
                amountInput.classList.add('is-invalid');
                warningEl.textContent = msg;
                warningEl.style.display = 'block';
                if (showBrowserValidity) {
                    amountInput.setCustomValidity(msg);
                }
                return false;
            } else {
                amountInput.classList.remove('is-invalid');
                warningEl.textContent = '';
                warningEl.style.display = 'none';
                amountInput.setCustomValidity(''); // clear any previous message
                return true;
            }
        }

        // Don’t clamp; just validate and show warning while typing
        amountInput.addEventListener('input', function() {
            validateAmount(false);
        });

        document.getElementById('openRemitConfirm').addEventListener('click', function() {
            const okAmount = validateAmount(true);

            const account = form.elements['account'].value.trim();
            const achold = form.elements['achold'].value.trim();
            const branch = form.elements['branch'].value.trim();
            const operatorEl = document.querySelector('input[name="operator"]:checked');
            const operator = operatorEl ? operatorEl.value : "Not selected";

            // If amount invalid OR required fields missing, block and show native messages
            if (!okAmount || !account || !achold || operator === "Not selected") {
                form.reportValidity();
                return;
            }

            // Fill modal (safe: amount passed validation)
            document.getElementById('mAccount').textContent = account;
            document.getElementById('mAmount').textContent = amountInput.value + ' টাকা';
            document.getElementById('mAchold').textContent = achold;
            document.getElementById('mBranch').textContent = branch || '—';
            document.getElementById('mOperator').textContent = operator;

            document.getElementById('pinInput').value = '';

            const modal = new bootstrap.Modal(document.getElementById('remitConfirmModal'));
            modal.show();
        });
    })();
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleMobile = document.getElementById("toggleMobile");
        const toggleBank = document.getElementById("toggleBank");
        const mobileSection = document.getElementById("mobileSection");
        const bankSection = document.getElementById("bankSection");

        function activateToggle(activeBtn, inactiveBtn, showSection, hideSection) {
            activeBtn.classList.add("active");
            inactiveBtn.classList.remove("active");
            showSection.style.display = "block";
            hideSection.style.display = "none";
        }

        toggleMobile.addEventListener("click", function() {
            activateToggle(toggleMobile, toggleBank, mobileSection, bankSection);
        });

        toggleBank.addEventListener("click", function() {
            activateToggle(toggleBank, toggleMobile, bankSection, mobileSection);
        });
    });
</script>


@endsection