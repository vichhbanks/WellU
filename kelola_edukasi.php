<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Edukasi - Admin WellU</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans min-h-screen">

<div class="ml-0 md:ml-64 p-8">

  <!-- Tombol Kembali -->
  <div class="mb-6">
    <a href="admindashboard.php" class="inline-flex items-center text-blue-700 hover:text-blue-900">
      <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2"
           viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
        <path d="M15 18l-6-6 6-6" />
      </svg>
      Kembali ke Dashboard
    </a>
  </div>

  <!-- Judul Halaman -->
  <h1 class="text-2xl font-bold text-blue-800 mb-6">Kelola Edukasi</h1>

  <!-- Tombol Tambah -->
  <a href="tambah_edukasi.php"
     class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block shadow">
    + Tambah Edukasi
  </a>

  <!-- Tabel Edukasi -->
  <div class="overflow-x-auto">
    <table class="w-full table-auto bg-white rounded-lg shadow">
      <thead>
        <tr class="bg-blue-600 text-white">
          <th class="px-4 py-2 text-left">Judul</th>
          <th class="px-4 py-2 text-left">Tipe</th>
          <th class="px-4 py-2 text-left">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include 'db.php';
        $result = $conn->query("SELECT * FROM edukasi ORDER BY id DESC");
        while ($row = $result->fetch_assoc()) {
          echo "<tr class='border-t hover:bg-gray-50 transition'>
                  <td class='px-4 py-2'>" . htmlspecialchars($row['judul']) . "</td>
                  <td class='px-4 py-2 capitalize'>" . htmlspecialchars($row['tipe']) . "</td>
                  <td class='px-4 py-2 space-x-3'>
                    <a href='edit_edukasi.php?id={$row['id']}' class='text-blue-600 hover:underline'>Edit</a>
                    <a href='hapus_edukasi.php?id={$row['id']}' class='text-red-600 hover:underline'
                       onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>
                  </td>
                </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
