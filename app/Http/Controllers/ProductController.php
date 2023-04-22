<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\CategoryController;
use App\Helpers\Backend\ProductHelper;
use Illuminate\Support\Str;

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
            $this->validateDataRequest($this, $request);
            $data = $request->all();
            $slug = Str::slug($request->title);
            $count = Product::where('slug', $slug)->count();
            if ($count > 0) {
                $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
            }
            $data['slug'] = $slug;
            $data['category_id'] = $request->get('sub_category_id');
            $data['photo'] = "txt";
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
        $product = Product::where('id', $id)->first();
        if (!isset($product->id)){
            return Redirect::back()->with('error','This product has been existed');
        }
        if ($product->getAttribute('deleted_at') != null) {
            return Redirect::back()->with('error','This product has been deleted');
        } else {

            return view('backend.product.edit')->with('product', $product)
                ->with('categories', $category);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $productHelper = new ProductHelper();
            $product = Product::findOrFail($id);
            $this->validateDataRequest($this, $request);
            $data = $request->all();
            $product->update($data);

            request()->session()->flash('success', __('Product Successfully updated'));
        } catch (\Exception $exception) {
            request()->session()->flash('error', $exception->getMessage());
        }
        $backUrl = route('product.edit', $id);

        return redirect($backUrl);
    }

}
