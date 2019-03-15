<?php
require_once('classes/db.php');
$db= new DbManager();
if(isset($_GET['start'])&&isset($_GET['end'])){
  $UID='';
  $page='';
  if(isset($_GET['UID'])&&!empty($_GET['UID']))
    $UID=$_GET['UID'];
  if(isset($_GET['page'])&&!empty($_GET['page']))
    $page=$_GET['page'];
  echo generateAccordion($_GET['start'],$_GET['end'],$UID,$page);
}

if(isset($_GET['status'])&&isset($_GET['id'])){
  $status = $_GET['status'] ;
  $id = $_GET['id'] ;
  if(!empty($status)&&!empty($id))
      echo $db->updateProductStatus($status,$id);
   else echo "ERROR";
  exit;
}

function getUsers(){
  $db = new DbManager();
  $users = $db->getUsers();
  return $users;
}

function generateAccordion($start,$end,$uid,$page){
$db= new DbManager();
$allUsers = $db->checks($start,$end,'','');
$checks = $db->checks($start,$end,$uid,$page);
$ret=<<<EOT
<div class="btn-group" id="userList" >
  <button type="button" class="btn dropdown-toggle text" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Users
  </button>
  <div class="dropdown-menu"> 
EOT;
foreach ($allUsers as $key => $user) {
  $uName=$allUsers[$key]['UName'];
  $ret.= "<button class='dropdown-item' id='$key' onclick='checkFilter(event)' type='button'>$uName</button>";
  }    
$ret .=<<<EOT
  </div>
  </div>
  <div class="container">
  <div class="row text-center">
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
<div class="card text-center">
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
  $orderDate = strtotime($check['OTime'] );
  // {$check['OTime']}

$orderDate = date( ' m-d-Y H:i:s', $orderDate );
$ret .= <<<EOT
<div class="card">
<div class="card-header" id="heading-$i-$j">
  <h5 class="mb-0">
    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-$i-$j" aria-expanded="false" aria-controls="collapse-$i-$j">
    <div class="row">
    <div class="col-6">
    {$orderDate}    
    </div>
    <div class="col-6">
    {$check['OTotal']}
    </div>
</div>
    </a>
  </h5>
</div>
<div id="collapse-$i-$j" class="collapse" data-parent="#accordion-$i" aria-labelledby="heading-$i-$j">
<div class='row'>
EOT;
foreach ($check['Products'] as $product) { 
        $ret .= "
         <div class='col-sm-2'>
          <div class= 'product card' >
              <img src='$product[3]' class='card-img-top cardImg' alt='product image'>
              <div class='card-body'>
                <h5 class='card-title p-name'>$product[0]</h5>
                <p class='card-text'>  <strong> Price </strong> : <span value ='$product[2]' class='p-price'> $product[2]</span> EGP</p>
              </div>
            </div>
          </div>";
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
