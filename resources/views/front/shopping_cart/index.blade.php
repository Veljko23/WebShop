@extends('front._layout.layout')
@section('seo_title', 'Shopping Cart')

@section('content')
<!-- Breadcumb Area -->
<div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>Cart</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.index.index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="checkout_steps_area">
    <a class="active" href="{{route('front.shopping_cart.index')}}"><i class="icofont-check-circled"></i> Cart</a>
    <a class="" href="{{route('front.checkout.index')}}"><i class="icofont-check-circled"></i> Checkout</a>
</div>

<!-- Cart Area -->
<div class="cart_area section_padding_100_70 clearfix" id="shopping_cart_table">
    
</div>
<!-- Cart Area End -->
@endsection


@push('footer_javascript')
<script>
    
</script>
@endpush