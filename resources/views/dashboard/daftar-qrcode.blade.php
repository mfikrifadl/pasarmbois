@extends('template.dashboard.index')

@section('content')
<div class="container-fluid">
    <h3 class="mt-4">Daftar QR Code</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
        <li class="breadcrumb-item active">Daftar QR Code</li>
    </ol>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <!-- <div class="row">
        <div class="col-12"> -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th width="30%">Nama QR code</th>
                            <th width="15%">Produk</th>
                            <th width="15%">Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($qrcode as $key=>$c)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$c->pq_title}}<br>{{$c->pq_complete_address}}</td>
                            <td>{{$c->product->pp_title}}</td>
                            <td>
                                @if ($c->pq_status == 1)
                                <span class="label label-danger">Non Active</span>
                                @else
                                <span class="label label-info">Active</span>
                                @endif
                            </td>
                            <td>
                                @if ($c->pq_status == 1)
                                <form action="{{route('qrcode.active', $c->pq_id)}}" class="d-inline-block" method="POST">
                                    @csrf
                                    {{method_field('PUT')}}
                                    <button class="btn btn-success btn-sm waves-effect waves-light unban-qrcode" type="submit"><span class="btn-label"><i class="icon icon-like"></i></span>
                                        Active</button>
                                </form>
                                <form action="{{route('qrcode.destroy', $c->pq_id)}}" class="d-inline-block" method="POST">
                                    @csrf
                                    {{method_field('delete')}}
                                    <button class="btn btn-danger btn-sm waves-effect waves-light delete-qrcode" type="submit"><span class="btn-label"><i class="mdi mdi-delete-forever"></i></span>
                                        Hapus</button>
                                </form>
                                @else
                                <form action="{{route('qrcode.banned', $c->pq_id)}}" class="d-inline-block" method="POST">
                                    @csrf
                                    {{method_field('PUT')}}
                                    <button class="btn btn-danger btn-sm waves-effect waves-light ban-qrcode" type="submit"><span class="btn-label"><i class="fa as fa-ban"></i></span>
                                        Non Active</button>
                                </form>
                                @endif
                                <button class="btn btn-primary btn-sm waves-effect waves-light detail-qrcode" type="button" data-toggle="modal" data-target="#detail_modal"><span class="btn-label"><i class="fa as fas fa-search-plus"></i></span> Detail</button>
                            </td>
                        </tr>
                        @endforeach
                        </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- </div> -->
    <!-- </div> -->
</div>
@endsection
<!-- sample modal content -->
<div id="detail_modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Detail Qr Code</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <a class="download_link" href="#" download><img src="{{asset('customAuth/'.$c->pq_qrcode_path)}}" class="img-fluid img_qrcode" /></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label class="control-label col-form-label">Nama Qr Code</label>
                            <input type="text" class="form-control" name="pq_title" value="{{$c->pq_title}}" readonly>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label class="control-label col-form-label">Produk</label>
                            <input type="text" class="form-control" name="pp_title" value="{{$c->product->pp_title}}" readonly>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label class="control-label col-form-label">Provinsi</label>
                            <input type="text" class="form-control" name="pp_title" value="{{$c->province->pp_title}}" readonly>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label class="control-label col-form-label">Kabupaten/Kota</label>
                            <input type="text" class="form-control" name="pc_title" value="{{$c->city->pc_title}}" readonly>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label class="control-label col-form-label">Kecamatan</label>
                            <input type="text" class="form-control" name="ps_title" value="{{$c->subdistrict->ps_title}}" readonly>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label class="control-label col-form-label">Alamat Lengkap</label>
                            <input type="text" class="form-control" name="pq_complete_address" value="{{$c->pq_title}}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->