@extends('admin.adminLayout.master')

@section('meta')
<title>{{ isset($title) ? $title : 'Mobile Banking Accounts' }} - {{ @siteInfo()->company_name }}</title>
@endsection

@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
<style>
    .toggle-buttons {
        display: flex;
        justify-content: flex-start;
        margin-bottom: 20px;
    }

    .toggle-buttons button {
        margin-right: 10px;
        border-radius: 5px;
    }

    .active {
        background-color: #007bff;
        color: white;
    }

    .toggle-section {
        display: none;
    }
</style>
@endsection

@section('main')
<div class="container mt-5">
    <h3 class="mb-4">Add or Update Payment Accounts</h3>

    <!-- Toggle Buttons -->
    <div class="toggle-buttons">
        <button class="btn btn-primary" id="mobileBankingBtn" onclick="toggleSection('mobileBanking')">Add/Update Mobile Banking</button>
        <button class="btn btn-secondary" id="bankAccountBtn" onclick="toggleSection('bankAccount')">Add/Update Bank Account</button>
    </div>

    <!-- Toggle Section for Mobile Banking -->
    <div id="mobileBankingSection" class="toggle-section">
        <form action="{{ route('menual-payment.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="mobile_banking">Mobile Banking</label>
                <select name="mobile_banking" id="mobile_banking" class="form-control" required>
                    <option value="">Select Mobile Banking</option>
                    <option value="bkash">bKash</option>
                    <option value="nagad">Nagad</option>
                    <option value="rocket">Rocket</option>
                    <option value="upay">Upay</option>
                </select>
            </div>

            <div class="form-group" id="phoneField">
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter phone number" required>
            </div>

            <button type="submit" class="btn btn-success mt-3">Save</button>
        </form>
    </div>

    <!-- Toggle Section for Bank Accounts -->
    <div id="bankAccountSection" class="toggle-section">
        <form action="{{ route('menual-payment.store') }}" method="POST">
            @csrf
            <div class="form-group" id="bankField">
                <label for="bank">Bank</label>
                <select name="bank" id="bank" class="form-control">
                    <option value="">Select Bank</option>
                    <option value="brac">BRAC Bank</option>
                    <option value="dbbl">DBBL</option>
                    <option value="prime">Prime Bank</option>
                    <option value="scb">Standard Chartered</option>
                    <option value="abbl">AB Bank</option>
                    <option value="aub">Asian United Bank</option>
                    <option value="bankasialtd">Bank Asia Ltd</option>
                    <option value="bbl">Bangladesh Bank Ltd</option>
                    <option value="bb">Bangladesh Bank</option>
                    <option value="bis">Bangladesh Industrial Finance Corporation (BIFC)</option>
                    <option value="brac">BRAC Bank Limited</option>
                    <option value="citibank">Citibank N.A.</option>
                    <option value="dhaka">Dhaka Bank</option>
                    <option value="exim">EXIM Bank Limited</option>
                    <option value="fazal">Fazal & Co.</option>
                    <option value="hsbc">HSBC Bank</option>
                    <option value="islamicbank">Islamic Bank Bangladesh Ltd</option>
                    <option value="jpmorgan">JPMorgan Chase Bank</option>
                    <option value="mercantile">Mercantile Bank Limited</option>
                    <option value="mutual">Mutual Trust Bank Ltd</option>
                    <option value="nbl">National Bank Limited</option>
                    <option value="pbl">Premier Bank Limited</option>
                    <option value="scb">Standard Chartered Bank</option>
                    <option value="sbl">Sonali Bank</option>
                    <option value="sibl">Shahjalal Islami Bank Ltd</option>
                    <option value="upl">United Commercial Bank</option>
                    <option value="uab">United Bank Limited</option>
                    <option value="uttara">Uttara Bank Limited</option>
                    <option value="jamuna">Jamuna Bank Limited</option>
                </select>
            </div>

            <div class="form-group" id="accountFields">
                <label for="routing_number">Routing Number</label>
                <input type="text" class="form-control" id="routing_number" name="routing_number" placeholder="Enter Routing Number" required>

                <label for="account_number" class="mt-2">Account Number</label>
                <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Enter Account Number" required>
            </div>

            <button type="submit" class="btn btn-success mt-3">Save</button>
        </form>
    </div>
</div>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.toggle-section').hide();
        $('#mobileBankingBtn').removeClass('active');
        $('#bankAccountBtn').removeClass('active');


      window.toggleSection = function (section) {
        if ($('#' + section + 'Section').is(':visible')) {
            $('#' + section + 'Section').hide();
            $('#' + section + 'Btn').removeClass('active');
        } else {
        $('.toggle-section').hide();
        $('#mobileBankingBtn').removeClass('active');
        $('#bankAccountBtn').removeClass('active');

        $('#' + section + 'Section').show();

        if (section === 'mobileBanking') {
            $('#mobileBankingBtn').addClass('active');
        } else {
            $('#bankAccountBtn').addClass('active');
        }

        if (section === 'mobileBanking') {
            $('#mobile_banking').prop('required', true);
            $('#phone_number').prop('required', true);
            $('#bankField').hide();
            $('#accountFields').hide();
            $('#routing_number').prop('required', false);
            $('#account_number').prop('required', false);
        } else {
            $('#mobile_banking').prop('required', false);
            $('#phone_number').prop('required', false);
            $('#bankField').show();
            $('#accountFields').show();
            $('#routing_number').prop('required', true);
            $('#account_number').prop('required', true);
        }
    }
};


        $('#mobile_banking, #bank').change(function () {
            var gateway = $(this).val();

            $('#phone_number').val('');
            $('#routing_number').val('');
            $('#account_number').val('');

            if (gateway) {
                $.ajax({
                    url: '{{ route('get-payment-data') }}',
                    method: 'GET',
                    data: { gateway: gateway },
                    success: function (response) {
                        if (response) {
                            $('#phone_number').val('');
                            $('#routing_number').val('');
                            $('#account_number').val('');

                            if (response.gateway && response.number) {
                                $('#phone_number').val(response.number || '');
                            }

                            if (response.gateway && response.routing_number && response.account_number) {
                                $('#routing_number').val(response.routing_number || '');
                                $('#account_number').val(response.account_number || '');
                            }
                        }
                    }

                });
            }
        });
    });
</script>
@endsection
