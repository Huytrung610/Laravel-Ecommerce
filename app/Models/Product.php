<?php

namespace App\Models;

use App\Http\Controllers\CategoryController;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;


class Product extends Model
{
    use SoftDeletes;
    const ENTITY = 'product';
    const DEFAULT_PER_PAGE = 18;

    const PRICE_TYPE_PRODUCT_DETAIL = 'detail';
    const PRICE_TYPE_PRODUCT_LIST = 'list';
    const IS_ACTIVE = 'active';
    protected $primaryKey = "id"; // default it look for id


    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'category_id',
        'price',
        'discount',
        'status',
        'photo',
        'deleted_at'
    ];
 
    
    public function category()
    {
      return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    

    // public function sub_cat_info()
    // {
    //     return $this->hasOne('App\Models\Category', 'id', 'child_cat_id');
    // }

    // public function rel_prods()
    // {
    //     return $this->hasMany('App\Models\Product', 'cat_id', 'cat_id')->where('status', 'active')->orderBy('id', 'DESC')->limit(8);
    // }

    // public function getReview()
    // {
    //     return $this->hasMany('App\Models\ProductReview', 'product_id', 'id')->with('user_info')->where('status', 'active')->orderBy('id', 'DESC');
    // }

    // public static function getProductBySlug($slug)
    // {
    //     return Product::with(['cat_info', 'rel_prods', 'getReview'])->where('slug', $slug)->first();
    // }

    // public static function countActiveProduct()
    // {
    //     $data = Product::count();
    //     if ($data) {
    //         return $data;
    //     }
    //     return 0;
    // }

    // /**
    //  * @param $originalPrice
    //  * @return float|int
    //  */
    // private function calculateFinalPrice($originalPrice)
    // {
    //     if (empty(session()->get('userApi'))) {
    //         $currentCustomerId = auth()->user()->id;
    //     } else {
    //         $currentCustomerId = session()->get('userApi');
    //     }
    //     if (empty(session()->get('storeApi'))) {
    //         $helper = new \App\Helpers\Backend\CategoryHelper();
    //         $storeId = $helper->getCurrentStoreIdWithLocale();
    //     } else {
    //         $storeId = session()->get('storeApi');
    //     }
    //     $priceOptionValue = $originalPrice;
    //     $currentUser = User::findOrFail($currentCustomerId);
    //     $customerGroup = $currentUser->customer_group ?? '';
    //     if (empty($customerGroup)) {
    //         return $originalPrice;
    //     }
    //     // always apply customerGroup Price with default store view
    //     $priceOptionValue = $this->calculateWithCustomerGroupPrice($priceOptionValue, $this->id, $customerGroup, CategoryController::DEFAULT_STORE_VIEW, $originalPrice);
    //     return $this->calculateWithCustomerGroupPrice($priceOptionValue, $this->id, $customerGroup, $storeId, $originalPrice);
    // }

    // /**
    //  * @param $priceOptionValue
    //  * @param $productId
    //  * @param $customerGroup
    //  * @param $storeId
    //  * @param $originalPrice
    //  * @return float|int|mixed
    //  */
    // private function calculateWithCustomerGroupPrice($priceOptionValue, $productId, $customerGroup, $storeId, $originalPrice) {
    //     $tierPrice = TierPrice::setStore($storeId)->select(['attr.*'])
    //         ->where('entity_id', $productId)
    //         ->where('customer_group_id', $customerGroup)->first();
    //     if (!empty($tierPrice->value)) {
    //         $priceOptionValue = $tierPrice->value;
    //     } elseif (!empty($tierPrice->percentage_value)) {
    //         $priceOptionValue = ($originalPrice * $tierPrice->percentage_value) / 100;
    //     }
    //     return $priceOptionValue;
    // }

    // /**
    //  * @return float|int|mixed
    //  */
    // public function getPrice()
    // {
    //     $originalPrice = $this->price ?? 0;
    //     if (session()->get('userApi') == ProductHelper::DEFAULT_USER_NOT_LOGIN) {
    //         return $originalPrice;
    //     }

    //     return $this->calculateFinalPrice($originalPrice);
    // }

    // /**
    //  * @return int|mixed
    //  */
    // public function getPriceOriginal()
    // {
    //     return $this->price ?? 0;
    // }

    // /**
    //  * @return bool
    //  */
    // public function hasDiscount()
    // {
    //     return $this->getPrice() != $this->getPriceOriginal();
    // }

    // /**
    //  * @param string $type
    //  * @return string
    //  */
    // public function getPriceHtml($type = \App\Models\Product::PRICE_TYPE_PRODUCT_LIST)
    // {
    //     return view('templates.pricing.price', [
    //         'product' => $this,
    //         'type' => $type
    //     ])->render();
    // }

    // public function carts()
    // {
    //     return $this->hasMany(Cart::class)->whereNotNull('order_id');
    // }

    // public function wishlists()
    // {
    //     return $this->hasMany(Wishlist::class)->whereNotNull('cart_id');
    // }

    // public function brand()
    // {
    //     return $this->hasOne(Brand::class, 'id', 'brand_id');
    // }


    // /**
    //  * @param int $qty
    //  * @throws \Exception
    //  */
    // public function addToCart(int $qty = 1)
    // {
    //     $productId = $this->getAttribute('id');
    //     if (empty(session()->get('userApi'))) {
    //         $userId = auth()->user()->id;
    //     } else {
    //         $userId = session()->get('userApi');
    //     }
    //     $cartItem = Cart::where('user_id', $userId)->where('order_id', null)->where('product_id', $productId)->first();
    //     $finalPriceProduct = $this->getPrice();
    //     if ($cartItem) {
    //         $cartItem->quantity = $cartItem->quantity + $qty;
    //         $cartItem->amount = $finalPriceProduct + $cartItem->amount;
    //         if ($cartItem->product->stock < $cartItem->quantity || $cartItem->product->stock <= 0) {
    //             throw new \Exception(__('Stock not sufficient!'));
    //         }
    //         $cartItem->save();

    //     } else {
    //         $cartItem = new Cart;
    //         $cartItem->user_id = $userId;
    //         $cartItem->product_id = $this->id;
    //         $cartItem->price = $finalPriceProduct;
    //         $cartItem->quantity = $qty;
    //         $cartItem->amount = $cartItem->price * $cartItem->quantity;
    //         if ($cartItem->product->stock < $cartItem->quantity || $cartItem->product->stock <= 0) {
    //             throw new \Exception(__('Stock not sufficient!'));
    //         }
    //         $cartItem->save();
    //          Wishlist::where('user_id', $userId)->where('cart_id', null)->update(['cart_id' => $cartItem->id]);
    //     }
    // }
}
