<?php

namespace App\Models;

use App\Http\Controllers\CategoryController;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductAttribute;
use App\Models\ProductVariant;

class Product extends Model
{
    use SoftDeletes;
    const ENTITY = 'product';
    const DEFAULT_PER_PAGE = 9;

    const PRICE_TYPE_PRODUCT_DETAIL = 'detail';
    const PRICE_TYPE_PRODUCT_LIST = 'list';
    const IS_ACTIVE = 'active';
    protected $primaryKey = "id"; // default it look for id


    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'price', 
        'code',
        'category_id',
        'brand_id',
        'discount',
        'status',
        'photo',
        'deleted_at',
        'has_variants',
        'attribute_catalogue',
        'attribute'
    ];
    
    protected $cast = [
        'attribute' => 'json'
    ];
    
    public function category()
    {
      return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    // public function variants()
    // {
    //     return $this->hasMany(ProductVariant::class, 'product_variant_attribute_value', 'product_id', 'product_variant_id');
    // }
 

    public function product_variants(){
        return $this->hasMany(ProductVariant::class, 'product_id', 'id');
    }
}
