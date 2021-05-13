<div class="bigshop-main-menu" id="sticker">
            <div class="container">
                <div class="classy-nav-container breakpoint-off">
                    <nav class="classy-navbar" id="bigshopNav">

                        <!-- Nav Brand -->
                        <a href="{{route('front.index.index')}}" class="nav-brand"><img src="/themes/front/img/core-img/logo.png" alt="logo"></a>

                        <!-- Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">
                            <!-- Close -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="{{route('front.index.index')}}">Home</a></li>
                                    <li><a href="{{route('front.products.index')}}">Products</a></li>
                                    <li><a href="{{route('front.pages.faq')}}">FAQ</a></li>
                                    <li><a href="{{route('front.contact.index')}}">Contact Us</a></li>
                                    <li><a href="{{route('front.pages.about_us')}}">About Us</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Hero Meta -->
                        <div class="hero_meta_area ml-auto d-flex align-items-center justify-content-end">
                           @include('front._layout.cart')
                        </div>
                    </nav>
                </div>
            </div>
        </div>