<!doctype html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('customAuth/img/site/favicon.ico')}}">
    <title>{{$title_page ?? 'Pasar Mbois'}}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fira+Sans">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/bootstrap/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/perfect-scrollbar/perfect-scrollbar.min.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/font-awesome/font-awesome.min.css')}}">
    @if ($code_page == "home")
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/swiper/swiper.min.css')}}">
    @elseif ($code_page == "category" || $code_page == "search")
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/nouislider/nouislider.min.css')}}">
    @elseif ($code_page == "detail_produk")
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/swiper/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/photoswipe/photoswipe.min.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/photoswipe/photoswipe-default-skin/default-skin.min.css')}}">
    @elseif ($code_page == "profile")
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/select2/select2.min.css')}}">
    @elseif ($code_page == "replayTicket" || $code_page == "addTicket")
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/summernote/summernote-bs4.css')}}">
    @endif
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/front/css/style.css')}}">
    <link href="{{asset('customAuth/css/front.custom.css')}}" rel="stylesheet">
    <link href="{{asset('customAuth/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('customAuth/vendor/plugin/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
</head>

<body>
    <header class="navbar navbar-expand navbar-light fixed-top">

        <!-- Toggle Menu -->
        <span class="toggle-menu"><i class="fa fa-bars fa-lg"></i></span>

        <!-- Logo -->
        <a class="navbar-brand" href="/"><img src="{{asset('customAuth/img/site/logo_login.png')}}" class="logo" alt="Pasar Mbois"></a>

        <!-- Search Form -->
        <form class="form-inline form-search d-none d-sm-inline" action="#" method="get">
            <div class="input-group">
                <button class="btn btn-light btn-search-back" type="button"><i class="fa fa-arrow-left"></i></button>
                <input type="text" class="form-control" id="searchKeyword" type="search" name="search" placeholder="Search ..." aria-label="Search ...">
                <input type="hidden" id="isHeader" name="isHeader" value="1">
                <button class="btn btn-light" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
        <!-- /Search Form -->

        <!-- navbar-nav -->
        <ul class="navbar-nav ml-auto">
            <!-- Search Toggle -->
            <li class="nav-item d-sm-none">
                <a href="#" class="nav-link" id="search-toggle"><i class="fa fa-search fa-lg"></i></a>
            </li>
            <!-- /Search Toggle -->
            <!-- Shopping Cart Toggle -->
            <li class="nav-item dropdown ml-1 ml-sm-3">
                <a href="#" class="nav-link">
                    <i class="fa fa-qrcode fa-lg"></i>
                </a>
            </li>
            <!-- /Shopping Cart Toggle -->
            <!-- Shopping Cart Toggle -->
            @if(Auth::user() != null)
            @if (Auth::user()->pu_role == 1 || Auth::user()->pu_role == 2)
            <li class="nav-item dropdown ml-1 ml-sm-3">
                <a href="#" class="nav-link" data-toggle="modal" data-target="#cartModal">
                    <i class="fa fa-shopping-cart fa-lg"></i>
                    <span class="badge badge-pink badge-count">#</span>
                </a>
            </li>
            @endif
            @endif
            <!-- /Shopping Cart Toggle -->

        </ul>
        @if(Auth::user() != null)
        @if (Auth::user()->pu_role == 3)
        <div class="dropdown dropdown-user">
            <a class="dropdown-toggle" href="#" role="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{asset('customAuth/'.Auth::user()->userDetails->pud_img_path)}}" alt="User">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item has-icon" href="#"><i class="fa fa-user fa-fw"></i> Profile</a>
                <a class="dropdown-item has-icon" href="#"><i class="fa fa-cog fa-fw"></i> Ganti Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item has-icon" href="#"><i class="fa fa-sign-out fa-fw"></i> Sign out</a>
            </div>
        </div>
        @endif
        @endif
        <!-- /User Dropdown -->

    </header>
    <div class="container-fluid" id="main-container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col" id="main-sidebar">
                <div class="list-group list-group-flush">
                    <a href="/" class="list-group-item list-group-item-action active"><span class="lnr lnr-home"></span>
                        Home</a>
                    <a href="/" class="list-group-item list-group-item-action"><span class="lnr lnr-list"></span>
                        Kategori</a>
                    @foreach ($category as $key=>$cg)
                    @if ($key < 7) <a href="#" class="list-group-item list-group-item-action sub">{{$cg->pc_title}}</a>
                        @endif
                        @endforeach
                        <div class="collapse" id="categories">
                            @foreach ($category as $i=>$cg)
                            @if ($i > 6)
                            <a href="#" class="list-group-item list-group-item-action sub">{{$cg->pc_title}}</a>
                            @endif
                            @endforeach
                        </div>
                        <a href="#categories" class="list-group-item list-group-item-action sub toggle" data-toggle="collapse" aria-expanded="false">Kategori Lain &#9662;</a>
                        <a href="#" class="list-group-item list-group-item-action"><span class="lnr lnr-layers"></span> Halaman Informasi</a>
                        <a href="#" class="list-group-item list-group-item-action sub">About Us</a>
                        <a href="#" class="list-group-item list-group-item-action sub">Contact Us</a>
                        <a href="#" class="list-group-item list-group-item-action sub">FAQ</a>
                        @if(Auth::user() != null)
                        @if (Auth::user()->pu_role == 3)
                        <a href="#" class="list-group-item list-group-item-action sub">Keluar</a>
                        @elseif (Auth::user()->pu_role == 1 || Auth::user()->pu_role == 2)
                        <a href="#" class="list-group-item list-group-item-action sub">Login / Register</a>
                        @endif
                        @else
                        <a href="#" class="list-group-item list-group-item-action sub">Login / Register</a>
                        @endif
                        <a href="#" class="list-group-item list-group-item-action"><span class="lnr lnr-question-circle"></span> Help</a>
                </div>
                <div class="small p-3">Copyright © 2020 Fikri Ecak Aisyah Developer</div>
                <img src="{{asset('customAuth/img/site/osi.png')}}" class="sidebar-background sidebar-background--one">
                <img src="{{asset('customAuth/img/site/ji.png')}}" class="sidebar-background sidebar-background--two">
            </div>
            <!-- /Sidebar -->
            <div class="col" id="main-content">
                @yield('content')
                <!-- Footer -->
                <footer class="navbar-footer">
                    <div class="container-fluid">
                        <div class="footer-wrapper">
                            Copyright &copy; {{date("Y")}}- Pasar Mbois. All rights reserved.
                            <div class="footer-support">
                                <div>
                                    Operated by:
                                    <a href="http://mcf.or.id" target="_blank"><img class="footer-logo" src="{{asset('customAuth/img/site/logo_mkkm.png')}}" title="Malang Koperasi Kreatif Mbois"></a>
                                </div>
                                <div>
                                    Supported by:
                                    <a href="https://bni.co.id/" target="_blank"><img class="footer-logo" src="{{asset('customAuth/img/site/logo_bni.png')}}" title="Bank Negara Indonesia"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- /Footer -->
            </div>
        </div>
    </div>
    <script src="{{asset('customAuth/vendor/plugin/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/popper.js/popper.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    @if ($code_page == "home")
    <script src="{{asset('customAuth/vendor/plugin/swiper/swiper.min.js')}}"></script>
    @elseif ($code_page == "category")
    <script src="{{asset('customAuth/vendor/plugin/nouislider/nouislider.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/raty-fa/jquery.raty-fa.min.js')}}"></script>
    @elseif ($code_page == "detail_produk" || $code_page == "search" || $code_page == "detailinvoice")
    <script src="{{asset('customAuth/vendor/plugin/nouislider/nouislider.min.js')}}}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/swiper/swiper.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/raty-fa/jquery.raty-fa.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/photoswipe/photoswipe.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    @elseif ($code_page == "profile")
    <script src="{{asset('customAuth/vendor/plugin/select2/select2.full.min.js')}}"></script>
    @elseif ($code_page == "replayTicket" || $code_page == "addTicket")
    <script src="{{asset('customAuth/vendor/plugin/summernote/summernote-bs4.js')}}"></script>
    @elseif ($code_page == "scanqr")
    <script src="{{asset('customAuth/js/scanqr/qrcodelib.js')}}"></script>
    <script src="{{asset('customAuth/js/scanqr/webcodecamjs.js')}}"></script>
    <script src="{{asset('customAuth/js/scanqr/scanqr.js')}}"></script>
    @endif
    <script src="{{asset('customAuth/vendor/plugin/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/front/js/script.js')}}"></script>
    <script src="{{asset('customAuth/js/front.custom.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-129885026-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-129885026-1');
    </script>
</body>

</html>
<!-- sample modal content -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">Tambah Wishlist</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body"> Silahlan login terlebih dahulu</div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->