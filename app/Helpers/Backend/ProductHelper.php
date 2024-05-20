<?php

namespace App\Helpers\Backend;

use App\Http\Controllers\CategoryController;
use App\Models\CustomerGroup;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\TierPrice;
use App\Repositories\ProductRepository;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


class ProductHelper
{

    public function getCurrentSubParentCategoryStoreView($product)
    {
        $productRepository = new \App\Repositories\ProductRepository();
        return $productRepository->getSubParentCategoryLevel($product);
    }

    public function validateDataRequest($subject, $request)
    {

        $subject->validate($request, [
            'title' => 'string|required',
            'product_code' => 'string|required|unique:products,code',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'price' => 'required|numeric',
        ]);
    }

    public function convertSlugToTitle($slug){
        $title = str_replace('-', ' ', $slug); 
        $title = ucwords($title); 
        return $title;
    }


    public function formatPrice($productPrice){
       return number_format($productPrice, 0, ',', '.');
    }

    public function getAllAttributes(){
        $attributes = Attribute::get ();
        return $attributes;
    }
    public function combineVariants(array $variantsData, $attributeIds): void
    {
        foreach ($variantsData as $variant) {
            $productVariantObject = ProductVariant::find($variant['id']);
            $productVariantObject->attributes()->sync($attributeIds);
        }
    }

    
    public function updateAttributeCatalogue(int $productId, $attributeIds, $attributeArray): void
    {
        $product = Product::findOrFail($productId);
        
        $attributeIds = explode(',', $attributeIds);
        $attributeIds = array_map('trim', $attributeIds);
        
        $product->attribute_catalogue = json_encode($attributeIds);
        $product->attribute = json_encode($attributeArray);
        $product->save();
    }


    public function sortVariantId(string $productVariantId = '') {
        $extract = explode(',', $productVariantId);
        $extract = array_map('trim', $extract);
        sort($extract, SORT_NUMERIC);
        $newArray = implode(',', $extract);
        return $newArray;
    }
    public function createVariantArray(array $data = [], $product_id): array {
        $variants = [];
        foreach ($data['variants'] as $value) {
            if (isset($value['sku'])) {
                $vId = $value['code'] ?? null;
                $productVariantId = $this->sortVariantId($vId);
                $variant = [
                    'product_id' => $product_id, 
                    'code' => $productVariantId ?? null,
                    'quantity' => $value['quantity'] ?? '0',
                    'name' => str_replace(', ', ' ', $value['name']),
                    'sku' => $value['sku'],
                    'price' => $value['price'] ?? null,
                    'slug' => $value['slug'] ?? null,
                    'image' => $value['album'] ?? null,
                ];
                $variants[] = $variant;
            }
        }
        return $variants;
    }

   
    public static function getValueByAttribute($attributeId) {
        return AttributeValue::where('attribute_id', $attributeId)->get();
    }

    public function getVariantByProduct($productId){
        return ProductVariant::where('product_id', $productId)->get();
    }
    public function getAttribute($productDetail)
    {
        $attributes = [];
        $attributeData = '';
        if ($productDetail && isset($productDetail->attribute)) {
            $attributeData = json_decode($productDetail->attribute, true);
        }
        
        $attributeIds = array_keys($attributeData) ?? '';
        $attributeValueIds = collect($attributeData)->flatten()->unique()->values();

        $attributesList = Attribute::whereIn('id', $attributeIds)->get()->toArray();

        $attributeValuesList = AttributeValue::whereIn('id', $attributeValueIds)->get()->groupBy('attribute_id');

        foreach ($attributeData as $attributeId => $attributeValueIds) {
            $attributeName = '';
            foreach ($attributesList as $attribute) {
                if ($attribute['id'] == $attributeId) {
                    $attributeName = $attribute['name'];
                    break;
                }
            }

            $attributeValues = [];
            foreach ($attributeValueIds as $valueId) {
                if (isset($attributeValuesList[$attributeId])) {
                    foreach ($attributeValuesList[$attributeId] as $value) {
                        if ($value['id'] == $valueId) {
                            $attributeValues[] = $value;
                            break;
                        }
                    }
                }
            }

            $attributes[] = [
                'name' => $attributeName,
                'values' => $attributeValues,
            ];
        }

        return $attributes;
    }
}
