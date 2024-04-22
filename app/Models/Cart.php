<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'code_variant', 'order_id', 'quantity', 'amount', 'price', 'status'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function getQtyByCart($productId, $order_id){
        return $this->where('product_id', $productId)->where('order_id', $order_id)->value('quantity');
    }

    // Trong model Cart
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'code_variant', 'code');
    }

}
