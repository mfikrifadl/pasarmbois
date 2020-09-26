@extends('template.dashboard.backup')

@section('content')
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid" data-codepage="{{$code_page}}">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Column rendering -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row m-t-20">
                        <!-- Column -->
                        <div class="col-md-6 col-xlg-3">
                            <div class="card card-earning card-hover">
                                <div class="box bg-info text-center">
                                    <h1 class="font-light text-white">Rp. {{rupiah($totSell)}}</h1>
                                    <h6 class="text-white">Total Penjualan</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-xlg-3">
                            <div class="card card-earning card-hover">
                                <div class="box bg-primary text-center">
                                    <h1 class="font-light text-white">{{rupiah($totProduct)}}</h1>
                                    <h6 class="text-white">Total Produk Terjual</h6>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row m-t-20">
                        <!-- Column -->
                        <div class="col-md-6 col-xlg-3">
                            <div class="card card-earning card-hover">
                                <div class="box bg-success text-center">
                                    <h1 class="font-light text-white">Rp. {{rupiah($totProfit)}}</h1>
                                    <h6 class="text-white">Total Keuntungan bulan ini</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-xlg-3">
                            <div class="card card-earning card-hover">
                                <div class="box bg-secondary text-center">
                                    <h1 class="font-light text-white">Rp. {{rupiah($totAllProfit)}}</h1>
                                    <h6 class="text-white">Total Seluruh Keuntungan</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-month-tab" data-toggle="pill" href="#pills-month" role="tab" aria-controls="pills-month" aria-selected="true">Pendapatan bulan ini <span class="badge badge-light"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="false">Semua <span class="badge badge-light"></span></a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-month" role="tabpanel" aria-labelledby="pills-month-tab">
                            <div class="table-responsive">
                                <table id="listEarningMonth" class="table table-hover table-striped data" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="80%">Title</th>
                                            <th width="10%">Qty</th>
                                            <th>Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($earning as $e)
                                        <tr>
                                            <td>
                                                {{$e->pp_title}}
                                            </td>
                                            <td>
                                                {{$e->tid_qty}}
                                            </td>
                                            <td>
                                                {{rupiah($e->tid_total_price)}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                            <div class="table-responsive">
                                <table id="listAlleraning" class="table table-hover table-striped data" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="80%">Title</th>
                                            <th width="10%">Qty</th>
                                            <th>Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allearning as $e)
                                        <tr>
                                            <td>
                                                {{$e->pp_title}}
                                            </td>
                                            <td>
                                                {{$e->tid_qty}}
                                            </td>
                                            <td>
                                                {{rupiah($e->tid_total_price)}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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