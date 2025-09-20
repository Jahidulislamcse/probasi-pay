@extends('admin.adminLayout.master')

@section('meta')
    <title>Edit Guide - {{ @siteInfo()->company_name }}</title>
@endsection

@section('style')
    <!-- Add CKEditor CDN script for rich text editor -->
@endsection

@section('main')
    <div class="container">
        <h1>Edit Guide</h1>

        <form method="POST" action="{{ route('guides.update', $guide->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="mobile_deposit">Mobile Deposit</label>
                <textarea name="mobile_deposit" class="form-control" rows="5">{{ old('mobile_deposit', $guide->mobile_deposit) }}</textarea>
            </div>

            <div class="form-group">
                <label for="mobile_menual_deposit">Mobile Deposit</label>
                <textarea name="mobile_menual_deposit" class="form-control" rows="5">{{ old('mobile_menual_deposit', $guide->mobile_deposit) }}</textarea>
            </div>

            <div class="form-group">
                <label for="bank_deposit">Bank Deposit</label>
                <textarea name="bank_deposit" class="form-control" rows="5">{{ old('bank_deposit', $guide->bank_deposit) }}</textarea>
            </div>

            <div class="form-group">
                <label for="loan">Loan</label>
                <textarea name="loan" class="form-control" rows="5">{{ old('loan', $guide->loan) }}</textarea>
            </div>

            <div class="form-group">
                <label for="remittance">Remittance</label>
                <textarea name="remittance" class="form-control" rows="5">{{ old('remittance', $guide->remittance) }}</textarea>
            </div>

            <div class="form-group">
                <label for="how_to_balance_add">How to Add Balance</label>
                <textarea name="how_to_balance_add" class="form-control" rows="5">{{ old('how_to_balance_add', $guide->how_to_balance_add) }}</textarea>
            </div>

            <div class="form-group">
                <label for="how_to_bank_transfer">How to Bank Transfer</label>
                <textarea name="how_to_bank_transfer" class="form-control" rows="5">{{ old('how_to_bank_transfer', $guide->how_to_bank_transfer) }}</textarea>
            </div>

            <div class="form-group">
                <label for="how_to_mobile_banking">How to Use Mobile Banking</label>
                <textarea name="how_to_mobile_banking" class="form-control" rows="5">{{ old('how_to_mobile_banking', $guide->how_to_mobile_banking) }}</textarea>
            </div>

            <div class="form-group">
                <label for="about_us">About Us</label>
                <textarea name="about_us" class="form-control" rows="5">{{ old('about_us', $guide->about_us) }}</textarea>
            </div>

            <button type="submit" style="width: 150px;" class="btn btn-primary mt-4 mb-4">Save</button>

        </form>
    </div>
@endsection

@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    <!-- CKEditor Initialization for Text Areas -->
    <script>
        // Loop through all textareas and initialize CKEditor
        document.querySelectorAll('textarea').forEach(function(textarea) {
            ClassicEditor
                .create(textarea)
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endsection
