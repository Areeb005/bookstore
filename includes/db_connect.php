<?php
// includes/db_connect.php
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = ''; // change if needed
$DB_NAME = 'bookstore_db';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>
