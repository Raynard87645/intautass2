<?php

try {
$viewDir = __DIR__ ."/../views/";
$baseDir = __DIR__ ."/../";
$requestUri = strtok($_SERVER['REQUEST_URI'], '?');
$basePath = dirname($_SERVER['SCRIPT_NAME']);

$baseroutes = [
    '/' => 'landing.php',
    '/addcart' => 'includes/addcart.php',
    '/delete-cartitem' => 'includes/removecartitem.php',
    '/update-cartitem' => 'includes/updatecartitem.php',
    '/seed/database' => 'database/seed.php'
];

$viewroutes = [
    '/contact' => 'contact.php',
    '/about-us' => 'about.php',
    '/faq' => 'faq.php',
    '/dashboard' => 'dashboard.php',
    '/products' => 'products.php',
    '/products/{id}' => 'product-details.php',
    '/cart' => 'cart.php',
    '/checkout' => 'checkout.php',
    '/payment-success' => 'paymentsuccess.php',
    '/login' => 'auth/login.php',
    '/register' => 'auth/register.php'
];


$matched = false;

foreach ($baseroutes as $route => $handler) {
    $pattern = '#^' . preg_replace('/\{(\w+)\}/', '(?<$1>[^/]+)', $route) . '$#';
    
    if (preg_match($pattern, $requestUri, $matches)) {
        $matched = true;
        $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

        require "{$baseDir}/{$handler}";
        break;
    }
}

foreach ($viewroutes as $route => $handler) {
    $pattern = '#^' . preg_replace('/\{(\w+)\}/', '(?<$1>[^/]+)',  $route) . '$#';
    if (preg_match($pattern, $requestUri, $matches)) {
        $matched = true;
        $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
        // $params = array_merge($params, $_GET);
        require "{$viewDir}/{$handler}";
        break;
    }
}

if(!$matched){
// Handle missing route file
http_response_code(404);
require "{$viewDir}404.php";
}



} catch (\Throwable $th) {
    echo $th;
}