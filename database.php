
<?php

    // Database configuration
    $host = $_ENV['DB_HOST'];
    $username = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
    $database = $_ENV['DB_DATABASE'];
    $port = $_ENV['DB_PORT'];

    // Create a connection
    try {
        $conn = new mysqli("$host", $username, $password, $database);
    } catch (\Throwable $th) {
        throw $th;
    }

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
