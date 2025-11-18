<?php
$conn = mysqli_connect("localhost", "root", "", "bookstore_db");

if ($conn) {
    echo "✅ Database connection successful!";
} else {
    echo "❌ Connection failed: " . mysqli_connect_error();
}
?>
