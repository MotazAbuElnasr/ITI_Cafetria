<?php
    include 'tempelates/user-navbar/user-navbar.php' ;
    if ($_SESSION['userName']=="")
    header('Location: /');
    ?>

    <section class = "container user-home">
    <!-- Latest Product -->
    <h2> Latest Product </h2>
    <hr />
    <div class = "row latest-product">
            <?php include  'tempelates/product/latestProduct.php' ?>
    </div>
     <hr />

     <div class="row input-group input-group-lg">
     <div class="input-group-prepend">
     <i class="input-group-text fas fa-search fa-5x"></i>
  </div>
<input class="form-control" type="text" id="searchBar"  placeholder="Filter Products Here"/>
</div>

        <!-- Our Product  -->
        <div class = "row">

        <div class = "col-sm-5">
           <?php include  'tempelates/order-form/order-form.php'?>
        </div>

        <div class="col-sm-7">
         
            <div class="row">
                <?php include  'tempelates/product/allProduct.php' ?>
            </div>
        </div>

    </section>
