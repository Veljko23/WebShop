<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    
    protected $fillable = [
        'name',
        'brand_id',
        'product_category_id',
        'description',
        'price',
        'old_price',
        'index_page',
        'details'
        
    ];


    public function productCategory()
    {
        return $this->belongsTo(
                ProductCategory::class,
                'product_category_id', //fk u tabeli deteta
                'id' // naziv kljuca u tabeli roditelja
                );
    }
    
    public function brand()
    {
        return $this->belongsTo(
                Brand::class,
                'brand_id',
                'id'
                );
    }
    
    public function sizes()
    {
        return $this->belongsToMany(
                Size::class,
                'product_sizes',
                'product_id',
                'size_id'
        );
    }
    
    //QUERY SCOPES
    
    public function scopeNewArrivals($queryBuilder)
    {
        $queryBuilder->where('index_page', 1)
                ->where('created_at', '>=', date('Y-m-d', strtotime('-1 month')))
                ->orderBy('created_at', 'DESC');
    }
    
    /**
     * @return boolean
     */
    public function isOnIndexPage()
    {
        return $this->index_page == 1 ? true : false; // da li je index_page = 1
    }
    
    public function getPhoto1Url()
    {
        if($this->photo1){ //ako ima photo1
            return url('/storage/products/'. $this->photo1); //daj njenu adresu
        }
        return url('/themes/front/img/product-img/onsale-1.png');
    }
    
    public function getPhoto1ThumbUrl()
    {
        if($this->photo1){
            return url('/storage/products/thumbs/', $this->photo1);
        }
        return url('/themes/front/img/product-img/onsale-1.png');
    }
    
    public function deletePhoto1()
    {
        if(!$this->photo1){ //ako nema photo1 vrati this
            return $this; //fluent interface
        }
        
        $photoFilePath = public_path('/storage/products/'. $this->photo1);
        
        if(!is_file($photoFilePath)){ //informacija o fajlu u bazi postoji, ali ga nema na disku
            return $this;
        }
        
        unlink($photoFilePath);
        
        $photoThumbPath = public_path('/storage/products/thumbs/'. $this->photo1);
        
        if(!is_file($photoThumbPath)){// thumb slika ne postoji na disku
            return $this;
        }
        
        unlink($photoThumbPath);
        
        return $this;
    }
    
    public function getPhoto2Url()
    {
        if($this->photo2){
            return url('/storage/products/'. $this->photo2);
        }
        
        return url('/themes/front/img/product-img/best-1.png');
    }
    
    public function getPhoto2ThumbUrl()
    {
        if($this->photo2){
            return url('/storage/products/thumbs/', $this->photo2);
        }
        return url('/themes/front/img/product-img/onsale-1.png');
    }
    
    public function deletePhoto2()
    {
        if(!$this->photo2){ //ako nema photo1 vrati this
            return $this; //fluent interface
        }
        
        $photoFilePath = public_path('/storage/products/'. $this->photo2);
        
        if(!is_file($photoFilePath)){ //informacija o fajlu u bazi postoji, ali ga nema na disku
            return $this;
        }
        
        unlink($photoFilePath);
        
        $photoThumbPath = public_path('/storage/products/thumbs/'. $this->photo2);
        
        if(!is_file($photoThumbPath)){// thumb slika ne postoji na disku
            return $this;
        }
        
        unlink($photoThumbPath);
        
        return $this;
    }
    
    public function deletePhotos()
    {
        $this->deletePhoto1();
        $this->deletePhoto2();
        
        return $this;
    }
    
    public function deletePhoto($photoFieldName)
    {
        switch ($photoFieldName){
            case 'photo1':
                $this->deletePhoto1();
                break;
            case 'photo2':
                $this->deletePhoto2();
                break;
        }
        
        return $this;
    }
    
    public function getPhotoUrl($photoFieldName)
    {
        switch ($photoFieldName){
            case 'photo1':
                $this->getPhoto1Url();
                break;
            case 'photo2':
                $this->getPhoto2Url();
                break;
        }
        
        return url('/themes/front/img/product-img/best-1.png');

    }
    
    public function getFrontUrl()
    {
        return route('front.products.single', [
            'product' => $this->id,
            'seoSlug' => \Str::slug($this->name)
        ]);
    }
}
