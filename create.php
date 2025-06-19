<?php
include 'db.php';
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role     = $_POST['role'];

    // Validasi sederhana
    if (empty($username) || empty($password) || empty($role)) {
        $error = "Semua kolom harus diisi.";
    } else {
        // Cek apakah username sudah terdaftar
        $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Username sudah digunakan.";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $password, $role);

            if ($stmt->execute()) {
                $success = "Akun berhasil dibuat! Silakan login.";
            } else {
                $error = "Gagal mendaftar. Silakan coba lagi.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar - WellU</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-3xl font-bold text-blue-600 mb-6 text-center">Daftar Akun WellU</h2>

    <?php if ($error): ?>
      <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded"><?= $error ?></div>
    <?php elseif ($success): ?>
      <div class="bg-green-100 text-green-700 px-4 py-2 mb-4 rounded"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST" class="space-y-5">
      <div>
        <label for="username" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
        <input type="text" name="username" id="username" required
               class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" id="password" required
               class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
      </div>

      <div>
        <label for="role" class="block text-sm font-medium text-gray-700">Daftar Sebagai</label>
        <select name="role" id="role" required
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
      </div>

      <button type="submit"
              class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
        Daftar
      </button>
    </form>

    <p class="text-sm text-gray-600 mt-4 text-center">
      Sudah punya akun?
      <a href="login.php" class="text-blue-600 hover:underline">Login di sini</a>
    </p>
  </div>
</body>
</html>
