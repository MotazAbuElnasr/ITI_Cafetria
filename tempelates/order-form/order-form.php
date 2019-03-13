
<div class ="card order-card wow animated">
   <form>
       <div class="fom-group items">
           
      <input id= "userIdForm"  name = "userId" style = "display:none" > 
     
    </div>
    <div class = "order-notes">
            <textarea class="form-control col-sm-12" rows = "2" placeholder="Add Your Order Notes Here ..." name="order-note">
</textarea>
        </div>
        <div class = "order-room row">
           <label class="col-sm-3">Room</label>
           <select class="custom-select col-sm-6" name = "order-room-number">
           <?php
                    $stmt= $db->getRooms();
                    while($room = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        extract($room)
                        ?>
                        <option class="dropdown-item" value="<?php echo $room_num?>"> <?php echo $room_num?> </option>
                        <?php
                    }
                    ?>
              </select>
        </div>

        <hr>
        <strong> <p class="h3">Total Price : </p> <span  ><input type="text" id="totalPrice" disabled value="0" /> EGP</span></strong>
        <button type="submit" class="btn btn-primary" style="float: right">Confirm</button>
   </form>
</div>
