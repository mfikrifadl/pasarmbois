@extends('template.dashboard.index')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Setting Maps</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
        <li class="breadcrumb-item active">Setting Maps</li>
    </ol>
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