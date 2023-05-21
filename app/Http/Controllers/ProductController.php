<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Http\Controllers\CategoryController;
use App\Helpers\Backend\ProductHelper;
use Illuminate\Support\Str;
use App\Models\ProductAttribute;
use App\Repositories\ProductRepository;

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
        return view('backend.product.create')->with('categories', $category);
    }

    public function store(Request $request)
    {
        $productSave = '';
        try {
            $productHelper = new ProductHelper();
            // $this->validateDataRequest($this, $request);
            $data = $request->all();
            $slug = Str::slug($request->title);
            $count = Product::where('slug', $slug)->count();
            if ($count > 0) {
                $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
            }
            $data['slug'] = $slug;
            $data['category_id'] = $request->get('sub_category_id');
            $data['photo'] = $request->get('photo') ;
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
        $category = Category::all();
        $attributes = Attribute::where('product_id', $id)->get();
        
        $product = Product::where('id', $id)->first();
        if (!isset($product->id)){
            return Redirect::back()->with('error','This product has been existed');
        }
        if ($product->getAttribute('deleted_at') != null) {
            return Redirect::back()->with('error','This product has been deleted');
        } else {

            return view('backend.product.edit')->with('product', $product)
                ->with('categories', $category)->with('attributes',$attributes);
        }
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
            $attributes = Attribute::all();

            $productHelper = new ProductHelper();
            $product = Product::findOrFail($id);
            // $this->validateDataRequest($this, $request);
            $data = $request->all();
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


    public function productDetail($slug)
    {   

        // Xử lý yêu cầu Ajax
        if(request()->ajax()) {
            $color = request()->input('color');
            $sku = request()->input('sku'); // Lấy SKU từ yêu cầu Ajax
            $attribute = Attribute::where('color', $color)->where('sku',$sku )
            ->first();
        // Xử lý logic để lấy dữ liệu price và stock dựa trên SKU

        // Trả về response dưới dạng JSON
        return response()->json([
            'price' => $attribute->price,
            'stock' => $attribute->stock
        ]);
    }
        $productRepository = new ProductRepository();
        $productDetail = $productRepository->getProductWithSlug($slug);

        if (!empty($productDetail) && $productDetail->status != Product::IS_ACTIVE || empty($productDetail)) {
            abort(404);
        }

        return view('frontend.pages.product_detail')->with('productDetail', $productDetail);
    }


   
}


