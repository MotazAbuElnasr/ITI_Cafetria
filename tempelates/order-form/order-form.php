
<div class ="card order-card wow animated">
   <form action="../controllers/actions.php" method="post">
       <div class="fom-group items">       
     
    </div>
    <div class = "order-notes">
            <textarea class="form-control col-sm-12" rows = "2" placeholder="Add Your Order Notes Here ..." name="order_note">
</textarea>
        </div>
        <div class = "order-room row">
           <label class="col-sm-3">Room</label>
           <select class="custom-select col-sm-6" name = "order_room_number">
                <option selected>Select Room Number</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
        </div>

        <hr>
        <strong> <p class="h3">Total Price : </p> <span  ><input type="text" id="totalPrice" readonly value="0" name="price" /> EGP</span></strong>
        <input type="hidden" name="type" value="add_order"/>
        <button type="submit" class="btn btn-primary" style="float: right">Confirm</button>
   </form>
</div>

