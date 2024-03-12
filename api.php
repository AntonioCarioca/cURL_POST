<?php

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
