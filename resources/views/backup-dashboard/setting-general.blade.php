@extends('template.dashboard.backup')

<link rel="stylesheet" href="../css/bootstrap-tagsinput.css">

@section('content')
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid" data-codepage="{{$code_page}}">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="container-fluid" data-codepage="setting">

        <form action="{{route('setting.update', $general)}}" method="POST" enctype="multipart/form-data">
            @csrf
            {{method_field('PUT')}}
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Favicon</label>
                                <input type="file" id="input-file-disable-remove" name="ps_favicon" class="dropify" data-default-file="{{asset('customAuth/'.$general->ps_favicon)}}" data-show-remove="false" />
                            </div>
                            <div class="form-group">
                                <label for="name">Logo Web</label>
                                <input type="file" id="input-file-disable-remove" name="ps_logo" class="dropify" data-default-file="{{asset('customAuth/'.$general->ps_logo)}}" data-show-remove="false" />
                            </div>
                            <div class="form-group">
                                <label for="name">Logo Admin</label>
                                <input type="file" id="input-file-disable-remove" name="ps_logo_dashboard" class="dropify" data-default-file="{{asset('customAuth/'.$general->ps_logo_dashboard)}}" data-show-remove="false" />
                            </div>
        </form>
    </div>
</div>
</div>
<div class="col-8">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Judul Sistem</label>
                <input type="text" name="ps_title" id="title" class="form-control" value="{{$general->ps_title}}">
            </div>
            <div class="form-group">
                <label for="name">Deskripsi</label>
                <textarea name="ps_description" id="" cols="30" class="form-control" rows="10">{{$general->ps_description}}</textarea>
            </div>
            <div class="form-group">
                <label for="name">Meta Tag</label>
                <input data-role='tagsinput' name="ps_tags" id="tags" class="form-control" value="{{$general->ps_tags}}"></input>
            </div>
            <div class="form-group m-b-0 text-right">
                <button class="btn btn-success btn-sm waves-effect waves-light" type="submit" name="submit"><span class="btn-label"><i class="fas fa-cogs"></i></span> Update</button>
            </div>
        </div>
    </div>
</div>
</div>

</form>
</div>

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

<!-- tag input -->
<script src="../js/bootstrap-tagsinput.js"></script>
<script>
    $('#tagPlaces').tagsinput({
        allowDuplicates: true
    });
</script>

<!-- global site tag -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-129885026-1"></script>
@endpush