@extends('template.dashboard.backup')
@section('content')
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid" data-codepage="{{$code_page}}">
    <!-- ============================================================== -->
    <!-- Sales chart -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <i class="mdi mdi-emoticon font-20 text-info"></i>
                        </div>
                        <div class="col-10">
                            <h1 class="font-light text-right mb-0 btn-dahsboard-font">Rp. {{rupiah($totProfit)}}</h1>
                        </div>
                        <p class="font-16 m-b-5">Total Profit</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <i class="mdi mdi-image font-20 text-success"></i>
                        </div>
                        <div class="col-10">
                            <h1 class="font-light text-right mb-0 btn-dahsboard-font">{{$qty_sell}}</h1>
                        </div>
                        <p class="font-16 m-b-5">Jumlah Produk</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <i class="mdi mdi-currency-eur font-20 text-purple"></i>
                        </div>
                        <div class="col-10">
                            <h1 class="font-light text-right mb-0 btn-dahsboard-font">Rp. {{rupiah($countTrx)}}</h1>
                        </div>
                        <p class="font-16 m-b-5">Total Pemasukan</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <i class="mdi mdi-poll font-20 text-danger"></i>
                        </div>
                        <div class="col-10">
                            <h1 class="font-light text-right mb-0 btn-dahsboard-font">{{$countMember}}</h1>
                        </div>
                        <p class="font-16 m-b-5">Pengguna Aktif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Sales chart -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Email campaign chart -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h4 class="card-title">Transaksi Baru</h4>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="listTransaksi" class="table table-hover table-striped data" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="45%" height="18px">Invoice</th>
                                    <th width="25%">Pembeli</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction as $c)
                                <tr role="row" class="odd">
                                    <td>
                                        <small class="date">
                                            <span class="far fa-clock"></span> {{tgl_indo($c->created_at) . " " . substr($c->created_at, 10, 6)}}WIB
                                        </small><br><br style="line-height:10px">
                                        {{ucwords($c->ti_code_order)}}<br><br style="line-height:10px">
                                        @if ($c->ti_id_status == -1)
                                        <span class="label label-danger">Expired</span>
                                        @elseif ($c->ti_id_status == -2)
                                        <span class="label label-danger">Failed</span>
                                        @elseif ($c->ti_id_status == 0)
                                        <span class="label label-warning">Unpaid</span>
                                        @elseif ($c->ti_id_status == 1)
                                        <span class="label label-info">Paid</span>
                                        @elseif ($c->ti_id_status == 2)
                                        <span class="label label-primary">Deliver</span>
                                        @elseif ($c->ti_id_status == 3)
                                        <span class="label label-success">Success</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{$c->ti_firstname}} {{$c->ti_lastname}}
                                    </td>
                                    <td>
                                        @if ($c->type_user == 'user')
                                        <a href="{{route('transaksi.user.detail', $c)}}" class="btn btn-info btn-sm waves-effect waves-light" role="button" aria-pressed="true"><i class="fa as fas fa-search-plus"></i> Detail</a>
                                        <form action="{{route('transaksi.user.approve', $c)}}" class="d-inline-block" method="POST">
                                            @csrf
                                            {{method_field('PUT')}}
                                            <button class="btn btn-success btn-sm waves-effect waves-light approve-trans" type="submit"><span class="btn-label"><i class="icon icon-check"></i></span>
                                                Approve</button>
                                        </form>
                                        <form action="{{route('transaksi.delete', $transaction)}}" method="POST" class="d-inline-block">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-danger btn-sm waves-effect waves-light del-trans" type="submit"><span class="btn-label"><i class="mdi mdi-delete-forever"></i></span>
                                                Hapus</button>
                                        </form>
                                        @elseif ($c->type_user == 'guest')
                                        <a href="{{route('transaksi.guest.detail', $c)}}" class="btn btn-primary btn-sm waves-effect waves-light" role="button" aria-pressed="true"><i class="fa as fas fa-search-plus"></i> Detail</a>
                                        <form action="{{route('transaksi.guest.approve', $c)}}" class="d-inline-block" method="POST">
                                            @csrf
                                            {{method_field('PUT')}}
                                            <button class="btn btn-success btn-sm waves-effect waves-light approve-trans" type="submit"><span class="btn-label"><i class="icon icon-check"></i></span>
                                                Approve</button>
                                        </form>
                                        <form action="{{route('transaksi.guest.delete', $c)}}" method="POST" class="d-inline-block">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-danger btn-sm waves-effect waves-light del-trans" type="submit"><span class="btn-label"><i class="mdi mdi-delete-forever"></i></span>
                                                Hapus</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h4 class="card-title">Grafik Transaksi Dan kunjungan Web</h4>
                    </div>
                </div>
                <?php
                $first  = strtotime('first day this month');
                $months = array();

                for ($i = 6; $i >= 1; $i--) {
                    array_push($months, date('F Y', strtotime("-$i month", $first)));
                };
                unset($months);
                $months = array();

                for ($i = 6; $i >= 0; $i--) {
                    array_push($months, date('F', strtotime("-$i month", $first)));
                }

                $graph = array();
                $total = $accumulate = $current = 0;
                $totalt = $accumu = $current_t = 0;
                $top_increase = $current_increase = array(
                    'value' => 0,
                    'month' => '0'
                );
                foreach ($months as $row) {
                    $produk_bulan_ini = 0;
                    foreach ($chartTrx as $value) {
                        if ($row == $value->month) {
                            if ($accumulate < $value->accumulate) {
                                $accumulate =  $value->accumulate;
                            }
                            $produk_bulan_ini = $value->count;
                            if ($produk_bulan_ini > $top_increase['value']) {
                                $top_increase['value'] = $produk_bulan_ini;
                                $top_increase['month'] = $value->month;
                            }
                        }
                        $current = $row;
                        $current_increase['value'] = $value->count;
                    }
                    // transaksi
                    $guest = 0;
                    foreach ($chartGuest as $cg) {
                        if ($row == $cg->month) {
                            if ($accumu < $cg->accumulate) {
                                $accumu =  $cg->accumulate;
                            }
                            $guest = $cg->count;
                            if ($guest > $top_increase['value']) {
                                $top_increase['cg'] = $guest;
                                $top_increase['month'] = $cg->month;
                            }
                        }
                        $current_t = $row;
                        $top_increase['cg'] = $cg->count;
                    }
                    array_push($graph, array($current, $produk_bulan_ini, $guest));
                } ?>
                <ul class="nav nav-pills m-t-30 m-b-30">
                    <li class=" nav-item"> <a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="false">Pengunjung</a> </li>
                    <li class="nav-item"> <a href="#navpills-2" class="nav-link" data-toggle="tab" aria-expanded="false">Pembelian</a> </li>
                </ul>
                <div class="tab-content br-n pn">
                    <div id="navpills-1" class="tab-pane active">
                        <div class="visitor ct-charts m-grafik"></div>

                    </div>
                    <div id="navpills-2" class="tab-pane">
                        <div class="sales5 ct-charts m-grafik"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Statistik Transaksi</h4>
                <div class="status m-t-30" style="height:280px; width:100%"></div>

                <div class="row">
                    <div class="col-4 border-right">
                        <i class="fa fa-circle text-primary"></i>
                        <h4 class="mb-0 font-medium"><?= $chartStatus['success'] ?></h4>
                        <span>Success</span>
                    </div>
                    <div class="col-4 border-right p-l-20">
                        <i class="fa fa-circle text-info"></i>
                        <h4 class="mb-0 font-medium"><?= $chartStatus['pending'] ?></h4>
                        <span>Pending</span>
                    </div>
                    <div class="col-4 p-l-20">
                        <i class="fa fa-circle text-success"></i>
                        <h4 class="mb-0 font-medium"><?= $chartStatus['failed'] ?></h4>
                        <span>Failed</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- Email campaign chart -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Ravenue - page-view-bounce rate -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Recent Comments</h4>
            </div>
            <div class="comment-widgets scrollable" style="height:430px;">
                <!-- Comment Row -->
                @foreach ($comment as $cm)
                <div class="d-flex flex-row comment-row">
                    <div class="p-2">
                        @if ($cm->userDetail->pud_img_path == null)
                        <img src="{{asset('customAuth/img/site/user.png')}}" alt="{{$cm->userDetail->pud_firstname}} {$cm->userDetail->pud_lastname}}" width="50" class="rounded-circle">
                        @else
                        <img src="{{asset('customAuth/'.$cm->userDetail->pud_img_path)}}" alt="{{$cm->userDetail->pud_firstname}} {$cm->userDetail->pud_lastname}}" width="50" class="rounded-circle">
                        @endif
                    </div>
                    <div class="comment-text w-100">
                        <h6 class="font-medium">{{$cm->userDetail->pud_firstname}} {{$cm->userDetail->pud_lastname}}</h6>
                        <span class="m-b-15 d-block">{{$cm->pc_content}}</span>
                        <div class="comment-footer">
                            <span class="text-muted float-right">{{tgl_indo($cm->pc_created_at)}}</span><br style="line-height:8px">
                            <a href="{{route('main.product.show', $cm->product->pp_slug)}}" target=_blank><span class="label label-rounded label-danger">Check Post</span></a>
                        </div>
                    </div>
                </div>
                @foreach ($reply as $re)
                @if ($cm->pc_id == $re->pc_parent)
                <div class="d-flex flex-row comment-row ml-5">
                    <div class="p-2">
                        @if ($re->userDetail->pud_img_path == null)
                        <img src="{{asset('customAuth/img/site/user.png')}}" alt="{{$re->userDetail->pud_firstname}} {{$re->userDetail->pud_lastname}}" width="50" class="rounded-circle">
                        @else
                        <img src="{{asset('customAuth/'.$re->userDetail->pud_img_path)}}" alt="{{$re->userDetail->pud_firstname}} {{$re->userDetail->pud_lastname}}" width="50" class="rounded-circle">
                        @endif
                    </div>
                    <div class="comment-text w-100">
                        <h6 class="font-medium">{{$re->userDetail->pud_firstname}} {{$re->userDetail->pud_lastname}}</h6>
                        <span class="m-b-15 d-block">{{$re->pc_content}}</span>
                        <div class="comment-footer">
                            <span class="text-muted float-right">{{tgl_indo($re->pc_created_at)}}</span>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h4 class="card-title">Daftar Produk Minim Stock barang</h4>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="listProductDash" class="table table-hover table-striped data" style="width:100%">
                        <thead>
                            <tr>
                                <th width="60%">Nama Produk</th>
                                <th>Stok</th>
                                <th>Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $p)
                            <tr>
                                <td>
                                    {{$p->pp_title}}
                                </td>
                                <td>
                                    {{$p->pp_qty}}
                                </td>
                                <td>
                                    {{$p->sell}}
                                </td>
                            </tr>
                            @endforeach
                            </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-script')
