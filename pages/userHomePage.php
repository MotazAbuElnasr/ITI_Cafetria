<?php
    include 'tempelates/user-navbar/user-navbar.php' ;
    // Check if user Auth or not
    if ($_SESSION['userName']=="")
    header('Location: /');



    if(isset($_GET["price"])){
        echo "<div style='background-color:red'> <p>".$_GET["price"]."</p> </div>";
    }
    if(isset($_GET["notes"])){
        echo "<div style='background-color:red'> <p>".$_GET["notes"]."</p> </div>";
    }
    if(isset($_GET["room"])){
        echo "<div style='background-color:red'> <p>".$_GET["room"]."</p> </div>";
    }
    if(isset($_GET["product_id"])){
        echo "<div style='background-color:red'> <p>".$_GET["product_id"]."</p> </div>";
    }
    if(isset($_GET["quantity"])){
        echo "<div style='background-color:red'> <p>".$_GET["quantity"]."</p> </div>";
    }
    // if(isset($_SESSION["confirm"])){
    //     echo "<div style='background-color:green'> <p>".$_SESSION["confirm"]."</p> </div>";
    // }

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
