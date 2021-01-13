<?php

namespace App;


use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\ProductController;
use App\Controllers\BlogController;
use App\Controllers\CartController;
use App\Controllers\CatalogController;
use App\Controllers\HomeController;


class Router
{

    private static $routes = [
        '/' => HomeController::class . '@index',
        '/blog/(\w+)' => BlogController::class . '@show',
        '/blog/(\w+)/(\w+)' => BlogController::class . '@showPage',
        '/catalog/(\w+)/(\w+)' => CatalogController::class . '@showProduct',
        '/catalog/(\w+)' => CatalogController::class . '@showCategory',
        '/catalog' => CatalogController::class . '@index',
        '/cart/add' => CartController::class . '@addToCart',
        '/cart' => CartController::class . '@index',

        // crud
        '/admin/category' => CategoryController::class . '@index',
        '/admin/category/show/(\w+)' => CategoryController::class . '@show',
        '/admin/category/add' => CategoryController::class . '@add',
        '/admin/category/save' => CategoryController::class . '@save',
        '/admin/category/edit/(\w+)' => CategoryController::class . '@edit',
        '/admin/category/delete/(\w+)' => CategoryController::class . '@delete',

        '/admin/product' => ProductController::class . '@index',
        '/admin/product/show/(\w+)' => ProductController::class . '@show',
        '/admin/product/add' => ProductController::class . '@add',
        '/admin/product/save' => ProductController::class . '@save',
        '/admin/product/edit/(\w+)' => ProductController::class . '@edit',
        '/admin/product/delete/(\w+)' => ProductController::class . '@delete',

        // '/catalog/(\d+)' => BlogController::class.'@index',
    ];

    private static $routeArgs = [];

    public function getRoute()
    {
        $url = explode('?', $_SERVER['REQUEST_URI']);
        $url = $url[0];
        $controller = null;
        foreach (self::$routes as $pattern => $callback) {
            $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
            preg_match($pattern, $url, $params);
            if ($params) {
                $routeParams = explode('@', $callback);
                $controller = new $routeParams[0];
                array_shift($params);
                self::$routeArgs = $params;

                $controller->{$routeParams[1]}($params);
                break;
            }
        }
    }

    public static function getRouteArgs()
    {
        return self::$routeArgs;
    }
}