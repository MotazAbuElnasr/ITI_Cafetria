<?php
include_once 'classes/db.php';
$db= new DbManager();
?>
<div class ="card order-card wow animated">
   <form action="actions" method="post">
       <div class="fom-group items">       
  
           
      <input id= "userIdForm"  name = "userId" style = "display:none" > 
     
    </div>
    <div class = "order-notes">
            <textarea class="form-control col-sm-12" rows = "2" placeholder="Add Your Order Notes Here ..." name="order_note">
</textarea>
        </div>
        <div class = "order-room row">
           <label class="col-sm-3">Room</label>
           <select class="custom-select col-sm-6" name = "order_room_number">
                <option value="">Select Room Number</option>
                <?php
                    $stmt= $db->getRooms();
                    while($room = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        extract($room)
                        ?>
                        <option value="<?php echo $room_num?>"> <?php echo $room_num?> </option>
                        <?php
                    }
                    ?>
              </select>
        </div>
        <div  class = "order-room row">
        <label class="col-sm-3">Add to User</label>
        <select class='custom-select form-control col-sm-6' name='user_id' id = "userId">";
            <option value="">Select User...</option>;
            <?php $usersList = $db->getUsersList() ;
            while ( $user = $usersList->fetch() ) {
        ?>
            <option value="<?php echo $user['id']?>" > <?php echo $user['name']?></option>";
        <?php  } ?>

        </select>
        </div>

        <hr>
        <strong> <p class="h3">Total Price : </p> <span  ><input type="text" id="totalPrice" readonly value="0" name="totalPrice" /> EGP</span></strong>
        <input type="hidden" name="type" value="admin_add_order"/>
        <input type="submit" class="btn btn-primary" style="float: right"name="submit" value="Confirm">
   </form>
</div>

