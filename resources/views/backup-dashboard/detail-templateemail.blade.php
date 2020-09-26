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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body ">
                    <form action="{{route('templateemail.edit', $edit)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="form-group">
                            <label for="pagetitle" class="control-label">Judul</label>
                            <input type="text" name="pte_title" class="form-control" id="pagetitle" value="{{$edit->pte_title}}">
                        </div>
                        <div class="form-group">
                            <label for="pagetitle" class="control-label">Subject</label>
                            <input type="text" name="pte_subject" class="form-control" id="pagetitle" value="{{$edit->pte_subject}}">
                        </div>
                        <div class="form-group">
                            <label for="pagecontent" class="control-label">Opening:</label>
                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="pte_opening" id="pagecontent">{{$edit->pte_opening}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pagecontent" class="control-label">Content:</label>
                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="pte_content" id="pagecontent">{{$edit->pte_content}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pagecontent" class="control-label">Closing:</label>
                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="pte_closing" id="pagecontent">{{$edit->pte_closing}}</textarea>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection