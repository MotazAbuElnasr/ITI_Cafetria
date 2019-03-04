<?php
// require_once('user.php');
// require_once('product.php');
// require_once('order.php');
class dbManger{
    
private $host = 'localhost';
private $db   = 'NEWITISYSTEM';
private $user = 'Shawkat';
private $pass = 'root';
private $charset = 'utf8mb4';
private $dsn  = "";
private $pdo ;

private $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
public function __construct(){
    try {
        $this->dsn  = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->options);
        echo "Success";
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}
public function checks(){
    $stmt = $this->pdo->prepare('SELECT u.id as UId ,u.name as UName,o.o_id As ONum , o.time as OTime , po.price as PPrice , p.name as PName ,  po.number as PCount,p.img,p.p_id as PId 
            FROM orders o,users u,products p,products_orders po WHERE
            o.o_id = po.order_id and p.p_id = po.product_id and u.id = o.user_id');
    $users = array();
    $stmt->execute();
    $user = $stmt->fetchAll();
        foreach ($user as $row)
        {   
            echo $row['PName'];
            if(!isSet($users[$row['UId']]['Orders'][$row['ONum']]['Products']))$users[$row['UId']]['Orders'][$row['ONum']]['Products']=array();
            $users[$row['UId']]['UName'] = $row['UName'];
            $users[$row['UId']]['Orders'][$row['ONum']]['OTime'] = $row['OTime'];
            array_push($users[$row['UId']]['Orders'][$row['ONum']]['Products'],(array($row['PName'],$row['PCount'],$row['PPrice'])));
        }
        // print_r($users);
        return $users;
    }
}