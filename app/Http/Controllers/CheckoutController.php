<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Shop\ShoppingCart;
use App\Models\OrderItem;
use App\Mail\OrderCreatedMail;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $shoppingCart = ShoppingCart::getShoppingCartFromSession();
        
        return view('front.checkout.index', [
            'shoppingCart' => $shoppingCart
        ]);
    }
    
    public function confirmOrder(Request $request)
    {
        $formData = $request->validate([
            
            'payment_method' => ['required', 'numeric', 'in:' . implode(',', Order::PAYMENT_METHODS)],
            
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'max:255'],
            
            'customer_address_country' => ['required', 'string', 'max:255'],
            'customer_address_city' => ['required', 'string', 'max:255'],
            'customer_address_zip' => ['required', 'string', 'max:255'],
            'customer_address_street' => ['required', 'string', 'max:255'],
            'customer_address_number' => ['required', 'string', 'max:255'],
            
            'shipping_address_country' => ['required', 'string', 'max:255'],
            'shipping_address_city' => ['required', 'string', 'max:255'],
            'shipping_address_zip' => ['required', 'string', 'max:255'],
            'shipping_address_street' => ['required', 'string', 'max:255'],
            'shipping_address_number' => ['required', 'string', 'max:255'],
        ]);
        
        $shoppingCart = ShoppingCart::getShoppingCartFromSession();
        
        $formData['status'] = Order::STATUS_IN_PROGRESS;
        $formData['total'] = $shoppingCart->getTotal();
        $formData['uuid'] = \Str::uuid()->__toString();
        
        $newOrder = new Order($formData);
        $newOrder->save();
        
        foreach ($shoppingCart->getItems() as $shoppingCartItem){
            
            $orderItemData = [
                'order_id' => $newOrder->id,
                'product_id' => $shoppingCartItem->getProduct()->id,
                'price' => $shoppingCartItem->getProduct()->price,
                'quantity' => $shoppingCartItem->getQuantity()
            ];
            
            $orderItem = new OrderItem($orderItemData);
            $orderItem->save();
        }
        //ispraznimo korpu
        $shoppingCart->emptyCart();
        
        //poslati mejl korisniku sa detaljima porudzbine u kome stoji link za pracenje porudzbine
        
        \Mail::to($newOrder->customer_email)->send(new OrderCreatedMail($newOrder));
        
        return redirect()->route('front.orders.details', ['uuid' => $newOrder->uuid]);
    }
}
