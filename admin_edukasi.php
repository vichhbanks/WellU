<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit();
}

$result = mysqli_query($conn, "SELECT * FROM edukasi ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Konten Edukasi - Admin WellU</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 250px;
      height: 100vh;
      background: #3b82f6;
      padding: 60px 20px;
      color: white;
    }

    .sidebar-link {
      display: block;
      color: white;
      padding: 12px 16px;
      margin-bottom: 10px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      transition: background-color 0.3s;
    }

    .sidebar-link:hover {
      background-color: rgba(255, 255, 255, 0.2);
    }

    .sidebar-link.active {
      background-color: white;
      color: #3b82f6;
    }

    .content {
      margin-left: 260px;
      padding: 2rem;
    }
  </style>
</head>
<body class="bg-gray-100 font-inter">

<!-- Sidebar -->
<div class="sidebar">
  <h2 class="text-2xl font-bold mb-6">Admin Panel</h2>
  <a href="admindashboard.php" class="sidebar-link">Dashboard</a>
  <a href="admin_edukasi_list.php" class="sidebar-link active">Konten Edukasi</a>
  <a href="admin_konsultasi.php" class="sidebar-link">Data Konsultasi</a>
  <a href="logout.php" class="sidebar-link text-red-300">Logout</a>
</div>

<!-- Konten -->
<div class="content">
  <div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-blue-900">Semua Konten Edukasi</h1>
    <a href="kelola_edukasi.php" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
      + Kelola Edukasi
    </a>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all duration-300">
        <h3 class="text-lg font-semibold text-blue-800 mb-2"><?= htmlspecialchars($row['judul']) ?></h3>
        <p class="text-sm text-gray-600 mb-4"><?= nl2br(htmlspecialchars($row['ringkasan'])) ?></p>
        <a href="detail_edukasi.php?id=<?= $row['id'] ?>" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Lihat Selengkapnya</a>
      </div>
    <?php endwhile; ?>
  </div>
</div>

</body>
</html>

