<?php

use App\Helpers\Debugger;
use App\Router;

?>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <form role="form" method="post"
                  action="<?= isset($category->id) ?
                      '/admin/category/edit/' . $category->id : '/admin/category/save' ?>">
                <div class="form-group">
                    <label>Название категории</label>
                    <input class="form-control" name="name" value="<?= $category->name ?? '' ?>">
                </div>

                <button type="submit" class="btn btn-default">Submit Button</button>
                <button type="reset" class="btn btn-default">Reset Button</button>

            </form>

        </div>

    </div>

</div>
