<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>@yield('seo_title', __('Best webshop in the world')) | Bigshop</title>

    <meta name="description" content="@yield('seo_description', __('Buy best cloathing, shoes and...'))">
    
    <meta property="og:site_name" content="{{config('app.name')}}">
    <meta property="og:type" content="@yield('seo_og_type', 'article')">
    <meta property="og:title" content="@yield('seo_title', __('Best webshop in the world'))">
    <meta property="og:description" content="@yield('seo_description', __('Buy best cloathing, shoes and...'))">
    <meta property="og:image" content="@yield('seo_image', url('/themes/front/img/core-img/logo.png'))">
    <meta property="og:url" content="{{url()->current()}}">
    
    <!-- TWITTER META  -->
    <meta name="twitter:card" content="{{config('app.name')}}">
    <meta name="twitter:title" content="@yield('seo_title', __('Best webshop in the world'))">
    <meta name="twitter:description" content="@yield('seo_description', __('Buy best cloathing, shoes and...'))">
    <meta name="twitter:image" content="@yield('seo_image', url('/themes/front/img/core-img/logo.png'))">
    
    @yield('head_meta')
    
    <!-- Favicon  -->
    <link rel="icon" href="{{url('/themes/front/img/core-img/favicon.ico')}}">

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{url('/themes/front/style.css')}}">
    <link href="/themes/front/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
    @stack('head_css')
</head>

<body>
<!--     Preloader 
    <div id="preloader">
        <div class="spinner-grow" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>-->
<div id="preloader">
<div class="water"></div>
</div>
<style>
    .water{
            width:400px;
            height: 400px;
            background-color: skyblue;
            border-radius: 50%;
            position: relative;
            box-shadow: inset 0 0 30px 0 rgba(0,0,0,.5), 0 4px 10px 0 rgba(0,0,0,.5);
            overflow: hidden;
        }
        .water:before, .water:after{
            content:'';
            position: absolute;
            width:400px;
            height: 400px;
            top:-150px;
            background-color: #fff;
        }
        .water:before{
            border-radius: 45%;
            background:rgba(255,255,255,.7);
            animation:wave 5s linear infinite;
        }
        .water:after{
            border-radius: 35%;
            background:rgba(255,255,255,.3);
            animation:wave 5s linear infinite;
        }
        @keyframes wave{
            0%{
                transform: rotate(0);
            }
            100%{
                transform: rotate(360deg);
            }
        }
</style>

    <!-- Header Area -->
    <header class="header_area">
        
        @include('front._layout.navigation')
        
    </header>
    <!-- Header Area End -->

    @yield('content')

    @include('front._layout.footer')

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="/themes/front/js/jquery.min.js"></script>
        <script src="/themes/front/plugins/toastr/toastr.min.js" type="text/javascript"></script>

    <script src="/themes/front/js/popper.min.js"></script>
    <script src="/themes/front/js/bootstrap.min.js"></script>
    <script src="/themes/front/js/jquery.easing.min.js"></script>
    <script src="/themes/front/js/default/classy-nav.min.js"></script>
    <script src="/themes/front/js/owl.carousel.min.js"></script>
    <script src="/themes/front/js/default/scrollup.js"></script>
    <script src="/themes/front/js/default/sticky.js"></script>
    <script src="/themes/front/js/waypoints.min.js"></script>
    <script src="/themes/front/js/jquery.countdown.min.js"></script>
    <script src="/themes/front/js/jquery.counterup.min.js"></script>
    <script src="/themes/front/js/jquery-ui.min.js"></script>
    <script src="/themes/front/js/jarallax.min.js"></script>
    <script src="/themes/front/js/jarallax-video.min.js"></script>
    <script src="/themes/front/js/jquery.magnific-popup.min.js"></script>
    <script src="/themes/front/js/jquery.nice-select.min.js"></script>
    <script src="/themes/front/js/wow.min.js"></script>
    <script src="/themes/front/js/default/active.js"></script>
    
    @stack('footer_javascript')
</body>

</html>