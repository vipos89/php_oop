<?php

namespace App\Controllers;

class BlogController
{
    public function index(){
        echo 'Blog controller';
    }

    public function show($id)
    {
        // MOdel

        //render html
        echo "<h1>News page</h1>";
    }
}