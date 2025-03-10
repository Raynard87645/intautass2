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

function loginCSV($email, $password) {
    global $usersCSV;
    
    if (($handle = fopen($usersCSV, 'r')) !== FALSE) {
        $headers = fgetcsv($handle, 1000, ',');
        $results = [];

        while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $users = array_combine($headers, $row);
            if (strpos($users["email"], $email) !== FALSE) {
                $results[] = $users;
            }
        }

        // Close the file handle
        fclose($handle);
        
        if (!empty($results)) {            
            $user = $results[0];
            if (!empty($user) && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = "{$user['first_name']} {$user['last_name']}";
                $_SESSION['username'] = $user['username'];
                return true;
            }
        
        } else {
            echo "No user found with email: $email";
        }
        return false;
    } else {
        echo "Error: Unable to open the table you are looking for.\n";
    }
}

function logout() {
    session_destroy();
    header('Location: ../views/auth/login.php');
    exit();
}
?>
