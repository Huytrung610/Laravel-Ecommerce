<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attribute;

class AttributeValue extends Model
{
    protected $table = 'attribute_values';

    use HasFactory;

    protected $fillable = [
        'product_id',
        'attribute_id',
        'value'
    ];

    public function value()
    {
        return $this->belongsTo('App\Post','attribute_id');
    }

}
