<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Selamat datang, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
