@extends('front._layout.layout')

@section('seo_title', 'Order details')
@section('content')

<!-- Breadcumb Area -->
<div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>Order details</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Order Details</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb Area -->

<!-- Checkout Area -->
<div class="checkout_area mt-50">
    <div class="container">
        <div class="row order_complated_area">
            <div class="col-lg-6">
                <h1>Order #{{$order->id}}</h1>
                <small class="text-muted">
                    Last change: 
                    
                    {{\Carbon\Carbon::createFromTimeStamp(strtotime($order->updated_at))->diffForHumans()}}
                </small>
            </div>
            <div class="col-lg-6 text-right">
                <span class="btn border border-secondary">
                    <span class="badge badge-secondary">&nbsp;</span>
                    In Progress
                </span>
                <!--
                <span class="btn border border-secondary">
                    <span class="badge badge-info">&nbsp;</span>
                    Accepted
                </span>
                <span class="btn border border-secondary">
                    <span class="badge badge-warning">&nbsp;</span>
                    Delivering
                </span>
                <span class="btn border border-secondary">
                    <span class="badge badge-success">&nbsp;</span>
                    Completed
                </span>
                <span class="btn border border-secondary">
                    <span class="badge badge-danger">&nbsp;</span>
                    Rejected
                </span>
                -->
            </div>
        </div>
    </div>
</div>

<div class="checkout_area mt-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h4>
                    Order for:
                    <u>Aleksandar Dimic</u>
                </h4>
                <p><strong>aleksandar.dimic@cubes.rs</strong></p>
                <p><strong>+381643334445</strong></p>
            </div>
            <div class="col-lg-4 text-right">
                <h4 class="text-left">
                    Total: 
                    <span class="float-right">${{$order->total}}</span>
                </h4>
                <!--
                <label class="text-primary">
                    <i class="icofont-cash-on-delivery-alt align-middle" style="font-size: 6rem"></i> 
                    <span class="align-middle">Cash on Delivery</span>
                </label>
                
                -->
                <label class="text-primary">
                    <i class="icofont-bank-transfer-alt align-middle" style="font-size: 6rem"></i> 
                    <span class="align-middle">Direct bank transfer</span>
                </label>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Bank account</td>
                            <td><strong>123-342455465-32</strong></td>
                        </tr>
                        <tr>
                            <td>Reference Number</td>
                            <td><strong>{{$order->id}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <h6>Blling Address</h3>
                    <span>{{$order->customer_address_street}}</span>
                    <span>{{$order->customer_address_number}}</span>,
                    <span>{{$order->customer_address_zip}}</span>
                    <span>{{$order->customer_address_city}}</span>,
                    <span>{{$order->customer_address_country}}</span>
            </div>
            <div class="col-lg-6">
                <h6>Shipping Address</h3>
                    <span>{{$order->shipping_address_street}}</span>
                    <span>{{$order->shipping_address_number}}</span>,
                    <span>{{$order->shipping_address_zip}}</span>
                    <span>{{$order->shipping_address_city}}</span>,
                    <span>{{$order->shipping_address_country}}</span>
            </div>
        </div>
    </div>
</div>
<!-- Checkout Area -->

<!-- Cart Area -->
<div class="cart_area mt-50 mb-50 clearfix">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-12">
                <div class="cart-table">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $orderItem)
                                <tr>
                                    <td>
                                        <img src="{{$orderItem->product->getPhoto1ThumbUrl()}}" alt="Product">
                                    </td>
                                    <td>
                                        <a href="{{optional($orderItem->product)->getFrontUrl()}}">
                                            {{optional($orderItem->product)->name}}
                                        </a>
                                    </td>
                                    <td>${{$orderItem->price}}</td>
                                    <td>
                                        <div class="quantity">
                                            {{$orderItem->quantity}}
                                        </div>
                                    </td>
                                    <td>${{$orderItem->price * $orderItem->quantity}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">

            </div>

            <div class="col-12 col-lg-5">
                <div class="cart-total-area">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Total</td>
                                    <td>${{$order->total}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection