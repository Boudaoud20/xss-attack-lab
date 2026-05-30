<?php
$conn = mysqli_connect("localhost", "abdo", "test1234", "xss_lab");

if (!$conn) {
    die("Database connection failed");
}

mysqli_set_charset($conn, "utf8mb4");
?>
<link rel="stylesheet" href="style.css">