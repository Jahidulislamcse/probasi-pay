@extends('admin.adminLayout.master')
@section('meta')
    <title>Create Payable Account - {{ @siteInfo()->company_name }}</title>
@endsection

@section('style')

@endsection

@section('main')
    <div class="container mt-4">
        <h2>Create Payable Payment Method</h2>

        <form action="{{ route('admin.payable_accounts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Method</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" id="logo" name="logo" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="">Select Account Type</option>
                    <option value="mobile_banking">Mobile Banking</option>
                    <option value="bank_account">Bank Account</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success mt-3">Create Account</button>
        </form>
    </div>
@endsection

@section('script')

@endsection
