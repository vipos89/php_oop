<?php

use App\Helpers\Debugger;
use App\Router;

?>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <form role="form" method="post"
                  action="<?= isset($product->id) ?
                      '/admin/category/edit/' . $product->id : '/admin/category/save' ?>">
                <div class="form-group">
                    <label>Название товара</label>
                    <input class="form-control" name="name" value="<?= $product->name ?? '' ?>">
                </div>
                <div class="form-group">
                    <label>Категория товара</label>

                    <select name="category_name" id="" class="form-control">
                        <option value="">Выберите категорию</option>
                        <?php foreach ($categories as $category):?>
                        <?php $checked = ($product->category_id == $category->id)?>
                            <option value="<?=$category->id?>" <?=$checked?'selected':""?>>
                                <?=$category->name?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Бренд товара</label>
                    <select name="category_name" id="" class="form-control">
                        <option value="">Выберите бренд</option>
                        <?php foreach ($brands as $brand):?>
                            <?php $checked = ($product->brand_id ?? false) === $brand->id?>
                            <option value="<?=$brand->id?>" <?=$checked?'selected':""?>>
                                <?=$brand->name?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </div>



                <button type="submit" class="btn btn-default">Submit Button</button>
                <button type="reset" class="btn btn-default">Reset Button</button>

            </form>

        </div>

    </div>

</div>
