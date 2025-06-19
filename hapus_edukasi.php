<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit();
}

include 'db.php';

// Periksa apakah parameter ID tersedia
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Siapkan dan jalankan query hapus
    $stmt = $conn->prepare("DELETE FROM edukasi WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect kembali ke halaman kelola edukasi
        header("Location: kelola_edukasi.php");
        exit();
    } else {
        echo "Gagal menghapus data.";
    }

    $stmt->close();
} else {
    echo "ID tidak ditemukan.";
}

$conn->close();
?>
