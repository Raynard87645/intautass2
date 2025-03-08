<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ../views/auth/login.php');
        exit();
    }
}

function login($email, $password) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        die("Error executing query: " . $stmt->error);
    }
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            return true;
        }
    } else {
        echo "No user found with email: $email";
    }

    $stmt->close();
    $conn->close();

    return false;
}

function logout() {
    session_destroy();
    header('Location: ../views/auth/login.php');
    exit();
}
?>
