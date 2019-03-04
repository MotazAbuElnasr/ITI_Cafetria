
<link rel= "stylesheet" href="./style.css">
<div class ="card order-card">
   <form>
       <div class="form-group ">
           <div class = "added-item row">
           <label class="col-md-5" for ="p1">Product name </label>
           <input class="form-control col-md-2" min=0 type="number" name="product1 qty" id="p1" />
           <p class="item-price col-sm-3">12 EGP</p>
           <button class="btn btn-danger rounded-circle">X</button>

        </div>
       
        <div class = "order-notes">
            <textarea class="form-control col-sm-8" rows = "2" placeholder="Add Your Order Notes Here ..." name="order-note">
                
            </textarea>
        </div>
    </div>

        <div class = "order-room row">
           <label class="col-sm-3">Room</label>
           <select class="custom-select col-sm-6" name = "order-room-number">
                <option selected>Select Room Number</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
        </div>

        <hr>
        <strong> <p class="h3">Total Price : </p> <span>123 EGP</span></strong>
        <button type="submit" class="btn btn-primary" style="float: right">Confirm</button>
   </form>
</div>
