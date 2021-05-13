<h3>Order #{{$order->id}}</h3>
<p>
    <a href="{{$order->getFrontUrl()}}">Click to track your order</a>
</p>
<h5>Order Items</h5>
<table class="table table-bordered" style="width: 600px"> 
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