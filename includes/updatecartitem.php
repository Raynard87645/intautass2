<?php 
require_once "includes/cart.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $quantity = $_POST['quantity'];
        updateCartItem($id, $quantity);
        echo json_encode(["count" => getCartTotalItems(), "subtotal" => getCartSubTotalPrice(), "total" => getCartTotalPrice()]);
    }
?>

