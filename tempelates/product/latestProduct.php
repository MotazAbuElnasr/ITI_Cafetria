<<<<<<< HEAD
<?php 
require_once 'classes/db.php' ;
$db = new DbManager() ;
$products = $db->latestProduct () ; 
=======
<?php
require_once 'classes/db.php' ;
$db = new DbManager() ;
$products = $db->latestProduct () ;
>>>>>>> bcca0ff16856f2196d8a1c89d0dd57426861af38
while ($product = $products->fetch()) {
?>


<div class="col-sm-3">
<div class= "product card" >
<<<<<<< HEAD
    <img src="assets/images/coolCoffe.jpg" class="card-img-top" alt="product image">
    <div class="card-body">
      <h5 class="card-title p-name"><?php echo $product['name'] ?></h5>
      <p class="card-text">  <strong> Price </strong> : <span class="p-price"><?php echo $product['price'] ?> </span>EGP</p>
=======
    <img src=<?php echo $product['img'] ; ?>  class="card-img-top" alt="product image">
    <div class="card-body">
      <h5 class="card-title p-name"><?php echo $product['name'] ?></h5>
      <p class="card-text">  <strong> Price </strong> : <span class="p-price"><?php echo $product['price'] ?> </span>EGP</p>
      <span style = "display:none" class = "pId"> <?php echo $product['p_id'] ; ?></span>
>>>>>>> bcca0ff16856f2196d8a1c89d0dd57426861af38
      <button class="btn btn-primary add-product-order">Add to Your Order </button>
    </div>
  </div>
  </div>
<<<<<<< HEAD
<?php } ?>
=======
<?php } ?>
>>>>>>> bcca0ff16856f2196d8a1c89d0dd57426861af38
