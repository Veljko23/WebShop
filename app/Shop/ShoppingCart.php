<?php


namespace App\Shop;
use App\Models\Product;

class ShoppingCart {
    
    /**
     * 
     * @var ShoppingCartItem[]
     */
    protected $items = [];
    /**
     * 
     * @return \App\Shop\ShoppingCart
     */
    public static function getShoppingCartFromSession()
    {
        $shoppingCart = session()->get('shopping_cart');
        if(!($shoppingCart) instanceof ShoppingCart){
            $shoppingCart = new ShoppingCart();
            session()->put('shopping_cart', $shoppingCart);
        }
        
        return $shoppingCart;
    }
    
    public function addProduct(Product $product, $quantity = 1)
    {
        foreach ($this->items as $item){
            
            if($product->id == $item->getProduct()->id){
                $item->increaseQuantity($quantity);
                
                return $this;
            }
        }
        
        $newItem = new ShoppingCartItem($product, $quantity);
        
        $this->items[] = $newItem;
        
        return $this;
    }
    
    public function changeQuantity(Product $product, $quantity)
    {
        foreach ($this->items as $item){
            
            if($product->id == $item->getProduct()->id){
                $item->setQuantity($quantity);
                
                return $this;
            }
        }
                
        return $this;
    }
    /**
     * 
     * @param int $productId
     * @return ShoppingCart
     */
    public function removeProduct($productId)
    {
        foreach ($this->items as $key => $item){
            
            if($item->getProduct()->id == $productId){
                
                unset($this->items[$key]);
                
                return $this;
            }
        }
        
        return $this;
    }
    
    public function itemsCount()
    {
        return count($this->items);
    }
    /**
     * 
     * @return ShoppingCartItem[]
     */
    public function getItems(){
        return $this->items;
    }

    public function getTotal()
    {
        $total = 0;
        
        foreach ($this->items as $item){
            $total += $item->getSubtotal();
        }
        
        return $total;
    }
    
    public function emptyCart()
    {
        $this->items = [];
        
        return $this;
    }
}
