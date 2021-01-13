<?php


namespace App\Controllers;


use App\core\BaseController;
use App\Models\Product;

class CartController extends BaseController
{
    public function index()
    {
        $cart = $_SESSION['cart'] ?? [];
        $products = [];
        if ($cart) {
            $productIds = array_keys($cart);
            foreach ($productIds as $id) {
                $products[] = Product::findById($id);
            }
        }
        return $this->render('cart.index', [
            'products' => $products
        ]);
    }

    public function addToCart()
    {
        $cart = $_SESSION['cart'] ?? [];
        if (isset($cart[$_POST['id']])) {
            $cart[$_POST['id']] += $_POST['count'];
        } else {
            $cart[$_POST['id']] = $_POST['count'];
        }
        $_SESSION['cart'] = $cart;
        echo json_encode($cart);
    }
}