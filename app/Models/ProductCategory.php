<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';
    
    protected $fillable = [
        'name',
        'description',
        'priority'
    ];


    public function products()
    {
        return $this->hasMany(
                Product::class,
                'product_category_id', //fk u products tabeli
                'id' // kljuc kategorije se prenosi
                ); //vraca query builder
    }
}
