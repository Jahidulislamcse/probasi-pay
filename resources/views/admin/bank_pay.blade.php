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
    .modal-clr{
        background-color: #f1f1f1;
    }

    .image-radio-group {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .image-card {
        display: flex;
        flex-direction: column; 
        align-items: center;
        justify-content: center;
        cursor: pointer;
        width: 29%; 
        height: 150px; 
        text-align: center;
        border-radius: 10px;
        overflow: hidden;
        background-color: #ffffff;
    }

    .image-card img {
        width: 60%; 
        height: 60%;
        object-fit: cover;
    }

    .bank-name {
        margin-top: 5px; 
        font-size: 14px; 
        color: #333; 
        font-weight: bold; 
    }

    @media (max-width: 600px) {
        .image-card {
            width: 28%; 
            height: 100px; 
        }

        .bank-name {
            font-size: 9px; 
        }
    }


    .selected-bank-img {
        width: 150px;  
        height: 100px; 
        margin-bottom: 20px;
        display: none; 
        object-fit: contain;
        border-radius: 8px;
        margin: 0 auto;
    }

    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.7) !important;
    }

    #selectedBankImageModal {
        width: 100px;      
        height: 100px;     
        object-fit: contain; 
        margin: 0 auto;    
        display: block;    
    }

    .modal-header {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 15px;
    }

    .modal-title {
        margin: 0;
    }

</style>
@endsection

@section('main')

<div class="app-header st1">
    <div class="tf-container">
        <div class="tf-topbar d-flex justify-content-center align-items-center">
            <a href="{{  route('admin.index')  }}" class="back-btn"><i class="icon-left white_color"></i></a>
            <h3 class="white_color">ব্যাংক পে</h3>
        </div>
    </div>
</div>

<div class="modal fade" id="selectBankModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ব্যাংক নির্বাচন করুন</h5>
            </div>
            <div class="modal-body modal-clr">
                <div class="image-radio-group">
                    @foreach ($payable_accounts as $account)
                    <div class="image-card" data-bank="{{ $account->name }}" data-logo="{{ asset($account->logo) }}">
                        <img src="{{ asset($account->logo) }}" alt="{{ $account->name }}">
                        <p class="bank-name">{{ $account->name }}</p> 
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card-secton topup-content mt-1">
    <form id="bankForm" class="tf-form" method="post">
        @csrf
        <div class="tf-container">
            <div id="selectedBankContainer" style="text-align: center;">
                <img id="selectedBankImage" class="selected-bank-img" src="" alt="Selected Bank">
            </div>

             <input type="hidden" id="operator" name="operator" value="">
            <input type="hidden" id="pinInputHidden" name="pin" value="">

            <div id="bankFormContent" style="display: none;">
                <div class="tf-balance-box">
                    <div class="tf-form">
                        <div class="group-input input-field input-money">
                            <label for="">টাকার পরিমাণ</label>
                            <input name="amount" type="number" max="{{ auth()->user()->balance }}" value="" required class="search-field value_input st1" type="text">
                        </div>
                    </div>

                    <div class="tf-form">
                        <div class="group-input input-field input-money">
                            <label for="">ব্যাংক অ্যাকাউন্ট নম্বর দিন</label>
                            <input name="mobile" type="number" placeholder="Account Number" required>
                        </div>
                    </div>

                    <div class="tf-form">
                        <div class="group-input input-field input-money">
                            <label for="">ব্রাঞ্চের নাম লিখুন</label>
                            <input name="branch" type="text" placeholder="Branch Name" required>
                        </div>
                    </div>

                    <div class="tf-form">
                        <div class="group-input input-field input-money">
                            <label for="">অ্যাকাউন্ট হোল্ডারের নাম লিখুন</label>
                            <input name="achold" type="text" placeholder="Account Holder Name" required>
                        </div>
                    </div>
                     <h3 class="text-center" style="    margin-top: 30px;">ব্যবহারযোগ্য ব্যালেন্স: {{ currency(auth()->user()->balance) }} টাকা</h3>
                </div>

                <div class="text-center" style="margin-bottom: 30px; margin-top: 20px;">
                    <span id="openConfirm" class="small-button">এগিয়ে যান</span>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="txnConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bk-modal">
            <div class="bk-header text-center">
                <img id="selectedBankImageModal" src="" alt="Selected Bank" style="width: 100px; margin: 0 auto; display: block;">
            </div>

            <div class="bk-body">
                <div class="bk-summary">
                    <div class="bk-col">
                        <div class="up-col-title">একাউন্ট নম্বর</div>
                        <div class="bk-col-value" id="mAccount">—</div>
                    </div>
                    <div class="bk-sep"></div>
                    <div class="bk-col">
                        <div class="up-col-title">এমাউন্ট</div>
                        <div class="bk-col-value" id="mAmount">—</div>
                    </div>
                </div>

                <div class="bk-summary">
                    <div class="bk-col">
                        <div class="up-col-title">ব্যাংক</div>
                        <div class="bk-col-value" id="mType">—</div>
                    </div>
                </div>

                <div class="bk-summary">
                    <div class="bk-col">
                        <div class="up-col-title">ব্রাঞ্চ</div>
                        <div class="bk-col-value" id="branch">—</div>
                    </div>
                </div>

                <label class="bk-label" for="pinInput">পিন</label>
                <input id="pinInput" name="pin" type="password" class="form-control bk-input" placeholder="••••••" required>

                <button type="submit" style="background-color: green; color: white;" class="btn mt-3">কনফার্ম</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>
    $(document).ready(function() {
        var bankModal = new bootstrap.Modal(document.getElementById('selectBankModal'));
        bankModal.show();

        $('.image-card').on('click', function() {
            const selectedBankName = $(this).data('bank'); 
            const selectedBankLogo = $(this).data('logo'); 
            
            $('#operator').val(selectedBankName);
            $('#selectedBankImage').attr('src', selectedBankLogo).show();
            $('#selectedBankImageModal').attr('src', selectedBankLogo).show();

            $('#bankFormContent').show();
            $('#selectBankModal').modal('hide');

        });

        $('#openConfirm').on('click', function() {
            const form = document.getElementById('bankForm');
            const amount = form.elements['amount'].value.trim();
            const mobile = form.elements['mobile'].value.trim();
            const branch = form.elements['branch'].value.trim();
            const achold = form.elements['achold'].value.trim();
            
            if (!amount || !mobile || !branch || !achold) {
                form.reportValidity();
                return;
            }

            document.getElementById('mAccount').textContent = mobile;
            document.getElementById('mAmount').textContent = amount + ' টাকা';
            document.getElementById('mType').textContent = $('#operator').val(); 
            document.getElementById('branch').textContent = branch;

            const modal = new bootstrap.Modal(document.getElementById('txnConfirmModal'));
            modal.show();
        });

        $('#txnConfirmModal .btn.mt-3').on('click', function(e) {
            e.preventDefault();
            const pin = $('#pinInput').val().trim();
            $('#pinInputHidden').val(pin);
            $('#bankForm').submit();
        });
    });
</script>
@endsection

