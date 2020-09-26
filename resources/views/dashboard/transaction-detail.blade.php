@extends('template.dashboard.index')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-body printableArea">
            <h3><b>INVOICE</b> <span class="pull-right">#{{$transactions->ti_code_order}}</span></h3>
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
                                <h4 class="font-bold">{{$transactions->ti_firstname}} {{$transactions->ti_lastname}}</h4>
                                <p class="text-muted m-l-30">{{$transactions->ti_complete_address}}
                                    <br>{{$transactions->ti_zip_code}},
                                    <br>{{$transactions->subdistrict->ps_title}}
                                    <br>{{$transactions->city->pc_title}},
                                    <br>{{$transactions->province->pp_title}} - {{$transactions->ti_telephone}} </p>
                                <p class="m-t-30"><b>Waktu Pembelian :</b> <i class="fa fa-calendar"></i> {{tgl_indo($transactions->ti_created_at)}}</p>
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
                                    <td class="text-right">{{$invoice_detail->tid_qty}} </td>
                                    <td class="text-right"> Rp. {{rupiah($invoice_detail->product->pp_selling_price)}} </td>
                                    <td class="text-right">Rp. {{rupiah($invoice_detail->tid_total_price,2)}} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="pull-right m-t-30 text-right">
                    
                        <p>Sub - Total amount : Rp. {{rupiah($transactions->ti_total_price)}} </p>
                        <p>Kode Unik Pengiriman : {{$transactions->ti_price_unique}} </p>
                        <p>Ongkos kirim : Rp. {{rupiah($transactions->ti_delivery_fee)}} </p>
                        <hr>
                        <h3><b>Total : </b>Rp. {{rupiah($transactions->ti_total_price_unique,2)}}</h3>
                    
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="row">
                        <div class="col-6 pull-left">
                            @if ($transactions->ti_id_status >= 1 && $transactions->ti_id_status <= 3) <input type="hidden" name="ti_code_order" value="{{$transactions->ti_code_order}}">
                            @endif
                        </div>
                        <div class="col-6 text-right">
                            @if ($transactions->ti_id_status != -2)
                            <form action="{{route('transaksi.user.unapprove', $transactions)}}" method="POST" class="d-inline-block">
                                @csrf
                                {{method_field('PUT')}}
                                <button id="transaction-failed" class="btn btn-danger btn-outline" type="submit"> <span><i class="fa fa-times"></i> Transaksi Gagal</span>
                                </button>
                            </form>
                            @endif
                            @if ($transactions->ti_id_status >= -1 || $transactions->ti_id_status == 0) 
                            <form action="{{route('transaksi.user.approve', $transactions)}}" method="POST" class="d-inline-block">
                                @csrf
                                {{method_field('PUT')}}
                                <button class="btn btn-success" name="submit" type="submit"> Approve</button>
                            </form>
                            @endif
                            @if ($transactions->ti_id_status >= 1 || $transactions->ti_id_status != -2) 
                            <form action="{{route('transaksi.print', $transactions->ti_id)}}" method="GET" class="d-inline-block">
                                @csrf
                                {{method_field('GET')}}
                                <button class="btn btn-secondary" name="submit" type="submit"> Print</button>
                            <!-- <a href="{{ route('transaksi.print', $transactions->ti_id) }}" class="btn btn-secondary btn-sm" ><span> Print</span></a> -->
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection