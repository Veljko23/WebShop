<?php


namespace App\Shop;
use App\Models\Product;
/**
 * Description of ShoppingCartItem
 *
 * @author borin
 */
class ShoppingCartItem {
    /**
     * 
     * @var \App\Models\Product
     */
    protected $product;
    
    /**
     * 
     * @var int
     */
    protected $quantity = 1;
    
    public function __construct(Product $product, $quantity = 1) {
        $this->setProduct($product);
        $this->setQuantity($quantity);
    }

    /**
     * 
     * @return \App\Models\Product
     */
    public function getProduct(){
        return $this->product;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    public function setProduct(Product $product) {
        $this->product = $product;
        return $this;
    }

    public function setQuantity($quantity) {
        if($quantity < 1){
            throw new InvalidArgumentException('Quantity must be >= 1');
        }
        $this->quantity = $quantity;
        return $this;
    }

    public function increaseQuantity($quantity)
    {
        $this->quantity += $quantity;
    }
    
    public function getSubtotal()
    {
        return $this->getQuantity() * $this->getProduct()->price;
    }
    
}
