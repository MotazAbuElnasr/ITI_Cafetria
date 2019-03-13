<?php
    include 'tempelates/adminNavbar.php';
    require_once 'classes/db.php';
    include 'controllers/functions.php';
    if ($_SESSION['userName'] == '') {
        header('Location: /');
    }
    ?>

    <section class = "container user-home">
    <!-- Latest Product -->
    <h2> Add to User </h2>
    <hr />
    <!-- <div class = "row latest-product"> -->
    <select class='custom-select form-control' name='userId'>";
        <option>Select User...</option>;
        <?php $userList = $db->userList();
        while ($user = $userList->fetch()) {
            ?>
        <option value=<?php echo $user['id']; ?> > <?php echo $user['name']; ?></option>";
      <?php
        } ?>

    </select>

     <hr />

        <!-- Our Product  -->
        <div class = "row">

        <div class = "col-sm-5">
           <?php include 'tempelates/order-form/order-form.php'; ?>
        </div>

        <div class="col-sm-7">
        <div class="row">

              <?php include 'tempelates/product/allProduct.php'; ?>


            </div>
        </div>

    </section>
