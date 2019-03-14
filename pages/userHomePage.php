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

        <!-- Our Product  -->
        <div class = "row">

        <div class = "col-sm-5">
           <?php include  'tempelates/order-form/order-form.php'?>
        </div>

        <div class="col-sm-7">
            <div class="row">
                <input type="text" id="searchBar" />
            </div>
            <div class="row">
                <?php include  'tempelates/product/allProduct.php' ?>
            </div>
        </div>

    </section>
