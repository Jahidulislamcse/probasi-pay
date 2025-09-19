@extends('admin.adminLayout.master')
@section('meta')
    <title>Create Payable Account - {{ @siteInfo()->company_name }}</title>
@endsection

@section('style')

@endsection

@section('main')
    <div class="container">
        <h1>Create Guide</h1>

        <form method="POST" action="{{ route('guides.store') }}">
            @csrf

            <div class="form-group">
                <label for="mobile_deposit">Mobile Deposit</label>
                <textarea name="mobile_deposit" class="form-control" rows="5">{{ old('mobile_deposit') }}</textarea>
            </div>

            <div class="form-group">
                <label for="bank_deposit">Bank Deposit</label>
                <textarea name="bank_deposit" class="form-control" rows="5">{{ old('bank_deposit') }}</textarea>
            </div>

            <div class="form-group">
                <label for="loan">Loan</label>
                <textarea name="loan" class="form-control" rows="5">{{ old('loan') }}</textarea>
            </div>

            <div class="form-group">
                <label for="remittance">Remittance</label>
                <textarea name="remittance" class="form-control" rows="5">{{ old('remittance') }}</textarea>
            </div>

            <div class="form-group">
                <label for="how_to_balance_add">How to Add Balance</label>
                <textarea name="how_to_balance_add" class="form-control" rows="5">{{ old('how_to_balance_add') }}</textarea>
            </div>

            <div class="form-group">
                <label for="how_to_bank_transfer">How to Bank Transfer</label>
                <textarea name="how_to_bank_transfer" class="form-control" rows="5">{{ old('how_to_bank_transfer') }}</textarea>
            </div>

            <div class="form-group">
                <label for="how_to_mobile_banking">How to Use Mobile Banking</label>
                <textarea name="how_to_mobile_banking" class="form-control" rows="5">{{ old('how_to_mobile_banking') }}</textarea>
            </div>

            <div class="form-group">
                <label for="about_us">About Us</label>
                <textarea name="about_us" class="form-control" rows="5">{{ old('about_us') }}</textarea>
            </div>

            <button type="submit" style="width: 150px;" class="btn btn-primary mt-4 mb-4">Save</button>
        </form>
    </div>
@endsection
@section('script')
    <script src="https://cdn.tiny.cloud/1/g4ey3kcg0n64dzmmh0maa5ubocx61oj7sgbkeiy16qsu5cqp/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',  
            plugins: 'lists link image table code emoticons',  
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | outdent indent | link image emoticons code',  // Customize the toolbar
            menubar: false,  
        });
    </script>
@endsection

