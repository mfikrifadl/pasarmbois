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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-3 offset-md-9 text-right">
                        <a href="{{route('about.addPage')}}" class="btn btn-primary mb-3">+ Tambah Halaman</a>
                    </div>
                    <div class="table-responsive">
                        <table id="listPage" class="table table-hover table-striped data" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="20%">Judul</th>
                                    <th width="60%">Desc</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($about as $p)
                                <tr>
                                    <td>
                                        {{$p->psa_title}}
                                    </td>
                                    <td>
                                        {{substr($p->psa_desc, 0, 100)}}
                                    </td>
                                    <td>
                                        <form action="{{route('about.destroy', $p)}}" class="d-inline-block" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-danger btn-sm waves-effect waves-light del_page" type="submit"><span class="btn-label"><i class="fa as fa-ban"></i></span>
                                                Hapus</button>
                                        </form>
                                        <a href="{{route('about.editPage', $p)}}" class="btn btn-info btn-sm waves-effect waves-light" role="button" aria-pressed="true"><i class="fa as fas fa-edit"></i> Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-3 offset-md-9 text-right">
                        <a href="{{route('about.addPointPage')}}" class="btn btn-primary mb-3">+ Tambah Point Lain </a>
                    </div>
                    <div class="table-responsive">
                        <table id="listPageValue" class="table table-hover table-striped data" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="20%">Judul</th>
                                    <th width="60%">Desc</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($av as $av)
                                <tr>
                                    <td>
                                        {{$av->psv_title}}
                                    </td>
                                    <td>
                                        {{substr($av->psv_desc, 0, 100)}}
                                    </td>
                                    <td>
                                        <form action="{{route('about.destroyPoint', $av)}}" class="d-inline-block" method="POST">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-danger btn-sm waves-effect waves-light del_page" type="submit"><span class="btn-label"><i class="fa as fa-ban"></i></span>
                                                Hapus</button>
                                        </form>
                                        <a href="{{route('about.editPointPage', $av)}}" class="btn btn-info btn-sm waves-effect waves-light" role="button" aria-pressed="true"><i class="fa as fas fa-edit"></i> Edit</a>
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
    $(document).ready(function() {
        $('.data').DataTable();
    });
</script>
@endpush