<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - WellU</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Sidebar -->
  <input type="checkbox" id="toggle" class="hidden">
  <label for="toggle" class="hamburger fixed top-4 left-4 z-50 cursor-pointer">
    <div class="w-8 h-1 bg-blue-800 my-1"></div>
    <div class="w-8 h-1 bg-blue-800 my-1"></div>
    <div class="w-8 h-1 bg-blue-800 my-1"></div>
  </label>

  <div class="fixed top-0 left-0 w-64 h-full bg-blue-600 text-white transform -translate-x-full transition-transform duration-300 z-40" id="sidebar">
    <div class="p-6">
      <a href="admin_dashboard.php" class="text-2xl font-bold bg-white text-blue-600 px-4 py-2 rounded-lg inline-block mb-6">WellU Admin</a>
      <nav class="space-y-2">
        <a href="admin_dashboard.php" class="block px-4 py-2 rounded hover:bg-blue-700 bg-white text-blue-600">Dashboard</a>
        <a href="kelola_edukasi.php" class="block px-4 py-2 rounded hover:bg-blue-700">Kelola Edukasi</a>
        <a href="konsultasi_admin.php" class="block px-4 py-2 rounded hover:bg-blue-700">Data Konsultasi</a>
        <a href="read.php" class="block px-4 py-2 rounded hover:bg-blue-700">Manajemen Pengguna</a>
        <a href="logout.php" class="block px-4 py-2 rounded hover:bg-red-700 text-red-100">Logout</a>
      </nav>
    </div>
  </div>

  <!-- Content -->
  <div class="ml-0 md:ml-64 p-8 transition-all duration-300">
    <h1 class="text-3xl font-bold text-blue-800 mb-4">Selamat Datang, <?= htmlspecialchars($username) ?> 👋</h1>
    <p class="text-gray-600 mb-8">Ini adalah dashboard admin. Gunakan menu di sebelah kiri untuk mengelola data aplikasi WellU.</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <h2 class="text-xl font-semibold text-blue-700 mb-2">Jumlah Edukasi</h2>
        <p class="text-gray-600">Kelola konten artikel dan video.</p>
        <a href="admin_edukasi.php" class="text-blue-600 font-medium hover:underline">Lihat &raquo;</a>
      </div>

      <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <h2 class="text-xl font-semibold text-blue-700 mb-2">Data Konsultasi</h2>
        <p class="text-gray-600">Tinjau permintaan konsultasi pengguna.</p>
        <a href="konsultasi_admin.php" class="text-blue-600 font-medium hover:underline">Lihat &raquo;</a>
      </div>

      <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
        <h2 class="text-xl font-semibold text-blue-700 mb-2">Manajemen Pengguna</h2>
        <p class="text-gray-600">Tambah atau hapus akun pengguna.</p>
        <a href="read.php" class="text-blue-600 font-medium hover:underline">Lihat &raquo;</a>
      </div>
    </div>
  </div>

  <script>
    const toggle = document.getElementById('toggle');
    const sidebar = document.getElementById('sidebar');
    toggle.addEventListener('change', () => {
      sidebar.classList.toggle('-translate-x-full');
    });
  </script>

</body>
</html>
