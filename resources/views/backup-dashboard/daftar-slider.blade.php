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
            <button class="btn btn-primary waves-effect waves-light mb-3" type="button"><span class="btn-label" data-toggle="modal" data-target="#addSlider">+ Tambah Slider</button>
        </div>
        <!-- Modal add slider -->
        <div id="addSlider" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addSlider" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addSlider">Tambahkan Slider</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="mdi mdi-close"></i></button>
                    </div>
                    <form action="{{route('slider.add')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="slidernameInput" class="control-label col-form-label">Nama Slider</label>
                                <input type="text" class="form-control" name="pss_title" id="slidernameInput" required>
                            </div>
                            <div class="form-group">
                                <label for="slidernameInput" class="control-label col-form-label">URL</label>
                                <input type="text" class="form-control" name="pss_link" id="slidernameInput" required>
                            </div>
                            <div class="form-group">
                                <label for="slidericonInput" class="control-label col-form-label">Gambar Slider</label>
                                <input type="file" id="input-file-disable-remove" name="pss_img_path" class="dropify" data-show-remove="false" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="submit" class="btn btn-primary waves-effect">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End modal add slider -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="listSlider" class="table table-hover table-striped data" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="80%">Judul</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($slider as $s)
                                <tr>
                                    <td>
                                        {{$s->pss_title}}
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-sm waves-effect waves-light detail-slider" data-toggle="modal" data-target="#{{$s->pss_desc}}" type="button"><span class="btn-label"><i class="far fa-edit"></i></span>
                                            Edit</button>
                                        <!-- Modal edit slider -->
                                        <div id="{{$s->pss_desc}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editSlider" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="addSlider">Tambahkan Slider</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="mdi mdi-close"></i></button>
                                                    </div>
                                                    <form action="{{route('slider.edit', $s)}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        {{method_field('PUT')}}
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="slidernameInput" class="control-label col-form-label">Nama Slider</label>
                                                                <input type="text" class="form-control" name="pss_title" id="slidernameInput" value="{{$s->pss_title}}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="slidernameInput" class="control-label col-form-label">URL</label>
                                                                <input type="text" class="form-control" name="pss_link" id="slidernameInput" value="{{$s->pss_link}}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="slidericonInput" class="control-label col-form-label">Preview</label><br />
                                                                <img id="img-prev" src="{{asset('customAuth/'.$s->pss_img_path)}}" width="465" height="78" alt="image preview category"><br /><br />
                                                                <label for="slidericonInput" class="control-label col-form-label">Gambar Slider</label>
                                                                <input type="file" id="input-file-disable-remove" name="pss_img_path" class="dropify img" data-default-file="" data-show-remove="false" />
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="submit" class="btn btn-primary waves-effect">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End modal add slider -->
                                        <form action="{{route('slider.destroy', $s)}}" class="d-inline-block" method="POST">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-danger btn-sm waves-effect waves-light del_slider" type="submit"><span class="btn-label"><i class="fa as fas fa-trash"></i></span></button>
                                        </form>
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
<!-- End Container fluid  -->

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

<!-- data table -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.data').DataTable();
    });
</script>
@endpush