<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $table = 'general_setting';
    protected $fillable=['url_instagram','url_facebook','logo_path','contact_address','contact_phone','email'];
}
