@extends('template.dashboard.index')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Detail Admin</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
        <li class="breadcrumb-item active">Detail Admin</li>
    </ol>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    @if ($profile->pud_img_path == null)
                    <center class="m-t-30"> <img src="{{asset('customAuth/img/site/user.png')}}" class="rounded-circle" width="150" />
                        @else
                        <center class="m-t-30"> <img src="{{asset('customAuth/'.$profile->pud_img_path)}}" class="rounded-circle" style="height:130px; object-fit:cover;" width="150" />
                            @endif
                            <h4 class="card-title m-t-10">{{$profile->pud_firstname}} {{$profile->pud_lastname}}</h4>
                            <h6 class="card-subtitle">{{$profile->pru_title}}</h6>
                            @if ($profile->pu_is_ban == false)
                            <form action="{{route('manajemenadmin.banned', $profile)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{method_field('PUT')}}
                                <button class="btn btn-warning btn-sm waves-effect waves-light ban-profile" type="submit"><span class="btn-label"><i class="fa as fa-ban"></i></span> Banned</button>
                            </form>
                            @else
                            <form action="{{route('manajemenadmin.unbanned', $profile)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{method_field('PUT')}}
                                <button class="btn btn-success btn-sm waves-effect waves-light unban-profile" type="submit"><span class="btn-label"><i class="icon icon-like"></i></span> unBanned</button>
                            </form>
                            @endif
                        </center>
                </div>
                <div>
                    <hr>
                </div>
                <div class="card-body"> <small class="text-muted">Email address </small>
                    <h6>{{$profile->pud_email}}</h6> <small class="text-muted p-t-30 db">Phone</small>
                    <h6>{{$profile->pud_phone}}</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Tabs -->
                <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                    </li>
                    @if (Auth::user()->pu_id == $profile->pu_id)
                    <li class="nav-item">
                        <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Setting</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-password" data-toggle="pill" href="#password" role="tab" aria-controls="pills-password" aria-selected="false">Password</a>
                    </li>
                    @endif
                </ul>
                <!-- Tabs -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-xs-6 b-r"> <strong>Full Name</strong>
                                    <br>
                                    <p class="text-muted">{{$profile->pud_firstname}} {{$profile->pud_lastname}}</p>
                                </div>
                                <div class="col-md-4 col-xs-6 b-r"> <strong>Mobile</strong>
                                    <br>
                                    <p class="text-muted">{{$profile->pud_phone}}</p>
                                </div>
                                <div class="col-md-4 col-xs-6 b-r"> <strong>Email</strong>
                                    <br>
                                    <p class="text-muted">{{$profile->pud_email}}</p>
                                </div>
                            </div>
                            <hr>
                            <p class="m-t-30">{{$profile->note}}</p>
                            <div class="form-group row p-b-15">
                                <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">Line</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" disabled value="{{$profile->pud_line}}">
                                </div>
                            </div>
                            <div class="form-group row p-b-15">
                                <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">Whatsapp</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" disabled value="{{$profile->pud_whatsapp}}">
                                </div>
                            </div>
                            <div class="form-group row p-b-15">
                                <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">Telegram</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" disabled value="{{$profile->pud_telegram}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->pu_id == $profile->pu_id)
                    <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                        <div class="card-body">
                            <form action="{{route('manajemenadmin.update', $profile->pu_id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{method_field('PUT')}}
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Username</label>
                                        @if ($profile->pu_username == null)
                                        <input type="text" placeholder="username" name="pu_username" class="form-control form-control-line">
                                        @else
                                        <input type="text" placeholder="username" name="pu_username" class="form-control form-control-line" value="{{$profile->pu_username}}" disabled>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Nama Depan</label>
                                        <input type="text" placeholder="firstname" name="pud_firstname" class="form-control form-control-line" value="{{$profile->pud_firstname}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Nama Belakang</label>
                                        <input type="text" placeholder="Johnathan Doe" name="pud_lastname" class="form-control form-control-line" value="{{$profile->pud_lastname}}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>E-mail</label>
                                        <input type="email" placeholder="admin@pasarmbois" name="pud_email" class="form-control form-control-line" value="{{$profile->pud_email}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>No Handphone</label>
                                        <input type="text" placeholder="081XXXXXXXX" name="pud_phone" class="form-control form-control-line" value="{{$profile->pud_phone}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Line</label>
                                        <input type="text" placeholder="@anonim" name="pud_line" class="form-control form-control-line" value="{{$profile->pud_line}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Whastapp</label>
                                        <input type="text" placeholder="081XXXXXXXX" name="pud_whatsapp" class="form-control form-control-line" value="{{$profile->pud_whatsapp}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Telegram</label>
                                        <input type="text" placeholder="081XXXXXXXX" name="pud_telegram" class="form-control form-control-line" value="{{$profile->telegram}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Jenis Kelamin</label>
                                        <div>
                                            @if ($profile->pud_gender == 'male')
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="pud_gender" id="inlineRadio1" value="male" checked="checked">
                                                <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="pud_gender" id="inlineRadio2" value="female">
                                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                            </div>
                                            @else
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="pud_gender" id="inlineRadio1" value="male">
                                                <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="pud_gender" id="inlineRadio2" value="female" checked="checked">
                                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Upload Foto Profil</label>
                                        <div class="custom-file">
                                            <label for="slidericonInput" class="control-label col-form-label">Choose file</label>
                                            <input type="file" id="input-file-disable-remove" name="pud_img_path" class="dropify" data-show-remove="false" />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Password</label>
                                        <div>
                                            <input type="password" name="pu_password" class="form-control form-control-line">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" type="submit">Update Profile</button>
                                        </div>`
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="pills-password">
                        <div class="card-body">
                            <form action="{{route('manajemenadmin.updatePass', $profile)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{method_field('PUT')}}
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Password Baru</label>
                                        <input class="form-control" type="password" name="newpassword" minlength=5 required />
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Password Lama</label>
                                        <div>
                                            <input type="password" name="pu_password" class="form-control form-control-line">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" type="submit">Update Profile</button>
                                        </div>`
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
</div>
@endsection