<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
*class Product_category
*@property int $id 
*@property varchar $name 
*@property int $parent_id
*@property timestamp $created_at 
*@property timestamp $updated_at
*/   
class ProductCartegory extends Model
{
    use HasFactory;
    protected $table = 'product_cartegories';

    protected $fillable = [
        'name',
        'parent_id',
    ];
}
