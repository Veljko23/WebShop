@extends('front._layout.layout')

@section('seo_title', 'Index page')


@section('content')
<!-- Welcome Slides Area -->
<section class="welcome_area">
    <div class="welcome_slides owl-carousel">
        <!-- Single Slide -->
        <div class="single_slide bg-img" style="background-image: url(/themes/front/img/bg-img/8.jpg);">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-7 col-md-8">
                        <div class="welcome_slide_text">
                            <p data-animation="fadeInUp" data-delay="0">Special Offer</p>
                            <h2 data-animation="fadeInUp" data-delay="300ms">40% Off Today</h2>
                            <h4 data-animation="fadeInUp" data-delay="600ms">Only $78</h4>
                            <a href="#" class="btn btn-primary" data-animation="fadeInUp" data-delay="1s">Buy Now</a>
                        </div>
                    </div>
                    <div class="col-5 col-md-4">
                        <div class="welcome_slide_image">
                            <img src="/themes/front/img/bg-img/slide-1.png" alt="" data-animation="bounceInUp" data-delay="500ms">
                            <div class="discount_badge" data-animation="bounceInDown" data-delay="1.2s">
                                <span>30%<br>OFF</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Single Slide -->
        <div class="single_slide bg-img" style="background-image: url(/themes/front/img/bg-img/7.jpg);">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 col-md-8">
                        <div class="welcome_slide_text">
                            <p data-animation="fadeInUp" data-delay="0">Sustainable Clock</p>
                            <h2 data-animation="fadeInUp" data-delay="300ms">Smart Watch</h2>
                            <h4 data-animation="fadeInUp" data-delay="600ms">Only $31 <span class="regular-price">$43</span></h4>
                            <a href="#" class="btn btn-primary" data-animation="fadeInUp" data-delay="600ms">Check Collection</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Single Slide -->
        <div class="single_slide bg-img" style="background-image: url(/themes/front/img/bg-img/6.jpg);">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 col-md-6">
                        <div class="welcome_slide_text">
                            <p class="text-white" data-animation="fadeInUp" data-delay="0">100% Cotton</p>
                            <h2 class="text-white" data-animation="fadeInUp" data-delay="300ms">Hot Shoes</h2>
                            <h4 class="text-white" data-animation="fadeInUp" data-delay="600ms">Now $19</h4>
                            <a href="#" class="btn btn-primary" data-animation="fadeInUp" data-delay="900ms">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Welcome Slides Area -->


<!-- Quick View Modal Area -->
<div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="quickview_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-5">
                                <div class="quickview_pro_img">
                                    <img class="first_img" src="/themes/front/img/product-img/new-1-back.png" alt="">
                                    <img class="hover_img" src="/themes/front/img/product-img/new-1.png" alt="">
                                    <!-- Product Badge -->
                                    <div class="product_badge">
                                        <span class="badge-new">New</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div class="quickview_pro_des">
                                    <h4 class="title">Boutique Silk Dress</h4>
                                    <div class="top_seller_product_rating mb-15">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <h5 class="price">$120.99 <span>$130</span></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia expedita quibusdam aspernatur, sapiente consectetur accusantium perspiciatis praesentium eligendi, in fugiat?</p>
                                    <a href="#">View Full Product Details</a>
                                </div>
                                <!-- Add to Cart Form -->
                                <form class="cart" method="post">
                                    <div class="quantity">
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1">
                                    </div>
                                    <button type="submit" name="addtocart" value="5" class="cart-submit">Add to cart</button>
                                </form>
                                <!-- Share -->
                                <div class="share_wf mt-30">
                                    <p>Share with friends</p>
                                    <div class="_icon">
                                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick View Modal Area -->

<!-- New Arrivals Area -->
<section class="new_arrivals_area section_padding_100 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_heading new_arrivals">
                    <h5>New Arrivals</h5>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="new_arrivals_slides owl-carousel">
                    
                    @foreach($newArrivalProducts as $newArrivalProduct)
                    
                        @include('front.index.single_product_slide', [
                            
                            'product' => $newArrivalProduct
                        ])
                    
                    @endforeach
                    
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- New Arrivals Area -->

<!-- Popular Brands Area -->
<section class="popular_brands_area section_padding_100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="popular_section_heading mb-50">
                    <h5>Popular Brands</h5>
                </div>
            </div>
            <div class="col-12">
                <div class="popular_brands_slide owl-carousel">
                    
                    @foreach($brands as $brand)
                    @include('front.index.single_brand_slide', [
                        'brand' => $brand
                    ])
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Popular Brands Area -->

<!-- Special Featured Area -->
<section class="special_feature_area pt-5">
    <div class="container">
        <div class="row">
            <!-- Single Feature Area -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single_feature_area mb-5 d-flex align-items-center">
                    <div class="feature_icon">
                        <i class="icofont-ship"></i>
                        <span><i class="icofont-check-alt"></i></span>
                    </div>
                    <div class="feature_content">
                        <h6>Free Shipping</h6>
                        <p>For orders above $100</p>
                    </div>
                </div>
            </div>

            <!-- Single Feature Area -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single_feature_area mb-5 d-flex align-items-center">
                    <div class="feature_icon">
                        <i class="icofont-box"></i>
                        <span><i class="icofont-check-alt"></i></span>
                    </div>
                    <div class="feature_content">
                        <h6>Happy Returns</h6>
                        <p>7 Days free Returns</p>
                    </div>
                </div>
            </div>

            <!-- Single Feature Area -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single_feature_area mb-5 d-flex align-items-center">
                    <div class="feature_icon">
                        <i class="icofont-money"></i>
                        <span><i class="icofont-check-alt"></i></span>
                    </div>
                    <div class="feature_content">
                        <h6>100% Money Back</h6>
                        <p>If product is damaged</p>
                    </div>
                </div>
            </div>

            <!-- Single Feature Area -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single_feature_area mb-5 d-flex align-items-center">
                    <div class="feature_icon">
                        <i class="icofont-live-support"></i>
                        <span><i class="icofont-check-alt"></i></span>
                    </div>
                    <div class="feature_content">
                        <h6>Dedicated Support</h6>
                        <p>We provide support 24/7</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Special Featured Area -->
@endsection