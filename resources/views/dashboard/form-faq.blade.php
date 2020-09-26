@extends('template.dashboard.index')

@section('content')
<div class="container-fluid">
    @if (isset($faq))
    <h1 class="mt-4">Edit Faq</h1>
    @else
    <h1 class="mt-4">Tambah Faq</h1>
    @endif
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
        @if (isset($faq))
        <li class="breadcrumb-item active">Edit Faq</li>
        @else
        <li class="breadcrumb-item active">Tambah Faq</li>
        @endif
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body ">
                    @if (isset($faq))
                    <form action="{{route('faq.edit', $faq)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{method_field('PUT')}}
                        @else
                        <form action="{{route('faq.add')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @endif
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="pagetitle" class="control-label">Judul</label>
                                    @if (isset($faq))
                                    <input type="text" name="psf_title" class="form-control" id="pagetitle" value="{{$faq->psf_title}}" required>
                                    @else
                                    <input type="text" name="psf_title" class="form-control" id="pagetitle" required>
                                    @endif
                                </div>
                                <div class="form-group col-6">
                                    <label for="pagetitle" class="control-label">Kategori</label>
                                    @if (isset($faq))
                                    <input type="text" name="psf_type_faq" class="form-control" id="pagetitle" value="{{$faq->psf_type_faq}}" required>
                                    @else
                                    <input type="text" name="psf_type_faq" class="form-control" id="pagetitle" required>
                                    @endif
                                </div>
                                <div class="form-group col-6">
                                    <label for="pagetitle" class="control-label">Icon</label>
                                    @if (isset($faq))
                                    <input type="text" name="psf_icon" class="form-control" id="pagetitle" value="{{$faq->psf_icon}}">
                                    @else
                                    <input type="text" name="psf_icon" class="form-control" id="pagetitle">
                                    @endif
                                </div>
                                <div class="form-group col-12">
                                    <label for="pagecontent" class="control-label">Message:</label>
                                    @if (isset($faq))
                                    <textarea class="ckeditor form-control" name="psf_desc" id="pagecontent" reqired>{{$faq->psf_desc}}</textarea>    
                                    @else
                                    <textarea class="ckeditor form-control" name="psf_desc" id="pagecontent" required></textarea>
                                    @endif
                                </div>
                                <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Simpan</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection