<header class="masthead" style="background-image: url('img/contact-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Название товара</th>
                <th scope="col">Количество</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product):?>
            <tr>
                <td><?=$product->name?></td>
                <td><?=$_SESSION['cart'][$product->id]?></td>

            </tr>
            <?php endforeach ;?>
            </tbody>
        </table>

</div>
