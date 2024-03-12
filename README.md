# cURL_POST
How to use cURL to send POST with PHP.

## 1. Sending a POST Request with cURL:

```php
// URL to which the POST request will be sent
$url = 'http://127.0.0.1/cURL_4/insert/';

// Data to be sent in the POST request
$data = [
    'name' => 'XxZeroxX',
    'age' => 24,
    'message' => 'Testing Post via cURL'
];

// Convert data to JSON format
$json = json_encode($data);

// Headers to be sent with the POST request
$headers = [
    // Indicate that the content is JSON
    'Content-Type: application/json',
    // Specify the length of the content
    'Content-Length: ' . strlen($json)
];

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options
curl_setopt_array($ch, [
    // Return the response as a string instead of outputting it directly
    CURLOPT_RETURNTRANSFER => true,
    // Set the request type to POST
    CURLOPT_CUSTOMREQUEST  => 'POST',
    // Set the headers
    CURLOPT_HTTPHEADER => $headers,
    // Set the POST data
    CURLOPT_POSTFIELDS => $json
]);

// Execute the cURL request and store the response
$result = curl_exec($ch);

// Check for any cURL errors
if(curl_errno($ch)) {
    // Output error message
    echo 'Erro ao enviar requisição cURL: ' . curl_error($ch);
}

// Close the cURL session
curl_close($ch);

// Output the response from the server
echo $result;

```

- This script sends a POST request to a specified URL ($url) using cURL.
- It constructs JSON data ($json) from an associative array ($data).
- Headers are set to indicate that the content being sent is JSON.
- A cURL session is initialized and configured with options such as request type, headers, and POST data.
- The request is executed (curl_exec) and the response is stored in $result.
- Error handling is done to check for cURL errors (curl_errno) and output them if any.
- Finally, the cURL session is closed, and the response from the server is output.

## 2. Handling POST Request Data and Inserting into Database:

```php
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

```

- This script handles incoming POST data sent to the server.
- It includes a database connection configuration file (conect.php).
- The raw POST data is retrieved using file_get_contents('php://input').
- The JSON data is decoded into an associative array.
- SQL statement is prepared to insert data into a "user" table with placeholders for values.
- Parameters are bound with values from the JSON data to prevent SQL injection.
- The SQL statement is executed.
- If insertion is successful, it echoes a success message; otherwise, any exceptions caught during execution are printed.

These two scripts work together: the first sends a POST request with JSON data, and the second receives this data, inserts it into a database table.