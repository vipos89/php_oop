<?php

namespace App;


use App\Controllers\Admin\CategoryController;
use App\Controllers\BlogController;
use App\Controllers\HomeController;

class Router
{

    private static $routes = [
        '/' => HomeController::class . '@index',
        '/blog/(\w+)' => BlogController::class . '@show',
        '/blog/(\w+)/(\w+)' => BlogController::class . '@showPage',
        '/admin/category' => CategoryController::class . '@index',
        '/admin/category/show/(\w+)' => CategoryController::class . '@show',
        '/admin/category/add' => CategoryController::class . '@add',
        '/admin/category/save' => CategoryController::class . '@save',
        '/admin/category/edit/(\w+)' => CategoryController::class . '@edit',
        '/admin/category/delete/(\w+)' => CategoryController::class . '@delete',
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