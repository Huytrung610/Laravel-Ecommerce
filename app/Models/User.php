<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_TYPE_ADMIN = 'admin';
    const ROLE_TYPE_USER = 'user';
    const ROLE = [
        self::ROLE_TYPE_ADMIN => 'Admin',
        self::ROLE_TYPE_USER => 'User'
    ];
    const GENDER_MALE = 'Male';
    const GENDER_FEMALE = 'Female';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'photo',
        'status',
        'fcm_token',
        'user_id'
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAddress()
    {
        return $this->hasMany('App\Models\CustomerAddress', 'user_id', 'id')
            ->orderBy('is_default', 'DESC')
            ->get();
    }

    public function getAddressDefault()
    {
        $defaultAddress = $this->hasOne('App\Models\CustomerAddress', 'user_id', 'id')
            ->where('is_default', CustomerAddress::DEFAULT)
            ->first();
        if (!$defaultAddress) {
            $defaultAddress = $this->getAddress()->first();
        }

        return $defaultAddress;
    }

    public static function totalCustomers(){
        return self::where('role', 'user')->count();
    }
}
