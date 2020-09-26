@extends('template.dashboard.backup')

@section('content')
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid" data-codepage="{{$code_page}}">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$ticket[0]->pt_title}}</h4>
                    <p>{{$ticket[0]->pt_content}}</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ticket Replies</h4>
                    <ul class="list-unstyled m-t-40">
                        @foreach ($reply as $r)
                        <li class="media my-4">
                            @if ($r->pud_img_path == null)
                            <img class="m-r-15" src="{{asset('customAuth/img/site/user.png')}}" width="60" alt="{{$r->pud_firstname}} {{$r->pud_lastname}}">
                            @else
                            <img class="m-r-15" src="{{asset('customAuth/$r->pud_img_path')}}" width="60" alt="{{$r->pud_firstname}} {{$r->pud_lastname}}">
                            @endif
                            <div class="media-body">
                                <h5 class="mt-0 mb-1">{{$r->pud_firstname}} {{$r->pud_lastname}}</h5>{{$r->ptr_content}}<br>
                                <span class="label label-info">{{tgl_indo($r->ptr_created_at) . substr($r->ptr_created_at, 10, 6)}}</span>
                            </div>
                        </li>
                        <hr>
                        @endforeach
                    </ul>
                </div>
            </div>
            @if ($ticket[0]->pt_status < 3) <div class="card">
                <div class="card-body">
                    <h4 class="m-b-20">Write a reply</h4>
                    <form method="post" action="{{route('tiket.tiket.reply')}}">
                        @csrf
                        <input type="hidden" name="pt_no_ticket" value="{{$ticket[0]->pt_no_ticket}}">
                        <input type="hidden" name="ptr_id_ticket" value="{{$ticket[0]->pt_id}}">
                        <textarea class="form-control" rows="5" id="content" name="ptr_content"></textarea>
                        <div class="text-right">
                            <button type="submit" name="submit" class="m-t-20 btn waves-effect waves-light btn-success">Reply</button>
                        </div>
                    </form>
                </div>
        </div>
        @endif
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ticket Info</h4>
            </div>
            <div class="card-body bg-light">
                <div class="row text-center">
                    <div class="col-6 m-t-10 m-b-10">
                        @if ($ticket[0]->pt_status == 0)
                        <span class="label label-info">New Ticket</span>
                        @elseif ($ticket[0]->pt_status == 1)
                        <span class="label label-warning">Opened</span>
                        @elseif ($ticket[0]->pt_status == 2)
                        <span class="label label-danger">Pending</span>
                        @elseif ($ticket[0]->pt_status == 3)
                        <span class="label label-success">Close</span>
                        @endif
                    </div>
                    <div class="col-6 m-t-10 m-b-10">
                        {{tgl_indo($ticket[0]->pt_created_at) . substr($ticket[0]->pt_created_at, 10, 6)}}
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body text-center">
                <h4 class="card-title">User Info</h4>
                <div class="profile-pic m-b-20 m-t-20">
                    @if ($ticket[0]->pud_img_path == null)
                    <img src="{{asset('customAuth/img/site/user.png')}}" width="150" class="rounded-circle" alt="user">
                    @else
                    <img src="{{asset('customAuth/$r->pud_img_path')}}" width="150" class="rounded-circle" alt="user">
                    @endif
                    <h4 class="m-t-20 m-b-0">{{$ticket[0]->pud_firstname}} {{$ticket[0]->pud_lastname}}</h4>
                    <a href="mailto:{{$ticket[0]->pud_email}}">{{$ticket[0]->pud_email}}</a>
                </div>
                <div class="row text-center m-t-40">
                    <div class="col-4">
                        <h3 class="font-bold">{{$ticketTotal}}</h3>
                        <h6>Total</h6>
                    </div>
                    <div class="col-4">
                        <h3 class="font-bold">{{$ticketOpen}}</h3>
                        <h6>Open</h6>
                    </div>
                    <div class="col-4">
                        <h3 class="font-bold">{{$ticketClose}}</h3>
                        <h6>Closed</h6>
                    </div>
                </div>
                <div class="p-25 border-top m-t-15">
                    <div class="row text-center">
                        <div class="col-6 border-right">
                            @if ($ticket[0]->pt_status == 2)
                            <form method="post" action="{{route('tiket.tiket.open', $ticket[0]->pt_id)}}">
                                @csrf
                                {{method_field('PUT')}}
                                <button type="submit" class="link d-flex align-items-center justify-content-center font-medium open"><i class="mdi mdi-lock-open font-20 m-r-5"></i>Open</button>
                            </form>
                            @elseif ($ticket[0]->pt_status == 3)
                            <a class="link d-flex align-items-center justify-content-center font-medium disabled"><i class="mdi mdi-lock-open font-20 m-r-5"></i>Pending</a>
                            @else
                            <form method="post" action="{{route('tiket.tiket.pending', $ticket[0]->pt_id)}}">
                                @csrf
                                {{method_field('PUT')}}
                                <button type="submit" class="link d-flex align-items-center justify-content-center font-medium pending"><i class="mdi mdi-alert-octagon font-20 m-r-5"></i>Pending</button>
                            </form>
                            @endif
                        </div>
                        <div class="col-6">
                            @if ($ticket[0]->pt_status != 3)
                            <form method="post" action="{{route('tiket.tiket.close', $ticket[0]->pt_id)}}">
                                @csrf
                                {{method_field('PUT')}}
                                <button type="submit" class="link d-flex align-items-center justify-content-center font-medium open"><i class="mdi mdi-close font-20 m-r-5"></i>Close</a>
                            </form>
                            @else
                            <form method="post" action="{{route('tiket.tiket.open', $ticket[0]->pt_id)}}">
                                @csrf
                                {{method_field('PUT')}}
                                <button type="submit" class="link d-flex align-items-center justify-content-center font-medium open"><i class="mdi mdi-lock-open font-20 m-r-5"></i>Open</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection