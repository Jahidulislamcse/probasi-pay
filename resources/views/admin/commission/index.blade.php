@extends('admin.adminLayout.master')

@section('meta')
<title>{{ isset($title)?$title:'welcome' }} - {{ @siteInfo()->company_name }}</title>
@endsection

@section('style')
@endsection

@section('main')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ $title ?? 'Commition List' }}</h4>
        <a href="{{ route('admin.commission.create') }}" class="btn btn-primary">Add Commition</a>
    </div>

    <div class="table-responsive">
        <table id="table" class="table table-striped table-bordered align-middle">
            <thead>
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Percentage</th>
                <th>Created</th>
                <th class="text-end">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($commitions as $i => $row)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $row->type }}</td>
                    <td>{{ rtrim(rtrim(number_format($row->percentage, 2, '.', ''), '0'), '.') }}%</td>
                    <td>{{ $row->created_at?->format('Y-m-d') }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.commission.edit', $row) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.commission.destroy', $row) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this commition?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    let table = new DataTable('#table');
</script>
@endsection
