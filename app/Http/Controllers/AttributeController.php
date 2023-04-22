<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeController extends Controller
{
    public function index(Request $request)
    { 
        $attributes = Attribute::orderBy('id','ASC')->get();
        return view('backend.attribute.index')->with('attributes', $attributes);
    }
    

    public function create()
    {
        $attributes = Attribute::all();
        return view('backend.attribute.create')->with('attributes', $attributes);
    }
    public function store(Request $request)
    {
        $attributes = Attribute::orderBy('id','ASC')->get();
        $attributeSave = '';
        try {
            $data = $request->all();
            $attributeSave = Attribute::create($data);
            request()->session()->flash('success', __('Attribute successfully added'));
        }catch (\Exception $exception) {
            request()->session()->flash('error', __($exception->getMessage()));
            redirect()->route('attribute.create');
        }
        return redirect()->route('attribute.index');
    }

    public function edit(Request $request, $id)
    {
        $attribute = Attribute::findOrFail($id);
        return view('backend.attribute.edit')->with('attribute', $attribute);
       
    }

    public function update(Request $request, $id)
    {
        try {
            $attribute = Attribute::findOrFail($id);
            $data = $request->all();
            $attribute->update($data);

            request()->session()->flash('success', __('Attribute successfully updated'));
        }catch (\Exception $exception) {
            request()->session()->flash('error', __($exception->getMessage()));
        }
        $backUrl = route('attribute.edit', $id);
        return redirect($backUrl);
    }
   
    
    public function destroy($id)
    {
        $attribute = Attribute::findOrFail($id);
        // $childCatId = Category::where(self::ATTRIBUTE_IS_PARENT, $id)->pluck('id');
        $status = $attribute->delete();

        if ($status) {
            request()->session()->flash('success', __('Attribute successfully deleted'));
        } else {
            request()->session()->flash('error', __('Error while deleting category'));
        }
        return redirect()->route('attribute.index');
    }
       
    



}
