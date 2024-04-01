<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeValue;

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
            $data['name'] = $request->get('name');
            $attributes = Attribute::create($data);
            request()->session()->flash('success', __('Attribute successfully added'));
        }
        catch (\Exception $exception) {
            request()->session()->flash('error', __($exception->getMessage()));
            redirect()->route('brand.create');
        }
        return redirect()->route('attribute.index')->with('attributes', $attributes);
    }

    public function edit($id)
    {
        $attribute = Attribute::with('attributeValues')->find($id);
        return view('backend.attribute.edit')->with('attribute',$attribute);
       
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $attribute = Attribute::findOrFail($id);
        $attribute->name = $request->input('name');
        $attribute->save();

        // Get IDs of existing attribute values
        $existingValueIds = $attribute->attributeValues->pluck('id')->toArray();

        // Update or create attribute values
        $attributeValues = $request->input('attribute_values', []);

        foreach ($attributeValues as $value) {
            // Update existing values or create new ones
            $attribute->attributeValues()->updateOrCreate(
                ['id' => array_shift($existingValueIds)], // Use the ID for update
                ['value' => $value]
            );
        }

        // Delete any remaining values that were not updated or created
        $attribute->attributeValues()->whereIn('id', $existingValueIds)->delete();

        return redirect()->route('attribute.edit', ['attribute' => $id]);
    }
    public function getAttributes()
    {
        $attributes = Attribute::all();
        return response()->json($attributes);
    }

    public function getAttributeValues(Request $request)
    {
        $data = $request->all();
        $attributeId = $request->get('attributeId');
        $attributeValues = AttributeValue::where('attribute_id', $attributeId)->get();
        return response()->json($attributeValues);
    }
    
    public function destroy($id)
    { 
        $flash = array(
            'status' => 'success',
            'message' => 'Attribute Successfully deleted'
        );

        try {
            $attribute = Attribute::where('id', $id)->firstOrFail();

            if (isset($attribute)) {
                $attribute->delete();
            }
            else
            {
                $flash['status'] = 'error';
                $flash['message'] = 'Product SKU not found';

                return redirect()->back()->with($flash['status'], $flash['message']);
            }
        } catch (\Exception $e) {
            $flash['status']  = 'error';
            $flash['message'] = $e->getMessage();
        }

        return redirect()->back()->with($flash['status'], $flash['message']);
    }
       

    public function prepareAttributeDataModel($attributeModel, $data) {
        $attributeModel->sku    = $data['attribute_sku'];
        $attributeModel->color  = $data['attribute_color'] ?? '';
        $attributeModel->price  = $data['attribute_price'] ?? '';
        $attributeModel->stock  = $data['attribute_stock'] ?? null;
        $attributeModel->product_id = $data['product_id'] ?? null;
        $attributeModel->photo =  $data['attribute-photo'];

        $attributeModel->save();
    }
}
