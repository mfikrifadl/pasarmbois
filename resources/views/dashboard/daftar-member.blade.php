@extends('template.dashboard.index')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Daftar User</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
        <li class="breadcrumb-item active">Daftar User</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key=>$user)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$user->userdetails[0]->pud_firstname}} {{$user->userdetails[0]->pud_lastname}}</td>
                            <td>{{$user->pu_username}}</td>
                            <td>{{$user->userdetails[0]->pud_email}}</td>
                            <td>
                                <a href="{{route('member.member.show', $user->userdetails[0]->pud_id)}}" class="btn btn-primary btn-sm waves-effect waves-light" role="button" aria-pressed="true"><i class="fa as fas fa-search-plus"></i> Detail</a>
                                @if($user->pu_is_ban == false)
                                <form action="{{route('member.banned.edit', $user->pu_id)}}" class="d-inline-block" method="POST">
                                    @csrf
                                    {{method_field('PUT')}}
                                    <button class="btn btn-danger btn-sm waves-effect waves-light ban-product" type="submit"><span class="btn-label"><i class="fa as fa-ban"></i></span>
                                        Banned</button>
                                </form>
                                @else
                                <form action="{{route('member.unbanned.edit', $user->pu_id)}}" class="d-inline-block" method="POST">
                                    @csrf
                                    {{method_field('PUT')}}
                                    <button class="btn btn-success btn-sm waves-effect waves-light unban-product" type="submit"><span class="btn-label"><i class="icon icon-like"></i></span>
                                        Un Banned</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection