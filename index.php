<?php
// header is for each page
// body
include 'tempelates/userHeader.php';
session_start() ; 

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// echo $request;
switch ($request) {
    //israa
    case '/' :
        require __DIR__ . '/pages/login.php';
        break;
        //Motaz
    case '/orders' :
        require __DIR__ . '/pages/myOrders.php';
        break;
    case '/cancelOrder' :
        require __DIR__ . '/controllers/cancelOrder.php';
        break;
    case '/generateMyOrders' :
        require __DIR__ . '/controllers/generateMyOrders.php';
        break;
        //Khaled - Alaa
    case '/home' :
        require __DIR__ . '/pages/userHomePage.php';
        break;
        //Nouran
    case '/admin-addproduct' :
        require __DIR__ . '/pages/addProducts.php';
        break;
        //Israa
    case '/admin-adduser' :
        require __DIR__ . '/pages/addUser.php';
        break;
        //Shawkat
    case '/admin-checks' :
        require __DIR__ . '/pages/checks.php';
        break;
        //Alaa
    case '/admin-orders' :
        require __DIR__ . '/pages/adminReceivedOrders.php';
        break;
        //khaled
    case '/admin/manual' :
        require __DIR__ . '/pages/adminOrder.php';
        break;
        //nouran
    case '/admin/products' :
        require __DIR__ . '/pages/adminProducts.php';
        break;
        //Israa
    case '/admin/users' :
        require __DIR__ . '/pages/adminUsers.php';
        break;
    case '/function' :
        require __DIR__ . '/controllers/functions.php';
        break;
    case '/admin' :
        require __DIR__ . '/pages/adminHome.php';
        break;
    default:
        require __DIR__ . '/pages/404.php';
        break;
}
include 'tempelates/footer.php';