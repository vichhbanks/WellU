<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek apakah ada 1 user yang cocok
    if ($result->num_rows === 1) {
        $userData = $result->fetch_assoc(); // Ambil data user
        $_SESSION["username"] = $username;
        $_SESSION["role"] = $userData["role"]; // Simpan role di session

        // Redirect berdasarkan role
        if ($userData["role"] === "admin") {
            header("Location: admindashboard.php");
        } else {
            header("Location: dashboard.php");
        }
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - WellU</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <div class="text-center mb-6">
      <h1 class="text-3xl font-bold text-blue-600">WellU</h1>
      <p class="text-gray-600 mt-1">Kesehatan Mental Mahasiswa</p>
    </div>

    <?php if (isset($error)): ?>
      <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-sm">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="space-y-5">
      <div>
        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
        <input type="text" id="username" name="username" required
               class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
               placeholder="Masukkan nama pengguna">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" id="password" name="password" required
               class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
               placeholder="••••••••">
      </div>

      <div class="flex items-center justify-between">
        <label class="flex items-center text-sm text-gray-700">
          <input type="checkbox" name="remember" class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded">
          Ingat saya
        </label>
      </div>

      <button type="submit"
              class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
        Masuk
      </button>
    </form>

    <div class="mt-6 text-center">
      <p class="text-sm text-gray-600">
        Belum punya akun?
        <a href="create.php" class="text-blue-600 font-medium hover:text-blue-500">Daftar sekarang</a>
      </p>
    </div>

    <div class="mt-6 border-t border-gray-200 pt-6 text-xs text-gray-500 text-center">
      Dengan melanjutkan, Anda menyetujui
      <a href="#" class="text-blue-600">Syarat & Ketentuan</a> dan
      <a href="#" class="text-blue-600">Kebijakan Privasi</a> kami.
    </div>
  </div>
</body>
</html>
