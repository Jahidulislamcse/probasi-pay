@extends('admin.adminLayout.master')
@section('meta')
    <title>Edit Payable Account - {{ @siteInfo()->company_name }}</title>
@endsection

@section('style')

@endsection

@section('main')
    <div class="container mt-4">
        <h2>Edit Payable Payment Method</h2>

        <form action="{{ route('admin.payable_accounts.update', $account->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Method</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $account->name }}" required>
            </div>

            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" id="logo" name="logo" class="form-control">
                @if($account->logo)
                    <img src="{{ asset($account->logo) }}" width="50" alt="Logo">
                @endif
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="mobile_banking" {{ $account->type == 'mobile_banking' ? 'selected' : '' }}>Mobile Banking</option>
                    <option value="bank_account" {{ $account->type == 'bank_account' ? 'selected' : '' }}>Bank Account</option>
                </select>
            </div>


            <button type="submit" class="btn btn-success mt-3">Update Account</button>
        </form>
    </div>
@endsection

@section('script')

@endsection
