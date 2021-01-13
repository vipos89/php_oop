<?php

namespace App\Controllers;

use App\core\BaseController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Router;

class CatalogController extends BaseController
{

    public function index()
    {
        $categories = Category::getAll();
        $brands = Brand::getAll();
        $products = Product::selectWithConditions([
            'limit' => [
                'limit' => 10
            ]
        ]);

        return $this->render('catalog.catalog', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products
        ]);
    }
    public function showCategory()
    {
        $params = Router::getRouteArgs();
        $categories = Category::getAll();
        $category = Category::selectWithConditions(
                [
                    'where' => [
                        ['alias', $params[0]]
                    ]
                ]
            )[0] ?? null;
        if (!$category) {
            return $this->render('home.404', [], 404);
        }
        $products = Product::selectWithConditions([
            'where' => [
                ['category_id', $category->id]
            ],
            'order' => [
                'field' => 'id',
                'way' => 'desc'
            ],
        ]);

        return $this->render('catalog.category', compact('categories','category', 'products'));
    }

    public function showProduct()
    {
        $params = Router::getRouteArgs();
        $category = Category::selectWithConditions(
                [
                    'where' => [
                        ['alias', $params[0]]
                    ]
                ]
            )[0] ?? null;
        if (!$category) {
            return $this->render('home.404', [], 404);
        }
        $product = Product::selectWithConditions([
            'where' => [
                ['category_id', $category->id],
                ['alias', $params[1]]
            ]
        ])[0];
        if (!$product) {
            return $this->render('home.404', [], 404);
        }

        return $this->render('catalog.product', [
            'product' => $product
        ]);

    }
}