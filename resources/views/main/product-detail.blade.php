@extends('template.main.index')
@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/" class="text-info">Home</a></li>
        <li class="breadcrumb-item"><a href="#" class="text-info">{{$ct->pc_title}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$product->pp_title}}</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<div class="row align-items-center codepage" data-codepage="{{$code_page}}">
    <div class="col-md-5">
        <div class="img-detail-wrapper">
            @if (count($img_path) == 0)
            <img src="{{asset('customAuth/img/site/pasar-mbois-default-product.jpg')}}" class="img-fluid px-5 img-product-list" id="img-detail" alt="Responsive image" data-index="0">
            @else
            <img src="{{asset('customAuth/'.$img_path[0]->pip_img_path)}}" class="img-fluid px-5 img-product-list" id="img-detail" alt="Responsive image" data-index="0">
            @endif
            <div class="img-detail-list img-list">
                @if ($img_path != null)
                @foreach ($img_path as $i=>$img)
                <a href="#" class="<?php if ($i == 0) {
                                        echo "active";
                                    } ?> img-product-list">
                    <img src="{{asset('customAuth/'.$img->pip_img_path)}}" data-large-src="{{asset('customAuth/'.$img->pip_img_path)}}" alt="{{$product->pp_title}}" data-index="{{$i}}">
                </a>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="detail-header">
            <h3>{{$product->pp_title}}</h3>
            <h6><span class="rating" data-value="{{$rating}}"></span> <a class="ml-1" href="#reviews">{{$cr}} reviews</a></h6>
            <h3 class="price">Rp {{rupiah($product->pp_selling_price)}}/{{$product->measurement->pm_title_unit}}</h3>
        </div>
        <form>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="quantity">Stok</label>
                        <div>
                            <input type="text" class="form-control" value="{{$product->pp_qty}}" readonly>
                        </div>
                    </div>
                </div>
                @if(Auth::user() != null)
                @if ($product->pp_qty > 0 and Auth::user()->pu_id_role == 3)
                <div class="col-6">
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <div class="input-spinner" id="inputQty">
                            <input type="number" class="form-control" name="qty" id="quantity" value="1" min="1" max="{{$product->pp_qty}}">
                            <div class="btn-group-vertical">
                                <button type="button" class="btn btn-light"><i class="fa fa-chevron-up"></i></button>
                                <button type="button" class="btn btn-light"><i class="fa fa-chevron-down"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endif
            </div>
        </form>
    </div>
