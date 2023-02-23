<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
*class Product (
*@property int $id
*@property varchar $sku 
*@property varchar $name 
*@property int $stock
*@property varchar $avata
*@property date $expired_at 
*@property int $category_id 
*@property tinyint $flag_delete 
*@property timestamp &created_at 
*@property timestamp $updated_at 
*/
class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $dates = ['expired_at'];
    protected $fillable = [
        'name',
        'stock',
        'expired_at',
        'sku',
        'category_id',
        'avatar'
    ];
}
