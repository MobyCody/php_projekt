<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_firmentechnik";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tbl_firmentechnik";
$result = $conn->query($sql);
