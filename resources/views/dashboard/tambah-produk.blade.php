@extends('template.dashboard.index')
@section('content')
<div class="container-fluid" data-codepage="addproduct" data-pagetitle="Tambah Produk">
    <h3 class="mt-4">Tambah Produk</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
        <li class="breadcrumb-item active">Tambah Produk</li>
    </ol>
    <form id="add_product" method="post" action="{{route('product.product.store')}}">
        @csrf
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
                                    <input type="text" class="form-control" name="pp_title" id="pp_title" required="">
                                </div>
                            </div>
                            <!-- End Product Name -->
                            <!-- Category -->
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-form-label" for="pp_id_category">Kategori<span class="text-danger">*</span></label>
                                    <select class="form-control" id="pp_id_category" name="pp_id_category" required="">
                                        @foreach($categories as $category)
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
                                    <input type="number" class="form-control" name="pp_qty" id="pp_qty" required="">
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
                                        <input type="number" class="form-control" name="pp_weight">
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
                                        <input type="number" class="form-control" name="pp_basic_price" id="pp_basic_price" required="">
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
                                        <input type="number" class="form-control" name="pp_selling_price" id="pp_selling_price" required="">
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
                                        <textarea class="ckeditor form-control" name="pp_description" id="pp_description"></textarea>
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
                                    <!-- @foreach($products as $product)
                                    @if($product->pp_status)
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-animate bootstrap-switch-off" style="width: 148.667px;">
                                        <div class="bootstrap-switch-container" style="width: 220px; margin-left: -73.3333px;">
                                            <span class="bootstrap-switch-handle-on bootstrap-switch-warning" style="width: 73px;">Draft</span>
                                            <span class="bootstrap-switch-label" style="width: 73.3333px;">&nbsp;</span>
                                            <span class="bootstrap-switch-handle-off bootstrap-switch-success" style="width: 73px;">Publish</span>
                                            <input name="pp_status" id="pp_status" value="0" type="checkbox" data-on-color="warning" data-off-color="success" data-on-text="Draft" data-off-text="Publish" class="bootstrapswitch form-control">
                                        </div>
                                    </div>
                                    @else
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-animate bootstrap-switch-on" style="width: 148.667px;">
                                        <div class="bootstrap-switch-container" style="width: 220px; margin-left: 0px;">
                                            <span class="bootstrap-switch-handle-on bootstrap-switch-warning" style="width: 73px;">Draft</span>
                                            <span class="bootstrap-switch-label" style="width: 73.3333px;">&nbsp;</span>
                                            <span class="bootstrap-switch-handle-off bootstrap-switch-success" style="width: 73px;">Publish</span>
                                            <input name="pp_status" id="pp_status" value="0" type="checkbox" data-on-color="warning" data-off-color="success" data-on-text="Draft" data-off-text="Publish" class="bootstrapswitch form-control">
                                        </div>
                                    </div>
                                    @endif
                                    @break
                                    @endforeach -->
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" name="pp_status" value="true" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadioInline1">Publish</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="pp_status" value="false" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadioInline2">Draft</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end status -->

                        <!-- No. Handphone -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pp_phone" class="control-label col-form-label">No Handphone<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pp_phone" id="pp_phone" required="">
                                </div>
                            </div>
                        </div>
                        <!-- End No. Handphone -->

                        <!-- Email -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pp_email" class="control-label col-form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="pp_email" id="pp_email" required="">
                                </div>
                            </div>
                        </div>
                        <!-- End Email -->

                        <!-- image gallery -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="productpicture" class="control-label col-form-label">Upload Gambar<span class="text-danger">*</span></label>
                                    <input type="file" id="input-file-disable-remove" name="pip_img_path" class="dropify" data-show-remove="false" data-max-file-size="3M" required />
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
</div>
@endsection

@push('custom-script')
<!-- text area -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>

<!-- toggle -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/2.0.0/js/bootstrap-switch.js" integrity="sha512-G6rwJpLKxVKsIRz3qCi2xAXgmyv8vDuV7dfs0C4d3bX+xyrjlA2t6HfG6qjH+4+7oztCoFpQt3myUaPH8Ratjg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/2.0.0/js/bootstrap-switch.min.js" integrity="sha512-eRI64H/+n22qknZMCMmIRYY/PIVxRdJizYRB+fMHJRT+qkTX0B/no3i2V7945KwxReUScbdICK+ToNslFjZ2ng==" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('.bootstrapswitch').bootstrapSwitch();
    });
</script>

<!-- dropify -->
<script>
    //Dropify(image preview)
    $(document).ready(function() {
        $('.dropify').dropify();
    })
</script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
@endpush