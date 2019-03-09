<?php
require_once('classes/db.php');
include 'tempelates/userHeader.php';
include 'tempelates/user-navbar/user-navbar.php';
//include 'tempelates/userHeader.php';
$db = new DbManager();
$userId = 3; //it will be changed later IMMMMMMMPPPPPPPPPOOOOOOORRRRRRTTTTTTTAAAAAAANNNNNNNTTTT
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
    <div class="container-fluid">
        <h2>My orders</h2>
        <form name="frmSearch" method="post" action="orders">
            <p class="search_input">
                <label>start date</label>
                <input type="date" name="start" id="start">
                <label>end date</label>
                <input type="date" name="end" id="end">
                <input type="submit" value="filter" name="submit" class="">
            </p>
        </form>
        <div class="panel-group" id="accordion">
            <table class="table" id="orderTable">
                <!--                make it with css-->
                <tr>
                    <th>Order date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                <?php $i = 0;
                foreach ($orders as $order) { ?>
                    <tr>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <td>
                                        <a class="data" data-number="<?= $i ?>" id="element<?= $i ?>"
                                           data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $i ?>">
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
                                        } else {
                                            echo "  ";
                                        }
                                        ?>
                                    </td>
                                </div>
                            </div>
                        </div>
                    </tr>
                    <?php $i++;
                } ?>
            </table>
        </div>

        <?php $i = 0;
        foreach ($orders as $order) { ?>
            <div id="collapse<?= $i ?>" data-number="<?= $i ?>" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="row">
                        <? for ($j = 0; $j < sizeof($order["Products"]); $j++) { ?>
                            <div class="col-3">
                                <h5><?= $order["Products"][$j]["PName"] ?></h5>
                                <img src="<?= $order["Products"][$j]["img"] ?>">
                                <h5> price : <?= $order["Products"][$j]["price"] ?> </h5>
                                <h5> number : <?= $order["Products"][$j]["count"] ?> </h5>
                            </div>
                            <?
                        } ?>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-4"></div>
                    <div class="col-4"><h4>Total order : <?= $order["total"] ?> </h4></div>
                </div>
            </div>
            <? $i++;
        } ?>

    </div>
    <script>
        document.getElementById("end").valueAsDate = new Date();
        let start = new Date();
        start.setDate(start.getDate() - 3)
        document.getElementById("start").valueAsDate = start;
        document.querySelectorAll(".data").forEach((element) => {
            element.addEventListener("click", (e) => {
                let num = e.target.dataset.number;
                document.querySelectorAll(".collapse").forEach((element) => {
                    if (element.dataset.number !== num) {
                        element.classList.remove("show")
                    }
                })
            })
        })
    </script>


<?php include "tempelates/footer.php"; ?>