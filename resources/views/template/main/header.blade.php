@extends('main.product-detail')
@section('header')
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
        @if (Auth::user()->pu_role == 1 || Auth::user()->pu_role == 2)
        <li class="nav-item dropdown ml-1 ml-sm-3">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#cartModal">
                <i class="fa fa-shopping-cart fa-lg"></i>
                <span class="badge badge-pink badge-count">#</span>
            </a>
        </li>
        @endif
        <!-- /Shopping Cart Toggle -->

    </ul>

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
    <!-- /User Dropdown -->

</header>
@endsection