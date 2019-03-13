<?php

// header is for each page
// body
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
switch ($request) {
    //israa
    case '/':
        require __DIR__.'/pages/login.php';
        break;
        //Motaz
    case '/orders':
        require __DIR__.'/pages/myOrders.php';
        break;
        //Khaled - Alaa
    case '/home':
        require __DIR__.'/pages/userHomePage.php';
        break;
        //Nouran
    case '/admin/addproduct':
        require __DIR__.'/pages/addProducts.php';
        break;
        //Israa
    case '/admin/adduser':
        require __DIR__.'/pages/addUser.php';
        break;
        //Shawkat
    case '/admin/checks':
        require __DIR__.'/pages/checks.php';
        break;
        //Alaa
    case '/admin/orders':
        require __DIR__.'/pages/adminReceivedOrders.php';
        break;
        //khaled
    case '/admin/manual':
        require __DIR__.'/pages/adminOrder.php';
        break;
        //nouran
    case '/admin/products':
        require __DIR__.'/pages/main.php';
        break;
        //Israa
    case '/admin/users':
        require __DIR__.'/pages/adminUsers.php';
        break;

    default:
        require __DIR__.'/pages/404.php';
        break;
}
// footer
include 'tempelates/footer.php';

//  ./lampp start
// sudo /etc/init.d/mysql stop
