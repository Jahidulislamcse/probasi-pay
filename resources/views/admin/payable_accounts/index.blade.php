@extends('admin.adminLayout.master')
@section('meta')
    <title>{{ isset($title)?$title:'Payable Accounts' }} - {{ @siteInfo()->company_name }}</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/dataTable.css') }}">
@endsection

@section('main')
    <div class="container mt-4">
        <h2>Payable Accounts</h2>
        <a href="{{ route('admin.payable_accounts.create') }}" class="btn btn-primary">Create New Account</a>
        <table id="table" class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Logo</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $account)
                    <tr>
                        <td>{{ $account->name }}</td>
                        <td><img src="{{ asset($account->logo) }}" width="50" alt="Logo"></td>
                        <td>{{ $account->type }}</td>
                        <td>
                            <a href="{{ route('admin.payable_accounts.edit', $account->id) }}" class="btn btn-warning">Edit</a>
                             <form action="{{ route('admin.payable_accounts.destroy', $account->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this account?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        let table = new DataTable('#table');
    </script>
@endsection
