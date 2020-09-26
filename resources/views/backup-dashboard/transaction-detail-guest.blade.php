@extends('template.dashboard.backup')

@section('content')
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid" data-codepage="{{$code_page}}">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body printableArea">
                <h3><b>INVOICE</b> <span class="pull-right">#{{$transactions->tig_code_order}}</span></h3>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-6 pull-left">
                                <address>
                                    <img src="{{asset('customAuth/img/site/logo_login-dinper.png')}}" class="logo" alt="Pasarmbois">
                                    <p class="text-muted m-l-5">{{$sites->ps_complete_address}},
                                        <br> {{$sites->ps_zip_code}},
                                        <br> {{$sites->ps_title}},
                                        <br> {{$sites->city->pc_title}},
                                        <br> {{$sites->province->pp_title}} - {{$sites->ps_phone}}</p>
                                </address>
                            </div>
                            <div class="col-6 pull-right text-right">
                                <address>
                                    <h3>Kepada,</h3>
                                    <h4 class="font-bold">{{$transactions->tig_firstname}} {{$transactions->tig_lastname}}</h4>
                                    <p class="text-muted m-l-30">{{$transactions->tig_complete_address}}
                                        <br>{{$transactions->tig_zip_code}},
                                        <br>{{$transactions->tig_subdistrict}}
                                        <br>{{$transactions->tig_city}},
                                        <br>{{$transactions->tig_province}} - {{$transactions->tig_telephone}} </p>
                                    <p class="m-t-30"><b>Waktu Pembelian :</b> <i class="fa fa-calendar"></i> {{tgl_indo($transactions->tig_created_at)}}</p>
                                </address>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Description</th>
                                        <th class="text-right">Quantity</th>
                                        <th class="text-right">Unit Cost</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoice_details as $key=>$invoice_detail)
                                    <tr>
                                        <td class="text-center">{{$key+1}}</td>
                                        <td>{{$invoice_detail->product->pp_title}}</td>
                                        <td class="text-right">{{$invoice_detail->tidg_qty}} </td>
                                        <td class="text-right"> Rp. {{rupiah($invoice_detail->product->pp_selling_price)}} </td>
                                        <td class="text-right">Rp. {{rupiah($invoice_detail->tidg_total_price,2)}} </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right m-t-30 text-right">

                            <p>Sub - Total amount : Rp. {{rupiah($transactions->tig_total_price)}} </p>
                            <p>Kode Unik Pengiriman : {{$transactions->tig_price_unique}} </p>
                            <p>Ongkos kirim : Rp. {{rupiah($transactions->tig_delivery_fee)}} </p>
                            <hr>
                            <h3><b>Total : </b>Rp. {{rupiah($transactions->tig_total_price_unique,2)}}</h3>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="row">
                            <div class="col-6 pull-left">
                                @if ($transactions->tig_id_status >= 1 && $transactions->tig_id_status <= 3) <input type="hidden" name="tig_code_order" value="{{$transactions->tig_code_order}}">
                                @endif
                            </div>
                            <div class="col-6 text-right">
                                @if ($transactions->tig_id_status != -2)
                                <form action="{{route('transaksi.guest.unapprove', $transactions)}}" method="POST" class="d-inline-block">
                                    @csrf
                                    {{method_field('PUT')}}
                                    <button id="transaction-failed" class="btn btn-danger btn-outline" type="submit"> <span><i class="fa fa-times"></i> Transaksi Gagal</span>
                                    </button>
                                </form>
                                @endif
                                @if ($transactions->tig_id_status >= -1 || $transactions->tig_id_status == 0)
                                <form action="{{route('transaksi.guest.approve', $transactions)}}" method="POST" class="d-inline-block">
                                    @csrf
                                    {{method_field('PUT')}}
                                    <button class="btn btn-success" name="submit" type="submit"> Approve</button>
                                </form>
                                @endif
                                <form action="{{route('transaksi.guest.print', $transactions->tig_id)}}" method="GET" class="d-inline-block">
                                    @csrf
                                    {{method_field('GET')}}
                                    <button class="btn btn-secondary" name="submit" type="submit"> Print</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection