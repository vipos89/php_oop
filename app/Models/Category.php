<?php


namespace App\Models;


use App\core\Model;

class Category extends Model
{
    protected static $tableName = 'product_categories';

    protected static $fillable = ['name'];



}