@extends('template.dashboard.index')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Daftar Halaman</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
        <li class="breadcrumb-item active">Daftar Halaman</li>
    </ol>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="row">
        <div class="col-md-3 offset-md-9 text-right">
            <a href="{{route('page.addPage')}}" class="btn btn-primary mb-3">+ Tambah Halaman</a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="listHalaman" class="table table-hover table-striped data" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="65%">Judul</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($page as $key=>$p)
                                <tr>
                                    <td>
                                        {{$key+1}}
                                    </td>
                                    <td>
                                        {{$p->pp_title}}
                                    </td>
                                    <td>
                                        <form action="{{route('page.destroy', $p)}}" class="d-inline-block" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-danger btn-sm waves-effect waves-light del_page" type="submit"><span class="btn-label"><i class="fa as fa-ban"></i></span>
                                                Hapus</button>
                                        </form>
                                        <a href="{{route('page.editPage', $p)}}" class="btn btn-info btn-sm waves-effect waves-light" role="button" aria-pressed="true"><i class="fa as fas fa-edit"></i> Edit</a>
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