<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $primarykey  = 'parent_id';

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'status',
        'parent_id'
    ];
}
