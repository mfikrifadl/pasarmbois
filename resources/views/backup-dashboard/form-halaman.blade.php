@extends('template.dashboard.backup')

@section('content')
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid" data-codepage="{{$code_page}}">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body ">
                    @if (isset($page))
                    <form action="{{route('page.edit', $page)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{method_field('PUT')}}
                        @else
                        <form action="{{route('page.add')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @endif
                            <div class="form-group">
                                <label for="pagetitle" class="control-label">Judul</label>
                                @if (isset($page))
                                <input type="text" name="pp_title" class="form-control" id="pagetitle" value="{{$page->pp_title}}" required>
                                @else
                                <input type="text" name="pp_title" class="form-control" id="pagetitle" required>
                                @endif
                            </div>
                            <div class="form-group">
                                @if(isset($page))
                                <label for="categoryiconInput" class="control-label col-form-label">Preview</label><br />
                                <img id="img-prev" src="{{ asset('customAuth/'.$page->pp_img_path) }} "><br /><br />
                                <label for="categoryiconInput" class="control-label col-form-label">Background Gambar</label>
                                <input type="file" id="input-file-disable-remove" name="pp_img_path" class="dropify img-dropify" value="{{$page->pp_img_path}}" data-show-remove="false" />
                                @else
                                <label for="name">Img Path</label>
                                <input type="file" id="input-file-disable-remove" name="pp_img_path" class="dropify" data-show-remove="false" />
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="pagecontent" class="control-label">Message:</label>
                                @if (isset($page))
                                <textarea class="ckeditor form-control" name="pp_content" id="pagecontent" required>{{$page->pp_content}}</textarea>
                                @else
                                <textarea class="ckeditor form-control" name="pp_content" id="pagecontent" required></textarea>
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
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>

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