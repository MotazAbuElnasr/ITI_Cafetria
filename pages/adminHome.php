<?php
    include 'tempelates/adminNavbar.php';
    require_once 'classes/db.php';
    include 'controllers/functions.php';
    // Check if user is admin or not
   if ($_SESSION['userName']!="admin")
   header('Location: /');

    ?>

<section class = "container user-home">
<h1> Orders </h1>
<hr/>
<table class="table table-hover">
    <thead>
      <tr>
        <th>Order Date</th>
        <th>Name</th>
        <th>Room</th>
        <th>Ext</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $db = new DbManager();
    $orders = $db->showOrders();
    if($orders)
    {
    foreach($orders as $order)
    {
        ?>
      <!-- <tr  data-toggle="collapse" data-target="<?php echo "#c".$order['o_id'] ?>" > -->
      <tr>
            <td><?php echo $order["time"]?></td>
            <td><?php echo $order["name"] ?></td>
            <td><?php echo $order["room"] ?></td>
            <td><?php //echo $order["ext"] ?></th>
            <td>
            <select class="custom-select col-sm-6" id="status" onChange="changeStatus(this.value, <?php echo $order["o_id"] ?>)" name = "order_status">
                <option value="">Select Action</option>
                <option value="Processing" <?php if($order["status"] == "Processing" ){ echo "selected";  } ?> >Processing</option>
                <option value="Done" <?php if($order["status"] == "Done" ) {echo "selected";} ?>>Delivered</option>
            </select>
            </td>
        </tr>
     <tr>
    <td colspan="5">
        <!-- <div  id="<?php echo "#c".$order['o_id'] ?>" class="collapse"> -->
        <div>
            <div class="container">
                <div class="row">
               
                <?php 
                $products = $db->getProductsInOrders( $order['o_id']);
                
                foreach($products as $product)
                {
                ?>
                    <div class="col-xs-3 ">
                        <div class="thumbnail">
                            <img src="<?php echo $product['img'] ?>" class="col-xs-3" width="75px" class="img-rounded">
                            <div class="caption">
                            <p>EGP <?php echo $product['price'] ?></p>
                            <p>Quantity <?php echo $product['number'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                </div>
                <p> <?php echo $order["total"] ?>
            <div>
        </div>
        </td>
      </tr>
      <?php
    }
      }
      ?>
    </tbody>
  </table>

</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script>

  function changeStatus(status, id) {
       
        $.ajax({
        type: "POST",
        url: 'controllers/actions.php',
        data: {status: status, ajax_type:"order_status",id:id},
        success: function(data){
            alert("order status has been changed ");
        }
        });
    }


</script>