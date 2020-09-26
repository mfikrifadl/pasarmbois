@extends('template.dashboard.index')

@section('content')
<div class="container-fluid">
    @if(isset($help))
    <h1 class="mt-4">Edit Help</h1>
    @else
    <h1 class="mt-4">Daftar Help</h1>
    @endif
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
        @if(isset($help))
        <li class="breadcrumb-item active">Edit Help</li>
        @else
        <li class="breadcrumb-item active">Daftar Help</li>
        @endif
    </ol>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body ">
                    @if(isset($help))
                    <form action="{{route('help.edit', $help)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{method_field('PUT')}}
                        @else
                        <form action="{{route('help.add')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @endif
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="pagetitle" class="control-label">Judul</label>
                                    @if(isset($help))
                                    <input type="text" name="psh_title" class="form-control" id="pagetitle" value="{{$help->psh_title}}" required>
                                    @else
                                    <input type="text" name="psh_title" class="form-control" id="pagetitle" required>
                                    @endif
                                </div>
                                <div class="form-group col-6">
                                    <label for="pagetitle" class="control-label">Kategori</label>
                                    @if(isset($help))
                                    <input type="text" name="psh_type_faq" class="form-control" id="pagetitle" value="{{$help->psh_type_faq}}" required>
                                    @else
                                    <input type="text" name="psh_type_faq" class="form-control" id="pagetitle" required>
                                    @endif
                                </div>
                                <div class="form-group col-6">
                                    <label for="pagetitle" class="control-label">Icon</label>
                                    @if(isset($help))
                                    <input type="text" name="psh_icon" class="form-control" id="pagetitle" value="{{$help->psh_icon}}" required>
                                    @else
                                    <input type="text" name="psh_icon" class="form-control" id="pagetitle" required>
                                    @endif
                                </div>
                                <div class="form-group col-12">
                                    <label for="pagecontent" class="control-label">Message:</label>
                                    @if(isset($help))
                                    <textarea class="ckeditor form-control" name="psh_desc" id="pagecontent" required>{{$help->psh_desc}}</textarea>
                                    @else
                                    <textarea class="ckeditor form-control" name="psh_desc" id="pagecontent" required></textarea>
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