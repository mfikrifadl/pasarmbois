@extends('template.dashboard.index')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">User Detail</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
        <li class="breadcrumb-item active">member</li>
    </ol>
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30"> <img src="{{asset('customAuth/img/site/user.png')}}" class="rounded-circle" width="150" />
                            <h4 class="card-title m-t-10">{{$user->pud_firstname}}</h4>
                            <h6 class="card-subtitle">Member</h6>
                            @if($user->user->pu_is_ban == false)
                            <form action="{{route('member.banned.edit', $user)}}" method="POST">
                                @csrf
                                {{method_field('PUT')}}
                                <button class="btn btn-warning btn-sm waves-effect waves-light ban-product" type="submit"><span class="btn-label"><i class="fa as fa-ban"></i></span>
                                    Banned</button>
                            </form>
                            @else
                            <form action="{{route('member.unbanned.edit', $user->pu_id)}}" method="POST">
                                @csrf
                                {{method_field('PUT')}}
                                <button class="btn btn-success btn-sm waves-effect waves-light unban-product" type="submit"><span class="btn-label"><i class="icon icon-like"></i></span>
                                    Un Banned</button>
                            </form>
                            @endif
                        </center>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="card-body"> <small class="text-muted">Email address </small>
                        <h6>{{$user->pud_email}}</h6> <small class="text-muted p-t-30 db">Phone</small>
                        <h6>{{$user->pud_phone}}</h6>
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
                    </ul>
                    <!-- Tabs -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-xs-6 b-r"> <strong>Full Name</strong>
                                        <br>
                                        <p class="text-muted">{{$user->pud_firstname}} {{$user->pud_lastname}}</p>
                                    </div>
                                    <div class="col-md-4 col-xs-6 b-r"> <strong>Mobile</strong>
                                        <br>
                                        <p class="text-muted">{{$user->pud_phone}}</p>
                                    </div>
                                    <div class="col-md-4 col-xs-6 b-r"> <strong>Email</strong>
                                        <br>
                                        <p class="text-muted">{{$user->pud_email}}</p>
                                    </div>
                                </div>
                                <hr>
                                <p class="m-t-30"></p>
                                <div class="form-group row p-b-15">
                                    <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">Line</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" disabled value="{{$user->pud_line}}">
                                    </div>
                                </div>
                                <div class="form-group row p-b-15">
                                    <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">Whatsapp</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" disabled value="{{$user->pud_whatsapp}}">
                                    </div>
                                </div>
                                <div class="form-group row p-b-15">
                                    <label for="inputEmail3" class="col-sm-3 text-right control-label col-form-label">Telegram</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" disabled value="{{$user->pud_telegram}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
    </div>
</div>
@endsection