<?php
session_start();
include 'db.php';

if (!isset($_GET['id'])) {
  header("Location: edukasi.php");
  exit();
}

$id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM edukasi WHERE id = $id");

if (mysqli_num_rows($query) === 0) {
  echo "Konten tidak ditemukan.";
  exit();
}

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($data['judul']) ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white p-6 font-inter max-w-3xl mx-auto">
  <a href="edukasi.php" class="text-blue-600 hover:underline mb-6 inline-block">&larr; Kembali ke daftar</a>

  <h2 class="text-2xl font-bold text-blue-900 mb-4"><?= htmlspecialchars($data['judul']) ?></h2>

  <?php if ($data['tipe'] === 'video'): ?>
    <div class="aspect-w-16 aspect-h-9 mb-6">
      <iframe class="w-full h-64 rounded-md shadow" src="<?= htmlspecialchars($data['link_video']) ?>" frameborder="0" allowfullscreen></iframe>
    </div>
  <?php endif; ?>

  <div class="text-gray-800 leading-relaxed whitespace-pre-line">
    <?= nl2br(htmlspecialchars($data['isi'])) ?>
  </div>
</body>
</html>
