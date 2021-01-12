<?php


namespace App\Models;


use App\core\Model;

class Currency extends Model
{
    protected static $tableName = 'currencies';
    protected static $fillable = ['Cur_ID', 'Cur_Abbreviation', 'Cur_Scale', 'Cur_Name', 'Cur_OfficialRate'];
}