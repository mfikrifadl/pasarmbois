@extends('template.dashboard.index')

@section('content')
<div class="container-fluid">
    <h3 class="mt-4">Daftar Produk</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
        <li class="breadcrumb-item active">Daftar Produk</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Produk</th>
                            <th>Harga Dasar</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key=>$product)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$product->pp_title}}</td>
                            <td>Rp. {{rupiah($product->pp_basic_price)}}</td>
                            <td>Rp. {{rupiah($product->pp_selling_price)}}</td>
                            <td>{{$product->pp_qty}}</td>
                            <td>
                                <a href="{{route('main.product.show', $product->pp_slug)}}" class="btn btn-primary btn-sm waves-effect waves-light" role="button" aria-pressed="true"><i class="fa as fas fa-search-plus"></i> Detail</a>
                                @if($product->pp_status == true && $product->pp_is_ban == false)
                                <a class="btn btn-info btn-sm waves-effect waves-light edit-product" href="{{route('product.edit', $product)}}">
                                    <span class="btn-label"><i class="mdi mdi-lead-pencil"></i></span>
                                    Edit</a>
                                <form action="{{route('product.publish.edit', $product->pp_id)}}" class="d-inline-block" method="POST">
                                    @csrf
                                    {{method_field('PUT')}}
                                    <button class="btn btn-warning btn-sm waves-effect waves-light ban-product" type="submit"><span class="btn-label"><i class="fa as fa-ban"></i></span>
                                        Banned</button>
                                </form>
                                @elseif($product->pp_status == false && $product->pp_is_ban == false)
                                <a class="btn btn-warning btn-sm waves-effect waves-light edit-product" href="{{route('product.edit', $product)}}">
                                    <span class="btn-label"><i class="mdi mdi-lead-pencil"></i></span>
                                    Edit</a>
                                <form action="{{route('product.publish.edit', $product->pp_id)}}" class="d-inline-block" method="POST">
                                    @csrf
                                    {{method_field('PUT')}}
                                    <button class="btn btn-success btn-sm waves-effect waves-light post-product" type="submit"><span class="btn-label"><i class="icon icon-paper-plane"></i></span>
                                        Post</button>
                                </form>
                                @elseif($product->pp_is_ban == true)
                                <form action="{{route('product.unbanned.edit', $product->pp_id)}}" class="d-inline-block" method="POST">
                                    @csrf
                                    {{method_field('PUT')}}
                                    <button class="btn btn-success btn-sm waves-effect waves-light unban-product" type="submit"><span class="btn-label"><i class="icon icon-like"></i></span>
                                        Un Banned</button>
                                </form>
                                @endif
                                <form action="{{route('product.product.destroy', $product)}}" method="POST" class="d-inline-block">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button class="btn btn-danger btn-sm waves-effect waves-light del-product" type="submit"><span class="btn-label"></span>
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
@endsection