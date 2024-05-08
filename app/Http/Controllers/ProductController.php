<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\AttributeValue;
use App\Models\ProductVariant;
use App\Http\Controllers\CategoryController;
use App\Helpers\Backend\ProductHelper;
use Illuminate\Support\Str;
use App\Repositories\ProductRepository;
use DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();
        return view('backend.product.index',compact('products') );
    }

    public function create()
    {
        $category = Category::get();
        $brands = Brand::get();
        $childCategories = Category::getSubCategory(); 
        $parentCategories = Category::getParentCategories();
        return view('backend.product.create')->with('categories', $category)->with('brands', $brands)->with('childCategories', $childCategories)->with('parentCategories', $parentCategories);
    }

    public function store(Request $request)
    {
        $productSave = '';
        try {
            $productHelper = new ProductHelper();
            $this->validateDataRequest($this, $request);
            $data = $request->all();
            $slug = Str::slug($request->title);
            $count = Product::where('slug', $slug)->count();
            if ($count > 0) {
                $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
            }
            $data['slug'] = $slug;
            $data['code'] = $request->get('product_code');
            $data['category_id'] = $request->get('category_id');
            $data['brand_id'] = $request->get('brand_id');
            $data['photo'] = $request->get('photo');
           
            $data['album'] = $request->get('album') ?? '';
            $data['discount'] = 20;
            $productSave = Product::create($data);
            request()->session()->flash('success', __('Product Successfully added'));
        } catch (\Exception $exception) {
            request()->session()->flash('error', $exception->getMessage());
            return redirect()->route('product.create');
        }
        return redirect()->route('product.index');

    }

    private function validateDataRequest($subject, $request)
    {
        $helper = new \App\Helpers\Backend\ProductHelper();
        $helper->validateDataRequest($subject, $request);
    }

    public function edit(Request $request, $id)
    {
        $helper = new \App\Helpers\Backend\ProductHelper();

        $product = Product::findOrFail($id);
        $childCategories = Category::getSubCategory(); 

        $attributes = Attribute::all();

        $selectedVariants = $product->attribute;
        $variants = AttributeValue::all();

        $productVariants = $helper->getVariantByProduct($product->id);

        $productVariantsCount = ProductVariant::where('product_id', $id)->count();

        $parentCategories = Category::getParentCategories();
        $selectedCategory = $product->getAttribute('category_id'); 
        $attributeCatalougue = $helper->getAllAttributes();
        $selectedCategory = $selectedCategory ? [$selectedCategory] : [];
        $brands = Brand::get();

        if ($product->category && $product->category->count() > 0) {
            $selectedCategory = [$product->category->id];
        }

        if (!isset($product->id)) {
            return Redirect::back()->with('error', 'This product has been existed');
        }

        if ($product->getAttribute('deleted_at') != null) {
            return Redirect::back()->with('error', 'This product has been deleted');
        }

        return view('backend.product.edit')->with('product', $product)
            ->with('brands', $brands)
            ->with('childCategories', $childCategories)
            ->with('selectedCategory', $selectedCategory)
            ->with('parentCategories', $parentCategories)
            ->with('attributeCatalougue', $attributeCatalougue)
            ->with('productVariants', $productVariants)
            ->with('attributes', $attributes)
            ->with('productVariantsCount', $productVariantsCount)
            ->with('selectedVariants', $selectedVariants)
            ->with('variants', $variants);
    }

    public function productCat(Request $request)
    {
        $productRepository = new ProductRepository();
        $products = $productRepository->getAllProductWithSlugOfCategory($request->slug) ?? [];

        return view('frontend.pages.product-lists')
            ->with([
                'products' => $products,
            ]);
    }


    public function update(Request $request, $id)
    {
        try {

            $productHelper = new ProductHelper();
            $product = Product::findOrFail($id);
            // $this->validateDataRequest($this, $request);
            $data = $request->all();
            $product['code'] = $data['product_code'];
            if (isset($data['album'])) {
                $albumString = implode(',', $data['album']);
                $data['album'] = $albumString;
            }
            $product->update($data);
            request()->session()->flash('success', __('Product Successfully updated'));
        } catch (\Exception $exception) {
            request()->session()->flash('error', $exception->getMessage());
        }
        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $status = $product->delete();

        if ($status) {
            request()->session()->flash('success', __('Product successfully deleted'));
        } else {
            request()->session()->flash('error', __('Error while deleting product'));
        }
        return redirect()->route('product.index');
    }

    public function getAllProductByCategory(Request $request, $slug){
        $category = Category::where('slug', $slug)->firstOrFail();
        $categoryId = $category->id;
        $productList = Product::where('category_id', $categoryId)->get();
        
        return view('frontend.pages.product-lists')
        ->with('category', $category)
        ->with('productList', $productList);
    }

    public function getProductList(Request $request)
    {
        $helper = new \App\Helpers\Backend\ProductHelper();
        $categoryId = $request->input('category_id');
        $slug = $request->input('slug');
    
        $category = Category::where('id', $categoryId)->first();
    
        if ($category) {
            $products = $category->products()->get();
            $productList = [];
            foreach ($products as $product) {
                $minPrice =$helper->formatPrice($product->attributes()->min('price'));
                $maxPrice = $helper->formatPrice($product->attributes()->max('price'));
    
                $productList[] = [
                    'url' => route('product-detail', $product->slug),
                    'photo' => $product->photo,
                    'title' => $product->title,
                    'price' =>  $minPrice . ' - ' . $maxPrice
                ];
            }
    
            return response()->json($productList);
        } else {
            abort(404);
        }
    }

    public function searchProducts(Request $request)
    {
        $searchValue = $request->input('search');
        $helper = new \App\Helpers\Backend\ProductHelper();
        
        if ($searchValue) {
            $products = Product::where('title', 'like', '%' . $searchValue . '%')->get();
        } else {
            $products = Product::all();
        }
        
        $productList = [];
        
        foreach ($products as $product) {
            $minPrice = $helper->formatPrice($product->attributes()->min('price'));
            $maxPrice = $helper->formatPrice($product->attributes()->max('price'));

            $productList[] = [
                'url' => route('product-detail', $product->slug),
                'photo' => $product->photo,
                'title' => $product->title,
                'price' =>  $minPrice . ' - ' . $maxPrice
            ];
        }

        return response()->json($productList);
    }

    public function updateHasVariants(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            if ($request->has('has_variants')) {
                $product->has_variants = $request->input('has_variants');
                $product->save();

                return response()->json(['message' => 'Product variants updated successfully']);
            }
            return response()->json(['error' => 'Missing has_variants parameter'], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createVariant(Request $request, $id) {
        try {
            DB::beginTransaction();
        
            $product = Product::findOrFail($id);
            $productHelper = new ProductHelper();
            $data = $request->all();
            $variants = $productHelper->createVariantArray($data, $product->id);
            
            $product->product_variants()->delete();
            
            $variantsData = [];
            $codes = array_map(function($variant) {
                return explode(', ', $variant['code']);
            }, $variants);
            
            foreach ($variants as $variant) {
                $newVariant = $product->product_variants()->create($variant);
                $variantsData[] = $newVariant->toArray();   
            }
            DB::commit();
            $productHelper->updateAttributeCatalogue($product->id, $data['attribute'], $data['attributeArray'] );
            $attributeIds = array_map('intval', explode(',', $data['attribute']));
            $productHelper->combineVariants($variantsData, $attributeIds);
    
            return response()->json(['message' => 'Variants updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    public function productDetail($slug)
    {    
        $helper = new \App\Helpers\Backend\ProductHelper();
  
        $productRepository = new ProductRepository();
        $productDetail = $productRepository->getProductWithSlug($slug);
        if($productDetail->has_variants){
            $productDetail->attributes = $helper->getAttribute($productDetail);
        }
        if (!empty($productDetail) && $productDetail->status != Product::IS_ACTIVE || empty($productDetail)) {
            abort(404);
        }
        return view('frontend.pages.product_detail')->with('productDetail', $productDetail);
    }


    public function loadVariant(Request $request) {
        $get = $request->input();
        $attributeId = $request->input('attribute_id');
        sort($attributeId, SORT_NUMERIC);
        $attributeId = implode(',', $attributeId);
        $variant = ProductVariant::findVariant($attributeId, $request->input('product_id') );
        return response()->json([ 
            'variant' => $variant
        ]);
    }

}


