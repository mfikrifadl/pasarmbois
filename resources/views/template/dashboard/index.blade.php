<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{$title_page ?? 'Pasar Mbois'}}</title>
    <link href="{{url('https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" crossorigin="anonymous" />
    <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js')}}" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('customAuth/img/site/favicon.ico')}}">
    <title>Pasar Mbois</title>
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/bootstrapswitch/bootstrap-switch.min.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/dropzone/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/dropify/dropify.min.css')}}">
    <link href="{{asset('customAuth/vendor/plugin/c3/c3.min.css')}}" rel="stylesheet">
    <link href="{{asset('customAuth/vendor/plugin/chartist/chartist.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/datatables/responsive.dataTables.css')}}">
    <link rel="stylesheet" href="{{asset('customAuth/vendor/plugin/datatables/buttons.dataTables.min.css')}}">
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
    <link href="{{asset('customAuth/vendor/dashboard/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('customAuth/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('customAuth/vendor/plugin/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="/dashboard/"><img style="width:86%;" src="{{asset('customAuth/img/site/logo-light-text.png')}}" alt="img product" /></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{route('manajemenadmin.detail', Auth::user()->pu_id)}}">My Profile</a>
                    @can('manage-super')
                    <a class="dropdown-item" href="/dashboard/pendapatan">My Balance</a>
                    @endcan
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        {{ __('Logout')}}</a>
                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display:none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- siderbar -->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading"></div>
                        <a class="nav-link" href="\dashboard\">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">E-Commerce</div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="false" aria-controls="collapseProduct">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-store"></i>
                            </div>
                            Produk
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseProduct" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/dashboard/product/create">Tambah Produk</a>
                                <a class="nav-link" href="/dashboard/product">Daftar Produk</a>
                                <a class="nav-link" href="/dashboard/product/draft">Daftar Produk Draft</a>
                                <a class="nav-link" href="/dashboard/product/banned">Daftar Produk Banned</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMember" aria-expanded="false" aria-controls="collapseMember">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-user-friends"></i>
                            </div>
                            Member
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseMember" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/dashboard/member">Daftar Member</a>
                                <a class="nav-link" href="/dashboard/member/banned">Banned Member</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQr" aria-expanded="false" aria-controls="collapseQr">
                            <div class="sb-nav-link-icon">
                                <i class="mdi mdi-qrcode"></i>
                            </div>
                            QR Code
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseQr" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/dashboard/qrcode/add">Tambah QR Code</a>
                                <a class="nav-link" href="/dashboard/qrcode/daftar">Daftar QR Code</a>
                                <a class="nav-link" href="/dashboard/qrcode/banned">Daftar QR Code Banned</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi" aria-expanded="false" aria-controls="collapseTransaksi">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            Transaksi
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseTransaksi" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/dashboard/transaksi/user">Transaksi User</a>
                                <a class="nav-link" href="/dashboard/transaksi/tamu">Transaksi Tamu</a>
                            </nav>
                        </div>
                        @can('manage-super')
                        <a class="nav-link" href="/dashboard/pendapatan">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                            Pendapatan
                        </a>
                        @endcan
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="false" aria-controls="collapseLaporan">
                            <div class="sb-nav-link-icon">
                                <i class="far fa-comment-alt"></i>
                            </div>
                            Laporan Member
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseLaporan" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/dashboard/tiket">Daftar Tiket</a>
                                <a class="nav-link" href="/dashboard/kategori-tiket">Kategori Tiket</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="/dashboard/pesan-masuk">
                            <div class="sb-nav-link-icon">
                                <i class="far fa-comments"></i>
                            </div>
                            Pesan Masuk
                        </a>
                        <a class="nav-link" href="/dashboard/bank">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-money-bill"></i>
                            </div>
                            Informasi Rekening
                        </a>
                        <div class="sb-sidenav-menu-heading">System</div>
                        <a class="nav-link" href="/dashboard/kategori">
                            <div class="sb-nav-link-icon">
                                <i class="mdi mdi-bookmark"></i>
                            </div>
                            Kategori
                        </a>
                        <a class="nav-link" href="/dashboard/template-email">
                            <div class="sb-nav-link-icon">
                                <i class="mdi mdi-bookmark"></i>
                            </div>
                            Template Email
                        </a>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHalaman" aria-expanded="false" aria-controls="collapseHalaman">
                            <div class="sb-nav-link-icon">
                                <i class="mdi mdi-comment-multiple-outline"></i>
                            </div>
                            Halaman
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseHalaman" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/dashboard/faq">FAQ</a>
                                <a class="nav-link" href="/dashboard/about">About</a>
                                <a class="nav-link" href="/dashboard/help">Help</a>
                                <a class="nav-link" href="/dashboard/page">Halaman Informasi</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="/dashboard/slider">
                            <div class="sb-nav-link-icon">
                                <i class="mdi mdi-folder-multiple-image"></i>
                            </div>
                            Slider
                        </a>
                        @can('manage-super')
                        <a class="nav-link" href="/dashboard/manajemen-admin">
                            <div class="sb-nav-link-icon">
                                <i class="mdi mdi-account-key"></i>
                            </div>
                            User Admin
                        </a>
                        @endcan
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengaturan" aria-expanded="false" aria-controls="collapseHalaman">
                            <div class="sb-nav-link-icon">
                                <i class="mdi mdi-settings"></i>
                            </div>
                            Pengaturan
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapsePengaturan" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/dashboard/setting">Umum</a>
                                <a class="nav-link" href="/dashboard/setting/set-address">Alamat</a>
                                <a class="nav-link" href="/dashboard/setting/maps">Maps</a>
                                <a class="nav-link" href="/dashboard/setting/other">Halaman Informasi</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    {{Auth::user()->pu_username}}
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">
                            Copyright &copy; Pasarmbois 2020
                        </div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{url('https://code.jquery.com/jquery-3.5.1.min.js')}}" crossorigin="anonymous"></script>
    <script src="{{url('https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="{{url('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js')}}" crossorigin="anonymous"></script>
    <script src="{{url('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js')}}" crossorigin="anonymous"></script>
    <script src="{{asset('assets/demo/datatables-demo.js')}}"></script>
    <script src="{{asset('customAuth/js/custom.js')}}"></script>
    <script src="{{asset('customAuth/vendor/dashboard/js/dashboard3.js')}}"></script>
    @stack('custom-script')
</body>

</html>