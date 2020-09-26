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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <code>"<"iframe src="BAGIAN INI YANG DI ISIKAN" width="600" height="450" frameborder="0" style="border:0" allowfullscreen>
                            </ifram>"</code>
                    <form class="m-t-20" method="POST" action="{{route('setting.mapsEdit', $maps)}}">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="" name="ps_maps" aria-label="" aria-describedby="basic-addon1" value="{{$maps->ps_maps}}">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="submit"><i class="fas fa-location-arrow"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="map" class="gmaps">
                    <iframe src="{{$maps->ps_maps}}" width="100%" height="100%" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection