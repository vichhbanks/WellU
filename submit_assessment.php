<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    die("Silakan login terlebih dahulu.");
}

$username = $_SESSION['username'];
$jawaban = [];
$total = 0;

for ($i = 1; $i <= 9; $i++) {
    if (!isset($_POST["q$i"])) {
        die("Pertanyaan ke-$i belum dijawab.");
    }
    $jawaban[$i] = (int)$_POST["q$i"];
    $total += $jawaban[$i];
}

$sql = "INSERT INTO assesment (username, q1, q2, q3, q4, q5, q6, q7, q8, q9)
        VALUES ('$username', {$jawaban[1]}, {$jawaban[2]}, {$jawaban[3]}, {$jawaban[4]}, {$jawaban[5]},
                {$jawaban[6]}, {$jawaban[7]}, {$jawaban[8]}, {$jawaban[9]})";

$success = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Self Assessment</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f9fafb;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 700px;
      margin: 2rem auto;
      background: white;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      text-align: center;
    }
    h2 {
      color: #1e3a8a;
      margin-bottom: 1.5rem;
    }
    .score-bar {
      background: #e5e7eb;
      border-radius: 9999px;
      height: 16px;
      overflow: hidden;
      margin: 1rem 0;
    }
    .score-fill {
      background: linear-gradient(90deg, #3b82f6, #60a5fa);
      height: 100%;
      width: 0%;
      transition: width 1s ease;
    }
    .status {
      margin-top: 1rem;
      font-size: 1rem;
      color: #1e40af;
      background: #eff6ff;
      padding: 1rem;
      border-left: 4px solid #3b82f6;
      border-radius: 6px;
    }
    .btn {
      margin-top: 2rem;
      padding: 0.6rem 1.5rem;
      background-color: #3b82f6;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 500;
      transition: 0.3s;
    }
    .btn:hover {
      background-color: #2563eb;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Hasil Self Assessment Anda</h2>

    <?php if ($success): ?>
      <p>Skor Anda: <strong id="totalScore"><?= $total ?></strong> dari 45</p>
      <div class="score-bar">
        <div class="score-fill" id="scoreFill"></div>
      </div>

      <div class="status" id="interpretation"></div>

      <a href="dashboard.php"><button class="btn">Kembali ke Halaman Beranda</button></a>
    <?php else: ?>
      <p style="color:red;">Terjadi kesalahan saat menyimpan jawaban. Silakan coba lagi.</p>
      <a href="dashboard.php"><button class="btn">Kembali</button></a>
    <?php endif; ?>
  </div>

  <script>
    const total = <?= $total ?>;
    const fill = document.getElementById('scoreFill');
    fill.style.width = (total / 45 * 100) + '%';

    const interp = document.getElementById('interpretation');
    if (total <= 15) {
      interp.textContent = "Kondisi mental Anda baik. Tetap pertahankan kebiasaan sehat!";
    } else if (total <= 30) {
      interp.textContent = "Anda mengalami sedikit tekanan. Coba lakukan relaksasi atau bicarakan dengan teman.";
    } else {
      interp.textContent = "Anda mungkin mengalami stres atau kecemasan yang signifikan. Pertimbangkan untuk mencari bantuan profesional.";
    }
  </script>
</body>
</html>
