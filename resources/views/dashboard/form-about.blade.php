@extends('template.dashboard.index')

@section('content')
<div class="container-fluid">
    @if(isset($about))
    <h1 class="mt-4">Edit About</h1>
    @elseif(isset($addPoint))
    <h1 class="mt-4">Tambah About Point</h1>
    @elseif(isset($editPoint))
    <h1 class="mt-4">Edit About Point</h1>
    @else
    <h1 class="mt-4">Tambah About</h1>
    @endif
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
        @if(isset($about))
        <li class="breadcrumb-item active">Edit About</li>
        @elseif(isset($addPoint))
        <li class="breadcrumb-item active">Tambah About Point</li>
        @elseif(isset($editPoint))
        <li class="breadcrumb-item active">Edit About Point</li>
        @else
        <li class="breadcrumb-item active">Tambah About</li>
        @endif
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body ">
                    @if(isset($about))
                    <form action="{{route('about.edit', $about)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{method_field('PUT')}}
                        @elseif(isset($editPoint))
                        <form action="{{route('about.editPoint', $value)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{method_field('PUT')}}
                            @elseif(isset($addPoint))
                            <form action="{{route('about.addPoint')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @else
                                <form action="{{route('about.add')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @endif
                                    <div class="form-group">
                                        <label for="pagetitle" class="control-label">Judul</label>
                                        @if(isset($about))
                                        <input type="text" name="psa_title" class="form-control" id="pagetitle" value="{{$about->psa_title}}" required>
                                        @elseif(isset($editPoint))
                                        <input type="text" name="psv_title" class="form-control" id="pagetitle" value="{{$value->psv_title}}" required>
                                        @elseif(isset($addPoint))
                                        <input type="text" name="psv_title" class="form-control" id="pagetitle" required>
                                        @else
                                        <input type="text" name="psa_title" class="form-control" id="pagetitle" required>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        @if(isset($about))
                                        <label for="categoryiconInput" class="control-label col-form-label">Preview</label><br />
                                        <img id="img-prev" src="{{ asset('customAuth/'.$about->psa_img_path) }} "><br /><br />
                                        <label for="categoryiconInput" class="control-label col-form-label">Background Gambar</label>
                                        <input type="file" id="input-file-disable-remove" name="psa_img_path" class="dropify img-dropify" data-default-file="{{$about->psa_img_path}}" data-show-remove="false" />
                                        @elseif(isset($editPoint))
                                        <label for="categoryiconInput" class="control-label col-form-label">Preview</label><br />
                                        <img id="img-prev" src="{{ asset('customAuth/'.$value->psv_img_path) }} "><br /><br />
                                        <label for="categoryiconInput" class="control-label col-form-label">Background Gambar</label>
                                        <input type="file" id="input-file-disable-remove" name="psv_img_path" class="dropify img-dropify" value="{{$value->psv_img_path}}" data-show-remove="false" />
                                        @elseif(isset($addPoint))
                                        <label for="name">Image Path</label>
                                        <input type="file" id="input-file-disable-remove" name="psv_img_path" class="dropify" data-show-remove="false" required />
                                        @else
                                        <label for="name">Image Path</label>
                                        <input type="file" id="input-file-disable-remove" name="psa_img_path" class="dropify" data-show-remove="false" required />
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="pagecontent" class="control-label">Message:</label>
                                        @if(isset($about))
                                        <textarea class="ckeditor form-control" name="psa_desc" id="pagecontent" required>{{$about->psa_desc}}</textarea>
                                        @elseif(isset($editPoint))
                                        <textarea class="ckeditor form-control" name="psa_desc" id="pagecontent" required>{{$value->psv_desc}}</textarea>
                                        @elseif(isset($addPoint))
                                        <textarea class="ckeditor form-control" name="psv_desc" id="pagecontent" required></textarea>
                                        @else
                                        <textarea class="ckeditor form-control" name="psa_desc" id="pagecontent" required></textarea>
                                        @endif
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Simpan</button>
                                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-script')
<!-- text area -->
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>

<!-- dropify -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
<script > //Dropify (image preview)
$(document).ready(function() {
    $('.dropify').dropify();
}) </script>
@endpush