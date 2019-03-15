<?php
    include 'tempelates/adminNavbar.php';
    require_once 'classes/db.php';
    include 'controllers/functions.php';
    if ($_SESSION['userName'] == '') {
        header('Location: /');
    }
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
      <tr  data-toggle="collapse" data-target="#demo" >
            <td>11-02-2019 11:22:33</td>
            <td>Alaa Tarek</td>
            <td>1002</td>
            <td>222</th>
            <td>
            <select class="custom-select col-sm-6" name = "order_status">
                <option value="">Select Action</option>
                <option value="Preparing">Preparing</option>
                <option value="Deliver">Deliver</option>
            </select>
            </td>
        </tr>
     <tr>
    <td colspan="5">
        <div  id="demo" class="collapse">
            <div class="container">
                <div class="row">
                    <div class="col-xs-3 ">
                        <div class="thumbnail">
                            <img src="jkhkjh.jbg" class="img-rounded">
                            <div class="caption">
                                <p>Lorem ipsum...</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3 ">
                        <div class="thumbnail">
                            <img src="jkhkjh.jbg" class="img-rounded">
                            <div class="caption">
                                <p>Lorem ipsum...</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3 ">
                        <div class="thumbnail">
                            <img src="jkhkjh.jbg" class="img-rounded">
                            <div class="caption">
                                <p>Lorem ipsum...</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3 ">
                        <div class="thumbnail">
                            <img src="jkhkjh.jbg" class="img-rounded">
                            <div class="caption">
                                <p>Lorem ipsum...</p>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
        </div>
        </td>
      </tr>
    </tbody>
  </table>

</section>
