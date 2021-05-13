@extends('front._layout.layout')
@section('seo_title', $product->name) <!-- naziv proizvoda ce biti u kartici na browseru -->
@section('seo_description', $product->description)
@section('seo_image', $product->getPhoto1Url())
@section('seo_og_type', 'product')

@section('head_meta')
<meta property="product:price:amount" content="{{$product->price}}">
<meta property="product:price:currency" content="USD">
@endsection

@section('content')

<!-- Breadcumb Area -->
<div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>{{$product->name}}</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.index.index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('front.products.index')}}">Products</a></li>
                    <li class="breadcrumb-item active">{{$product->name}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb Area -->

<!-- Single Product Details Area -->
<section class="single_product_details_area section_padding_100">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="single_product_thumb">
                    <div id="product_details_slider" class="carousel slide" data-ride="carousel">

                        <!-- Carousel Inner -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a class="gallery_img" href="{{$product->getPhoto1Url()}}" title="First Slide">
                                    <img class="d-block w-100" src="{{$product->getPhoto1Url()}}" alt="First slide">
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a class="gallery_img" href="{{$product->getPhoto2Url()}}" title="Second Slide">
                                    <img class="d-block w-100" src="{{$product->getPhoto2Url()}}" alt="Second slide">
                                </a>
                            </div>
                        </div>

                        <!-- Carosel Indicators -->
                        <ol class="carousel-indicators">
                            <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url('{{$product->getPhoto1ThumbUrl()}}');">
                            </li>
                            <li data-target="#product_details_slider" data-slide-to="1" style="background-image: url('{{$product->getPhoto2ThumbUrl()}}');">
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Single Product Description -->
            <div class="col-12 col-lg-6">
                <div class="single_product_desc">
                    <h4 class="title mb-2">{{$product->name}}</h4>
                    <div class="single_product_ratings mb-2">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span class="text-muted">(8 Reviews)</span>
                    </div>
                    <h4 class="price mb-4">${{$product->price}} 
                        @if($product->old_price > 0)
                        <span>${{$product->old_price}}</span>
                        @endif
                    </h4>

                    <!-- Overview -->
                    <div class="short_overview mb-4">
                        <h6>Overview</h6>
                        <p>
                            {{$product->description}}
                        </p>
                    </div>

                    <!-- Color Option -->
                    <div class="widget p-0 color mb-3">
                        <h6 class="widget-title">Color</h6>
                        <div class="widget-desc d-flex">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label black" for="customRadio1"></label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label pink" for="customRadio2"></label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label red" for="customRadio3"></label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label purple" for="customRadio4"></label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label white" for="customRadio5"></label>
                            </div>
                        </div>
                    </div>

                    <!-- Size Option -->
                    <div class="widget p-0 size mb-3">
                        <h6 class="widget-title">Size</h6>
                        <div class="widget-desc">
                            <ul>
                                @foreach($product->sizes as $size)
                                <li><a href="#">{{$size->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    @include('front.products.partials.add_to_cart_form', [
                        'product' => $product,
                    ])
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product_details_tab section_padding_100_0 clearfix">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs" role="tablist" id="product-details-tab">
                        <li class="nav-item">
                            <a href="#description" class="nav-link active" data-toggle="tab" role="tab">Description</a>
                        </li>
                        <li class="nav-item">
                            <a href="#reviews" class="nav-link" data-toggle="tab" role="tab">Reviews <span class="text-muted">(3)</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#addi-info" class="nav-link" data-toggle="tab" role="tab">Additional Information</a>
                        </li>
                        <li class="nav-item">
                            <a href="#refund" class="nav-link" data-toggle="tab" role="tab">Return &amp; Cancellation</a>
                        </li>
                    </ul>
                    <!-- Tab Content -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade show active" id="description">
                            <div class="description_area">
                                {!! $product->details !!}
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="reviews">
                            <div class="reviews_area">
                                <ul>
                                    <li>
                                        <div class="single_user_review mb-15">
                                            <div class="review-rating">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <span>for Quality</span>
                                            </div>
                                            <div class="review-details">
                                                <p>by <a href="#">Designing World</a> on <span>12 Sep 2019</span></p>
                                            </div>
                                        </div>
                                        <div class="single_user_review mb-15">
                                            <div class="review-rating">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <span>for Design</span>
                                            </div>
                                            <div class="review-details">
                                                <p>by <a href="#">Designing World</a> on <span>12 Sep 2019</span></p>
                                            </div>
                                        </div>
                                        <div class="single_user_review">
                                            <div class="review-rating">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <span>for Value</span>
                                            </div>
                                            <div class="review-details">
                                                <p>by <a href="#">Designing World</a> on <span>12 Sep 2019</span></p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="submit_a_review_area mt-50">
                                <h4>Submit A Review</h4>
                                <form action="#" method="post">
                                    <div class="form-group">
                                        <span>Your Ratings</span>
                                        <div class="stars">
                                            <input type="radio" name="star" class="star-1" id="star-1">
                                            <label class="star-1" for="star-1">1</label>
                                            <input type="radio" name="star" class="star-2" id="star-2">
                                            <label class="star-2" for="star-2">2</label>
                                            <input type="radio" name="star" class="star-3" id="star-3">
                                            <label class="star-3" for="star-3">3</label>
                                            <input type="radio" name="star" class="star-4" id="star-4">
                                            <label class="star-4" for="star-4">4</label>
                                            <input type="radio" name="star" class="star-5" id="star-5">
                                            <label class="star-5" for="star-5">5</label>
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nickname</label>
                                        <input type="email" class="form-control" id="name" placeholder="Nazrul">
                                    </div>
                                    <div class="form-group">
                                        <label for="options">Reason for your rating</label>
                                        <select class="form-control small right py-0 w-100" id="options">
                                            <option>Quality</option>
                                            <option>Value</option>
                                            <option>Design</option>
                                            <option>Price</option>
                                            <option>Others</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="comments">Comments</label>
                                        <textarea class="form-control" id="comments" rows="5" data-max-length="150"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Review</button>
                                </form>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="addi-info">
                            <div class="additional_info_area">
                                <h5>Additional Info</h5>
                                <p>What should I do if I receive a damaged parcel?
                                    <br> <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit impedit similique qui, itaque delectus labore.</span></p>
                                <p>I have received my order but the wrong item was delivered to me.
                                    <br> <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis quam voluptatum beatae harum tempore, ab?</span></p>
                                <p>Product Receipt and Acceptance Confirmation Process
                                    <br> <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum ducimus, temporibus soluta impedit minus rerum?</span></p>
                                <p class="mb-0">How do I cancel my order?
                                    <br> <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum eius eum, minima!</span></p>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="refund">
                            <div class="refund_area">
                                <h6>Return Policy</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa quidem, eos eius laboriosam voluptates totam mollitia repellat rem voluptate obcaecati quas fuga similique impedit cupiditate vitae repudiandae. Rem, tenetur placeat!</p>

                                <h6>Return Criteria</h6>
                                <ul class="mb-30 ml-30">
                                    <li><i class="icofont-check"></i> Package broken</li>
                                    <li><i class="icofont-check"></i> Physical damage in the product</li>
                                    <li><i class="icofont-check"></i> Software/hardware problem</li>
                                    <li><i class="icofont-check"></i> Accessories missing or damaged etc.</li>
                                </ul>

                                <h6>Q. What should I do if I receive a damaged parcel?</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit impedit similique qui, itaque delectus labore.</p>

                                <h6>Q. I have received my order but the wrong item was delivered to me.</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis quam voluptatum beatae harum tempore, ab?</p>

                                <h6>Q. Product Receipt and Acceptance Confirmation Process</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum ducimus, temporibus soluta impedit minus rerum?</p>

                                <h6>Q. How do I cancel my order?</h6>
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum eius eum, minima!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Single Product Details Area End -->

<!-- Related Products Area -->
<section class="you_may_like_area section_padding_0_100 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_heading new_arrivals">
                    <h5>You May Also Like</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="you_make_like_slider owl-carousel">
                    
                    @foreach($relatedProducts as $relatedProduct)
                    
                    @include('front.products.single_related', [
                        'relatedProduct' => $relatedProduct
                    ])
                    
                    
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Related Products Area -->

@endsection