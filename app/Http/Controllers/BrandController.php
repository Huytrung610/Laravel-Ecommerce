<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
class BrandController extends Controller
{

    const RULE_VALIDATE_COMMON = [
        'name' => 'string|required',
        'photo' => 'string|nullable',
        'status' => 'required',
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('id','ASC')->get();
        return view('backend.brand.index')->with('brands', $brands);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::orderBy('id','ASC')->get();
        $categories = Category::orderBy('id','ASC')->get();
        
        return view('backend.brand.create')->with('brands', $brands)->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $brands = Brand::orderBy('id','ASC')->get();
        $brandSave = '';
        try {
            $slugRequest = $request->get('title');
            $validateSlug = [];
            if (!empty($request->get('slug'))) {
                $validateSlug = ['slug' => 'unique:brands,slug'];
                $slugRequest = $request->get('slug');
            }
            $slug = Str::slug($slugRequest);
            $request['slug'] = $slug;
            $this->validate($request, array_merge(self::RULE_VALIDATE_COMMON, $validateSlug));
            $data = $request->all();
            $data['slug'] = $slug;
            $data['status'] = $request->get('status');
            $data['name'] = $request->get('name');
            $data['logo'] = $request->get('logo_brand');
            $brand = Brand::create($data);
            $categoryIds = $request->get('category', []);
            $brand->categories()->attach($categoryIds);
            request()->session()->flash('success', __('Brand successfully added'));
        }
        catch (\Exception $exception) {
            request()->session()->flash('error', __($exception->getMessage()));
            redirect()->route('brand.create');
        }
        return redirect()->route('brand.index')->with('brands', $brands);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $categories = Category::all();
        $selectedCategories = $brand->categories->pluck('id')->toArray();
        return view('backend.brand.edit')
        ->with('brand', $brand)
        ->with('categories', $categories)
        ->with('selectedCategories', $selectedCategories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $brand = Brand::findOrFail($id);
            $this->validateDataCategoryFormEdit($request, $brand);
            $data = $request->all();
            $brand->update($data);
            $selectedCategories = $request->input('category', []);
            $brand->categories()->sync($selectedCategories);

            request()->session()->flash('success', __('Brand successfully updated'));
        }catch (\Exception $exception) {
            request()->session()->flash('error', __($exception->getMessage()));
        }
        return redirect()->route('brand.index');
    }
    private function validateDataCategoryFormEdit($request, $brand) {
        $newSlugRequest = $request->get('slug');
        $slug = Str::slug($newSlugRequest);
        $brandId = $brand->getAttribute('id');

        $validateSlug = ['slug' => [
            'required',
            Rule::unique('brands')
                ->ignore($brandId)
                ->where(function ($query) use ($request, $brand) {
                    $query->where('slug' , $request->get('slug')
            );
            return $query;
        })]];

        $request['slug'] = $slug;
        $this->validate($request, array_merge(self::RULE_VALIDATE_COMMON, $validateSlug));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);

        $status = $brand->delete();

        if($status){
            request()->session()->flash('success','Brand successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting Brand ');
        }
        return redirect()->route('brand.index');
    }
}
