<?php


namespace App\Helpers;


class Debugger
{
    public static function debug($var)
    {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }
}