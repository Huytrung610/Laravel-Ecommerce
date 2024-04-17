<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    public function carts()
    {
        return $this->hasMany(Cart::class,'product_id');
    }
    

    public function getPrice()
    {
        $originalPrice = $this->price ?? 0;
        return $originalPrice;
    }
    
    public function getSku($productId){
        return $this->where('id', $productId)->value('sku');
    }
    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }
    
    public function productVariants()
    {
        return $this->belongsToMany(ProductVariant::class, 'product_variant_attribute', 'attribute_id', 'product_variant_id');
    }

    
}
