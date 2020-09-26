@extends('template.main.index')
@section('content')
<!-- Home Slider -->
<div class="swiper-container codepage" data-codepage="{{$code_page}}" id="home-slider">
    <div class="swiper-wrapper">
        @foreach ($slider as $s)
        <a href="<?php if ($s->pss_link == null) {
                        echo "#";
                    } else {
                        echo $s->pss_link;
                    } ?>" class="swiper-slide" data-cover="{{asset('customAuth/'.$s->pss_img_path)}}" data-xs-height="150px" data-sm-height="265px" data-md-height="300px" data-lg-height="300px" data-xl-height="300px"></a>
        @endforeach
    </div>
    <a href="#" role="button" class="carousel-control-prev d-none d-sm-flex" id="home-slider-prev"><i class="fa fa-angle-left fa-lg"></i></a>
    <a href="#" role="button" class="carousel-control-next d-none d-sm-flex" id="home-slider-next"><i class="fa fa-angle-right fa-lg"></i></a>
</div>
<!-- /Home Slider -->

<!-- Hot new releases -->
<h3 class="title mt-4">Produk Terbaru</h3>
<div class="row no-gutters gutters-2">
    @foreach ($productNew as $pn)
    <div class="col-6 col-md-3 mb-2">
        <div class="card card-product">
            <?php
            if (isset($pn['id_wishlist'])) {
                if ($pn['id_wishlist'] != 0) {
                    $class_wishlist = "active";
                    $data_wishlist = ' data-product=' . $pn['id_product'] . ' data-id=' . $pn['id_wishlist'] . ' data-wishlist=remove' . "data-url= /wishlist/user_wishlist";
                } else {
                    $class_wishlist = "";
                    $data_wishlist = ' data-product=' . $pn['id_product'] . ' data-wishlist=add' . "data-url= /wishlist/user_wishlist";
                }
            } else {
                $class_wishlist = "";
                $data_wishlist = ' data-product=' . $pn['id_product'] . ' data-wishlist=add' . "data-url= /wishlist/user_wishlist";
            }

            if (isset($pn['id_cart'])) {
                if ($pn['id_cart'] != 0) {
                    $class_cart = "active";
                    $data_cart = ' data-product=' . $pn['id_product'] . ' data-id=' . $pn['id_cart'] . ' data-cart=remove' . " data-url= /cart/remove_cart";
                } else {
                    $class_cart = "";
                    $data_cart = ' data-product=' . $pn['id_product'] . ' data-cart=add' . ' data-url=cart/add_cart';
                }
            } else {
                $class_cart = "";
                $data_cart = ' data-product=' . $pn['id_product'] . ' data-cart=add' . ' data-url=cart/add_cart';
            }

            $now = strtotime('Y-m-d H:i:s');
            $expire =  strtotime('Y-m-d H:i:s', strtotime('+24 hour', strtotime($pn['pp_created_at'])));
            if ($expire < $now) : ?>
                <div class="ribbon"><span class="bg-info text-white">New</span></div>
            <?php elseif ($pn['pp_qty'] > 0 && $pn['pp_qty'] <= 5) : ?>
                <div class="badge badge-danger badge-pill">Tersedia {{$pn->pp_qty}}</div>
            <?php elseif ($pn['pp_qty'] <= 0) : ?>
                <div class="badge badge-danger badge-pill">Habis</div>
            <?php endif; ?>
            <?php if (Auth::user() != null) : ?>
                <?php if (Auth::user()->pu_id_role == 1 || Auth::user()->pu_id_role == 2) : ?>
                    <button class="wishlist <?= $class_wishlist; ?>" <?= $data_wishlist; ?> <?php if (Auth::user()->pu_id_role == 3) {
                                                                                                echo 'data-toggle="modal" data-target=".bs-example-modal-sm"';
                                                                                            } ?> title="Add to wishlist"><i class="fa fa-heart"></i></button>
                <?php endif; ?>
                <?php if ($pn['pp_qty'] > 0 and Auth::user()->pu_id_role == 1 || Auth::user()->pu_id_role == 2) : ?>
                    <button class="add-cart  <?= $class_cart; ?>" <?= $data_cart; ?> title="Added to cart" data-id="<?php echo $pn['pp_id'] ?>"><i class="fa fa-shopping-cart fa-lg"></i></button>
                <?php endif; ?>
            <?php endif; ?>
            <a href="p/{{$pn->pp_slug}}">
                @if(count($pn->images) > 0)
                <img src="{{asset('customAuth/'.$pn->images[0]->pip_img_path)}}" alt="{{$pn->pp_title}}" class="card-img-top img-product">
                @else
                <img src="{{asset('customAuth/img/site/pasar-mbois-default-product.jpg')}}" alt="{{$pn->pp_title}}" class="card-img-top img-product">
                @endif
            </a>
            <div class="card-body">
                <span class="price">Rp. {{rupiah($pn->pp_selling_price)}}</span>
                <a href="/p/{{$pn->pp_slug}}" class="card-title h6">{{$pn->pp_title}}</a>
                <div class="d-flex justify-content-between align-items-center">
                    @if ($pn->rating == 0)
                    <button type="button" data-id="{{$pn->pp_id}}" onclick="window.location.href='/p/{{$pn->pp_slug}}'" class="btn btn-outline-info btn-sm btn-block detail-product">Lihat Detail</button>
                    @else
                    <span class="rating" data-value="{{$pn->rating}}"></span>
                    <button type="button" data-id="{{$pn->pp_id}}" onclick="window.location.href='/p/{{$pn->pp_slug}}'" class="btn btn-outline-info btn-sm detail-product">Lihat Detail</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- /Hot new releases -->
