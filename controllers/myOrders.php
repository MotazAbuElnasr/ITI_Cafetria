<?php
require_once('../classes/db.php');
include '../tempelates/user-navbar/user-navbar.php';
include '../tempelates/header.php';
$db = new dbManger();
$userId = 3;
if (isset($_POST['submit'])) { //check if form was submitted
    $startDate = $_POST['start']; //get input text
    $endDate = $_POST['end'];
} else {
    $startDate = date("Y-m-d");
    try {
        $endDated = new DateTime();
        $endDated->sub(new DateInterval('P3D'));
        $endDate = $endDated->format('Y-m-d');
    } catch (Exception $e) {
    }

}
$orders = $db->userOrders($userId, $startDate, $endDate, 2);
?>
    <div class="container">
        <h2>My orders</h2>
        <form name="frmSearch" method="post" action="./myOrders.php">
            <p class="search_input">
                <label>start date</label>
                <input type="date" name="start" id="start">
                <label>end date</label>
                <input type="date" name="end" id="end">
                <input type="submit" value="filter" name="submit" class="">
            </p>
        </form>
        <table>
            <th>
            <td>Order date</td>
            <td>Status</td>
            <td>Amount</td>
            <td>Total</td>
            <td>Action</td>
            </th>
            <div class="panel-group" id="accordion">
            <?php $i = 0;
            foreach ($orders as $order) { ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                <div class="panel-title" >
                <tr>
                    <td>
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $i?>">
                            <?php echo $order["time"] ?> </a>
                    </td>
                    <td>
                        <?php echo $order["status"] ?>
                    </td>
                    <td>
                        <?php echo $order["total"] ?>
                    </td>
                    <td>
                        <?php $orderNo = $order['total'];
                        if ($order["status"] == "Processing") {
                            echo "<form action='myOrders.php' method='post'> 
                                    <input type='hidden' name='orderNo' value='$orderNo'>
                                    <input type='submit' value='Cancel'>
                                  </form>";
                        }
                        else{
                            echo "  ";
                        }
                        ?>
                    </td>
                </tr>
                    </div>
                </div>
                <?php $i++;
            } ?>
            </div>
        </table>



   <?php $i = 0 ;foreach ($orders as $order) { ?>

            <div id="collapse<?= $i?>" class="panel-collapse collapse">
                <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </div>
            </div>
    <? $i++; } ?>

    </div>



    <script>
        document.getElementById("end").valueAsDate = new Date();
        let start = new Date();
        start.setDate(start.getDate() - 3)
        document.getElementById("start").valueAsDate = start;


    </script>


<?php include "../tempelates/footer.php"; ?>