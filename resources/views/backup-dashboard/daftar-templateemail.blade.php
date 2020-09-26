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
    $(document).ready(function() {
        $('.data').DataTable();
    });
</script>
@endpush