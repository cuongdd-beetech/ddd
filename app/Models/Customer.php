<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $guard ='customers';
    protected $table ='customers';
    protected $primarykey ='id';
    protected $fillable = [
        'id',
        'email',
        'password',
        'phone',
        'birthday',
        'province_id',
        'district_id',
        'commune_id',
    ];

    protected $hidden = [
        'password',
        'reset_password',
        'flag_delete',
        'update_at',
        'created_at'
    ];

}