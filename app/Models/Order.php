<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    const STATUS_IN_PROGRESS = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_DELIVERING = 3;
    const STATUS_COMPLETE = 4;
    const STATUS_REJECTED = 99;
    
    const STATUSES = [
        self::STATUS_IN_PROGRESS,
        self::STATUS_ACCEPTED,
        self::STATUS_DELIVERING,
        self::STATUS_COMPLETE,
        self::STATUS_REJECTED
    ];
    
    const PAYMENT_METHOD_CASH_ON_DELIVERY = 1;
    const PAYMENT_METHOD_BANK_TRANSFER = 2;
    
    const PAYMENT_METHODS = [
        self::PAYMENT_METHOD_CASH_ON_DELIVERY,
        self::PAYMENT_METHOD_BANK_TRANSFER
    ];
    
    protected $table = 'orders';
    
    protected $fillable = [
        'status', 'payment_method', 'total', 'customer_name', 'uuid',
        'customer_email', 'customer_phone', 'customer_address_city',
        'customer_address_country', 'customer_address_zip',
        'customer_address_street', 'customer_address_number',
        
        'shipping_address_city',
        'shipping_address_country', 'shipping_address_zip',
        'shipping_address_street', 'shipping_address_number',
    ];
    
    //RELACIJE
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    
    public function getFrontUrl()
    {
        return route('front.orders.details', [
            'uuid' => $this->uuid
        ]);
    }
    
    
    
}
