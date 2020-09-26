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
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5>Alamat Sekarang</h5>
                    {{$address->province->pp_title}}
                    <br>{{$address->city->pc_title}}
                    {{$address->subdistrict->ps_title}}
                    {{$address->ps_complete_address}}
                    {{$address->ps_zip_code}}
                    {{$address->ps_phone}}

                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <form class="m-t-20" action="{{route('setting.address-update', $address->ps_id)}}" method="POST">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="input-group set-address">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Provinsi</span>
                            </div>
                            <select class="select2 form-control select2-label select-province" name="ps_id_province" required>
                                @if(isset($address->ps_id_province))
                                <option value="{{$address->ps_id_province}}">{{$address->province->pp_title}}</option>
                                @else
                                <option>Pilih Provinsi</option>
                                @endif
                                @foreach ($province as $pr)
                                <option value="{{$pr->pp_id}}">{{$pr->pp_title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group set-address">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Kota/Kabupaten</span>
                            </div>
                            <select class="select2 form-control select2-label select-city" name="ps_id_city" required>
                                @if(isset($address->ps_id_city))
                                <option value="{{$address->ps_id_city}}">{{$address->city->pc_title}}</option>
                                @else
                                <option>Pilih Kota/Kabupaten</option>
                                @endif
                            </select>
                        </div>
                        <div class="input-group set-address">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Kecamatan</span>
                            </div>
                            <select class="select2 form-control select2-label select-district" name="ps_id_subdistrict" required>
                                @if(isset($address->ps_id_subdistrict))
                                <option value="{{$address->ps_id_subdistrict}}">{{$address->subdistrict->ps_title}}</option>
                                @else
                                <option value="">Pilih Kecamatan</option>
                                @endif
                            </select>
                        </div>
                        <div class="input-group set-address">
                            <div class="col-6">
                                <label for="Kodepos">Kodepos</label>
                                <input type="text" name="ps_zip_code" value="{{$address->ps_zip_code}}" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="Telp">No Telp</label>
                                <input type="text" name="ps_phone" value="{{$address->ps_phone}}" class="form-control">
                            </div>

                        </div>
                        <div class="set-address">
                            <label for="">Alamat Lengkap</label>
                            <textarea name="ps_complete_address" id="" class="form-control" cols="30" rows="10">{{$address->ps_complete_address}}</textarea>
                        </div>
                        <div class="form-group m-b-0 text-right">
                            <button class="btn btn-success btn-sm waves-effect waves-light" type="submit" name="submit"><span class="btn-label"><i class="fas fa-save"></i></span> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-script')
<script type="text/javascript">
    function changeKota() {

        jQuery('select[name="ps_id_province"]').on('change', function() {
            var idProv = jQuery(this).val();
            if (idProv) {
                jQuery.ajax({
                    url: '/dashboard/getKota/' + idProv,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        jQuery('select[name="ps_id_city"]').empty();
                        $('select[name="ps_id_city"]').append('<option value="">Pilih Kota</option>');
                        jQuery.each(data, function(key, value) {
                            $('select[name="ps_id_city"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="ps_id_city"]').empty();
            }
        });
    }

    function changeKecamatan() {
        jQuery('select[name="ps_id_city"]').on('change', function() {
            var idCity = jQuery(this).val();
            if (idCity) {
                jQuery.ajax({
                    url: '/dashboard/getKecamatan/' + idCity,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        jQuery('select[name="ps_id_subdistrict"]').empty();
                        $('select[name="ps_id_subdistrict"]').append('<option value="0">Pilih Desa</option>');
                        jQuery.each(data, function(key, value) {
                            $('select[name="ps_id_subdistrict"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="ps_id_subdistrict"]').empty();
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