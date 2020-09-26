@extends('template.dashboard.backup')

@section('content')
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid" data-codepage="{{$code_page}}">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <div id="listTransaction_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-12">
                            <table id="listTransaksi" class="table table-hover table-striped data no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="listTransaction_info">
                                <thead>
                                    <tr role="row">
                                        <th></th>
                                        <th width="40%">Invoice</th>
                                        <th width="20%">Pembeli</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($transactions))
                                    @foreach($transactions as $key=>$transaction)
                                    <tr role="row" class="odd">
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <small class="date">
                                                <span class="far fa-clock"></span> {{$transaction->ti_created_at}} WIB
                                            </small><br>
                                            {{$transaction->ti_code_order}}<br>
                                            @if($transaction->ti_id_status == -1)
                                            <span class="label label-danger">Expired</span>
                                            @elseif($transaction->ti_id_status == -2)
                                            <span class="label label-danger">Failed</span>
                                            @elseif($transaction->ti_id_status == 0)
                                            <span class="label label-warning">Unpaid</span>
                                            @elseif($transaction->ti_id_status == 1)
                                            <span class="label label-info">Paid</span>
                                            @elseif($transaction->ti_id_status == 2)
                                            <span class="label label-primary">Deliver</span>
                                            @elseif($transaction->ti_id_status == 3)
                                            <span class="label label-success">Success</span>
                                            @endif
                                        </td>
                                        <td>{{$transaction->ti_firstname}} {{$transaction->ti_lastname}}</td>
                                        <td>
                                            <a href="{{route('transaksi.user.detail', $transaction)}}" class="btn btn-primary btn-sm waves-effect waves-light" role="button" aria-pressed="true"><i class="fa as fas fa-search-plus"></i> Detail</a>
                                            <button class="btn btn-info btn-sm waves-effect waves-light upd-receipt" data-toggle="modal" data-target="#{{$transaction->ti_code_order}}" type="button"><span class="btn-label"><i class="icon icon-doc"></i></span>
                                                Resi</button>
                                            <div id="{{$transaction->ti_code_order}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Input Resi Pengiriman</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="update-receipt" method="POST" action="{{route('transaksi.user.editreceipt', $transaction)}}">
                                                                @csrf
                                                                {{method_field('PUT')}}
                                                                <input type="hidden" id="ti_code_order" name="ti_code_order" value="{{$transaction->ti_code_order}}">
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="control-label">Recipient:</label>
                                                                    <input type="text" class="form-control" id="ti_receipt" name="ti_receipt" value="{{$transaction->ti_receipt}}">
                                                                </div>
                                                                <button type="submit" class="btn btn-danger waves-effect waves-light">Save changes</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($transaction->ti_id_status == 0 || $transaction->ti_id_status == -1)
                                            <form action="{{route('transaksi.user.approve', $transaction)}}" class="d-inline-block" method="POST">
                                                @csrf
                                                {{method_field('PUT')}}
                                                <button class="btn btn-success btn-sm waves-effect waves-light approve-trans" type="submit"><span class="btn-label"><i class="icon icon-check"></i></span>
                                                    Approve</button>
                                            </form>
                                            @endif
                                            @if($transaction->ti_id_status == 1 || $transaction->ti_id_status == 2)
                                            <form action="{{route('transaksi.user.unapprove', $transaction)}}" class="d-inline-block" method="POST">
                                                @csrf
                                                {{method_field('PUT')}}
                                                <button class="btn btn-danger btn-sm waves-effect waves-light approve-trans" type="submit"><span class="btn-label"><i class="icon icon-check"></i></span>
                                                    UnApprove</button>
                                            </form>
                                            @endif
                                            @if($transaction->ti_id_status == 0 || $transaction->ti_id_status == -1 || $transaction->ti_id_status == -2)
                                            <form action="{{route('transaksi.delete', $transaction)}}" method="POST" class="d-inline-block">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button class="btn btn-danger btn-sm waves-effect waves-light del-product" type="submit"><span class="btn-label"></span>
                                                    Hapus</button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    @foreach($transaction_guest as $key=>$transaction)
                                    <tr role="row" class="odd">
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <small class="date">
                                                <span class="far fa-clock"></span> {{$transaction->tig_created_at}} WIB
                                            </small><br>
                                            {{$transaction->tig_code_order}}<br>
                                            @if($transaction->tig_id_status == -1)
                                            <span class="label label-danger">Expired</span>
                                            @elseif($transaction->tig_id_status == -2)
                                            <span class="label label-danger">Failed</span>
                                            @elseif($transaction->tig_id_status == 0)
                                            <span class="label label-warning">Unpaid</span>
                                            @elseif($transaction->tig_id_status == 1)
                                            <span class="label label-info">Paid</span>
                                            @elseif($transaction->tig_id_status == 2)
                                            <span class="label label-primary">Deliver</span>
                                            @elseif($transaction->tig_id_status == 3)
                                            <span class="label label-success">Success</span>
                                            @endif
                                        </td>
                                        <td>{{$transaction->tig_firstname}} {{$transaction->tig_lastname}}</td>
                                        <td>
                                            <a href="{{route('transaksi.guest.detail', $transaction)}}" class="btn btn-primary btn-sm waves-effect waves-light" role="button" aria-pressed="true"><i class="fa as fas fa-search-plus"></i> Detail</a>
                                            <button class="btn btn-info btn-sm waves-effect waves-light upd-receipt" data-toggle="modal" data-target="#{{$transaction->tig_code_order}}" type="button"><span class="btn-label"><i class="icon icon-doc"></i></span>
                                                Resi</button>
                                            <div id="{{$transaction->tig_code_order}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Input Resi Pengiriman</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="update-receipt" method="POST" action="{{route('transaksi.guest.editreceipt', $transaction)}}">
                                                                @csrf
                                                                {{method_field('PUT')}}
                                                                <input type="hidden" id="tig_code_order" name="tig_code_order" value="{{$transaction->tig_code_order}}">
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="control-label">Recipient:</label>
                                                                    <input type="text" class="form-control" id="tig_receipt" name="tig_receipt" value="{{$transaction->tig_receipt}}">
                                                                </div>
                                                                <button type="submit" class="btn btn-danger waves-effect waves-light">Save changes</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($transaction->tig_id_status == 0 || $transaction->tig_id_status == -1)
                                            <form action="{{route('transaksi.guest.approve', $transaction)}}" class="d-inline-block" method="POST">
                                                @csrf
                                                {{method_field('PUT')}}
                                                <button class="btn btn-success btn-sm waves-effect waves-light approve-trans" type="submit"><span class="btn-label"><i class="icon icon-check"></i></span>
                                                    Approve</button>
                                            </form>
                                            @endif
                                            @if($transaction->tig_id_status == 1 || $transaction->tig_id_status == 2)
                                            <form action="{{route('transaksi.guest.unapprove', $transaction)}}" class="d-inline-block" method="POST">
                                                @csrf
                                                {{method_field('PUT')}}
                                                <button class="btn btn-danger btn-sm waves-effect waves-light approve-trans" type="submit"><span class="btn-label"><i class="icon icon-check"></i></span>
                                                    UnApprove</button>
                                            </form>
                                            @endif
                                            @if($transaction->tig_id_status == 0 || $transaction->tig_id_status == -1 || $transaction->tig_id_status == -2)
                                            <form action="{{route('transaksi.guest.delete', $transaction)}}" method="POST" class="d-inline-block">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button class="btn btn-danger btn-sm waves-effect waves-light del-product" type="submit"><span class="btn-label"></span>
                                                    Hapus</button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-script')
<!-- data table -->
<script type="text/javascript">
	$(document).ready(function(){
		$('.data').DataTable();
	});
</script>
@endpush