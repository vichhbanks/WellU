<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit();
}
include 'db.php';

$pesan = "";
if (isset($_POST['submit'])) {
  $judul = $conn->real_escape_string($_POST['judul']);
  $ringkasan = $conn->real_escape_string($_POST['ringkasan']);
  $isi = $conn->real_escape_string($_POST['isi']);
  $tipe = $_POST['tipe'];
  $link_video = isset($_POST['link_video']) ? $conn->real_escape_string($_POST['link_video']) : null;

  $sql = "INSERT INTO edukasi (judul, ringkasan, isi, tipe, link_video) 
          VALUES ('$judul', '$ringkasan', '$isi', '$tipe', " . ($link_video ? "'$link_video'" : "NULL") . ")";

  if ($conn->query($sql)) {
    $pesan = "<p class='text-green-600 mt-4'>Data berhasil ditambahkan!</p>";
  } else {
    $pesan = "<p class='text-red-600 mt-4'>Gagal menambahkan data: " . $conn->error . "</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Edukasi - WellU</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-lg shadow">
  <h1 class="text-2xl font-bold text-blue-800 mb-6">Tambah Edukasi</h1>

  <form action="tambah_edukasi.php" method="POST" class="space-y-4">
    <div>
      <label class="block text-gray-700">Judul</label>
      <input type="text" name="judul" required class="w-full border px-4 py-2 rounded"/>
    </div>

    <div>
      <label class="block text-gray-700">Ringkasan</label>
      <textarea name="ringkasan" rows="3" required class="w-full border px-4 py-2 rounded"></textarea>
    </div>

    <div>
      <label class="block text-gray-700">Isi Konten</label>
      <textarea name="isi" rows="6" required class="w-full border px-4 py-2 rounded"></textarea>
    </div>

    <div>
      <label class="block text-gray-700">Tipe</label>
      <select name="tipe" id="tipe" onchange="toggleVideoInput(this.value)" class="w-full border px-4 py-2 rounded" required>
        <option value="artikel">Artikel</option>
        <option value="video">Video</option>
      </select>
    </div>

    <div id="video-link-field" class="hidden">
      <label class="block text-gray-700">Link YouTube</label>
      <input type="url" name="link_video" placeholder="https://www.youtube.com/watch?v=..." class="w-full border px-4 py-2 rounded"/>
    </div>

    <div class="pt-2">
      <button type="submit" name="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan</button>
      <a href="admindashboard.php" class="ml-4 text-blue-600 hover:underline">Kembali</a>
    </div>
  </form>

  <?= $pesan ?>
</div>

<script>
  function toggleVideoInput(tipe) {
    const videoField = document.getElementById('video-link-field');
    videoField.classList.toggle('hidden', tipe !== 'video');
  }

  // Panggil saat halaman dimuat untuk set tampilan awal
  document.addEventListener("DOMContentLoaded", function () {
    toggleVideoInput(document.getElementById('tipe').value);
  });
</script>

</body>
</html>
