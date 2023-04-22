<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeValue;
use DB;

class AttributeValueController extends Controller
{
    public function index(Request $request)
    {
        $attributeValues =  DB::table('attributes')->join('attribute_values', 'attributes.id', '=', 'attribute_values.attribute_id')->get();
        return view('backend.attribute_value.index')->with('attributeValues', $attributeValues);
    }

    public function create()
    {
        $attributes = Attribute::orderBy('id','ASC')->get();
        $attributeValues = AttributeValue::all();
        return view('backend.attribute_value.create')->with('attributes', $attributes)->with('attributeValues', $attributeValues);
    }
    
    
    public function store(Request $request)
    {
        $attributes = Attribute::orderBy('id','ASC')->get();
        $attributeValueSave = '';
        try {
            $data['attribute_id'] = $request->get('attribute');
            $data['value'] = $request->get('value');
            $attributeValueSave = AttributeValue::create($data);
            request()->session()->flash('success', __('Attribute successfully added'));
        }catch (\Exception $exception) {
            request()->session()->flash('error', __($exception->getMessage()));
            redirect()->route('attribute_value.create');
        }
        return redirect()->route('attribute_value.index');
    }

    public function edit(Request $request, $id)
    {
        $attributeValue =  AttributeValue::findOrFail($id);
        return view('backend.attribute_value.edit')->with('attributeValue', $attributeValue);
    }

    public function update(Request $request, $id)
    {
        try {
            $attributeValue =  AttributeValue::findOrFail($id);;
            $data['value'] = $request->get('value');
            $attributeValue->update($data);

            request()->session()->flash('success', __('Attribute value successfully updated'));
        }catch (\Exception $exception) {
            request()->session()->flash('error', __($exception->getMessage()));
        }
        $backUrl = route('attribute_value.edit', $id);
        return redirect($backUrl);
    }



    public function destroy($id)
    {
        $attributeValue = AttributeValue::findOrFail($id);
        $status = $attributeValue->delete();

        if ($status) {
            request()->session()->flash('success', __('Attribute successfully deleted'));
        } else {
            request()->session()->flash('error', __('Error while deleting category'));
        }
        return redirect()->route('attribute_value.index');
    }

}
