<?php


namespace App\Models;


use App\core\Model;

class Product extends Model
{
    protected static $fillable = ['name', 'category_id', 'brand_id'];

}