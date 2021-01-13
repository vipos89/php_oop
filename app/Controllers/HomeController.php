<?php


namespace App\Controllers;


use App\core\BaseController;
use App\Helpers\Debugger;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class HomeController extends BaseController
{
    public function index()
    {
        $products = Product::selectWithConditions([
            'order' => [
                'field' => 'id',
                'way' => 'desc'
            ],
            'limit' => [
                'limit' => 10
            ]
        ]);
        $categories = Category::getAll();
        $categories_ids = array_column($categories, 'id');
        $categories = array_combine($categories_ids, $categories);
        $brands = Brand::getAll();
        $brands_ids = array_column($brands, 'id');
        $brands = array_combine($brands_ids, $brands);
        $this->render('home.main', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }
}