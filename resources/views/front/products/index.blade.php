@extends('front._layout.layout')
@section('seo_title', 'Products')
@section('seo_description', 'Search for one of our products')
@section('content')


<!-- Breadcumb Area -->
<div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>Products</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.index.index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Products</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb Area -->

<!-- Shop List Area -->
<section class="shop_list_area section_padding_100">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 col-xl-3">
                <form action="{{route('front.products.index')}}" 
                      method="get" 
                      id="products_filter_form">
                <div class="shop_sidebar_area">
                    <!-- Single Widget -->
                    <div class="widget catagory mb-30">
                        <h6 class="widget-title">Product Categories</h6>
                        <div class="widget-desc">
                            @foreach($productCategories as $productCategory)
                            <!-- Single Checkbox -->
                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                <input 
                                    type="checkbox"
                                    name="product_category_id[]"
                                    value="{{$productCategory->id}}"
                                    class="custom-control-input" 
                                    id="product_category_{{$productCategory->id}}"
                                    
                                    @if(
                                        isset($formData['product_category_id'])
                                        && in_array($productCategory->id, $formData['product_category_id'])
                                    )
                                    checked
                                    
                                    @php
                                    $counter += $productCategory->products_count
                                    @endphp
                                    
                                    @endif
                                >
                                <label 
                                    class="custom-control-label" 
                                    for="product_category_{{$productCategory->id}}">
                                    {{$productCategory->name}} 
                                    <span class="text-muted">({{$productCategory->products_count}})</span>
                                </label>
                            </div>
 
                            @endforeach
                            
                        </div>
                        <div class="text-success">
                       
                        </div>
                    </div>

                    <!-- Single Widget -->
                    <div class="widget color mb-30">
                        <h6 class="widget-title">Filter by Color</h6>
                        <div class="widget-desc">
                            <!-- Single Checkbox -->
                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck6">
                                <label class="custom-control-label black" for="customCheck6">Black <span class="text-muted">(9)</span></label>
                            </div>
                            <!-- Single Checkbox -->
                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck7">
                                <label class="custom-control-label pink" for="customCheck7">Pink <span class="text-muted">(6)</span></label>
                            </div>
                            <!-- Single Checkbox -->
                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck8">
                                <label class="custom-control-label red" for="customCheck8">Red <span class="text-muted">(8)</span></label>
                            </div>
                            <!-- Single Checkbox -->
                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck9">
                                <label class="custom-control-label purple" for="customCheck9">Purple <span class="text-muted">(4)</span></label>
                            </div>
                            <!-- Single Checkbox -->
                            <div class="custom-control custom-checkbox d-flex align-items-center">
                                <input type="checkbox" class="custom-control-input" id="customCheck10">
                                <label class="custom-control-label orange" for="customCheck10">Orange <span class="text-muted">(7)</span></label>
                            </div>
                        </div>
                    </div>

                    <!-- Single Widget -->
                    <div class="widget brands mb-30">
                        <h6 class="widget-title">Filter by brands</h6>
                        <div class="widget-desc">
                            @foreach($brands as $brand)
                            <!-- Single Checkbox -->
                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                <input type="checkbox" 
                                       class="custom-control-input" 
                                       name="brand_id[]"
                                       value="{{$brand->id}}"
                                       id="brand_id_{{$brand->id}}"
                                       @if(
                                            isset($formData['brand_id'])
                                            && in_array($brand->id, $formData['brand_id']))
                                       )
                                       
                                       checked
                                       @endif
                                 >
                                <label class="custom-control-label" 
                                       for="brand_id_{{$brand->id}}">
                                    {{$brand->name}} 
                                    <span class="text-muted">({{$brand->products_count}})</span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                </form>
            </div>

            <div class="col-12 col-md-8 col-xl-9">
                <!-- Shop Top Sidebar -->
                <div class="shop_top_sidebar_area d-flex flex-wrap align-items-center justify-content-between">
                    <select id="products_filter_sort_by" class="small right" name="sort_by" form="products_filter_form">
                        <option 
                            value="G"
                            @if(
                                isset($formData['sort_by'])
                                && $formData['sort_by'] == 'G'
                            )
                            selected
                            @endif
                            
                        >Newest</option>
                        <option 
                            value="W"
                            @if(
                                isset($formData['sort_by'])
                                && $formData['sort_by'] == 'W'
                            )
                            selected
                            @endif
                        >Oldest</option>
                        <option 
                            value="X"
                            @if(
                                isset($formData['sort_by'])
                                && $formData['sort_by'] == 'X'
                            )
                            selected
                            @endif
                        >Cheapest</option>
                        <option 
                            value="Q"
                            @if(
                                isset($formData['sort_by'])
                                && $formData['sort_by'] == 'Q'
                            )
                            selected
                            @endif
                        >Most Expensive</option>
                    </select>
                    
                </div>

                <div class="shop_list_product_area">
                    <div class="row">
                        
                        @foreach($products as $product)
                        
                        <!-- Single Product -->
                        <div class="col-12">
                            <div class="single-product-area mb-30">
                                <div class="product_image">
                                    <!-- Product Image -->
                                    <img class="normal_img" src="{{$product->getPhoto1ThumbUrl()}}" alt="">
                                    <img class="hover_img" src="{{$product->getPhoto2ThumbUrl()}}" alt="">

                                    @if($product->isOnIndexPage())
                                    <!-- Product Badge -->
                                    <div class="product_badge">
                                        <span>New</span>
                                    </div>
                                    @endif
                                </div>

                                <!-- Product Description -->
                                <div class="product_description">
                                    <!-- Add to cart -->
                                    <div class="product_add_to_cart">
                                        <a 
                                            href="#"
                                            data-action ="add_to_cart"
                                            data-product-id="{{$product->id}}"
                                            data-quantity = "1"
                                         >
                                            <i class="icofont-shopping-cart"></i> 
                                            Add to Cart
                                        </a>
                                    </div>

                                    <!-- Quick View -->
                                    <div class="product_quick_view">
                                        <a 
                                            href="{{$product->getFrontUrl()}}" 
                                        >
                                            <i class="icofont-eye-alt"></i> View Product</a>
                                    </div>

                                    <p class="brand_name">{{optional($product->brand)->name}} / {{optional($product->productCategory)->name}}</p>
                                    <a href="{{$product->getFrontUrl()}}">
                                        {{$product->name}}
                                    </a>
                                    <h6 class="product-price">${{$product->price}} 
                                        @if($product->old_price > 0)
                                        <span>{{$product->old_price}}</span>
                                        @endif
                                    </h6>

                                    <p class="product-short-desc">
                                        {{$product->description}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>

                <!-- Shop Pagination Area -->
                <div class="shop_pagination_area mt-30">
                    <nav aria-label="Page navigation">
                       {{$products->links()}}
                    </nav>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Shop List Area -->

@endsection

@push('footer_javascript')

<script src="{{url('/themes/front/plugins/jquery.ba-throttle-debounce.min.js')}}" type="text/javascript"></script>

<script>
    $('#products_filter_form').on('click', '.custom-checkbox', $.debounce(1000, function(e){
        e.stopPropagation();
//        setTimeout(function(){
//            $('#products_filter_form').trigger('submit');
//        }, 1000)
        $('#products_filter_form').trigger('submit');
    }));
    
    $('#products_filter_sort_by').on('change', $.debounce(500, function(e){
        e.stopPropagation();
        $('#products_filter_form').trigger('submit');
    }));
</script>
@endpush