</div>
<hr>
<div class="row mt-4">
    <div class="col">
        <h3>Deskripsi</h3>
        <p>{{$product->pp_description}}</p>
        <hr>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Komentar <span class="badge badge-light">{{$cc}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab" aria-controls="pills-review" aria-selected="false">Ulasan <span class="badge badge-light">{{$cr}}</span></a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                @if(Auth::user() != null)
                @if (Auth::user()->pu_id_role == 3)
                <form>
                    <input type="hidden" name="id_product" value="{{$product->pp_id}}">
                    <div class="form-group">
                        <textarea name="content" class="form-control" id="" cols="10" rows="5"></textarea>
                    </div>
                    <div class="form-actions">
                        <div class="text-right">
                            <button type="submit" name="submit" class="btn btn-info"><i class="fa fa-send"></i> Submit</button>
                        </div>
                    </div>
                </form>
                @endif
                @endif
                <hr>
                @if (count($comment) > 0)
                @foreach ($comment as $counter=>$cm)
                <div class="media">
                    @if ($cm->userDetail->pud_img_path == null)
                    <img src="{{asset('customAuth/img/site/user.png')}}" width="50" height="50" alt="{{$cm->userDetail->pud_firstname}} {{$cm->userDetail->pud_lastname}}" class="rounded-circle">
                    @else
                    <img src="{{asset('customAuth/'.$cm->userDetail->pud_img_path)}}" width="50" height="50" alt="{{$cm->userDetail->pud_firstname}} {{$cm->userDetail->pud_lastname}}" class="rounded-circle">
                    @endif
                    <div class="media-body ml-3">
                        <h5 class="mb-0">{{$cm->userDetail->pud_firstname}} {{$cm->userDetail->pud_lastname}}</h5>
                        <small class="ml-2">{{tgl_indo($cm->pc_created_at)}}</small>
                        <p>{{$cm->pc_content}}</p>
                        @if(Auth::user() != null)
                        @if (Auth::user()->pu_id_role == 1 || Auth::user()->pu_id_role == 2)
                        <button type="button" id="reply{{$cm->pc_id}}" data-rbtn="#reply{{$cm->pc_id}}" class="btn btn-info btn-sm reply" data-form="{{$counter}}">Balas Komentar</button>
                        @endif
                        @endif
                    </div>
                </div>
                <div class="col-11 ml-5 mt-2 formreply" data-form="{{$counter}}" id="{{$cm->pc_id}}" data-fbtn="#formreply{{$cm->pc_id}}" style="display:none;">
                    @if(Auth::user() != null)
                    @if (Auth::user()->pu_id_role == 1 || Auth::user()->pu_id_role == 2)
                    <form action="{{route('main.product.comment.reply')}}" method="POST">
                        @csrf
                        <input type="hidden" name="pc_id_product" value="{{$product->pp_id}}">
                        <input type="hidden" name="pc_parent" value="{{$cm->pc_id}}">
                        <div class="form-group">
                            <textarea name="pc_content" class="form-control" id="" cols="10" rows="5" required></textarea>
                        </div>
                        <div class="form-actions">
                            <div class="text-right">
                                <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Submit</button>
                            </div>
                        </div>
                    </form>
                    @endif
                    @endif
                </div>
                @foreach ($reply as $re)
                @if ($cm->pc_id == $re->pc_parent)
                <div class="media col-11 ml-5 mt-2">
                    @if ($re->userDetail->pud_img_path == null)
                    <img src="{{asset('customAuth/img/site/user.png')}}" width="50" height="50" alt="{{$re->userDetail->pud_firstname}} {{$re->userDetail->pud_lastname}}" class="rounded-circle">
                    @else
                    <img src="{{asset('customAuth/'.$re->userDetail->pud_img_path)}}" width="50" height="50" alt="{{$re->userDetail->pud_firstname}} {{$re->userDetail->pud_lastname}}" class="rounded-circle">
                    @endif
                    <div class="media-body ml-3">
                        <h5 class="mb-0">{{$re->userDetail->pud_firstname}} {{$re->userDetail->pud_lastname}}</h5>
                        <small class="ml-2">{{tgl_indo($re->pc_created_at)}}</small>
                        <p>{{$re->pc_content}}</p>
                    </div>
                </div>
                @endif
                @endforeach
                <hr>
                @endforeach
                @else
                <h5 class="text-center">Komentar Produk Ini belum tersedia</h5>
                <hr>
                @endif

            </div>
            <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
                <hr>
                @if (count($review) > 0)
                @foreach ($review as $r)
                <div class="media">
                    @if ($r->userDetail->pud_img_path == null)
                    <img src="{{asset('customAuth/img/site/user.png')}}" width="50" height="50" alt="{{$r->userDetail->pud_firstname}} {{$r->userDetail->pud_lastname}}" class="rounded-circle">
                    @else
                    <img src="{{asset('customAuth/'.$r->pud_img_path)}}" width="50" height="50" alt="{{$r->userDetail->pud_firstname}} {{$r->userDetail->pud_lastname}}" class="rounded-circle">
                    @endif
                    <div class="media-body ml-3">
                        <h5 class="mb-0">{{$r->userDetail->pud_firstname}} {{$r->userDetail->pud_lastname}}</h5>
                        <span class="rating text-secondary" data-value="{{$r->pr_rating}}"></span>
                        <small class="ml-2">{{tgl_indo($r->pr_created_at)}}</small>
                        <p>{{$r->pr_content}}</p>
                    </div>
                </div>
                @endforeach
                @else
                <h5 class="text-center">Ulasan Produk Ini belum tersedia</h5>
                @endif
                <hr>

            </div>
        </div>
        @endsection