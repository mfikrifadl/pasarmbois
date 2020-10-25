@extends('template.dashboard.backup')

@section('content')
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid" data-codepage="{{$code_page}}">
    @if(session()->has('message'))
    <div class="alert alert-primary" role="alert">
        {{ session()->get('message') }}
    </div>
    @endif
    @if ($code_page == "addproduct")
    @if(session()->has('message'))
    <div class="alert alert-primary" role="alert">
        {{ session()->get('message') }}
    </div>
    @endif
    @elseif ($code_page == "editProduct")
    @if (!empty($_SESSION['success_msg_edit']))
    <div class="alert alert-primary" role="alert">
        {{ session()->get('message') }}
    </div>
    @endif
    @endif
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Column rendering -->
    <form id="update_product" method="POST" action="{{route('product.update', $product)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- id_product -->
                            <!-- <input name="pp_id" id="pp_id" value="" hidden=""> -->
                            <!-- Product Name -->
                            <div class="col-sm-12 col-md-8">
                                <div class="form-group">
                                    <label for="pp_title" class="control-label col-form-label">Nama produk<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{$product->pp_title}}" name="pp_title" id="pp_title" required="">
                                </div>
                            </div>
                            <!-- End Product Name -->
                            <!-- Category -->
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-form-label" for="pp_id_category">Kategori<span class="text-danger">*</span></label>
                                    <select class="form-control" id="pp_id_category" name="pp_id_category" required="">
                                        @foreach($categories as $key => $category)
                                        <option value="{{$category->pc_id}}">{{$category->pc_title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- End Category -->
                        </div>

                        <div class="row">
                            <!-- Product Stock -->
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="pp_qty" class="control-label col-form-label">Stok produk<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" value="{{$product->pp_qty}}" name="pp_qty" id="pp_qty" required="">
                                </div>
                            </div>
                            <!-- End Product Stock -->
                            <!-- Satuan -->
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-form-label" for="pp_id_measurement">Satuan<span class="text-danger">*</span></label>
                                    <select name="pp_id_measurement" class="form-control">
                                        @foreach($measurements as $measurement)
                                        @if($measurement->pm_desc=="")
                                        <option value="{{$measurement->pm_id}}">{{$measurement->pm_title_unit}}</option>
                                        @endif
                                        @endforeach
                                        <optgroup label="Berat">
                                            @foreach($measurements as $measurement)
                                            @if($measurement->pm_desc=="berat")
                                            <option value="{{$measurement->pm_id}}">{{$measurement->pm_title_unit}}</option>
                                            @endif
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="Volume">
                                            @foreach($measurements as $measurement)
                                            @if($measurement->pm_desc=="Volume")
                                            <option value="{{$measurement->pm_id}}">{{$measurement->pm_title_unit}}</option>
                                            @endif
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="Panjang">
                                            @foreach($measurements as $measurement)
                                            @if($measurement->pm_desc=="Panjang")
                                            <option value="{{$measurement->pm_id}}">{{$measurement->pm_title_unit}}</option>
                                            @endif
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <!-- End Satuan -->
                            <!-- Product Weight -->
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-form-label" for="pp_weight">Berat<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" value="{{$product->pp_weight}}" name="pp_weight">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Gram</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End product weight -->
                        </div>

                        <div class="row">
                            <!-- Product Base Price -->
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="pp_basic_price" class="control-label col-form-label">Harga Dasar<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" class="form-control" value="{{$product->pp_basic_price}}" name="pp_basic_price" id="pp_basic_price" required="">
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Base Price -->
                            <!-- Product Sell Price -->
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="pp_selling_price" class="control-label col-form-label">Harga Jual<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" class="form-control" value="{{$product->pp_selling_price}}" name="pp_selling_price" id="pp_selling_price" required="">
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Sell Price -->
                        </div>

                        <div class="row">
                            <!-- Product Description -->
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="pp_description" class="control-label col-form-label">Deskripsi barang<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <textarea class="ckeditor form-control" name="pp_description" id="pp_description">{{$product->pp_description}}</textarea>

                                    </div>
                                </div>
                            </div>
                            <!-- End Product Description -->

                        </div>
                    </div>
                </div>
            </div>

            <!-- status -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pp_description" class="control-label col-form-label">Status Produk<span class="text-danger">*</span></label>
                                    <br>
                                    @if ($product->pp_status == true)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pp_status" id="inlineRadio1" value="true" checked="checked">
                                        <label class="form-check-label" for="inlineRadio1">Publish</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pp_status" id="inlineRadio2" value="false">
                                        <label class="form-check-labe2" for="inlineRadio2">Draft</label>
                                    </div>
                                    @else
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pp_status" id="inlineRadio1" value="true">
                                        <label class="form-check-label" for="inlineRadio1">Publish</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pp_status" id="inlineRadio2" value="false" checked="checked">
                                        <label class="form-check-labe2" for="inlineRadio2">Draft</label>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- end status -->

                        <!-- No. Handphone -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pp_phone" class="control-label col-form-label">No Handphone<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{$product->pp_phone}}" name="pp_phone" id="pp_phone" required="">
                                </div>
                            </div>
                        </div>
                        <!-- End No. Handphone -->

                        <!-- Email -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pp_email" class="control-label col-form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" value="{{$product->pp_email}}" name="pp_email" id="pp_email" required="">
                                </div>
                            </div>
                        </div>
                        <!-- End Email -->

                        <!-- image gallery -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="productpicture" class="control-label col-form-label">Upload Gambar<span class="text-danger">*</span></label>
                                    <input type="file" id="input-file-disable-remove" name="pp_link" class="dropify" data-show-remove="false" data-default-file="{{asset('customAuth/'.$product->pp_link)}}"></input>
                                </div>
                            </div>
                        </div>
                        <!-- end image gallery -->

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary w-100">Simpan</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div><!-- end row -->
    </form>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="productpicture" class="control-label col-form-label">Galeri</label> <br />
                                @foreach ($product->images as $i)
                                <div class="thumb-wrapper">
                                    <img class="img img-gallery" src="{{asset('customAuth/'.$i->pip_img_path)}}" alt="{{$product->pp_title}}">
                                    <form action="{{route('product.img.delete', $i)}}" method="POST" class="d-inline-block">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger btn-circle del-img-gallery">
                                            <i class="mdi mdi-delete-forever"></i> </button>
                                    </form>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
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