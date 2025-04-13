<?php
    session_start();

    // Initialize cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    function clearCart() {
        unset($_SESSION['cart']);
    }

    function productInCart($productId) {
        if (isset($_SESSION['cart'][$productId])) return $_SESSION['cart'][$productId];

        return false;
    }

    function addToCart($productId, $quantity = 1, $price = 0, $name = '', $avatar = '', $category = '', $options = []) {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = [
                'quantity' => $quantity,
                'price' => $price,
                'name' => $name,
                'category' => $category,
                'avatar' => $avatar,
                'options' => $options,
                'added_at' => time()
            ];
        }
    }


    function removeFromCart($productId) {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
            return true;
        }
        return false;
    }


    function updateCartItem($productId, $quantity) {
        if (isset($_SESSION['cart'][$productId]) && $quantity > 0) {
            $_SESSION['cart'][$productId]['quantity'] = $quantity;
            return true;
        }
        return false;
    }

    function getCartContents() {
        return $_SESSION['cart'] ?? [];
    }
    
    // Get total items in cart (count of quantities)
    function getCartTotalItems() {
        $total = 0;
        foreach ($_SESSION['cart'] as $key => $item) {
            $total += (int)$item['quantity'];
        }
        return $total;
    }
    
    // Calculate cart total price
    function getCartSubTotalPrice() {
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['quantity'] * $item['price'];
        }
        return $total;
    }

    function getCartTotalPrice() {
        $total = 20;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['quantity'] * $item['price'];
        }
        return $total + (0.15 * $total);
        // return getCartSubTotalPrice() + 20;
    }