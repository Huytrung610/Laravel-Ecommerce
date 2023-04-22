<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Category;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
   
    public function getParentCategoryLevel($product)
    {
        $categoryId = $product->category_id ?? '';
        if (empty($categoryId)) {
            return false;
        }
        return Category::where('id', $categoryId)->first();
    }

    
    public function getSubParentCategoryLevel($product, $storeId = 0)
    {
        $subCategoryId = $product->child_cat_id ?? '';
        if (empty($subCategoryId)) {
            return false;
        }
        return Category::setStore($storeId)
            ->select(['attr.*'])->where('id', $subCategoryId)->first();
    }

 
    // public function getAllProductWithSlugOfCategory($slug, $storeId = 0) {
    //    $category = Category::with('products')->where('slug', $slug)->first();
    //    $allProductIds  = [];
    //    if(!empty($category)) {
    //        $allProductIds = $category->products->pluck('id');
    //    }
    //    return Product::setStore($storeId)->select(['attr.*'])->whereIn('id', $allProductIds)->whereAttribute('status', 'active')->paginate(Product::DEFAULT_PER_PAGE);
    // }

  
    // public function getProductWithSlug($slug, $storeId = 0) {
    //     return Product::with(['cat_info', 'rel_prods', 'getReview'])
    //         ->setStore($storeId)->select(['attr.*'])
    //         ->where('slug', $slug)->first();
    // }


    // public function getProductWithId($id, $storeId = 0) {
    //     return Product::with(['cat_info', 'rel_prods', 'getReview'])
    //         ->setStore($storeId)->select(['attr.*'])
    //         ->where('id', $id)->first();
    // }

}
