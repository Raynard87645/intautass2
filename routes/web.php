<?php

try {
    //code...
    
$request = explode("?", $_SERVER['REQUEST_URI'])[0];
$viewDir = __DIR__ ."/../views/";
$baseDir = __DIR__ ."/../";

switch ($request) {
    case '':
        
    case '/':
        require "{$baseDir}landing.php";
        break;

    case '/addcart':
        require "{$baseDir}includes/addcart.php";
        break;
        
    case '/contact':        
        require  "{$viewDir}contact.php";
        break;

    case '/faq':        
        require  "{$viewDir}faq.php";
        break;

    case '/dashboard':        
        require  "{$viewDir}dashboard.php";
        break;

    case '/products':        
        require  "{$viewDir}products.php";
        break;

    case '/cart':        
        require  "{$viewDir}cart.php";
        break;

    case '/checkout':        
        require  "{$viewDir}checkout.php";
        break;

    case '/payment-success':        
        require  "{$viewDir}paymentsuccess.php";
        break;

    case '/login':        
        require  "{$viewDir}auth/login.php";
        break;

    case '/register':        
        require  "{$viewDir}auth/register.php";
        break;

    default:
        // echo __DIR__ . $viewDir . 'admin/dashboard.php';
        http_response_code(404);
        require __DIR__ . $viewDir . '404.php';
}

} catch (\Throwable $th) {
    echo $th;
}