<div class="cart--btn">
    <i class="icofont-cart"></i> 
    <span class="cart_quantity">{{$shoppingCart->itemsCount()}}</span>
</div>

<!-- Cart Dropdown Content -->
<div class="cart-dropdown-content">
    <ul class="cart-list">
        @foreach($shoppingCart->getItems() as $item)
        <li>
            <div class="cart-item-desc">
                <a href="{{$item->getProduct()->getFrontUrl()}}" class="image">
                    <img src="{{$item->getProduct()->getPhoto1Url()}}" class="cart-thumb" alt="">
                </a>
                <div>
                    <a href="{{$item->getProduct()->getFrontUrl()}}">
                        {{$item->getProduct()->name}}
                    </a>
                    <p>
                        {{$item->getQuantity()}} 
                        x - 
                        <span class="price">${{$item->getProduct()->price}}</span>
                    </p>
                </div>
            </div>
            <span
                class="dropdown-product-remove"
                data-action="remove_product"
                data-product-id="{{$item->getProduct()->id}}"
            ><i class="icofont-bin"></i>
            </span>
        </li>
        @endforeach
    </ul>
    <div class="cart-pricing my-4">
        <ul>
            <li>
                <span>Total:</span>
                <span>${{$shoppingCart->getTotal()}}</span>
            </li>
        </ul>
    </div>
    <div class="cart-box">
        <a href="{{route('front.shopping_cart.index')}}" class="btn btn-primary d-block">Checkout</a>
    </div>
</div>