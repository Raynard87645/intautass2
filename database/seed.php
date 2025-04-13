<?php 
    include "config.php";
    include "config/database.php";
    include "layout/app.php"; 

    $sqlFile = __DIR__.'/schema.sql';
    if (!file_exists($sqlFile)) {
        die("Error: The .sql file does not exist.");
    }else{
        echo "<h5>Importing SQL file for mysql database ... </h5>\r\n";
    }
try {
    //code...


    $sql = file_get_contents($sqlFile);
    if ($sql === false) {
        die("Error reading SQL file");
    }
// echo $sql;
    // Execute multi-query
    if ($conn->multi_query($sql)) {
        do {
            // Store first result set
            if ($result = $conn->store_result()) {
                $result->free();
            }
        } while ($conn->more_results() && $conn->next_result());
        
        echo "SQL import completed successfully";
    } else {
        echo "Error during import: " . $conn->error;
    }
} catch (\Throwable $th) {
    echo $th;
}
    // Close the connection
    $conn->close();

    


    