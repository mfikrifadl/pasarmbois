@extends('template.main.index')
@section('js')
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
<script src="{{asset('customAuth/vendor/plugin/select2/select2.full.min.js') ?>"></script>
@elseif ($code_page == "replayTicket" || $code_page == "addTicket")
<script src="{{asset('customAuth/vendor/plugin/summernote/summernote-bs4.js') ?>"></script>
@elseif ($code_page == "scanqr")
<script src="{{asset('customAuth/js/scanqr', 'qrcodelib.js')}}"></script>
<script src="{{asset('customAuth/js/scanqr', 'webcodecamjs.js')}}"></script>
<script src="{{asset('customAuth/js/scanqr', 'scanqr.js')}}"></script>
@endif
<script src="{{asset('customAuth/vendor/plugin/sweetalert/sweetalert.min.js') ?>"></script>
<script src="{{asset('customAuth/vendor/front/js/script.js')}}"></script>
<script src="{{asset('customAuth/js', 'front.custom.js')}}"></script>
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
@endsection