@extends('template.dashboard.index')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Kategori Tiket</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
        <li class="breadcrumb-item active">Kategori Tiket</li>
    </ol>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <form id="add-category-ticket" method="POST" action="{{route('tiket.kategori.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="name"> Judul</label>
                            <input type="text" name="ptt_title" id="ptt_title" class="form-control" placeholder="Nama Kategori Ticket" aria-describedby="ptt_title">
                        </div>
                        <div class="text-right">
                            <button class="btn btn-success btn-sm waves-effect waves-light" type="submit"><span class="btn-label"><i class="fas fa-save"></i></span> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="60%">Jenis Type ticket</th>
                                    <th width=""></th>
                                    <th width="5%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $categorie)
                                <tr>
                                    <td>{{$categorie->ptt_title}}</td>
                                    <td>{{$categorie->ptt_update_at}}</td>
                                    <td>
                                        <form action="{{route('tiket.kategori.destroy', $categorie)}}" method="POST">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-danger btn-sm waves-effect waves-light del-product" type="submit"><span class="btn-label"><i class="fa as fas fa-trash"></i></span>
                                                Hapus</button>
                                        </form>
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
@endsection