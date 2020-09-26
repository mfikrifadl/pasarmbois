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
        <div class="col-md-3 offset-md-9 text-right">
            <a href="{{route('faq.addPage')}}" class="btn btn-primary mb-3">+ Tambah Halaman</a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="listFAQ" class="table table-hover table-striped data" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="45%">Judul</th>
                                    <th widht="15">Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faq as $key=>$p)
                                <tr>
                                    <td>
                                        {{$key+1}}
                                    </td>
                                    <td>
                                        {{$p->psf_title}}
                                    </td>
                                    <td>
                                        {{$p->psf_type_faq}}
                                    </td>
                                    <td>
                                        <form action="{{route('faq.destroy', $p)}}" class="d-inline-block" method="POST">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-danger btn-sm waves-effect waves-light del_page" type="submit"><span class="btn-label"><i class="fa as fa-ban"></i></span>
                                                Hapus</button>
                                        </form>
                                        <a href="{{route('faq.editPage', $p)}}" class="btn btn-info btn-sm waves-effect waves-light" role="button" aria-pressed="true"><i class="fa as fas fa-edit"></i> Edit</a>
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