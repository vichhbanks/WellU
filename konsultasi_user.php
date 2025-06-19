<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
  header("Location: login.php");
  exit();
}

$username = $_SESSION['username'];

// Jika user mengirim pesan baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['pesan'])) {
  $pesan = $conn->real_escape_string($_POST['pesan']);
  $conn->query("INSERT INTO konsultasi (username, pengirim, pesan) VALUES ('$username', 'user', '$pesan')");
  header("Location: konsultasi_user.php"); // Refresh
  exit();
}

// Ambil semua pesan user
$result = $conn->query("SELECT * FROM konsultasi WHERE username='$username' ORDER BY waktu ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Konsultasi - WellU</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
  <h1 class="text-2xl font-bold text-blue-900 mb-4">Konsultasi dengan Admin</h1>

  <div class="bg-white p-4 rounded-lg shadow max-w-2xl mx-auto">
    <div class="h-64 overflow-y-auto border p-4 rounded mb-4 bg-gray-50">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="<?= $row['pengirim'] === 'user' ? 'text-right' : 'text-left' ?>">
          <div class="inline-block px-4 py-2 rounded-lg 
            <?= $row['pengirim'] === 'user' ? 'bg-blue-200 text-blue-900' : 'bg-gray-300 text-gray-800' ?> 
            mb-1 max-w-xs">
            <?= nl2br(htmlspecialchars($row['pesan'])) ?>
          </div>
          <div class="text-xs text-gray-500"><?= $row['waktu'] ?></div>
        </div>
      <?php endwhile; ?>
    </div>

    <form method="POST" class="flex gap-2">
        <a href="dashboard.php" 
   class="inline-block mt-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
   ← Kembali ke Dashboard
</a>

      <input type="text" name="pesan" placeholder="Tulis pesan..." required
             class="flex-1 border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kirim</button>
    </form>
  </div>
</body>
</html>
