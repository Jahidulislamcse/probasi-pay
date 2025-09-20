@extends('admin.adminLayout.master')

@section('meta')
    <title>Create Payable Account - {{ @siteInfo()->company_name }}</title>
@endsection

@section('style')
    <style>
        .table td {
            color: black;
        }
    </style>
@endsection

@section('main')
    <div class="container">
        <h1>Guide</h1>

        @if ($guide)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Section</th>
                        <th>Content</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td><strong>Mobile Deposit</strong></td><td>{!! $guide->mobile_deposit !!}</td></tr>
                    <tr><td><strong>Bank Deposit</strong></td><td>{!! $guide->bank_deposit !!}</td></tr>
                    <tr><td><strong>Loan</strong></td><td>{!! $guide->loan !!}</td></tr>
                    <tr><td><strong>Remittance</strong></td><td>{!! $guide->remittance !!}</td></tr>
                    <tr><td><strong>How to Add Balance</strong></td><td>{!! $guide->how_to_balance_add !!}</td></tr>
                    <tr><td><strong>How to Bank Transfer</strong></td><td>{!! $guide->how_to_bank_transfer !!}</td></tr>
                    <tr><td><strong>How to Use Mobile Banking</strong></td><td>{!! $guide->how_to_mobile_banking !!}</td></tr>
                    <tr><td><strong>About Us</strong></td><td>{!! $guide->about_us !!}</td></tr>
                </tbody>
            </table>

            {{-- Update button under the table --}}
            <div class="mt-4 mb-4" >
                <a href="{{ route('guides.edit', $guide->id) }}" class="btn btn-primary" style="width: 150px;">
                    Update
                </a>
            </div>
        @else
            <p>No guide information available.</p>
            <div class="mt-3">
                <a href="{{ route('guides.create') }}" class="btn btn-success">
                    Create Guide
                </a>
            </div>
        @endif
    </div>
@endsection

@section('script')
<script src="https://cdn.tiny.cloud/1/g4ey3kcg0n64dzmmh0maa5ubocx61oj7sgbkeiy16qsu5cqp/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'lists link image table code emoticons',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | outdent indent | link image emoticons code',
        menubar: false,
    });
</script>
@endsection
