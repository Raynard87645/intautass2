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
    try {
        //code...
   
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
            $_SESSION['name'] = "{$user['first_name']} {$user['last_name']}";
            $_SESSION['username'] = $user['username'];
            return true;
        }
    } else {
        echo "No user found with email: $email";
    }

    $stmt->close();
    $conn->close();

    return false;
} catch (\Throwable $th) {
    echo $th;
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
    header('Location: ../');
    exit();
}
?>
