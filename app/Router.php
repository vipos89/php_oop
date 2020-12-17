<?php


namespace App;


use App\Controllers\BlogController;
use App\Controllers\CatalogController;
use App\Controllers\HomeController;

class Router
{
    public function getRoute()
    {

        if ($_SERVER['REQUEST_URI'] == '/') {
            $controller = new HomeController();
            $controller->index();

        } elseif ($_SERVER['REQUEST_URI'] == '/catalog') {
            $controller = new CatalogController();
            $controller->index();

        } elseif ($_SERVER['REQUEST_URI'] == '/blog') {
            $controller = new BlogController();
            $controller->index();
        }
        elseif ($_SERVER['REQUEST_URI'] == '/blog/234234') {
            $controller = new BlogController();
            $controller->show(234234);
        }
    }
}