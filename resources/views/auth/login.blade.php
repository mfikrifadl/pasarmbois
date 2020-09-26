<!DOCTYPE html>
<html dir="ltr" lang="en">


<!-- Login Page -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/customAuth/./img/site/favicon3.ico')}}">
    <title>Pasar Mbois</title>
    <link href="{{asset('/customAuth/vendor/plugin/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/customAuth/vendor/dashboard/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('/customAuth/css/custom.css')}}" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{asset('/customAuth/img/site/auth-bg.jpg')}}) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="{{asset('customAuth/img/site/logo_login-dinper.png')}}" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Sign In to Admin</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal m-t-20" method="POST" id="loginform" action="{{route('login')}}">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" id="inputUsername" name="pu_username" placeholder="Username / Telepon / E-mail" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" id="inputPassword" placeholder="Password" name="pu_password" aria-label="Password" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <a href="javascript:void(0)" id="to-recover" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i>
                                                Forgot pwd?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn btn-block btn-lg btn-info" id="button-masuk" type="submit">Masuk</button>
                                    </div>
                                </div>
                                <div class="col-xs-12 text-danger">
                                    <!-- <p class="mt-20" id="error">Username or Phone or E-mail is incorrect</p> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="recoverform">
                    <div class="logo">
                        <!-- <span class="db"><img src="../../assets/images/logo-icon.png" alt="logo" /></span> -->
                        <h5 class="font-medium m-b-20">Recover Password</h5>
                        <span>Enter your Email and instructions will be sent to you!</span>
                    </div>
                    <div class="row m-t-20">
                        <!-- Form -->
                        <form class="col-12" action="#">
                            <!-- email -->
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control form-control-lg" type="email" required="" id="inputUsername" placeholder="Username / Telepon / E-mail" name="username" autofocus>
                                </div>
                            </div>
                            <!-- email -->
                            <!-- pwd -->
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control form-control-lg" type="password" required="" id="inputPassword" placeholder="password" name="password" autofocus>
                                </div>
                            </div>
                            <!-- pwd -->
                            <div class="row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-block btn-lg btn-danger" type="submit" name="action">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('customAuth/vendor/plugin/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/popper.js/popper.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('customAuth/vendor/plugin/sweetalert/sweetalert.min.js')}}"></script>

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
<!-- End Login Page -->

<!-- Other Page -->

</html>