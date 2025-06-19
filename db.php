<?php

$hostname = "localhost";
$username = "root";
$password = "";
$db = "aplikasi";

$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("koneksi gagal: " .
$conn->connect_error);
}
?>
