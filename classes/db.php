<?php
// require_once('user.php');
// require_once('product.php');
// require_once('order.php');
class DbManager
{
  private $host = 'remotemysql.com';
  private $db = 'ZYQoYMYzrK';
  private $user = 'ZYQoYMYzrK';
  private $pass = 'uRp0Kci943';
  private $charset = 'utf8mb4';
  private $dsn = '';
  public $pdo;
//   Username: ZYQoYMYzrK

// Database name: ZYQoYMYzrK

// Password: uRp0Kci943

// Server: remotemysql.com
    //    private $host = 'localhost';
    //    private $db = 'cafetria'; // iti_cafe
    //    private $user = 'root';
    //    private $pass = '';
    //    private $charset = 'utf8mb4';
    //    private $dsn = "";
    //    public $pdo;
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
            // echo "Success" ;
        } catch (PDOException $e) {
            // echo "ERROR";/PName
            // var_dump($this->pdo);
        }
    }
    public function checks($start, $end, $uid, $page)
    {
        $dateCondition = '';
        $userCondition = '';
        $limitCondition = '';
        if (isset($start) && !empty($start) && isset($end) && !empty($end)) {
            $dateCondition = " and o.time BETWEEN '$start 00:00:00' and  '$end 23:59:59' ";
        }
        if (isset($uid) && !empty($uid)) {
            $userCondition = " and u.id = $uid ";
        }
        if (isset($page) && !empty($page)) {
            $offset = $page > 0 ? ($page - 1) * 4 : 0;
            $limitCondition = " LIMIT 4 OFFSET $offset ";
        }
        $stmt = $this->pdo->prepare("SELECT u.id as UId ,u.name as UName,o.o_id As ONum , o.time as OTime , o.total as OTotal, po.price as PPrice , p.name as PName ,  po.number as PCount , p.img as PImg ,p.p_id as PId 
        FROM orders o,(select DISTINCT u.id as id , u.name as name from users u,orders o 
        where u.id = o.user_id  $dateCondition $limitCondition ) as u,products p,products_orders po WHERE
        o.o_id = po.order_id and p.p_id = po.product_id and u.id = o.user_id".$userCondition);
        $users = array();
        $stmt->execute();
        $user = $stmt->fetchAll();
        foreach ($user as $row) {
            if (!isset($users[$row['UId']]['Orders'][$row['ONum']]['Products'])) {
                $users[$row['UId']]['Orders'][$row['ONum']]['Products'] = array();
            }
            $users[$row['UId']]['UName'] = $row['UName'];
            $row['PImg'] = '../assets/images'.$row['PImg'];
            $users[$row['UId']]['Orders'][$row['ONum']]['OTime'] = $row['OTime'];
            $users[$row['UId']]['Orders'][$row['ONum']]['OTotal'] = $row['OTotal'];
            array_push($users[$row['UId']]['Orders'][$row['ONum']]['Products'], (array($row['PName'], $row['PCount'], $row['PPrice'], $row['PImg'])));
        }
        // print_r($users);
        return $users;
    }
    //pagination
    //SELECT o.o_id As oNum , o.time as OTime , o.total as total ,
    //o.status as status, po.price as PPrice , p.name as PName ,
    //po.number as PCount,p.img as img FROM
    //(SELECT ord.o_id, ord.time, ord.total ,
    //ord.status, ord.user_id FROM orders ord limit 4 OFFSET 4 ) as o,
    //products p,
    //products_orders po WHERE o.o_id = po.order_id
    //and p.p_id = po.product_id and o.user_id = 3
    public function userOrders($userId, $start, $end, $page)
    {
        $dateCondition = " and o.time BETWEEN '$start 00:00:00' and  '$end 23:59:59'";
        $offset = $page > 0 ? ($page - 1) * 4 : 0;
        $limitCondition = " LIMIT 4 OFFSET $offset ";
        $stmt = $this->pdo->prepare("SELECT o.o_id As oNum , o.time as OTime , o.total as total ,
                o.status as status, po.price as PPrice , p.name as PName ,
                po.number as PCount,p.img as img FROM
                (SELECT ord.o_id, ord.time, ord.total ,
                ord.status, ord.user_id FROM orders ord where ord.user_id = $userId limit 4 OFFSET $offset ) as o,
                products p,
                products_orders po WHERE o.o_id = po.order_id
                and p.p_id = po.product_id and o.user_id = $userId
                ".$dateCondition);
        $orders = array();
        $stmt->execute();
        $order = $stmt->fetchAll();
        foreach ($order as $row) {
            if (!isset($orders[$row['oNum']]['Products'])) {
                $orders[$row['oNum']]['Products'] = array();
            }
            $orders[$row['oNum']]['oNum'] = $row['oNum'];
            $orders[$row['oNum']]['time'] = $row['OTime'];
            $orders[$row['oNum']]['status'] = $row['status'];
            $orders[$row['oNum']]['total'] = $row['total'];
            array_push($orders[$row['oNum']]['Products'], (array('PName' => $row['PName'],
                'count' => $row['PCount'],
                'price' => $row['PPrice'], 'img' => $row['img'], )));
            // print_r($users);
        }
        return $orders;
    }
    // Return All Product Function  Khaled
    public function allProduct()
    {
        $q = $this->pdo->query('SELECT * FROM `products` where `status` = "available"');
        return $q;
    }
    public function createProduct($name, $price, $img, $category_id, $timestamp)
    {
        $stmt = $this->pdo->prepare('INSERT INTO products
                    VALUES ( DEFAULT , ? , ? , ? , ? , ? )');
        return $stmt->execute(array($name, $price, $img, $category_id, 'available'));
    }
    public function updateProduct($name, $price, $img, $category_id, $timestamp)
    {
        $stmt = $this->pdo->prepare('INSERT INTO products
                    VALUES ( DEFAULT , ? , ? , ? , ? , ? )');
        return $stmt->execute(array($name, $price, $img, $category_id, 'available'));
    }
    public function updateProductStatus($status,$id)
    {
        $query= "UPDATE products SET status = ? WHERE p_id = ? ;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($status,$id));
        return $status;
    }
    // Return Latest Product Function  Khaled
    public function latestProduct()
    {
        $q = $this->pdo->query('SELECT * FROM `products` where `status` = "available"  LIMIT 1,3  ');
        return $q;
    }
    public function readCategory()
    {
        $query = 'SELECT
                cat_id, name
                FROM
                categories
                ORDER BY
                name';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    //inserting user
    public function insertUser($name, $email, $password, $img, $room)
    {
        $query = "SELECT COUNT(*) as count FROM `users` WHERE  name = ? and email = ? ;" ;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array($name,$email));
        $count = $stmt->fetchAll();
        if($count[0]['count'] > 0){
            return "EXIST";
        }
        $query = "SELECT COUNT(*) FROM `users` WHERE  name = ? and email = ?" ;
        $stmt = $this->pdo->prepare("INSERT INTO `users`(`name`, `email` , `password` , `img` , `room`) VALUES
            ('$name','$email' , '$password' , '$img' ,'$room')");
        $stmt->execute();
        return "NOT EXIST";
    }
    // products Nouran
    public function getRooms()
    {
        $query = 'SELECT `room_num` FROM `rooms`';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function readProducts($from_record_num, $records_per_page)
    {
        $query = "SELECT p_id, name, img, price, cat_id , status FROM
         products
    ORDER BY
        name ASC
    LIMIT
        $from_record_num, $records_per_page";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function countAll()
    {
        $query = 'SELECT p_id FROM products';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        return $num;
    }
    public function getUsers($from_record_num, $records_per_page){
        $query = "SELECT `id` as UID, `name` as UName , `img` , `room` , `ext` FROM users , rooms 
        WHERE is_admin =0 and room_num = room ORDER BY
        name ASC
        LIMIT
        $from_record_num, $records_per_page";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt;
        $users = array();
        $user = $stmt->fetchAll();
        foreach ($user as $row) {
            $users[$row['UID']]['UID']=$row['UID'];
            $users[$row['UID']]['UName']=$row['UName'];
            $users[$row['UID']]['img']=$row['img'];
            $users[$row['UID']]['room']=$row['room'];
            $users[$row['UID']]['ext']=$row['ext'];
        }
        return $users;
    }
    public function getUser($email)
    {
        $query = "SELECT `email` FROM `users` where email = '$email'";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        if($stmt->rowCount()!=0){
            return $email;
        }
        return "";
    }
    public function deleteProduct($id)
    {
        $query = "DELETE FROM products WHERE p_id = $id";
        $stmt = $this->pdo->prepare($query);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function readName($id)
    {
        $query = 'SELECT name FROM categories WHERE cat_id = ? limit 0,1';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['name'];
    }
    public function cancelOrder($id)
    {
        $query = "DELETE FROM orders WHERE o_id = $id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
    }
    public function getUsersList()
    {
        $q = $this->pdo->query('SELECT `id` , `name` from users ');
        return $q;
    }
    public function updateUser($name , $img , $room , $uid){
        if ($img != "") {
            $query = "UPDATE users set `name` = '$name' , `img` = '$img' , `room` = $room  WHERE `id` = $uid";
        }else{
            $query = "UPDATE users set `name` = '$name' , `room` = $room  WHERE `id` = $uid";
        }
        // $users = array();
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
    }
    /**
     * @param params is array of order data
     */
    public function addOrder($params){
        try{
            // var_dump($params["price"]);
            $sql = 'INSERT INTO orders ( time, status, user_id, notes, room, total)
            VALUES ("'.$params["time"].'", "'.$params["status"].'", '.(int)$params["user_id"].', "'.$params["notes"].'",'.(int)$params["room"].','.(int)$params["price"].')';
            // use exec() because no results are returned
            $this->pdo->exec($sql);
            $order_id = $this->pdo->lastInsertId();
            for($i=0;$i< count($params["product_id"]); $i++)
            {
                try
                {
                    $sql_order = 'INSERT INTO `products_orders`(`product_id`, `order_id`, `number`, `price`) VALUES
                 ('.(int)$params["product_id"][$i].', '.(int)$order_id.', '.(int)$params["quantity"][$i].', '.(int)$params["price"][$i].')';
                    $this->pdo->exec($sql_order);
                }
                catch(PDOException $e)
                {
                    return false;
                }
            }
            return true;
        }
        catch(PDOException $e)
        {
            return false;
        }
    }
    public function login($email, $password)
    {
        $query = $this->pdo->query("SELECT `name` , `id` , `img` from users where email = '$email' and password = '$password' ");
        // var_dump($query);
        return $query;
    }
    public function changePassword($email, $password)
    {
        $query = $this->pdo->query("UPDATE users `password` set `password` = '$password' where email = '$email'");
        return $query;
    }
    public function deleteUser($uid)
    {
        $query = "DELETE FROM users WHERE `id` = $uid ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
    }
    public function showOrders()
    {
        $data = array();
        try
        {
            $query = 'SELECT * FROM users 
            JOIN orders ON users.id = orders.user_id WHERE status ="Processing" ORDER BY time DESC';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $orders = $stmt->fetchAll();
            return $orders;
        }
        catch(PDOException $e)
        {
//            echo $sql . "<br>" . $e->getMessage();
            return false;
        }
    }
    public function getProductsInOrders($oid)
    {
        try
        {
            $sql_order = 'SELECT p_id, name, img , product_id, order_id, number, products_orders.price as price FROM products_orders
             JOIN products 
             ON products_orders.product_id = products.p_id
              WHERE products_orders.order_id = '. $oid;
            $stat = $this->pdo->prepare($sql_order);
            $stat ->execute();
            $products_orders = $stat->fetchAll();
            return $products_orders;
        }
        catch(PDOException $e)
        {
//            echo $sql . "<br>" . $e->getMessage();
            return false;
        }
    }
    public function changeOrderStatus($id, $status)
    {
        try
        {
            // var_dump( $id);
            // var_dump($status);
            $sql = 'UPDATE `orders` SET `status`="'.$status.'" WHERE o_id ='.$id.' ';
            $stmt = $this->pdo->prepare($sql);
            // execute the query
            $stmt->execute();
            return true;
        }
        catch(PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
            return false;
        }
    }
    public function addCat($cat){
        $stmt = $this->pdo->prepare('INSERT INTO categories
        VALUES ( DEFAULT , ?  )');
        return $stmt->execute(array($cat));
    }
}
