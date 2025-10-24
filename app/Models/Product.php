<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function Cart(){
        return $this->hasMany(Cart::class);
    }
    public function ProductPhoto(){
        return $this->belongsTo(ProductPhoto::class);
    }

    public function product()
{
    return $this->belongsTo(Product::class, 'product_id', 'id');
}
public function offer(){
    return $this->hasMany(Offer::class);
}
public function latestoffer(){
    return $this->hasOne(Offer::class)->latestOfMany();
}

public function getFinalPriceAttribute(){
    if($this->latestoffer){
        return $this->latestoffer;
    }
    $this->price;
}
}
