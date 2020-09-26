@extends('template.dashboard.index')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h1 class="mt-4">Setting Site</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
            <li class="breadcrumb-item active">Setting Site</li>
        </ol>
    </div>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <form class="m-t-20" method="POST" action="{{route('setting.otherEdit', $general)}}" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Default Image Product</label>
                            <input type="file" id="input-file-disable-remove" name="ps_img_product_default" class="dropify" data-default-file="{{asset('customAuth/'.$general->ps_img_product_default)}}" data-show-remove="false" />
                        </div>
                        <img style="width:75%;" src="{{asset('customAuth/'.$general->ps_img_product_default)}}" alt="img product" />
                        <div class="form-group">
                            <label for="name">Default Image Category</label>
                            <input type="file" id="input-file-disable-remove" name="ps_img_category_default" class="dropify" data-show-remove="false" />
                        </div>
                        <img style="width:75%;" src="{{asset('customAuth/'.$general->ps_img_category_default)}}" alt="img category" />
                        <div class="form-group">
                            <label for="name">Default Image User</label>
                            <input type="file" id="input-file-disable-remove" name="ps_img_user_default" class="dropify" data-show-remove="false" />
                        </div>
                        <img style="width:75%;" src=" {{asset('customAuth/'.$general->ps_img_user_default)}}" alt="img user" />
    </form>
</div>
</div>
</div>
<div class="col-6">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Produk Pada Halaman Search</label>
                <input type="text" name="ps_page_search" id="ps_page_search" class="form-control" value="{{$general->ps_page_search}}">
            </div>
            <div class="form-group">
                <label for="name">Produk Pada Halaman Category</label>
                <textarea name="ps_page_category" id="ps_page_category" cols="30" class="form-control" rows="10">{{$general->ps_page_category}}</textarea>
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
<script > //Dropify (image preview)
$(document).ready(function() {
    $('.dropify').dropify();
}) </script>
@endpush