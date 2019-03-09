<?
// require_once('user.php');
// require_once('product.php');
// require_once('order.php');
class dbManger
{

    private $host = '127.0.0.1';
    private $db = 'iti_cafe';
    private $user = 'Motaz';
    private $pass = 'motaz';
    private $charset = 'utf8mb4';
    private $dsn = "";
    private $pdo;

    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    public function __construct()
    {
        try {
            $this->dsn = "mysql:host=$this->host;dbname=$this->db";
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->options);
            echo "Success";
        } catch (PDOException $e) {
            var_dump($this->pdo);
        }
    }

    public function checks()
    {
        $stmt = $this->pdo->prepare('SELECT u.id as UId ,u.name as UName,o.o_id As ONum , o.time as OTime , po.price as PPrice , p.name as PName ,  po.number as PCount,p.img,p.p_id as PId 
            FROM orders o,users u,products p,products_orders po WHERE
            o.o_id = po.order_id and p.p_id = po.product_id and u.id = o.user_id');
        $users = array();
        $stmt->execute();
        $user = $stmt->fetchAll();
        var_dump($user);

        foreach ($user as $row) {
            if (!isSet($users[$row['UId']]['Orders'][$row['ONum']]['Products']))
                $users[$row['UId']]['Orders'][$row['ONum']]['Products'] = array();
            $users[$row['UId']]['UName'] = $row['UName'];
            $users[$row['UId']]['Orders'][$row['ONum']]['OTime'] = $row['OTime'];
            array_push($users[$row['UId']]['Orders'][$row['ONum']]['Products'], (array($row['PName'], $row['PCount'], $row['PPrice'])));
        }
        // print_r($users);
        return $users;
    }

    //SELECT o.o_id o.time, o.status, o.total from orders o where o.user_id = 3 Date between 2011/02/25 and 2011/02/27;
    public function userOrders($userId,$start,$end,$page)
    {
        $offset = $page >= 0 ? $page*4 : 0;

        $stmt = $this->pdo->prepare("SELECT o.o_id As oNum , o.time as OTime , o.total as total ,
                                              o.status as status, po.price as PPrice , p.name as PName ,
                                              po.number as PCount,p.img as img FROM orders o,products p,
                                              products_orders po WHERE o.o_id = po.order_id 
                                              and p.p_id = po.product_id and o.user_id = $userId
                                              and o.time between ? AND ? LIMIT 0 , 4 ");
        $orders = array();
        $stmt->execute(array($start,$end));
        $order = $stmt->fetchAll();

        foreach ($order as $row) {
            $i=0;
            if (!isSet($orders[$row['oNum']]["Products"]))
                $orders[$row['oNum']]["Products"] = array();
            $orders[$row['oNum']]['oNum'] = $row['oNum'];
            $orders[$row['oNum']]['time'] = $row['OTime'];
            $orders[$row['oNum']]['status'] = $row['status'];
            $orders[$row['oNum']]['total'] = $row['total'];
                array_push($orders[$row['oNum']]["Products"], (array("PName"=>$row["PName"],"count" => $row['PCount'],
                    "price"=>$row['PPrice'] , "img"=>$row['img'])));



            // print_r($users);
        }
        return $orders;

    }
}

