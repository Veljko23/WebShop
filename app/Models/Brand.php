<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    
    protected $fillable = [
        'name',
        'website'
    ];


    public function products()
    {
        return $this->hasMany(
                Product::class,
                'brand_id',
                'id'
                );
    }
    
    public function getPhotoUrl()
    {
        if(!empty($this->photo)){
            return url('/storage/brands/' . $this->photo);
        }
        return url('/themes/front/img/partner-img/5.jpg');
    }
    
    public function deletePhoto()
    {
        //nema slike
        if(empty($this->photo)){
            return $this;
        }
        
        $photoFilePath = public_path('/storage/brands/' . $this->photo);
        
        //ako fajl ne postoji fizicki na disku
        if(!is_file($photoFilePath)){
            return $this;
        }
        unlink($photoFilePath);
        
        return $this;
    }
}



