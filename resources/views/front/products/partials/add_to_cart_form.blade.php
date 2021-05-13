<!-- Add to Cart Form -->
<form id="add_to_cart_form" class="cart clearfix my-5 d-flex flex-wrap align-items-center" method="post">
    <div class="quantity">
        <input type="number" 
               class="qty-text form-control" 
                
               step="1" 
               min="1" 
               max="12" 
               name="quantity" 
               value="1"
        >
    </div>
    <button type="submit" name="addtocart" value="5" class="btn btn-primary mt-1 mt-md-0 ml-1 ml-md-3">Add to cart</button>
</form>

@push('footer_javascript')

<script type="text/javascript">
    $('#add_to_cart_form').on('submit', function(e){
        e.preventDefault();
        e.stopPropagation();
        
        let quantity = $('#add_to_cart_form [name="quantity"]').val(); //obelezena forma sa #id i daj atribut []
        
        let productId = "{{$product->id}}";
        
        shoppingCartFrontAddToCart(productId, quantity);
        
    });
</script>

@endpush