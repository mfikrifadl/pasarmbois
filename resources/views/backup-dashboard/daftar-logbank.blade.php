@extends('template.dashboard.backup')

@section('content')
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid" data-codepage="{{$code_page}}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="listBank" class="table table-hover table-striped data" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="50%">Bank</th>
                                    <th width="20%">Rekening</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekening as $p)
                                <tr>
                                    <td>{{$p->tbs_description}}</td>
                                    <td>{{$p->tbs_amount}}</td>

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
@endsection
@push('custom-script')
<!-- data table -->
<script type="text/javascript">
	$(document).ready(function(){
		$('.data').DataTable();
	});
</script>
@endpush