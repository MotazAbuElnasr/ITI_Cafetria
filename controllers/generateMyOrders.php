<?php

require_once 'classes/db.php';
if (isset($_GET['start']) && isset($_GET['end'])) {
    echo generateOrders($_GET['start'], $_GET['end'], $_GET['page']);
}
function generateOrders($startDate, $endDate, $page)
{
    $db = new DbManager();
    $userId = $_SESSION['userId'] ; //it will be changed later IMMMMMMMPPPPPPPPPOOOOOOORRRRRRTTTTTTTAAAAAAANNNNNNNTTTT
$orders = $db->userOrders($userId, $startDate, $endDate, $page); //This will be page
$page="
<div class='panel-group' id='accordion' style='min-height: 450px'>
    <table class='table table-hover text-center table table-bordered text' id='orderTable'>
        <!--                make it with css-->
        <thead class='thead-blue'>
        <tr>
            <th>Order date</th>
            <th>Status</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        </thead>
        ";
        $i = 0;
        foreach ($orders as $order) {
            $time = $order['time'];
            $status = $order['status'];
                               $total = $order['total'];
            $orderNo = $order['oNum'];
$page.="
            <tr onclick='accordionFix(event)' data-number='$i' data-toggle='collapse' data-target='#collapse$i' class='order accordion-toggle'>
                            <td class='align-middle'>
                                    $time
                            </td>
                            <td class='align-middle'>
                                $status
                            </td>
                            <td class='align-middle'>
                                $total
                            </td>
                            <td class='align-middle'>";
        if ($order['status'] == 'Processing') {
            $page .= "
                                    <input id='$orderNo' onclick=\"cancelOrder(event)\" type='submit' value='Cancel' class='filterBtn'>
                                  ";
        } else {
            $page .= '  ';
        }
        $page .= "      
                            </td>
            </tr>
           <tr>
           <td colspan='4'>
           <div id='collapse$i' data-number='$i' class='accordion-body collapse data'>
            <div class='row orderProducts'>";
        for ($j = 0; $j < sizeof($order['Products']); ++$j) {
            $pName = $order['Products'][$j]['PName'];
            $pImg = $order['Products'][$j]['img'];
            $pPrice = $order['Products'][$j]['price'];
            $pCount = $order['Products'][$j]['count'];
            $oTotal = $order['total'];
            $page .= "          
                    <div class='col-3'>
                        <h5>$pName</h5>
                        <img width='110px' src='$pImg'>
                        <h5> price : $pPrice </h5>
                        <h5> number : $pCount </h5>
                    </div>
                   ";
        }
        $page .= "
            </div>
        <div class='row mt-3'>
            <div class='col-4'></div>
            <div class='col-4'><h4>Total order : $oTotal</h4></div>
        </div>
    </div>
    </td>
    </tr>";
        ++$i;
    }
    $page .= '
    </table>
</div>
';

    return $page;
}
