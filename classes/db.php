<?
class All
{
    function __construct()
    {
        $this->dbConnection();
    }

    function dbConnection()
    {
        require("../controllers/dbConnection.php");

    }
//SELECT o.o_id o.time, o.status, o.total from orders o where o.user_id = 3 Date between 2011/02/25 and 2011/02/27;
function a (){
        $order = [];
        $product = '';
        $price = "";
        $number = "";
        $productDetails = [$number , $price];

        
        $order = new Order([]);
}

//$order = ["time" =>    , "status" =>    , total =>  , orderInfo => [] ]

//select p.name, p.img , po.number , po.price from products p inner join products_orders po where po.product_id = p.p_id AND po.order_id = 1




    function selectUserOrders($user , $start , $end){
        ord
        $statement = "SELECT o.time, o.status, o.total from orders o inner join users u where u.id = o.user_id"
    }

}
