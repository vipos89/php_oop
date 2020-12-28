<?php


namespace App\Controllers\Admin;


use App\core\BaseController;
use App\Helpers\Debugger;
use App\Models\Category;
use App\Router;

class CategoryController extends BaseController
{
    public $layout = 'admin';
    // вывод списка
    public function index()
    {
        $categories = Category::getAll();
        return $this->render('admin.category.index', compact('categories'));
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