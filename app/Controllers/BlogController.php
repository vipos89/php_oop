<?php

namespace App\Controllers;

use App\core\BaseController;
use App\Helpers\Debugger;
use App\Router;

class BlogController extends BaseController
{
    public function index(){
        echo 'Blog controller';
    }

    public function show()
    {
        $arguments = Router::getRouteArgs();
        // sql ....
        $person  = [
            'id'=>1,
            'name' => 'Igor',
            'lastName' => 'Alekseychuk'
        ];
        $this->render('blog.category', [
            'man' => $person,
            'id' => 123
        ]);

    }

    public function showPage()
    {
        Debugger::debug(Router::getRouteArgs());
        echo "<h1>News page</h1>";
    }
}