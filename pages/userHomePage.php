<?php 
    include './tempelates/user-navbar/user-navbar.php' ; 
    ?>

    <section class = "container user-home">
     
    <!-- Latest Product -->
    <h2> Latest Product </h2>
    <div class = "row latest-product">
     
        <div class="col-sm-3">
              <?php include  './tempelates/product/product.php' ?>
            </div>
            <div class="col-sm-3">
              <?php include  './tempelates/product/product.php' ?>
            </div>
            

    </div>

     <hr />

        <!-- Our Product  -->
        <div class = "row">

        <div class = "col-sm-5">
           <?php include  './tempelates/order-form/order-form.php'?>
        </div>

        <div class="col-sm-7">
        <div class="row">
            <div class="col-sm-6">
              <?php include  './tempelates/product/product.php' ?>
            </div>
            <div class="col-sm-6">
              <?php include  './tempelates/product/product.php' ?>
            </div>
           
            </div>
        </div>

    </section>