<?php 
require_once "includes/cart.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo file_get_contents($_POST["id"]);
        $id = $_POST['id'];
        $price = $_POST['price'];
        $name = $_POST['name'];
        $avatar = $_POST['avatar'];
        $category = $_POST['category'];

// echo $_REQUEST["id"];
        addToCart($id, 1, $price, $name, $avatar, $category, $options = []);
        echo getCartTotalItems();
    }
?>

