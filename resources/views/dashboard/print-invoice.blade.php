<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="{{asset('customAuth/img/site/favicon3.ico')}}"> -->
    <title>Pasar Mbois</title>
    <link href="{{asset('customAuth/vendor/dashboard/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('customAuth/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('customAuth/vendor/plugin/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    
</head>

<body>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body printableArea">
                <h3><b>INVOICE</b> <span class="pull-right">#{{$transaction->ti_code_order}}</span></h3>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-6 pull-left">
                                <address>
                                    <img src="{{asset('customAuth/img/site/logo_login-dinper.png')}}" class="logo" alt="Pasarmbois">
                                    <p class="text-muted m-l-5">{{$site[0]->ps_complete_address}},
                                        <br> {{$site[0]->ps_zip_code}},
                                        <br> {{$site[0]->ps_title}},
                                        <br> {{$site[0]->pc_title}},
                                        <br> {{$site[0]->pp_title}} - {{$site[0]->ps_phone}}</p>
                                </address>
                            </div>
                            <div class="col-6 pull-right text-right">
                                <address>
                                    <h3>Kepada,</h3>
                                    <h4 class="font-bold">{{$transaction->ti_firstname}} {{$transaction->ti_lastname}}</h4>
                                    <p class="text-muted m-l-30">{{$transaction->ti_complete_address}}
                                        <br>{{$transaction->ti_zip_code}},
                                        <br>{{$transaction->ps_title}}
                                        <br>{{$transaction->pc_title}},
                                        <br> {{$transaction->pp_title}} - {{$transaction->ti_telephone}} </p>
                                    <p class="m-t-30"><b>Waktu Pembelian :</b> <i class="fa fa-calendar"></i> {{tgl_indo($transaction->ti_created_at)}}</p>
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
                                    @foreach($invoice_detail as $key=>$invoice_detail)
                                    <tr>
                                        <td class="text-center">{{$key+1}}</td>
                                        <td>{{$invoice_detail->pp_title}}</td>
                                        <td class="text-right">{{$invoice_detail->tid_qty}} </td>
                                        <td class="text-right"> {{$invoice_detail->pp_selling_price}} </td>
                                        <td class="text-right"> {{$invoice_detail->tid_total_price}} </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right m-t-30 text-right">
                            <p>Sub - Total amount: {{$transaction->ti_total_price}} </p>
                            <p>Kode Unik Pengiriman : {{$transaction->ti_price_unique}} </p>
                            <p>Ongkos kirim : {{$transaction->ti_delivery_fee}} </p>
                            <hr>
                            <h3><b>Total :</b>{{$transaction->ti_total_price_unique}}</h3>
                        </div>
                        <div class="clearfix"></div>
                        </hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>