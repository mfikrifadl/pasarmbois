@extends('template.dashboard.index')

@section('content')
<div class="container-fluid">
	<h1 class="mt-4">Daftar Admin</h1>
	<ol class="breadcrumb mb-4">
		<li class="breadcrumb-item"><a href="\dashboard\">Dashboard</a></li>
		<li class="breadcrumb-item active">Daftar Admin</li>
	</ol>
	@if(session()->has('message'))
	<div class="alert alert-success">
		{{ session()->get('message') }}
	</div>
	@endif
	<div class="row">
		<div class="col-4 card">
			<form action="{{route('manajemenadmin.add')}}" method="POST">
				@csrf
				<div class="form-group checkUsername">
					<label for="">Username</label>
					<input type="text" id="checkUsername" class="form-control" name="pu_username" id="username" required>
				</div>
				<div class="form-group">
					<label for="">Firstname</label>
					<input type="text" name="pud_firstname" class="form-control" placeholder="Username" required>
				</div>
				<div class="form-group">
					<label for="">Lastname</label>
					<input type="text" name="pud_lastname" class="form-control" placeholder="Username" required>
				</div>
				<div class="form-group checkEmail">
					<label for="">Email</label>
					<input id="checkEmail" type="email" class="form-control" name="pud_email" required>
				</div>
				<div class="form-group">
					<label for="">Jabatan</label>
					<select name="pu_id_role" class="form-control">
						<option value="1">Super Admin</option>
						<option value="2">Admin</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Password</label>
					<input type="password" name="pu_password" class="form-control" placeholder="Password" required>
				</div>
				<div class="form-group text-right">
					<button class="btn btn-danger btn-sm waves-effect waves-light" type="submit" name="submit"><span class="btn-label"><i class="fas fa-save"></i></span> Simpan</button>
				</div>
			</form>
		</div>
		<div class="col-8">
			<div class="row el-element-overlay">
				@foreach ($admin as $a)
				<div class="col-lg-3 col-md-3">
					<div class="card">
						<div class="el-card-item ">
							@if ($a->pud_img_path == null)
							<div class="el-card-avatar el-overlay-1"> <img src="{{asset('customAuth/img/site/user.png')}}" alt="user" />
								@else
								<div class="el-card-avatar el-overlay-1"> <img src="{{asset('customAuth/'.$a->pud_img_path)}}" alt="user" />
									@endif

									<div class="el-overlay">
										<ul class="list-style-none el-info">
											@if ($a->pu_is_ban == false)
											<form action="{{route('manajemenadmin.banned', $a)}}" class="d-inline-block" method="POST" enctype="multipart/form-data">
												@csrf
												{{method_field('PUT')}}
												<li class="el-item"><button class="btn default btn-outline image-popup-vertical-fit el-link ban-admin" type="submit"><i class="fa as fa-ban"></i>
													</button></li>
											</form>
											@else
											<form action="{{route('manajemenadmin.unbanned', $a)}}" method="POST" class="d-inline-block" enctype="multipart/form-data">
												@csrf
												{{method_field('PUT')}}
												<li class="el-item"><button class="btn default btn-outline image-popup-vertical-fit el-link unban-admin" type="submit"><i class="icon icon-like"></i></button></li>
											</form>
											@endif
											<li class="el-item"><a class="btn default btn-outline el-link" href="{{route('manajemenadmin.detail', $a->pu_id)}}"><i class="mdi mdi-magnify-plus"></i></a></li>
										</ul>
									</div>
								</div>
								<!-- end of image -->

								<div class="el-card-content">
									<h4 class="m-b-0">{{$a->pud_firstname}} {{$a->pud_lastname}}</h4> <span class="text-muted">{{$a->pru_title}}</span>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	@endsection