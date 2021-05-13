@extends('front._layout.layout')

@section('seo_title', __('Checkout'))

@section('content')
<!-- Breadcumb Area -->
<div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>Cart</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="shopping-cart.html">Cart</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb Area -->

<!-- Checkout Area -->
<!-- Checkout Step Area -->
<div class="checkout_steps_area">
    <a class="complated" href="{{route('front.shopping_cart.index')}}"><i class="icofont-check-circled"></i> Cart</a>
    <a class="active" href="{{route('front.checkout.index')}}"><i class="icofont-check-circled"></i> Checkout</a>
</div>

<!-- Checkout Area -->
<div class="checkout_area section_padding_100">
    <div class="container">
        <form id="checkout-form" class="row" action="{{route('front.checkout.confirm_order')}}" method="post" autocomplete="off">
            @csrf
            <div class="col-12 col-lg-6">
                <fieldset>
                    <legend class="h5 text-primary mb-4">Billing</legend>
                    <div class="form-group">
                        <label>Your Name</label>
                        <input 
                            name="customer_name"
                            value="{{old('customer_name')}}"
                            type="text" 
                            class="form-control @if($errors->has('customer_name')) is-invalid @endif" 
                            placeholder="Enter your name"
                            >
                        @include('front._layout.partials.form_errors', ['fieldName' => 'customer_name'])
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input 
                            name="customer_email"
                            value="{{old('customer_email')}}"
                            type="text" 
                            class="form-control @if($errors->has('customer_email')) is-invalid @endif" 
                            placeholder="Enter your email"
                            >
                        @include('front._layout.partials.form_errors', ['fieldName' => 'customer_email'])
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input 
                            name="customer_phone"
                            value="{{old('customer_phone')}}"
                            type="text" 
                            class="form-control @if($errors->has('customer_phone')) is-invalid @endif" 
                            placeholder="Enter your phone number"
                            >
                        @include('front._layout.partials.form_errors', ['fieldName' => 'customer_phone'])
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Country</label>
                                <input 
                                    name="customer_address_country"
                                    value="{{old('customer_address_country')}}"
                                    type="text" 
                                    class="form-control @if($errors->has('customer_address_country')) is-invalid @endif" 
                                    placeholder="Your Country"
                                    >
                                @include('front._layout.partials.form_errors', ['fieldName' => 'customer_address_country'])
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label>City</label>
                                <input 
                                    name="customer_address_city"
                                    value="{{old('customer_address_city')}}"
                                    type="text" 
                                    class="form-control @if($errors->has('customer_address_city')) is-invalid @endif" 
                                    placeholder="Your city"
                                    >
                                @include('front._layout.partials.form_errors', ['fieldName' => 'customer_address_city'])
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>ZIP Code</label>
                                <input 
                                    name="customer_address_zip"
                                    value="{{old('customer_address_zip')}}"
                                    type="text" 
                                    class="form-control @if($errors->has('customer_address_zip')) is-invalid @endif" 
                                    placeholder="Your ZIP"
                                    >
                                @include('front._layout.partials.form_errors', ['fieldName' => 'customer_address_zip'])
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label>Street</label>
                                <input 
                                    name="customer_address_street"
                                    value="{{old('customer_address_street')}}"
                                    type="text" 
                                    class="form-control @if($errors->has('customer_address_street')) is-invalid @endif" 
                                    placeholder="Your street"
                                    >
                                @include('front._layout.partials.form_errors', ['fieldName' => 'customer_address_street'])
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Number</label>
                                <input 
                                    type="text" 
                                    name="customer_address_number"
                                    value="{{old('customer_address_number')}}"
                                    class="form-control @if($errors->has('customer_address_number')) is-invalid @endif" 
                                    placeholder="Number"
                                    >
                                @include('front._layout.partials.form_errors', ['fieldName' => 'customer_address_number'])
                            </div>
                        </div>
                    </div>
                </fieldset>
                <hr>
                <fieldset>
                    <legend class="h5 text-primary mb-4 mt-5">
                        Shipping Address
                        <small class="text-secondary">
                            (
                            <input type="checkbox" id="shipping-as-billing-check">
                            <label for="shipping-as-billing-check">Same as Billing Address</label>
                            )
                        </small>

                    </legend>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Country</label>
                                <input 
                                    name="shipping_address_country"
                                    value="{{old('shipping_address_country')}}"
                                    class="form-control @if($errors->has('shipping_address_country')) is-invalid @endif"
                                    type="text" 
                                    placeholder="Your Country" 
                                    >
                                @include('front._layout.partials.form_errors', ['fieldName' => 'shipping_address_country'])
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label>City</label>
                                <input 
                                    name="shipping_address_city"
                                    value="{{old('shipping_address_city')}}"
                                    class="form-control @if($errors->has('shipping_address_city')) is-invalid @endif"
                                    type="text" 
                                    placeholder="Your city"
                                    >
                                @include('front._layout.partials.form_errors', ['fieldName' => 'shipping_address_city'])
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>ZIP Code</label>
                                <input 
                                    name="shipping_address_zip"
                                    value="{{old('shipping_address_zip')}}"
                                    class="form-control @if($errors->has('shipping_address_zip')) is-invalid @endif"
                                    type="text" 
                                    placeholder="Your ZIP"
                                    >
                                @include('front._layout.partials.form_errors', ['fieldName' => 'shipping_address_zip'])
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label>Street</label>
                                <input 
                                    name="shipping_address_street"
                                    value="{{old('shipping_address_street')}}"
                                    class="form-control @if($errors->has('shipping_address_street')) is-invalid @endif"
                                    type="text" 
                                    placeholder="Your street"
                                    >
                                @include('front._layout.partials.form_errors', ['fieldName' => 'shipping_address_street'])
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Number</label>
                                <input 
                                    name="shipping_address_number"
                                    value="{{old('shipping_address_number')}}"
                                    class="form-control @if($errors->has('shipping_address_number')) is-invalid @endif"
                                    type="text" 
                                    placeholder="Number"
                                    >
                                @include('front._layout.partials.form_errors', ['fieldName' => 'shipping_address_number'])
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-12 col-lg-5">
                <div class="cart-total-area mb-30">
                    <h5 class="mb-3">Payment Method</h5>
                    <div class="table-responsive">
                        <table class="table mb-3">
                            <tbody>
                                <tr>
                                    <td class="text-left">
                                        <label for="payment_method_1" class="text-primary">
                                            <input 
                                                type="radio" 
                                                name="payment_method" 
                                                value="{{\App\Models\Order::PAYMENT_METHOD_CASH_ON_DELIVERY}}"
                                                @if(old('payment_method') == \App\Models\Order::PAYMENT_METHOD_CASH_ON_DELIVERY)
                                                checked
                                                @endif
                                                id="payment_method_1" 
                                                class="align-middle"
                                                >
                                            <i class="icofont-cash-on-delivery-alt align-middle" style="font-size: 6rem"></i> 
                                            <span class="align-middle">Cash on Delivery</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <label for="payment_method_2" class="text-primary">
                                            <input 
                                                type="radio"
                                                name="payment_method" 
                                                value="{{\App\Models\Order::PAYMENT_METHOD_BANK_TRANSFER}}"
                                                @if(old('payment_method') == \App\Models\Order::PAYMENT_METHOD_BANK_TRANSFER)
                                                checked
                                                @endif
                                                id="payment_method_2" 
                                                class="align-middle"
                                                >
                                            <i class="icofont-bank-transfer-alt align-middle" style="font-size: 6rem"></i> 
                                            <span class="align-middle">Direct Bank Transfer</span>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-control @if($errors->has('payment_method')) is-invalid @endif" style="display: none"></div>
                    @include('front._layout.partials.form_errors', ['fieldName' => 'payment_method'])
                </div>
                <hr>
                <div class="cart-total-area mb-30">
                    <h5 class="mb-3">Order Totals</h5>
                    <div class="table-responsive">
                        <table class="table mb-3">
                            <tbody>
                                <tr>
                                    <td>Total</td>
                                    <td>{{$shoppingCart->getTotal()}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Confirm Order</button>
                    <p class="text-right">
                        <a class="text-muted" href="{{route('front.shopping_cart.index')}}">
                            <i class="fa fa-caret-left"></i>
                            Review your cart
                        </a>
                    </p>

                </div>
            </div>
        </form>
    </div>
</div>

<!-- Checkout Area End -->

@endsection

@push('footer_javascript')
<script>
    let shippingCopyMap = {
            "customer_address_country": "shipping_address_country",
            "customer_address_city": "shipping_address_city",
            "customer_address_zip": "shipping_address_zip",
            "customer_address_street": "shipping_address_street",
            "customer_address_number": "shipping_address_number"
        };
    
    $('#shipping-as-billing-check').on('click', function (e) {
        let checked = $(this).is(':checked');

        

        for (let customerField in shippingCopyMap) {
            let shippingField = shippingCopyMap[customerField];

            if (checked) {
                $('#checkout-form [name="' + shippingField +'"]').attr('readonly', 'readonly');
                $('#checkout-form [name="' + shippingField +'"]').val(
                        $('#checkout-form [name="' + customerField +'"]').val()
                        );
            } else {
                $('#checkout-form [name="' + shippingField +'"]').removeAttr('readonly');
            }
        }

    });
    
    $('#checkout-form [name="customer_address_country"], #checkout-form [name="customer_address_city"], #checkout-form [name="customer_address_zip"], #checkout-form [name="customer_address_street"], #checkout-form [name="customer_address_number"]').on('keyup', function(){
        
        let checked = $('#shipping-as-billing-check').is(':checked');
        
        if(!checked){
            return;
        }
        
        let customerField = $(this).attr('name');
        
        let shippingField = shippingCopyMap[customerField];
        
        $('#checkout-form [name="' + shippingField  +'"]').val(
                $(this).val()
        );
    });
    
</script>
@endpush