<!-- Popular -->
<h3 class="title mt-4">Produk Populer</h3>
<div class="content-slider">
    <div class="swiper-container" id="popular-slider">
        <div class="swiper-wrapper">

            <div class="swiper-slide">
                <div class="row no-gutters gutters-2">
                    <?php $i = 0;
                    foreach ($populer as $pp) :
                        if (isset($pp->pp_id_wishlist)) {
                            if ($pp->pp_id_wishlist != 0) {
                                $class_wishlist = "active";
                                $data_wishlist = ' data-produc=' . $pp->pp_id . ' data-id=' . $pp['id_wishlist'] . ' data-wishlist=remove' . " data-url=wishlist/user_wishlist";
                            } else {
                                $class_wishlist = "";
                                $data_wishlist = ' data-product=' . $pp->pp_id . ' data-wishlist=add' . ' data-url=wishlist/user_wishlist';
                            }
                        } else {
                            $class_wishlist = "";
                            $data_wishlist = ' data-product=' . $pp->pp_id . ' data-wishlist=add' . ' data-url=wishlist/user_wishlist';
                        }

                        if (isset($pp->pp_id_cart)) {
                            if ($pp->pp_id_cart != 0) {
                                $class_cart = "active";
                                $data_cart = ' data-product=' . $pp->pp_id . ' data-id=' . $pp['id_cart'] . ' data-cart=remove' . " data-url=cart/remove_cart";
                            } else {
                                $class_cart = "";
                                $data_cart = ' data-product=' . $pp->pp_id . ' data-cart=add' . ' data-url=cart/add_cart';
                            }
                        } else {
                            $class_cart = "";
                            $data_cart = ' data-product=' . $pp->pp_id . ' data-cart=add' . ' data-url=cart/add_cart';
                        }

                        if ($i < 4) : ?>
                            <div class="col-6 col-md-3 mb-2">
                                <div class="card card-product">
                                    @if ($pp->pp_qty > 0 && $pp->pp_qty <= 5) <div class="badge badge-danger badge-pill">Tersedia {{$pp->pp_qty}}</div>
                                @elseif ($pp->pp_qty <= 0) <div class="badge badge-danger badge-pill">Habis
                            </div>
                            @endif
                            @if(Auth::user() != null)
                            @if (Auth::user()->pu_id_role == 1 || Auth::user()->pu_id_role == 2)
                            <button class="wishlist <?= $class_wishlist; ?>" <?= $data_wishlist; ?> <?php if (Auth::user()->pu_id_role == 3) {
                                                                                                        echo 'data-toggle="modal" data-target=".bs-example-modal-sm"';
                                                                                                    } ?> title="Add to wishlist"><i class="fa fa-heart"></i></button>
                            @endif
                            @endif
                            @if(Auth::user() != null)
                            @if ($pp->pp_qty > 0 and Auth::user()->pu_id_role == 1 || Auth::user()->pu_id_role == 2)
                            <button class="add-cart  <?= $class_cart; ?>" <?= $data_cart; ?> title="Added to cart" data-id="{{$pp->pp_id}}"><i class="fa fa-shopping-cart fa-lg"></i></button>
                            @endif
                            @endif
                            <a href="/p/{{$pp->pp_slug}}">
                                @if($pp->img_path != null)
                                <img src="{{asset('customAuth/'.$pp->img_path)}}" alt="{{$pp->pp_title}}" class="card-img-top img-product">
                                @else
                                <img src="{{asset('customAuth/img/site/pasar-mbois-default-product.jpg')}}" alt="{{$pn->pp_title}}" class="card-img-top img-product">
                                @endif
                            </a>
                            <div class="card-body">
                                <span class="price">Rp. {{rupiah($pp->pp_selling_price)}}</span>
                                <a href="/p/{{$pp->pp_slug}}" class="card-title h6">{{$pp->pp_title}}</a>
                                <div class="d-flex justify-content-between align-items-center">
                                    @if ($pp->rating == 0)
                                    <button type="button" data-id="{{$pp->pp_id}}" onclick="window.location.href='/p/{{$pp->pp_slug}}'" class="btn btn-outline-info btn-sm btn-block detail-product">Lihat Detail</button>
                                    @else
                                    <span class="rating" data-value="{{$pp->rating}}"></span>
                                    <button type="button" data-id="{{$pp->pp_id}}" onclick="window.location.href='/p/{{$pp->pp_slug}}'" class="btn btn-outline-info btn-sm detail-product">Lihat Detail</button>
                                    @endif
                                </div>
                            </div>
                </div>
            </div>
    <?php endif;
                        $i++;
                    endforeach; ?>
        </div>
    </div>

    <div class="swiper-slide">
        <div class="row no-gutters gutters-2">
            <?php $i = 0; ?>
            @foreach ($populer as $pp)
            @if ($i > 3 && $i < 8) <div class="col-6 col-md-3 mb-2">
                <div class="card card-product">
                    @if ($pp->pp_qty > 0 && $pp->pp_qty <= 5) <div class="badge badge-danger badge-pill">Tersedia {{$pp->pp_qty}}</div>
                @elseif ($pp->pp_qty <= 0) <div class="badge badge-danger badge-pill">Habis</div>
        @endif
        @if(Auth::user() != null)
        <button class="wishlist" <?php if (Auth::user() != null) {
                                        if (Auth::user()->pu_id_role != 3) {
                                            echo 'data-toggle="modal" data-target=".bs-example-modal-sm"';
                                        }
                                    } ?> title="Add to wishlist"><i class="fa fa-heart"></i></button>
        @if ($pp->pp_qty > 0)
        <button class="add-cart  <?= $class_cart; ?>" <?= $data_cart; ?> <?php if (Auth::user() != null) {
                                                                                if (Auth::user()->pu_id_role != 3) {
                                                                                    echo 'data-toggle="modal" data-target=".bs-example-modal-sm"';
                                                                                }
                                                                            } ?> title="Added to cart" data-id="{{$pp->pp_id}}"><i class="fa fa-shopping-cart fa-lg"></i></button>
        @endif
        @endif
        <a href="/p/{{$pp->pp_slug}}">
            @if(isset($pp->img_path))
            <img src="{{asset('customAuth/'.$pp->img_path)}}" walt="{{$pp->pp_title}}" class="card-img-top img-product">
            @else
            <img src="{{asset('customAuth/img/site/pasar-mbois-default-product.jpg')}}" alt="{{$pn->pp_title}}" class="card-img-top img-product">
            @endif
        </a>
        <div class="card-body">
            <span class="price">Rp. {{rupiah($pp->pp_selling_price)}}</span>
            <a href="/p/{{$pp->pp_slug}}" class="card-title h6">{{$pp->pp_title}}</a>
            <div class="d-flex justify-content-between align-items-center">
                @if ($pp->rating == 0)
                <button type="button" data-id="{{$pp->pp_id}}" onclick="window.location.href='/p/{{$pp->pp_slug}}'" class="btn btn-outline-info btn-sm btn-block detail-product">Lihat Detail</button>
                @else
                <span class="rating" data-value="{{$pp->rating}}"></span>
                <button type="button" data-id="{{$pp->pp_id}}" onclick="window.location.href='/p/{{$pp->pp_slug}}'" class="btn btn-outline-info btn-sm detail-product">Lihat Detail</button>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
<?php $i++; ?>
@endforeach
</div>
</div>
</div>
</div>
<a href="#" role="button" class="carousel-control-prev" id="popular-slider-prev"><i class="fa fa-angle-left fa-lg"></i></a>
<a href="#" role="button" class="carousel-control-next" id="popular-slider-next"><i class="fa fa-angle-right fa-lg"></i></a>
</div>
<!-- /Popular -->
@endsection