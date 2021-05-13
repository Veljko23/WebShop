<!-- Single Product -->
<div class="single-product-area">
    <div class="product_image">
        <!-- Product Image -->
        <img class="normal_img" src="{{$relatedProduct->getPhoto1ThumbUrl()}}" alt="">
        <img class="hover_img" src="{{$relatedProduct->getPhoto1ThumbUrl()}}" alt="">

        <!-- Product Badge -->
        <div class="product_badge">
            <span>New</span>
        </div>
    </div>

    <!-- Product Description -->
    <div class="product_description">
        <!-- Add to cart -->
        <div class="product_add_to_cart">
            <a href="#"
               data-action ="add_to_cart"
               data-product-id="{{$relatedProduct->id}}"
               data-quantity = "1"
            ><i class="icofont-shopping-cart"></i> 
                Add to Cart
            </a>
        </div>

        <!-- Quick View -->
        <div class="product_quick_view">
            <a href="#" 
            ><i class="icofont-eye-alt"></i> 
                Quick View
            </a>
        </div>

        <p class="brand_name">Top</p>
        <a href="{{$relatedProduct->getFrontUrl()}}">{{$relatedProduct->name}}</a>
        <h6 class="product-price">{{$relatedProduct->price}}</h6>
    </div>
</div>