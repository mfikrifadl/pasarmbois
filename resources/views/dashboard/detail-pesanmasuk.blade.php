@extends('template.dashboard.index')
@section('content')
<body>
<div class="container-fluid">
    <h1 class="mt-4">Pemberitahuan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
        <li class="breadcrumb-item active">Pemberitahuan</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <div class="email-app">
                    <div class="mail-details bg-white">
                        <div class="card-body border-bottom">
                            <h4 class="m-b-0">Pesan Detail</h4>
                        </div>
                        <div class="card-body border-bottom">
                            <div class="d-flex no-block align-items-center m-b-40">
                                <div class="">
                                    <h5 class="m-b-0 font-16 font-medium">{{$pesan->pc_name}}<small> ( {{$pesan->pc_email}} )</small></h5><span>to
                                        {{$pesan->pc_email}}</span>
                                </div>
                            </div>
                            <p>{{$pesan->pc_content}}</p>
                            @foreach ($reply as $r)
                            <div class="card bg-secondary text-white mt-1">
                                <div class="card-body">
                                    <div class="media-body ml-3">
                                        <h5>{{$r->pud_firstname}} {{$r->pud_lastname}}</h5>
                                        <small class="ml-2">{{tgl_indo($r->pc_created_at) . " " . substr($r->pc_created_at, 10, 6)}}</small>
                                        <p>{{$r->pc_content}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <form action="{{route('pesanmasuk.store')}}" method="POST">
                            @csrf
                            <div class="border m-t-20 p-15">
                                <input type="hidden" name="pc_parent" value="{{$pesan->pc_id}}">
                                <input type="hidden" name="pc_email" value="{{$pesan->pc_email}}">
                                <input type="hidden" name="pc_name" value="{{$pesan->pc_name}}">
                                <div class="form-group">
                                
                                    <textarea class="ckeditor form-control" name="pc_content" id="pc_content"></textarea>
                                                                                                       
                                </div>
                                <div class="text-right">
                                    <button type="submit" name="submit" id="" class="btn btn-primary" btn-lg btn-block><i class="fas fa-reply"></i> Kirim</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection