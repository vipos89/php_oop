<?php


namespace App\Controllers;


use App\core\BaseController;
use App\Helpers\Debugger;
use App\Models\Product;
use App\Models\User;

class HomeController extends BaseController
{
    public function index()
    {
        $user = User::findById(1);

        $product = Product::create([
            'name' => 'Product1',
            'category_id' => 1,
            'brand_id' => 1
        ]);

        $product->name = 'Product 2';
        $product->save();
        $prod2 = new Product();

        $prod2->save();

//        $this->render('home.main', [
//            'user' => $user,
//            'product' =>$product
//        ]);
    }
}