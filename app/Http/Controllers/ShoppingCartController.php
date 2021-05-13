<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop\ShoppingCart;
use App\Models\Product;

class ShoppingCartController extends Controller
{
    public function index(Request $request)
    {
        $shoppingCart = ShoppingCart::getShoppingCartFromSession();

        return view('front.shopping_cart.index',[
            'shoppingCart' => $shoppingCart,
        ]);
    }
    
    public function table(Request $request)
    {
        
        $shoppingCart = ShoppingCart::getShoppingCartFromSession();

        return view('front.shopping_cart.partials.table',[
            'shoppingCart' => $shoppingCart,
        ]);
    }
    
    public function content(Request $request)
    {
        //sleep(5);
        
        $shoppingCart = ShoppingCart::getShoppingCartFromSession();
        
        
        //throw new \Exception('NESTO LOSE SE DESILO');
        return view('front._layout.partials.cart_content', [
            'shoppingCart' => $shoppingCart,
        ]);
    }
    
    public function addProduct(Request $request)
    {
        $formData = $request->validate([
            'product_id' =>['required', 'exists:products,id'],
            'quantity' =>['required', 'numeric', 'min:1', 'max:10'],
        ]);
        
        $shoppingCart = ShoppingCart::getShoppingCartFromSession();
        
        $product = Product::findOrFail($formData['product_id']);
        
        $shoppingCart->addProduct($product, $formData['quantity']);
        
        //dump($product->toArray(), $shoppingCart);
        return response()->json([
            'system_message' => 'Product has been added to cart',
        ]);
    }
    
    public function changeQuantity(Request $request)
    {
        $formData = $request->validate([
            'product_id' =>['required', 'exists:products,id'],
            'quantity' =>['required', 'numeric', 'min:1', 'max:10'],
        ]);
        
        $shoppingCart = ShoppingCart::getShoppingCartFromSession();
        
        $product = Product::findOrFail($formData['product_id']);
        
        $shoppingCart->changeQuantity($product, $formData['quantity']);
        
        //dump($product->toArray(), $shoppingCart);
        return response()->json([
            'system_message' => 'Quantity has been changed',
        ]);
    }
    
    public function removeProduct(Request $request)
    {
        $formData = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);
        
        $shoppingCart = ShoppingCart::getShoppingCartFromSession();
        
        $shoppingCart->removeProduct($formData['product_id']);
        
        return response()->json([
            'system_message' => 'Product has been deleted from cart'
        ]);
    }
}
