<?php
session_start();
require 'db.php';

// Batasi hanya admin yang bisa akses
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit();
}

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Pengguna - Admin WellU</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 font-inter p-8">

  <div class="max-w-5xl mx-auto bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold text-blue-800 mb-6">Daftar Pengguna</h2>

    <a href="create.php" class="inline-block mb-4 bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">+ Tambah User</a>

    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-200 rounded-lg">
        <thead class="bg-blue-600 text-white">
          <tr>
            <th class="px-4 py-2 text-left">ID</th>
            <th class="px-4 py-2 text-left">Username</th>
            <th class="px-4 py-2 text-left">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr class="border-t hover:bg-gray-50">
              <td class="px-4 py-2"><?= htmlspecialchars($row['id']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['username']) ?></td>
              <td class="px-4 py-2 space-x-2">
                <a href="update.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:underline">Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus user ini?')" class="text-red-600 hover:underline">Hapus</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <a href="admindashboard.php" class="inline-block mt-6 text-blue-600 hover:underline">&larr; Kembali ke Dashboard</a>
  </div>

</body>
</html>
