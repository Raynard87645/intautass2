
<?php

$dbtype = $_ENV['DB_TYPE']||"mysql";
$dbhost = $_ENV['DB_HOST'];
$dbusername = $_ENV['DB_USERNAME'];
$dbpassword = $_ENV['DB_PASSWORD'];
$dbdatabase = $_ENV['DB_DATABASE'];

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbdatabase);


$usersCSV = __DIR__.'/../database/users.csv';
$productsCSV = __DIR__.'/../database/products.csv';
// $databaseSql = __DIR__.'/../database/schema.sql';

// echo $port;



// // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Open the CSV file for reading
// if (($handle = fopen($csvFile, 'r')) !== FALSE) {
//     // Read the header row
//     $headers = fgetcsv($handle, 1000, ',');

//     // Define your query criteria
//     $searchColumn = 'name'; // Column to search in
//     $searchValue = 'John';  // Value to search for

//     // Initialize an array to store the results
//     $results = [];

//     // Loop through each row in the CSV file
//     while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
//         // Combine the headers with the row data to create an associative array
//         $rowData = array_combine($headers, $row);

//         // Check if the row matches the query criteria
//         if ($rowData[$searchColumn] === $searchValue) {
//             // Add the matching row to the results array
//             $results[] = $rowData;
//         }
//     }

//     // Close the file handle
//     fclose($handle);

//     // Output the results
//     if (!empty($results)) {
//         echo "Found " . count($results) . " matching records:\n";
//         print_r($results);
//     } else {
//         echo "No matching records found.\n";
//     }
// } else {
//     echo "Error opening the CSV file.\n";
// }
?>
