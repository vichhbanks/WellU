<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>

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
}</style>
  <input type="checkbox" id="toggle" />
<label class="hamburger" for="toggle">
  <div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div>
</label>

<div class="sidebar">
<a href="dashboard.php" class="wellu-button">WellU</a>
  <a href="riwayat.php" class="sidebar-link">Dashboard</a>
  <a href="edukasi.php" class="sidebar-link">Edukasi</a>
  <a href="konsultasi.php" class="sidebar-link">Konsultasi</a>
</div>
  <meta charset="UTF-8">
  <title>Self Assessment - WellU</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-inter">
  <div class="max-w-4xl mx-auto px-4 py-10">
    <div class="bg-white rounded-2xl shadow-md p-8">
      <h2 class="text-3xl font-bold text-blue-800 mb-6 text-center">Self-Assessment Kesehatan Mental</h2>

      <form action="submit_assessment.php" method="POST" class="space-y-8">
        <?php
        $questions = [
          "Saya merasa stres atau tertekan dalam seminggu terakhir.",
          "Saya merasa cemas secara berlebihan.",
          "Saya kesulitan tidur atau tidur tidak nyenyak.",
          "Saya kehilangan minat dalam aktivitas yang biasa saya nikmati.",
          "Saya merasa tidak berharga atau bersalah berlebihan.",
          "Saya sulit berkonsentrasi dalam aktivitas sehari-hari.",
          "Saya merasa lelah meskipun tidak banyak beraktivitas.",
          "Saya merasa tidak bersemangat dalam menjalani hari.",
          "Saya memiliki pikiran negatif terhadap diri sendiri."
        ];

        $choices = [
          1 => "Tidak Pernah",
          2 => "Jarang",
          3 => "Kadang-kadang",
          4 => "Sering",
          5 => "Sangat Sering"
        ];

        foreach ($questions as $i => $text) {
          $no = $i + 1;
          echo "<div>
                  <p class='font-semibold text-gray-800 mb-3'>$no. $text</p>
                  <div class='flex flex-wrap gap-3'>";
          foreach ($choices as $value => $label) {
            echo "<label class='flex items-center gap-2 px-4 py-2 rounded-full bg-gray-100 border border-gray-300 cursor-pointer hover:bg-blue-50 transition'>
                    <input type='radio' name='q$no' value='$value' class='accent-blue-600' required>
                    <span class='text-sm text-gray-700'>$label</span>
                  </label>";
          }
          echo "</div></div>";
        }
        ?>

        <div class="text-center pt-6">
          <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-md">
            Kirim Jawaban
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
