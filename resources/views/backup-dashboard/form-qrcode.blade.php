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
    <form id="add_qrcode" method="post" action="{{route('qrcode.add')}}">
        @csrf
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- id_qrcode -->
                            @if($title_page == 'Edit QR Code')
                            <input name="id_qrcode" value="#" hidden>
                            @endif
                            <!-- Qrcode Name -->
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-form-label">Nama Qr Code<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="pq_title" required>
                                </div>
                            </div>
                            <!-- End Qrcode Name -->
                            <!-- province -->
                            <div class="col-sm-12 col-md-12">
                                <div class="input-group set-address">
                                    <label class="control-label col-form-label">Pilih Produk<span class="text-danger">*</span></label>
                                    <select class="select2 form-control select2-label" name="pq_id_product" required>
                                        <option value="">Pilih Produk</option>
                                        @foreach ($product as $p)
                                        <option value="{{$p->pp_id}}">{{$p->pp_title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- End province -->
                            <!-- province -->
                            <div class="col-sm-12 col-md-6">
                                <div class="input-group set-address">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Provinsi</span>
                                    </div>
                                    <select class="select2 form-control select2-label select-province" name="pq_id_province" required>
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($province as $pr)
                                        <option value="{{$pr->pp_id}}">{{$pr->pp_title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- End province -->
                            <!-- city -->
                            <div class="col-sm-12 col-md-6">
                                <div class="input-group set-address">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Kota/Kabupaten</span>
                                    </div>
                                    <select class="select2 form-control select2-label select-city" name="pq_id_city" required>
                                        <option value="">Pilih Kota/Kabupaten</option>
                                    </select>
                                </div>
                            </div>
                            <!-- End city -->
                            <!-- district -->
                            <div class="col-sm-12 col-md-6">
                                <div class="input-group set-address">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Kecamatan</span>
                                    </div>
                                    <select class="select2 form-control select2-label select-district" name="pq_id_subdistrict" required>
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <!-- End district -->
                            <!-- Complete Address -->
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="productdescription" class="control-label col-form-label">Alamat Lengkap</label>
                                    <textarea class="form-control" name="pq_complete_address" required></textarea>
                                </div>
                            </div>
                            <!-- End Complete Address -->
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
<script type="text/javascript">
    function changeKota() {

        jQuery('select[name="pq_id_province"]').on('change', function() {
            var idProv = jQuery(this).val();
            if (idProv) {
                jQuery.ajax({
                    url: '/dashboard/getKota/' + idProv,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        jQuery('select[name="pq_id_city"]').empty();
                        $('select[name="pq_id_city"]').append('<option value="">Pilih Kota/Kabupaten</option>');
                        jQuery.each(data, function(key, value) {
                            $('select[name="pq_id_city"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="pq_id_city"]').empty();
            }
        });
    }

    function changeKecamatan() {
        jQuery('select[name="pq_id_city"]').on('change', function() {
            var idCity = jQuery(this).val();
            if (idCity) {
                jQuery.ajax({
                    url: '/dashboard/getKecamatan/' + idCity,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        jQuery('select[name="pq_id_subdistrict"]').empty();
                        $('select[name="pq_id_subdistrict"]').append('<option value="0">Pilih Kecamatan</option>');
                        jQuery.each(data, function(key, value) {
                            $('select[name="pq_id_subdistrict"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="pq_id_subdistrict"]').empty();
            }
        });
    }

    jQuery(document).ready(function()

        {

            $('#province').change(function() {

                $('#city').val(0);

                $('#subdistrict').val(0);

            });



            $('#city').change(function() {

                $('#subdistrict').val(0);

            });

            changeKota();
            changeKecamatan();
        });
</script>
@endpush