<!-- Page Header -->
<header class="masthead" style="background-image: url('img/contact-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                    <h1>Contact Me</h1>
                    <span class="subheading">Have questions? I have answers.</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <h1> Новые поступления</h1>
    </div>
    <div class="row">

        <?php foreach ($products as $product):?>
        <div class="col-md-6">
            <div class="card" style="width: 18rem;">
                <img src="https://loremflickr.com/320/240" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?=$product->name?></h5>
                    <p class="card-text">
                        Категория: <?=$categories[$product->category_id] ?? ''?>
                        <br>
                        Брэнд: <?= ($brands[$product->brand_id])->name ?? ''?>
                    </p>
                    <a href="/catalog/<?=($categories[$product->category_id])->alias?>/<?=$product->alias?>" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>