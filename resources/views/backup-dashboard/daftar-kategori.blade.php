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
        <div class="col-12 text-right">
            <button class="btn btn-primary waves-effect waves-light mb-3" type="button"><span class="btn-label" data-toggle="modal" data-target="#addCategory">+ Tambah Kategori</button>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="listKategori" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="2%">No</th>
                            <th>Nama Kategori</th>
                            <th>Jumlah Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $key=>$c)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$c->pc_title}}</td>
                            <td>{{$c->product}}</td>
                            <td>
                                <form action="{{route('kategori.destroy', $c->pc_id)}}" class="d-inline-block" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{method_field('DELETE')}}

                                    <button class="btn btn-danger btn-sm waves-effect waves-light del-category" type="submit"><span class="btn-label"></span>
                                        Hapus</button>
                                </form>

                                <button class="btn btn-info btn-sm waves-effect waves-light e_category" data-toggle="modal" data-target="#{{$c->pc_slug}}"><span class="btn-label"></span>Edit</button>
                                <!-- Modal edit category -->
                                <div id="{{$c->pc_slug}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addCategoryLabel">Edit Kategori</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="mdi mdi-close"></i></button>
                                                <!-- <button class="btn btn-info btn-sm waves-effect waves-light addCategoryLabel" data-dismiss="modal" aria-hidden="true" type="submit"><span class="btn-label"></span> -->
                                                <!-- Edit</button> -->
                                            </div>
                                            <form action="{{route('kategori.edit', $c->pc_id)}}" method="POST" class="d-inline-block" enctype="multipart/form-data">
                                                @csrf
                                                {{method_field('PUT')}}
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="categorynameInput" class="control-label col-form-label">Nama Kategori</label>
                                                        <input type="text" class="form-control" name="pc_title" id="categorynameInput" value="{{$c->pc_title}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="categoryiconInput" class="control-label col-form-label">Preview</label><br />
                                                        <img id="img-prev" src="{{ asset('customAuth/'.$c->pc_img_path) }} " width="465" height="135" alt="image preview slider"><br /><br />
                                                        <label for="categoryiconInput" class="control-label col-form-label">Background Gambar</label>
                                                        <input type="file" id="input-file-disable-remove" name="pc_img_path" class="dropify img-dropify" data-default-file="" data-show-remove="false" />
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="submit" class="btn btn-primary waves-effect">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End modal add category -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal add category -->
<div id="addCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addCategoryLabel">Tambahkan Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="mdi mdi-close"></i></button>
            </div>
            <form action="{{route('kategori.store')}}" class="d-inline-block" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="categorynameInput" class="control-label col-form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="pc_title" id="categorynameInput">
                    </div>
                    <!-- <div class="form-group">
						<label for="categoryiconInput" class="control-label col-form-label">Gambar Icon Kategori</label>
						<input type="file" class="form-control-file" name="categoryiconInput" id="categoryiconInput">
					</div> -->
                    <div class="form-group">
                        <label for="categoryiconInput" class="control-label col-form-label">Background Gambar</label>
                        <input type="file" id="input-file-disable-remove" name="pc_img_path" class="dropify" data-show-remove="false" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary waves-effect">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End modal add category -->
@endsection

@push('custom-script')
<!-- dropify -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
<script>
    //Dropify (image preview)
    $(document).ready(function() {
        $('.dropify').dropify();
    })
</script>
@endpush