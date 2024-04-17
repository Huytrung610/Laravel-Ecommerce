<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'code',
        'slug',
        'sku',
        'name',
        'quantity',
        'price',
        'image',
        'barcode',
        'deleted_at',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    protected $casts = [
        'image' => 'json'
    ];
    
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_variant_attribute', 'product_variant_id', 'attribute_id');
    }

    public static function findVariant($code, $productId){
        return self::where([
            'code' => $code,
            'product_id' => $productId
        ])->first();
    }
    
}
