<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit();
}

include 'db.php';

// Ambil daftar username unik
$userList = $conn->query("SELECT DISTINCT username FROM konsultasi");

// Jika admin mengirim pesan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['balasan'], $_POST['username'])) {
  $balasan = $conn->real_escape_string($_POST['balasan']);
  $user = $conn->real_escape_string($_POST['username']);
  $conn->query("INSERT INTO konsultasi (username, pengirim, pesan) VALUES ('$user', 'admin', '$balasan')");
  header("Location: konsultasi_admin.php"); // refresh
  exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Konsultasi Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 font-sans">

  <!-- Tombol Kembali -->
  <a href="admindashboard.php" 
     class="inline-block mb-6 px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
    ← Kembali ke Dashboard Admin
  </a>

  <h1 class="text-3xl font-bold text-blue-900 mb-6">Konsultasi Pengguna</h1>

  <div class="space-y-8">
    <?php while ($user = $userList->fetch_assoc()): 
      $username = htmlspecialchars($user['username']);
    ?>
      <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold text-blue-700"><?= $username ?></h2>
          <button onclick="toggleChat('chat-<?= $username ?>', this)" 
                  class="text-sm text-blue-600 hover:underline">
            Minimize
          </button>
        </div>

        <div id="chat-<?= $username ?>" class="space-y-2 max-h-64 overflow-y-auto border p-4 rounded transition-all duration-300">
          <?php
            $chats = $conn->query("SELECT * FROM konsultasi WHERE username='$username' ORDER BY waktu ASC");
            while ($chat = $chats->fetch_assoc()):
          ?>
            <div class="<?= $chat['pengirim'] === 'admin' ? 'text-right' : 'text-left' ?>">
              <div class="inline-block px-4 py-2 rounded-lg 
                <?= $chat['pengirim'] === 'admin' ? 'bg-blue-200 text-blue-900' : 'bg-gray-200 text-gray-800' ?>">
                <?= nl2br(htmlspecialchars($chat['pesan'])) ?>
              </div>
              <div class="text-xs text-gray-500"><?= $chat['waktu'] ?></div>
            </div>
          <?php endwhile; ?>
        </div>

        <form action="" method="POST" class="mt-4 flex gap-2">
          <input type="hidden" name="username" value="<?= $username ?>">
          <input type="text" name="balasan" placeholder="Ketik balasan..." required
                 class="flex-1 px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"/>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kirim</button>
        </form>
      </div>
    <?php endwhile; ?>
  </div>

  <!-- Script toggle -->
  <script>
    function toggleChat(id, button) {
      const chatBox = document.getElementById(id);
      chatBox.classList.toggle('hidden');
      button.textContent = chatBox.classList.contains('hidden') ? 'Expand' : 'Minimize';
    }
  </script>
</body>
</html>
