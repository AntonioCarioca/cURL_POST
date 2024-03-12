<?php

// Import the database connection configuration
require_once __DIR__ . '/../conexao.php';

// Get the raw POST data
$input = file_get_contents('php://input');

// Decode the JSON data into an associative array
$data = json_decode($input, true);

try {
    // Prepare SQL statement for inserting data into the "user" table
    $sql = 'INSERT INTO "user"(name,age,message) VALUES(:name,:age,:message)';
    $result = $conn->prepare($sql);

    // Bind parameters with values from the JSON data
    $result->bindParam(':name', $data['name'], PDO::PARAM_STR);
    $result->bindParam(':age', $data['age'], PDO::PARAM_INT);
    $result->bindParam(':message', $data['message'], PDO::PARAM_STR);

    // Execute the SQL statement
    $result->execute();

    // Check if the insertion was successful
    if ($result) {
        echo "User was inserted";
    }

} catch (Exception $e) {
    // Print any exceptions that occur during the execution
    print $e->getMessage();
}
