
<?php
//  require_once __DIR__.'../config.php';
// echo "asdiasudia";
// Database configuration
$host = $_ENV['DB_HOST'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_DATABASE'];
$port = $_ENV['DB_PORT'];

// echo $port;
$conn = new mysqli("$host", $username, $password, $database);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start a transaction
// $conn->begin_transaction();

// try {
//     // Read the SQL file
//     $sql = file_get_contents($sqlFile);

//     // Execute the SQL commands
//     if ($conn->multi_query($sql)) {
//         echo "SQL file executed successfully";
//         $conn->commit(); // Commit the transaction
//     } else {
//         throw new Exception("Error executing SQL file: " . $conn->error);
//     }
// } catch (Exception $e) {
//     $conn->rollback(); // Rollback the transaction
//     echo $e->getMessage();
// }


// // Prepare and bind
// // $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
// // $stmt->bind_param("ss", $name, $email);

// // // Set parameters and execute
// // $name = "Bob Brown";
// // $email = "bob@example.com";
// // $stmt->execute();

// // echo "New record created successfully";

// // Close the connection
// $stmt->close();
// $conn->close();
?>
