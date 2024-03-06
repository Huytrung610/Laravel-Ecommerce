<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Brand extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    use HasFactory;
    protected $fillable = ['name','slug','summary','logo_brand','category_id','status'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

}
