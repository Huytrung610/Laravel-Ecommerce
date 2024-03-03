<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterSubcriber extends Model {
    use HasFactory;

    const STATUS_ACTIVE = '1';
    const STATUS_INACTIVE = '0';

    protected $fillable=['email_subcriber', 'status'];
    public static function getAllSubcriber(){
        return NewsletterSubcriber::orderBy('id','DESC')->get();
    }

}