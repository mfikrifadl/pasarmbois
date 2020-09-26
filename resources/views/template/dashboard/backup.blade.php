<!DOCTYPE html>
<html dir="ltr" lang="en">

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
    @if ($code_page == "dashboard_index")
    <link href="{{asset('customAuth/vendor/plugin/c3/c3.min.css')}}" rel="stylesheet">
    <link href="{{asset('customAuth/vendor/plugin/chartist/chartist.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/datatables/responsive.dataTables.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/datatables/buttons.dataTables.min.css')}}">
    @elseif (
    $code_page == "dashboard_product" ||
    $code_page == "dashboard_member" ||
    $code_page == "banned_member" ||
    $code_page == "dashboard_qrcode" ||
    $code_page == "dashboard_transaction" ||
    $code_page == "dashboard_ticket" ||
    $code_page == "dashboard_page" ||
    $code_page == "useradmin" ||
    $code_page == "slider" ||
    $code_page == "useradmin" ||
    $code_page == "detail_profile" ||
    $code_page == "list_category" ||
    $code_page == "dashboard_affiliate" ||
    $code_page == "dashboard_earning"
    )
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/datatables/responsive.dataTables.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/datatables/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/dropify/dropify.min.css')}}">
    <link href="{{asset('customAuth/vendor/plugin/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    @elseif (
    $code_page == "addproduct" ||
    $code_page == "addpage" ||
    $code_page == "editProduct" ||
    $code_page == "dashboard_contact"
    )
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/bootstrapswitch/bootstrap-switch.min.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/dropzone/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/dropify/dropify.min.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/datatables/responsive.dataTables.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/datatables/buttons.dataTables.min.css')}}">
    @elseif ($code_page == "setting")
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/dropify/dropify.min.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/tagsinput/jquery-tagsinput.min.css')}}">
    @elseif (
    $code_page == "set-address" ||
    $code_page == "add_qrcode"
    )
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/select2/select2.min.css')}}">
    @else

    @endif
    <link href="{{asset('customAuth/vendor/dashboard/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('customAuth/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('customAuth/vendor/plugin/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <a href="/dashboard" class="logo">
                            <!-- Logo text -->
                            <span class="logo-text">
                                <!-- dark Logo text -->
                                <img src="{{asset('customAuth/img/site/logo-light-text.png')}}" alt="homepage" class="dark-logo" />
                                <!-- Light Logo text -->
                                <img src="{{asset('customAuth/img/site/logo-light-text.png')}}" class="light-logo img-fluid" alt="homepage" />
                            </span>
                        </a>
                        <a class="sidebartoggler d-none d-md-block" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                            <i class="mdi mdi-toggle-switch mdi-toggle-switch-off font-20"></i>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-more"></i>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <!-- <li class="nav-item d-none d-md-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                                <i class="mdi mdi-menu font-24"></i>
                            </a>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box">
                            <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-magnify font-20 mr-1"></i>
                                    <div class="ml-1 d-none d-sm-block">
                                        <span>Search</span>
                                    </div>
                                </div>
                            </a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter">
                                <a class="srh-btn">
                                    <i class="ti-close"></i>
                                </a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (Auth::user()->userDetails[0]->pud_img_path == null)
                                <img src="{{asset('customAuth/img/site/user.png')}}" alt="user" class="rounded-circle" width="40">
                                @else
                                <img src="{{asset('customAuth/'.Auth::user()->userDetails[0]->pud_img_path)}}" alt="user" class="rounded-circle" width="40">
                                @endif
                                <span class="m-l-5 font-medium d-none d-sm-inline-block">{{Auth::user()->userDetails[0]->pud_firstname}} {{Auth::user()->userDetails[0]->pud_lastname}}<i class="mdi mdi-chevron-down"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow">
                                    <span class="bg-primary"></span>
                                </span>
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                    <div class="">
                                        @if (Auth::user()->userDetails[0]->pud_img_path == null)
                                        <img src="{{asset('customAuth/img/site/user.png')}}" alt="user" class="rounded-circle" width="60">
                                        @else
                                        <img src="{{asset('customAuth/'.Auth::user()->userDetails[0]->pud_img_path)}}" alt="user" class="rounded-circle" width="60">
                                        @endif
                                    </div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0">{{Auth::user()->userDetails[0]->pud_firstname}} {{Auth::user()->userDetails[0]->pud_lastname}}</h4>
                                        <p class=" m-b-0">{{Auth::user()->userDetails[0]->pud_email}}</p>
                                    </div>
                                </div>
                                <div class="profile-dis scrollable">
                                    <a class="dropdown-item" href="{{route('manajemenadmin.detail', Auth::user()->pu_id)}}">
                                        <i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                    <a class="dropdown-item" href="/dashboard/pendapatan">
                                        <i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('manajemenadmin.detail', Auth::user()->pu_id)}}">
                                        <i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="fa fa-power-off m-r-5 m-l-5"></i>
                                        {{ __('Logout')}}</a>
                                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display:none;">
                                        @csrf
                                    </form>
                                    <div class="dropdown-divider"></div>
                                </div>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- dashboard -->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/dashboard" aria-expanded="false"><i class="mdi mdi-apps"></i><span class="hide-menu">Dashboard</span></a></li>
                        <!-- end dashboard -->
                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">E-commerce</span>
                        </li>
                        <!-- Produk -->
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-archive"></i>
                                <span class="hide-menu">Produk </span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="/dashboard/product/create" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Tambah Produk</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/dashboard/product" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Daftar Produk </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/dashboard/product/draft" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Daftar Produk Draft</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/dashboard/product/banned" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Daftar Produk Banned</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- end Produk -->
                        <!-- Member -->
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="/dashboard/member" aria-expanded="false">
                                <i class="mdi mdi-account-multiple"></i>
                                <span class="hide-menu">Member</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="/dashboard/member" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Daftar Member </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/dashboard/member/banned" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Banned Member</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- end Member -->
                        <!-- Qr code -->
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="/dashboard/qrcode/daftar" aria-expanded="false">
                                <i class="mdi mdi-qrcode"></i>
                                <span class="hide-menu">QR Code</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="/dashboard/qrcode/add" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Tambah QR Code</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/dashboard/qrcode/daftar" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Daftar Qr Code</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/dashboard/qrcode/banned" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Daftar Qr Code Banned</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- End qrcode -->
                        <!-- Transaksi -->
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="/dashboard/transaksi/user" aria-expanded="false">
                                <i class="mdi mdi-cart"></i>
                                <span class="hide-menu">Transaksi</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="/dashboard/transaksi/user" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Transaksi User</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/dashboard/transaksi/tamu" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Transaksi Tamu</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- End Transaksi -->
                        <!-- Pendapatan -->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/dashboard/pendapatan" aria-expanded="false"><i class="mdi mdi-cash"></i><span class="hide-menu">Pendapatan</span></a></li>
                        <!-- End Pendapatan -->
                        <!-- Bantuan -->
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-comment-multiple-outline"></i>
                                <span class="hide-menu">Laporan Member</span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="/dashboard/tiket" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Daftar Tiket</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/dashboard/kategori-tiket" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Kategori Ticket</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- end Bantuan -->
                        <!-- Contacact -->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/dashboard/pesan-masuk" aria-expanded="false"><i class="mdi mdi-message"></i><span class="hide-menu">Pesan masuk</span></a></li>
                        <!-- End Contacact -->
                        <!-- Transaksi masuk rekening -->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/dashboard/bank" aria-expanded="false"><i class="mdi mdi-cash"></i><span class="hide-menu">Informasi rekening</span></a></li>
                        <!-- end Transaksi rekening -->
                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">System</span>
                        </li>
                        <!-- Kategori Barang -->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/dashboard/kategori" aria-expanded="false"><i class="mdi mdi-bookmark"></i><span class="hide-menu">Kategori</span></a></li>
                        <!-- end Kategori Barang -->
                        <!-- Template email -->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/dashboard/template-email" aria-expanded="false"><i class="mdi mdi-bookmark"></i><span class="hide-menu">Template Email</span></a></li>
                        <!-- end template email -->

                        <!-- Kategori Halaman -->
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-comment-multiple-outline"></i>
                                <span class="hide-menu">Halaman</span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="/dashboard/faq" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> FAQ</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/dashboard/about" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> About</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/dashboard/help" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Help</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/dashboard/page" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Halaman Informasi</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- end Kategori Halaman -->
                        <!-- Slider -->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/dashboard/slider" aria-expanded="false"><i class="mdi mdi-folder-multiple-image"></i><span class="hide-menu">Slider</span></a></li>
                        <!-- End Slider -->
                        <!-- User Admin -->
                        @can('manage-super')
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/dashboard/manajemen-admin" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">User Admin</span></a></li>
                        @endcan
                        <!-- end user Admin -->
                        <!-- Pengaturan -->
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-settings"></i>
                                <span class="hide-menu">Pengaturan</span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="/dashboard/setting" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Umum</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/dashboard/setting/set-address" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Alamat</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/dashboard/setting/maps" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Maps</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/dashboard/setting/other" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Lain</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- end Pengaturan -->
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">{{$title_page}}</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/dashboard">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$title_page}}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
            <footer class="footer text-center">Copyright &copy; 2020 All Rights Reserved<a href="https://profileimage.studio/"> Profile Image Studio</a>.</footer>
        </div>
    </div>
    <script src="{{asset('customAuth/vendor/plugin/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/popper.js/popper.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/sweetalert/sweetalert.min.js')}}"></script>

    @if ($code_page == "login")
    <!-- ============================================================== -->
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        // ==============================================================
        // Login and Recover Password
        // ==============================================================
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>

    @elseif (
    $code_page == "dashboard" ||
    $code_page == "dashboard_index" ||
    $code_page == "dashboard_product" ||
    $code_page == "dashboard_member" ||
    $code_page == "banned_member" ||
    $code_page == "dashboard_qrcode" ||
    $code_page == "dashboard_transaction" ||
    $code_page == "dashboard_ticket" ||
    $code_page == "dashboard_page" ||
    $code_page == "useradmin" ||
    $code_page == "profile" ||
    $code_page == "detail_profile" ||
    $code_page == "addproduct" ||
    $code_page == "addpage" ||
    $code_page == "list_category" ||
    $code_page == "setting" ||
    $code_page == "set-address" ||
    $code_page == "slider" ||
    $code_page == "addpage" ||
    $code_page == "add_qrcode" ||
    $code_page == "editProduct" ||
    $code_page == "detail_profile" ||
    $code_page == "add_qrcode" ||
    $code_page == "order" ||
    $code_page == "dashboard_earning" ||
    $code_page == "dashboard_affiliate" ||
    $code_page == "dashboard_contact"
    )
    <script src="{{asset('customAuth/vendor/dashboard/js/app.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/dashboard/js/app.init.js')}}"></script>
    <script src="{{asset('customAuth/vendor/dashboard/js/app-style-switcher.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/perfect-scrollbar/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/sparkline/sparkline.js')}}"></script>
    <script src="{{asset('customAuth/vendor/dashboard/js/waves.js')}}"></script>
    <script src="{{asset('customAuth/vendor/dashboard/js/sidebarmenu.js')}}"></script>
    <script src="{{asset('customAuth/vendor/dashboard/js/custom.js')}}"></script>

    @if ($code_page == "dashboard_index")
    <!-- charts -->
    <script src="{{asset('customAuth/vendor/plugin/chartist/chartist.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/chartist/chartist-plugin-tooltip.min.js')}}"></script>
    <!-- End charts -->
    <!-- Ci3 -->
    <script src="{{asset('customAuth/vendor/plugin/c3/c3.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/c3/d3.min.js')}}"></script>
    <!-- End charts -->
    <script src="{{asset('customAuth/vendor/dashboard/js/dashboard3.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/datatables/dataTables.responsive.js')}}"></script>

    @elseif (
    $code_page == "dashboard_product" ||
    $code_page == "dashboard_member" ||
    $code_page == "banned_member" ||
    $code_page == "dashboard_qrcode" ||
    $code_page == "dashboard_transaction" ||
    $code_page == "dashboard_ticket" ||
    $code_page == "dashboard_page" ||
    $code_page == "useradmin" ||
    $code_page == "slider" ||
    $code_page == "dashboard_earning" ||
    $code_page == "dashboard_affiliate" ||
    $code_page == "list_message"
    )
    <script src="{{asset('customAuth/vendor/plugin/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/datatables/dataTables.responsive.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/summernote/summernote-bs4.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/dropify/dropify.min.js')}}"></script>

    @elseif (
    $code_page == "addproduct" ||
    $code_page == "addpage" ||
    $code_page == "editProduct" ||
    $code_page == "dashboard_contact"
    )
    <script src="{{asset('customAuth/vendor/plugin/summernote/summernote-bs4.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/bootstrapswitch/bootstrap-switch.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/dropify/dropify.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/datatables/dataTables.responsive.js')}}"></script>
    <script>
        $('body').on('submit', '#form-file-manager', function(e) {
            e.preventDefault();
            alert('Success');
        });
        $('#description').summernote({
            height: 350,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'image', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            buttons: {
                image: function() {
                    var ui = $.summernote.ui;

                    // create button
                    var button = ui.button({
                        contents: '<i class="note-icon-picture" />',
                        click: function() {
                            $('#modal-image').remove();

                            $.ajax({
                                url: '/dashboard/filemanager',
                                dataType: 'html',
                                beforeSend: function() {
                                    $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                                    $('#button-image').prop('disabled', true);
                                },
                                complete: function() {
                                    $('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
                                    $('#button-image').prop('disabled', false);
                                },
                                success: function(html) {
                                    $('body').append('<div id="modal-image" class="modal">' + html + '</div>');

                                    $('#modal-image').modal('show');

                                    $('#modal-image').delegate('a.thumbnail', 'click', function(e) {
                                        e.preventDefault();

                                        $('#description').summernote('insertImage', $(this).attr('href'));

                                        $('#modal-image').modal('hide');
                                    });
                                }
                            });
                        }
                    });

                    return button.render();
                }
            }
        });
    </script>
    @elseif ($code_page == "list_category" || $code_page == "setting")
    <script src="{{asset('customAuth/vendor/plugin/dropify/dropify.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/tagsinput/jquery-tagsinput.min.js')}}"></script>
    @elseif ($code_page == "set-address" || $code_page == "add_qrcode")
    <script src="{{asset('customAuth/vendor/plugin/select2/select2.full.min.js')}}"></script>
    @elseif ($code_page == "order")
    <script src="{{asset('customAuth/vendor/plugin/jquery/jquery.PrintArea.js')}}"></script>
    @endif

    <script src="{{asset('customAuth/js/custom.js')"></script>
    @endif
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
    @stack('custom-script')
</body>

</html>