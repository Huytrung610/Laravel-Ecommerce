<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\CategoryController;

class Category extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    const CATEGORY_PARENT = 'parent';
    const SUB_CATEGORY = 'child';
    const CATEGORY_PARENT_ID = 0;

    const CATEGORY_TYPE = [
        self::CATEGORY_PARENT => "Parent Category",
        self::SUB_CATEGORY => "Child Category"
    ];
    
    protected $fillable = [
        'title',
        'photo',
        'slug',
        'summary',
        'status',
        'category_type',
        'parent_id'
    ];

    public function child_cat()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }
    

    public function products()
    {
        return $this->hasMany('App\Models\Product','category_id','id');
    }

    public static function getSubCategory()
    {
        return Category::where('parent_id', '<>',CategoryController::IS_PARENT_CATEGORY)
            ->where('status', 'active')
            ->get()
            ->sortBy('sort_order');
    }

    public static function getParentCategories()
    {
        return self::where('parent_id', Category::CATEGORY_PARENT_ID)->where('status',self::STATUS_ACTIVE )->get();
    }
    public static function getChildCatByParentCat($id){
        return self::where('parent_id', $id)->where('status', self::STATUS_ACTIVE)->get();
    }
    public static function getAllChildCat(){
        return self::where('parent_id', '!=', self::CATEGORY_PARENT_ID)->where('status', self::STATUS_ACTIVE)->get();
    }

    public static function shiftChild($catId)
    {
        return Category::whereIn('id', $catId)->update(['is_parent' =>self::CATEGORY_PARENT_ID]);
    }
}
