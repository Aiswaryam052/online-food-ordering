<?php
$conn = new mysqli("localhost", "root", "", "online food ordering");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
