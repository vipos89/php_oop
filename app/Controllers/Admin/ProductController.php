<?php


namespace App\Controllers\Admin;


use App\core\BaseController;
use App\Helpers\Debugger;
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

        $this->render('admin.products.index', [
            'products' => $products,
            'pages' => ceil($count / $limit),
            'currentPage' => $currentPage
        ]);
    }

    // отображение одного товара
    public function show()
    {
        $id = Router::getRouteArgs()[0];
        $category = Category::findById($id);
        return $this->render('admin.category.show', compact('category'));
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
        return $this->render('admin.category.show');
    }

    public function delete()
    {
        Category::delete(Router::getRouteArgs()[0]);
        return $this->redirect('/admin/category');

    }
}