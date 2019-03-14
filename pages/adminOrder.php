<?php
    include 'tempelates/adminNavbar.php' ;
    require_once('classes/db.php');
    $db = new DbManager() ;
    if ($_SESSION['userName']=="")
    header('Location: /');
    ?>

    <section class = "container user-home">
    <!-- Latest Product -->
    <h2> Add to User </h2>
    <hr />
    <!-- <div class = "row latest-product"> -->

    <select class='custom-select form-control' name='userId' id = "userId">";
        <option>Select User...</option>;
        <?php $usersList = $db->getUsersList() ;
        while ( $user = $usersList->fetch() ) {
      ?>
        <option value=<?php echo $user['id']?> > <?php echo $user['name']?></option>";
      <?php  } ?>

    </select>

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
                <!-- <input type="text" id="searchBar" /> -->
            </div>
        <div class="row">

              <?php include  'tempelates/product/allProduct.php' ?>


            </div>
        </div>

    </section>
