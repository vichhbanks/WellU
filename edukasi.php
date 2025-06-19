<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

$result = mysqli_query($conn, "SELECT * FROM edukasi ORDER BY created_at DESC");
?>

<style>

.wellu-button {
  display: inline-block;
  background-color: white;
  color: #3b82f6;
  font-weight: 700;
  font-size: 1.5rem;
  padding: 10px 16px;
  margin-bottom: 1.5rem;
  border-radius: 12px;
  text-align: center;
  text-decoration: none;
  transition: background-color 0.3s, transform 0.3s;
  box-shadow: 0 4px 8px rgba(255, 255, 255, 0.2);
}

.wellu-button:hover {
  background-color: #f0f9ff;
  transform: scale(1.05);
  box-shadow: 0 6px 12px rgba(255, 255, 255, 0.25);
}
  .hamburger {
    cursor: pointer;
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 1100;
  }

  .hamburger div {
    width: 30px;
    height: 4px;
    background: #222;
    margin: 6px 0;
    transition: 0.3s;
  }

  .sidebar {
    position: fixed;
    top: 0;
    left: -250px;
    width: 250px;
    height: 100%;
    background: #3b82f6;
    color: white;
    padding: 60px 20px;
    transition: left 0.3s ease;
    z-index: 1000;
  }

  #toggle {
    display: none;
  }

  #toggle:checked ~ .sidebar {
    left: 0;
  }

  #toggle:checked + label .bar1 {
    transform: rotate(45deg) translate(5px, 5px);
  }

  #toggle:checked + label .bar2 {
    opacity: 0;
  }

  #toggle:checked + label .bar3 {
    transform: rotate(-45deg) translate(6px, -6px);
  }

.sidebar-link {
  display: block;
  width: 100%;
  background-color: transparent;
  color: white;
  text-align: left;
  padding: 12px 16px;
  margin-bottom: 10px;
  font-size: 16px;
  font-weight: 500;
  text-decoration: none;
  border-radius: 8px;
  transition: background-color 0.3s ease;
}

.sidebar-link:hover {
  background-color: rgba(255, 255, 255, 0.2);
}

.sidebar-link.active {
  background-color: white;
  color: #3b82f6;
}

.sidebar button:hover {
  background-color: rgba(255, 255, 255, 0.2);
  cursor: pointer;
}

.sidebar button.active {
  background-color: white;
  color: #3b82f6;
}



</style>
<input type="checkbox" id="toggle" />
<label class="hamburger" for="toggle">
  <div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div>
</label>

<div class="sidebar">
<a href="dashboard.php" class="wellu-button">WellU</a>
  <a href="riwayat.php" class="sidebar-link">Dashboard</a>
  <a href="edukasi.php" class="sidebar-link active">Edukasi</a>
  <a href="konsultasi_user.php" class="sidebar-link">Konsultasi</a>
</div>


<head>
  <meta charset="UTF-8">
  <title>Materi Edukasi</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-inter p-6">
  <h1 class="text-3xl font-bold text-blue-900 text-center mb-10">Sumber Daya Edukasi Kesehatan Mental</h1>

  <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all duration-300">
        <h3 class="text-lg font-semibold text-blue-800 mb-2"><?= htmlspecialchars($row['judul']) ?></h3>
        <p class="text-sm text-gray-600 mb-4"><?= nl2br(htmlspecialchars($row['ringkasan'])) ?></p>
        <a href="detail_edukasi.php?id=<?= $row['id'] ?>" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Lihat Selengkapnya</a>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>
