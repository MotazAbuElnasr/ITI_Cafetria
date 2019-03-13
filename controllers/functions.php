<?php
    require_once('classes/db.php');
$db= new DbManager();
if(isset($_GET['start'])&&isset($_GET['end'])){
  echo generateAccordion($_GET['start'],$_GET['end'],'');
}
else if(isset($_GET['UID'])&&!empty($_GET['UID'])){
  echo generateAccordion('','',$_GET['UID']);
}
function getUsers(){
  $db = new DbManager();
  $users = $db->getUsers();
  return $users;
}

function generateAccordion($start,$end,$uid){
$db= new DbManager();
$checks = $db->checks($start,$end,$uid);
$ret =<<<EOT
  <div class="container">
  <div class="row">
      <div class="col-6">
         <h3> Name </h3>
      </div>
      <div class="col-6">
      <h3>Total Amount</h3>
      </div>
  </div>
</div>
EOT;
$i=1;
foreach($checks as $user){
$total=0; 
foreach ($user['Orders'] as $check) $total += $check['OTotal'];
$ret .= <<<EOT
<div class="card">
  <div class="card-header" id="heading-$i">
    <h5 class="mb-0">
      <a role="button" data-toggle="collapse" href="#collapse-$i" aria-expanded="true" aria-controls="collapse-$i">
      <div class="row">
      <div class="col-6">
            {$user['UName']}
      </div>
      <div class="col-6">
        $total
      </div>
  </div>
      </a>
    </h5>
  </div>
  <div id="collapse-$i" class="collapse" data-parent="#accordion" aria-labelledby="heading-$i">
    <div class="card-body">
      <div id="accordion-$i">
      <div class="container">
          <div class="row">
              <div class="col-6">
              Order Date
              </div>
              <div class="col-6">
              Amount
              </div>
          </div>
      </div>
EOT;
$j=1;
foreach ($user['Orders'] as $check) {
$ret .= <<<EOT
<div class="card">
<div class="card-header" id="heading-$i-$j">
  <h5 class="mb-0">
    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-$i-$j" aria-expanded="false" aria-controls="collapse-$i-$j">
    <div class="row">
    <div class="col-6">
    {$check['OTime']}
    </div>
    <div class="col-6">
    {$check['OTotal']}
    </div>
</div>
    </a>
  </h5>
</div>
<div id="collapse-$i-$j" class="collapse" data-parent="#accordion-$i" aria-labelledby="heading-$i-$j">
  <div class="card-body">  
EOT;
foreach ($check['Products'] as $product) { 
        $ret .= "<div> <div> $product[0] </div> <div> $product[2] </div> </div>";
                  }
$ret .= <<<EOT
            </div>
          </div>
        </div>
EOT;
$j++;} 
$ret .=<<<EOT
      </div>           
    </div>
  </div>
</div>
EOT;
$i++; 
} 
return $ret;
}
