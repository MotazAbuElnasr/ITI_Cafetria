<?php
require_once ('../classes/db.php');
$db= new dbManger();
$checks = $db->checks();
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<style>

.mb-0 > a {
  display: block;
  position: relative;
}
.mb-0 > a:after {
  content: "\f078"; /* fa-chevron-down */
  font-family: 'FontAwesome';
  position: absolute;
  right: 0;
  top : -4;
}
.mb-0 > a[aria-expanded="true"]:after {
  content: "\f077"; /* fa-chevron-up */
}
</style>
<!-- //this is for admin past order which will include filtering -->
<div id="accordion">
<div class="container">
    <div class="row">
        <div class="col-6">
            Name
        </div>
        <div class="col-6">
            Total Amount
        </div>
    </div>
</div> <?php ?>
<?php $i=1; foreach($checks as $user){ ?>
  <div class="card">
    <div class="card-header" id="heading-<?= $i?>">
      <h5 class="mb-0">
        <a role="button" data-toggle="collapse" href="#collapse-<?= $i?>" aria-expanded="true" aria-controls="collapse-<?= $i?>">
         <?= $user['UName'] ?>
        </a>
      </h5>
    </div>
    <div id="collapse-<?= $i?>" class="collapse show" data-parent="#accordion" aria-labelledby="heading-<?= $i?>">
      <div class="card-body">
        <div id="accordion-<?= $i?>">
        <div class="container">
            <div class="row">
                <div class="col-6">
                Order Date
                </div>
                <div class="col-6">
                Total
                </div>
            </div>
        </div>
        <?php $j=1; foreach ($user['Orders'] as $check) { ?>
          <div class="card">
            <div class="card-header" id="heading<?="-$i-$j"?>">
              <h5 class="mb-0">
                <a class="collapsed show" role="button" data-toggle="collapse" href="#collapse<?="-$i-$j"?>" aria-expanded="false" aria-controls="collapse<?="-$i-$j"?>">
                        <?= $check['OTime'] ?>
                        <?= 300 ?>
                </a>
              </h5>
            </div>
            <div id="collapse<?="-$i-$j"?>" class="collapse" data-parent="#accordion-<?= $i?>" aria-labelledby="heading<?="-$i-$j"?>">
              <div class="card-body">    
                   
                    <?php foreach ($check['Products'] as $product) { 
                        // print_r($check['Products']);
                        echo "<div> <div> $product[0] </div> <div> $product[2] </div> </div>";
                        // echo $check['Products'][0]." ".$check['Products'][1]." ".$check['Products'][2];
                    }
                        ?>
              </div>
            </div>
          </div>
        <?php $j++;} ?>
        </div>           
      </div>
    </div>
  </div>
  <?php $i++; } ?>
</div>

