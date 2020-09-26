@extends('template.dashboard.index')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Daftar Tiket</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
        <li class="breadcrumb-item active">Daftar Tiket</li>
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
                    <h4 class="card-title">Tickets</h4>
                    <div class="row m-t-40">
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="box bg-info text-center">
                                    <h1 class="font-light text-white">{{$all}}</h1>
                                    <h6 class="text-white">Total Tickets</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="box bg-primary text-center">
                                    <h1 class="font-light text-white">{{$open}}</h1>
                                    <h6 class="text-white">Responded</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="box bg-success text-center">
                                    <h1 class="font-light text-white">{{$resolve}}</h1>
                                    <h6 class="text-white">Resolve</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white">{{$pending}}</h1>
                                    <h6 class="text-white">Progress</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                    </div>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Title</th>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Created by</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)
                                <tr>
                                    <td>
                                        @if($ticket->pt_status == 0)
                                        <span class="label label-info">New Ticket</span>
                                        @elseif ($ticket->pt_status == 1)
                                        <span class="label label-warning">Opened</span>
                                        @elseif ($ticket->pt_status == 2)
                                        <span class="label label-danger">Progress</span>
                                        @elseif ($ticket->pt_status == 3)
                                        <span class="label label-success">Close</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($ticket->pt_status == 0)
                                        <a href="{{route('tiket.tiket.detail', $ticket->pt_no_ticket)}}" class="font-bold link">{{$ticket->pt_title}}</a>
                                        @else
                                        <a href="{{route('tiket.tiket.detail', $ticket->pt_no_ticket)}}" class="font-medium link">{{$ticket->pt_title}}</a>
                                        @endif
                                    </td>
                                    <td><a href="{{route('tiket.tiket.detail', $ticket->pt_no_ticket)}}" class="font-medium link">{{$ticket->pt_no_ticket}}</a></td>
                                    <td>{{$ticket->ptt_title}}</td>
                                    <td>{{$ticket->pud_firstname}} {{$ticket->pud_lastname}}</td>
                                    <td>{{$ticket->pt_created_at}}</td>
                                    <td>
                                        <form action="{{route('tiket.tiket.destroy', $ticket)}}" method="POST">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-danger btn-sm waves-effect waves-light del-product" type="submit"><span class="btn-label"><i class="fa as fas fa-trash"></i></span>
                                                Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
