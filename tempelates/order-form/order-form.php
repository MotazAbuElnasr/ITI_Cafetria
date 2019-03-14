<?php
include_once 'classes/db.php';
$db= new DbManager();
?>
<div class ="card order-card wow animated">
   <form action="controllers/actions.php" method="post">
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

        <hr>
        <strong> <p class="h3">Total Price : </p> <span  ><input type="text" id="totalPrice" readonly value="0" name="price" /> EGP</span></strong>
        <input type="hidden" name="type" value="add_order"/>
         <input type="hidden" name="user_id" value="1" >
        <input type="submit" class="btn btn-primary" style="float: right"name="submit" value="Confirm">
   </form>
</div>

