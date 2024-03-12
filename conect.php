<?php

$name = 'cURL';
$user = 'zero';
$pass = 'XxZero123xX';
$host = '127.0.0.1';
$port = '5432';

try {
$conn = new PDO("pgsql:dbname={$name}; user={$user}; password={$pass}; host={$host}; port={$port}");
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
	echo 'Error: Database connection not successful ' . $err->getMessage();
}
