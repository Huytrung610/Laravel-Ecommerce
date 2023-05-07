<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AttributeValue;
use App\Models\Product;


class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'price',
        'stock',
        'color',
        'product_id'
    ];

    
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    
    
}
