@extends('template.dashboard.index')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Pesan Masuk</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
        <li class="breadcrumb-item active">Pesan Masuk</li>
    </ol>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th width="20%">Email</th>
                                    <th width="55%">Content</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesan as $key=>$p)
                                <tr>
                                    <td>
                                        {{$key+1}}
                                    </td>
                                    <td>
                                        @if ($p->pc_status == 0)
                                        <a href="#" class="font-bold link">{{$p->pc_email}}</a>
                                        @else
                                        <a href="#" class="link">{{$p->pc_email}}</a>
                                        @endif
                                    <td> {{$p->pc_content}}</td>
                                    <td>
                                        <form action="{{route('pesanmasuk.destroy', $p)}}" method="POST" class="d-inline-block">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-danger btn-sm waves-effect waves-light del_contact" type="submit"><span class="btn-label"><i class="mdi mdi-delete-forever"></i></span>
                                                Hapus</button>
                                        </form>
                                        <a href="{{route('pesanmasuk.detail', $p)}}"><button class="btn btn-info btn-sm waves-effect waves-light" type="button"><span class="btn-label"><i class="fas fa-reply"></i></span> Balas</button></a>
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