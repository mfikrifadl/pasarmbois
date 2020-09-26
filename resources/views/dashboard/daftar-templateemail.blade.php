@extends('template.dashboard.index')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Daftar Template Email</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
        <li class="breadcrumb-item active">Daftar Template Email</li>
    </ol>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="listTemplateEmail" class="table table-hover table-striped data" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="20%">Judul</th>
                                    <th width="80%">Subjek</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($email as $p)
                                <tr>
                                    <td>{{$p->pte_title}}</td>
                                    <td>{{$p->pte_subject}}</td>
                                    <td><a href="{{route('templateemail.editPage', $p)}}" class="btn btn-info btn-sm waves-effect waves-light" role="button" aria-pressed="true"><i class="fa as fas fa-edit"></i> Edit</a>
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
@endsection
@push('custom-script')
<!-- data table -->
<script type="text/javascript">
	$(document).ready(function(){
		$('.data').DataTable();
	});
</script>
@endpush