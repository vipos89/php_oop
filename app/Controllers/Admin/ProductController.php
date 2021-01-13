<?php


namespace App\Controllers\Admin;

use App\core\BaseController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Router;

class ProductController extends BaseController
{
    public $layout = 'admin';

    public function index()
    {
        $count = count(Product::getAll());
        $currentPage = $_GET['page'] ?? 1;
        $currentPage = $currentPage < 1 ? 1 : $currentPage;
        $limit = 5;
        $offset = ($limit * ($currentPage - 1));
        $offset = $offset > 0 ? $offset : 0;


        $products = Product::selectWithConditions([
            'order' => [
                'field' => 'id',
                'way' => 'DESC'
            ],
            'limit' => [
                'limit' => 5,
                'offset' => $offset
            ]
        ]);

        $categories = Category::getAll();
        $categoryList = [];
        foreach ($categories as $category){
            $categoryList[$category->id] = $category;
        }
        unset($categories);


        $this->render('admin.products.index', [
            'products' => $products,
            'pages' => ceil($count / $limit),
            'currentPage' => $currentPage,
            'categories' => $categoryList
        ]);
    }

    // отображение одного товара
    public function show()
    {
        $id = Router::getRouteArgs()[0];
        $categories = Category::getAll();
        $brands = Brand::getAll();
        $product = Product::findById($id);

        return $this->render('admin.products.show',
            compact('categories', 'brands', 'product')
        );
    }

    // редактировать товар
    public function edit()
    {
        $id = Router::getRouteArgs()[0];
        $category = Category::findById($id);
        $category->name = $_POST['name'];
        $category->save();

        return $this->redirect('/admin/category');

    }

    // создание нового товара
    public function save()
    {
        $category = new Category();
        $category->load($_POST);
        $category->save();
        return $this->redirect('/admin/category');
    }

    // форма создания нового товара
    public function add()
    {

        $categories = Category::getAll();
        $brands = Brand::getAll();

        return $this->render('admin.products.show',
            compact('categories', 'brands')
        );

    }

    public function delete()
    {
        Category::delete(Router::getRouteArgs()[0]);
        return $this->redirect('/admin/category');
    }
}