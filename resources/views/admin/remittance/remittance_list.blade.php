@extends('admin.adminLayout.master')

@section('meta')
<title>{{ isset($title)?$title:'welcome' }} - {{ @siteInfo()->company_name }}</title>
@endsection

@section('style')
{{-- any custom styles if needed --}}
@endsection

@section('main')
<div class="row" style="overflow: scroll;">
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">

                <table id="table" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Transaction ID</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Information</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($lists as $list)
                        <tr>
                            <td>{!! \Illuminate\Support\Carbon::parse(@$list->created_at)->format('d-m-Y') !!}</td>
                            <td>{{ @$list->transaction_id }}</td>
                            <td>
                                {{ @$list->user->name }}
                                <br>
                                {{ @$list->user->phone }}
                            </td>
                            <td>{{ number_format(@$list->amount, 2) }}</td>
                            <td>
                                {{ @$list->operator }}<br>
                                {{ @$list->branch }}<br>
                                Ac Holder: {{ @$list->achold }}<br>
                                Ac No: {{ @$list->account }}
                            </td>

                            <td>{!! @$list->status() !!}</td>

                            <td class="text-center">
                                @if(@$list->status == 0)
                                <a class="btn btn-small btn-success btn-circle mb-2"
                                    href="{{ route('remittance.approve', $list->id) }}"
                                    onclick="return confirmAction('approve')">
                                    <i class="fa fa-check"></i>
                                </a>

                                <a class="btn btn-small btn-danger btn-circle mb-2"
                                    href="{{ route('remittance.reject', $list->id) }}"
                                    onclick="return confirmAction('reject')">
                                    <i class="fa fa-times"></i>
                                </a>
                                @endif

                                {{-- Optional hard delete --}}
                                {{--
                <a class="btn btn-small btn-danger btn-circle mb-2"
                   href="{{ route('remittance.delete', $list->id) }}"
                                onclick="return confirmAction('delete')">
                                <i class="bx bx-trash"></i>
                                </a>
                                --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    let table = new DataTable('#table', {
        order: false
    });
</script>

<script type="text/javascript">
    function confirmAction(action) {
        let message = '';
        if (action === 'approve') {
            message = 'Are you sure you want to approve this transaction?';
        } else if (action === 'reject') {
            message = 'Are you sure you want to reject this transaction?';
        } else if (action === 'delete') {
            message = 'Are you sure you want to delete this record?';
        }
        return confirm(message);
    }
</script>
@endsection