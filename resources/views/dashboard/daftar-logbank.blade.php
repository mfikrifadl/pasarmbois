@extends('template.dashboard.index')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Informasi Rekening</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
        <li class="breadcrumb-item active">Informasi Rekening</li>
    </ol>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover table-bordered" style="width:100%">
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