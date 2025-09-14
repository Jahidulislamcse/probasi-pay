@extends('admin.adminLayout.master')

@section('meta')
<title>{{ isset($title)?$title:'welcome' }} - {{ @siteInfo()->company_name }}</title>
@endsection

@section('main')
<div class="container-fluid">
    <h4 class="mb-3">{{ $title ?? 'Create Commition' }}</h4>

    <form action="{{ route('admin.commission.store') }}" method="POST" class="card card-body">
        @csrf

        @include('admin.commission.partials._form', ['button' => 'Create'])

    </form>
</div>
@endsection

@section('script')
<script type="text/javascript">
    // no table on this page; left for consistency
</script>
@endsection
