<?php 
    include "../config.php";
    include "../config/database.php";
    include "../layout/app.php"; 

    $sqlFile = __DIR__.'/schema.sql';
    if (!file_exists($sqlFile)) {
        die("Error: The .sql file does not exist.");
    }else{
        echo "<h5>Importing SQL file for mysql database ... </h5>\r\n";
    }

    $sql = file_get_contents($sqlFile);

    // Execute the SQL commands
    if ($conn->multi_query($sql)) {
        echo "<h5>SQL file imported successfully. ... </h5>\r\n";
    } else {
        echo "Error importing SQL file: " . $conn->error;
    }

    // Close the connection
    $conn->close();

    
    $database = [
        // "tbl_users" => [
        //     ['id' => 1, 'first_name' => 'John', 'last_name' => 'Doe', 'username' => "john", 'email' => 'john@example.com', "password" => password_hash("password", PASSWORD_DEFAULT)],
        //     ['id' => 2, 'first_name' => 'Jane', 'last_name' => 'Smith', 'username' => "jane", 'email' => 'jane@example.com', "password" => password_hash("password", PASSWORD_DEFAULT)],
        //     ['id' => 3, 'first_name' => 'Alice', 'last_name' => 'Johnson', 'username' => "alice",  'email' => 'alice@example.com', "password" => password_hash("password", PASSWORD_DEFAULT)],
        // ],
        "users" => [
            ['id' => 1, 'first_name' => 'John', 'last_name' => 'Doe', 'username' => "john", 'email' => 'john@example.com', "password" => password_hash("password", PASSWORD_DEFAULT)],
            ['id' => 2, 'first_name' => 'Jane', 'last_name' => 'Smith', 'username' => "jane", 'email' => 'jane@example.com', "password" => password_hash("password", PASSWORD_DEFAULT)],
            ['id' => 3, 'first_name' => 'Alice', 'last_name' => 'Johnson', 'username' => "alice",  'email' => 'alice@example.com', "password" => password_hash("password", PASSWORD_DEFAULT)],
        ],
        "products" => [
            ["id" => 1, "name" => "Fry Chicken", "description" => "Fry chicken mixed with fries", "price" =>  299.99, "category" => "Dairy product", "image_url" => "/public/images/img1.jpg", "status" => false],
            ["id" => 2, "name" => "Burger", "description" => "Beef burger with cheese. A juicy treat with juice", "price" => 199.99, "category" => "Dairy product", "image_url" => "/public/images/img2.jpg", "status" => false],
            ["id" => 3, "name" => "Pasta Salad", "description" => "Chicken chunks mixed with macaroni and varnish", "price" => 999.99, "category" => "Vegetable", "image_url" => "/public/images/img3.jpg", "status" => true],
            ["id" => 4, "name" => "Cherry", "description" => "Sorted and freshly picked cherry.", "price" => 421.99, "category" => "Dairy", "image_url" => "/public/images/img4.jpg", "status" => true],
            ["id" => 5, "name" => "Fry Fish", "description" => "Cooked to perfection.", "price" => 30.99, "category" => "Fruits", "image_url" => "/public/images/img5.jpg", "status" => true],
            ["id" => 6, "name" => "Chicken", "description" => "Fresh chicken tenders.", "price" => 299.99, "category" => "Meet", "image_url" => "/public/images/img6.jpg", "status" => true],
            ["id" => 9, "name" => "Fry Chicken", "description" => "Fry chicken mixed with fries", "price" =>  299.99, "category" => "Dairy product", "image_url" => "/public/images/img1.jpg", "status" => false],
            ["id" => 8, "name" => "Burger", "description" => "Beef burger with cheese. A juicy treat with juice", "price" => 199.99, "category" => "Dairy product", "image_url" => "/public/images/img2.jpg", "status" => false],
            ["id" => 7, "name" => "Pasta Salad", "description" => "Chicken chunks mixed with macaroni and varnish", "price" => 999.99, "category" => "Vegetable", "image_url" => "/public/images/img3.jpg", "status" => true],
            ["id" => 10, "name" => "Cherry", "description" => "Sorted and freshly picked cherry.", "price" => 421.99, "category" => "Dairy", "image_url" => "/public/images/img4.jpg", "status" => true],
            ["id" => 11, "name" => "Fry Fish", "description" => "Cooked to perfection.", "price" => 30.99, "category" => "Fruits", "image_url" => "/public/images/img5.jpg", "status" => true],
            ["id" => 12, "name" => "Chicken", "description" => "Fresh chicken tenders.", "price" => 299.99, "category" => "Meet", "image_url" => "/public/images/img6.jpg", "status" => true],
        ]
    ];

    foreach ($database as $key => $table) {
        $csvFile =  __DIR__."/{$key}.csv";
        echo "<h5>Seeding data for {$key} ... </h5>\r\n";
        
        // Open the CSV file for writing
        if (($handle = fopen($csvFile, 'w')) !== FALSE) {
            // Write the header row
            fputcsv($handle, array_keys($table[0]));

            // Write each user's data as a row in the CSV file
            foreach ($table as $column) {
                fputcsv($handle, $column);
            }

            // Close the file handle
            fclose($handle);

            echo "<h5>Seeding data for {$key} completed successfully. </h5>\r\n";
        } else {
            echo "<h5>Error: Unable to open the CSV file for writing. </h5>\n";
        }
    }



    