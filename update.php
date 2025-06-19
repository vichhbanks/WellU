<?php
include 'db.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
    $stmt->bind_param("ssi", $username, $hashed_password, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal memperbarui data: " . $conn->error;
    }
}

// Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID tidak valid");
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if (!$data) {
    die("Data tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pengguna</title>
</head>
<body>
    <h2>Edit Data Pengguna</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">
        <input type="text" name="username" value="<?= htmlspecialchars($data['username']) ?>" required>
        <input type="password" name="password" placeholder="Masukkan password baru" required>
        <button type="submit" name="update">Simpan</button>
    </form>
</body>
</html>
