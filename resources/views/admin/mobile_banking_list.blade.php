@extends('admin.adminLayout.master')
@section('meta')

<title>{{ isset($title)?$title:'welcome' }} - {{ @siteInfo()->company_name }}</title>



@endsection
@section('style')




@endsection
@section('main')



<div class="row" style="overflow: scroll;">

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">

                <table id="table" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>

                            <th>Date</th>
                            <th>Transaction ID</th>
                            <th>User</th>
                            <th>Phone</th>
                            <th>Amount</th>
                            <th>Operator</th>
                            <th>Type</th>
                            <th>Pin</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lists as $list)
                        <tr>

                            <td>{!! Illuminate\Support\Carbon::parse(@$list->created_at)->format('d-m-Y') !!}</td>
                            <td>{{ @$list->transaction_id }} </td>
                            <td>{{ @$list->user->name }} <br>
                                {{ @$list->user->phone }}
                            </td>
                            <td>{{ @$list->mobile }} </td>
                            <td>{{ @$list->amount }} </td>
                            <td>{{ @$list->operator }} </td>
                            <td>{{ @$list->type }} </td>
                            <td>{{ @$list->pin }} </td>
                            <td>{!! @$list->status() !!}</td>
                            <td class="text-center">
                                @if(@$list->status == 0)
                                    <button type="button" class="btn btn-small btn-success btn-circle mb-2"
                                            onclick="showPinModal('{{ route('mobilebankinglist.approve', $list->id) }}')">
                                        <i class="fa fa-check"></i>
                                    </button>
                                    <a class="btn btn-small btn-danger btn-circle mb-2" href="{{ route('mobilebankinglist.reject', $list->id) }}" onclick="return confirmAction('reject')">
                                        <i class="fa fa-times"></i>
                                    </a>
                                @endif
                                <!-- <a class="btn btn-small btn-danger btn-circle mb-2" href="{{ route('mobilebankinglist.delete', $list->id) }}" onclick="return confirmAction('delete')">
                                    <i class="bx bx-trash"></i>
                                </a> -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pinModal" tabindex="-1" aria-labelledby="pinModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
            <form id="pinForm" method="POST" action="">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="pinModalLabel">Enter PIN / Agent Last numbers</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <input type="password" name="pin" class="form-control" placeholder="Enter PIN" required>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    let table = new DataTable('#table',{
        order:false,
    });

</script>

<script>
    function confirmAction(action) {
        let message = '';
        switch(action) {
            case 'approve':
                message = 'Are you sure you want to approve this?';
                break;
            case 'reject':
                message = 'Are you sure you want to reject this?';
                break;
            case 'delete':
                message = 'Are you sure you want to delete this?';
                break;
        }
        return confirm(message);
    }
</script>

<script>
    function showPinModal(url) {
        document.getElementById('pinForm').action = url;
        var pinModal = new bootstrap.Modal(document.getElementById('pinModal'));
        pinModal.show();
    }
</script>


@endsection
