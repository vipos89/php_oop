<header class="masthead" style="background-image: url('img/contact-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                    <h1>Каталог товаров</h1>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
   <div class="row">
       <div class="col-md-4">
           <div class="row">
               <ul class="nav flex-column">
                   <?php foreach($categories as $category):?>
                   <li class="nav-item">
                       <a class="nav-link" href="/catalog/<?=$category->alias?>"><?=$category->name?></a>
                   </li>
                  <?php endforeach; ?>
               </ul>
           </div>
       </div>
       <div class="col-md-8">
           <div class="row">

               <?php foreach ($products as $product):?>
                   <div class="col-md-6">
                       <div class="card" style="width: 18rem;">
                           <img src="https://loremflickr.com/320/240" class="card-img-top" alt="...">
                           <div class="card-body">
                               <h5 class="card-title"><?=$product->name?></h5>

                               <a href="/catalog/<?=$category->alias?>/<?=$product->alias?>" class="btn btn-primary">Go somewhere</a>
                           </div>
                       </div>
                   </div>
               <?php endforeach;?>
           </div>
       </div>
   </div>

</div>