<script type="text/javascript">
    var graph = [
        ["{{$chart[0]['month']}}", "{{$chart[0]['trans']}}", "{{$chart[0]['count']}}"],
        ["{{$chart[1]['month']}}", "{{$chart[1]['trans']}}", "{{$chart[1]['count']}}"],
        ["{{$chart[2]['month']}}", "{{$chart[2]['trans']}}", "{{$chart[2]['count']}}"],
        ["{{$chart[3]['month']}}", "{{$chart[3]['trans']}}", "{{$chart[3]['count']}}"],
        ["{{$chart[4]['month']}}", "{{$chart[4]['trans']}}", "{{$chart[4]['count']}}"],
        ["{{$chart[5]['month']}}", "{{$chart[5]['trans']}}", "{{$chart[5]['count']}}"],
        ["{{$chart[6]['month']}}", "{{$chart[6]['trans']}}", "{{$chart[6]['count']}}"],
    ];
</script>
<script type="text/javascript">
    var chartstatus = [{
        "success": "{{$chartStatus['success']}}",
        "pending": "{{$chartStatus['pending']}}",
        "failed": "{{$chartStatus['failed']}}"
    }];
</script>

<!-- data table -->
<script type="text/javascript">
	$(document).ready(function(){
		$('.data').DataTable();
	});
</script>
@endpush