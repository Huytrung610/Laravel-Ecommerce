<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'status',
        'parent_id'
    ];

    public function child_cat()
    {
        return $this->hasOne('App\Models\Category', 'parent_id', 'id');
    }

    // public static function getProductBySubCat($slug)
    // {
    //     return Category::with('sub_products')->where('slug', $slug)->first();
    // }
    

    public function products()
    {
        return $this->hasMany('App\Models\Product','category_id','id');
    }
}
