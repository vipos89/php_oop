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
    <div class="row">
        <div class="col-md-6">
            <img src="https://loremflickr.com/640/480" alt="" style="max-width: 100%">
        </div>
        <div class="col-md-6">
            <h1><?= $product->name ?></h1>

            <h4>Категория: <?= $product->category ?></h4>
            <h4> Брэнд: <?= $product->brand->name ?></h4>
        </div>
    </div>
    <div class="row">
        <button class="btn btm-sm btn-success add-to-cart-js" data-product_id="<?= $product->id ?>">Положить в корзину
        </button>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".add-to-cart-js").click(function () {
            let productId = $(this).data('product_id');
            $.ajax({
                method: "POST",
                url: "/cart/add",
                data: {id: productId, count: 1},
                success: function (response) {
                    console.log(JSON.parse(response))
                }
            })
        })
    });
</script>
