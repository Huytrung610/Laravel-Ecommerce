<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsContent extends Model
{
    use HasFactory;
    protected $table = 'cms_content';
    protected $fillable=['title','slug','content'];


    public static function getAllCmsPage(){
        return CmsContent::orderBy('id','DESC')->get();
    }
}
