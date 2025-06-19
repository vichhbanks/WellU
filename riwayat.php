<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

include 'db.php';
$username = $_SESSION['username'];

// Ambil data self-assessment
$query = "SELECT *, (q1+q2+q3+q4+q5+q6+q7+q8+q9) as total FROM assesment WHERE username = '$username' ORDER BY create_at DESC";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

$riwayat = [];
while ($row = mysqli_fetch_assoc($result)) {
    $riwayat[] = [
        'date' => $row['create_at'],
        'score' => $row['total']
    ];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Riwayat Self-Assessment</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background: #f9fafb;
      color: #1f2937;
      padding-left: 260px;
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      top: 0;
      left: -260px;
      width: 250px;
      height: 100%;
      background: #3b82f6;
      color: white;
      padding: 60px 20px;
      transition: left 0.3s ease;
      z-index: 1000;
      display: flex;
      flex-direction: column;
    }

    #toggle {
      display: none;
    }

    #toggle:checked ~ .sidebar {
      left: 0;
    }

    .hamburger {
      position: fixed;
      top: 20px;
      left: 20px;
      cursor: pointer;
      z-index: 1100;
    }

    .hamburger div {
      width: 30px;
      height: 4px;
      background: #1e3a8a;
      margin: 6px 0;
      transition: 0.3s;
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
      box-shadow: 0 4px 8px rgba(255, 255, 255, 0.2);
      transition: 0.3s ease;
    }

    .wellu-button:hover {
      background-color: #f0f9ff;
      transform: scale(1.05);
    }

    .sidebar-link {
      display: block;
      padding: 12px 16px;
      margin-bottom: 10px;
      font-size: 16px;
      font-weight: 500;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      transition: background 0.3s;
    }

    .sidebar-link:hover {
      background-color: rgba(255, 255, 255, 0.2);
    }

    .sidebar-link.active {
      background-color: white;
      color: #3b82f6;
    }

    /* Konten utama */
    .dashboard-container {
      max-width: 1000px;
      margin: 2rem auto;
      padding: 2rem;
      background: white;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
    }

    .dashboard-header {
      font-size: 1.75rem;
      color: #1e3a8a;
      margin-bottom: 2rem;
      border-bottom: 2px solid #3b82f6;
      padding-bottom: 0.5rem;
    }

    .chart-container h3,
    .history-container h3 {
      font-size: 1.2rem;
      color: #1e40af;
      margin-bottom: 1rem;
    }

    .chart-wrapper {
      background: #f1f5f9;
      padding: 1rem;
      border-radius: 8px;
      box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
      margin-bottom: 2rem;
    }

    .history-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.95rem;
    }

    .history-table thead {
      background-color: #e5efff;
    }

    .history-table th,
    .history-table td {
      padding: 0.75rem 1rem;
      text-align: left;
      border-bottom: 1px solid #e5e7eb;
    }

    .history-table tr:hover {
      background-color: #f0f9ff;
    }

    .status-badge {
      padding: 0.3rem 0.75rem;
      border-radius: 9999px;
      font-size: 0.75rem;
      font-weight: 500;
      color: white;
    }

    .status-good {
      background-color: #10b981;
    }

    .status-medium {
      background-color: #facc15;
      color: #1f2937;
    }

    .status-warning {
      background-color: #ef4444;
    }
  </style>
</head>
<body>

<input type="checkbox" id="toggle" />
<label class="hamburger" for="toggle">
  <div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div>
</label>

<div class="sidebar">
  <a href="dashboard.php" class="wellu-button">WellU</a>
  <a href="riwayat.php" class="sidebar-link active">Dashboard</a>
  <a href="edukasi.php" class="sidebar-link">Edukasi</a>
  <a href="konsultasi_user.php" class="sidebar-link">Konsultasi</a>
</div>

<div class="dashboard-container">
  <h2 class="dashboard-header">Riwayat Self-Assessment</h2>

  <div class="chart-container">
    <h3>Tren Skor Anda</h3>
    <div class="chart-wrapper">
      <canvas id="trendChart"></canvas>
    </div>
  </div>

  <div class="history-container">
    <h3>Riwayat Pengisian</h3>
    <table class="history-table">
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Skor</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (empty($riwayat)) {
            echo '<tr><td colspan="3">Belum ada data</td></tr>';
        } else {
            foreach ($riwayat as $r) {
                $skor = (int)$r['score'];
                $status = '';
                if ($skor <= 15) {
                    $status = '<span class="status-badge status-good">Baik</span>';
                } elseif ($skor <= 30) {
                    $status = '<span class="status-badge status-medium">Sedang</span>';
                } else {
                    $status = '<span class="status-badge status-warning">Perlu Perhatian</span>';
                }

                $tanggal = date("d M Y", strtotime($r['date']));
                echo "<tr>
                        <td>$tanggal</td>
                        <td>$skor</td>
                        <td>$status</td>
                      </tr>";
            }
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<script>
  const labels = <?php echo json_encode(array_reverse(array_column($riwayat, 'date'))); ?>;
  const scores = <?php echo json_encode(array_reverse(array_column($riwayat, 'score'))); ?>;

  const ctx = document.getElementById('trendChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: labels.map(d => new Date(d).toLocaleDateString("id-ID", { day: 'numeric', month: 'short' })),
      datasets: [{
        label: 'Skor Assessment',
        data: scores,
        borderColor: '#3b82f6',
        backgroundColor: 'rgba(59, 130, 246, 0.1)',
        borderWidth: 2,
        fill: true,
        tension: 0.3
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: {
        y: {
          beginAtZero: true,
          max: 50,
          ticks: { stepSize: 10 }
        },
        x: { grid: { display: false } }
      }
    }
  });
</script>

</body>
</html>
