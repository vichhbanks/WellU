<?php
session_start();
if (!isset($_SESSION['username']))
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WellU - Kesehatan Mental Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<style>
<style>
    /* Base Styles */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    body {
        font-family: 'Poppins', sans-serif;
        line-height: 1.6;
        color: #333;
        background-color: #f8fafc;
    }
    
    /* Navigation */
    nav {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        z-index: 50;
        animation: fadeInDown 0.8s ease-out;
    }
    
    nav a {
        transition: all 0.3s ease;
        position: relative;
    }
    
    nav a:hover {
        transform: translateY(-2px);
    }
    
    nav a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 0;
        background-color: white;
        transition: width 0.3s ease;
    }
    
    nav a:hover::after {
        width: 100%;
    }
    
    /* Hero Section */
    .hero {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        position: relative;
        overflow: hidden;
        animation: fadeIn 1s ease-out;
        border-radius: 1rem;
    }
    
    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 70% 30%, rgba(255,255,255,0.1) 0%, transparent 70%);
    }
    
    .hero h2 {
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
    }
    
    .hero a {
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }
    
    .hero a:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    
    .hero a::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(255,255,255,0.1), rgba(255,255,255,0.3));
        transform: translateX(-100%);
        transition: transform 0.6s ease;
    }
    
    .hero a:hover::after {
        transform: translateX(100%);
    }
    
    /* Features Section */
    .feature {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(59, 130, 246, 0.1);
        border-radius: 0.75rem;
    }
    
    .feature:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(59, 130, 246, 0.1);
        border-color: rgba(59, 130, 246, 0.2);
    }
    
    .feature::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #3b82f6, #93c5fd);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }
    
    .feature:hover::before {
        transform: scaleX(1);
    }
    
    .feature h3 {
        color: #1e40af;
        transition: color 0.3s ease;
    }
    
    .feature:hover h3 {
        color: #3b82f6;
    }
    
    /* Footer */
    footer {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        animation: fadeInUp 0.8s ease-out;
    }
    
    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Button Animation */
    .button-animate {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
        }
    }

    /* Floating Animation */
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    /* User Profile */
    .user-profile {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: #93c5fd;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1e40af;
        font-weight: 600;
    }

    /* Logout Button */
    .logout-btn {
        transition: all 0.3s ease;
    }

    .logout-btn:hover {
        background-color: #eff6ff !important;
        transform: translateY(-1px);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .features {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .hero {
            padding: 2rem 1.5rem;
            text-align: center;
        }
        
        nav div {
            display: flex;
            gap: 1rem;
        }

        .user-profile {
            flex-direction: column;
            align-items: flex-end;
            gap: 0.25rem;
        }

        .user-profile span {
            font-size: 0.875rem;
        }
    }

    /* Card Hover Effect */
    .testimonial-card {
        transition: all 0.3s ease;
    }

    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }

    /* Icon Animation */
    .feature-icon {
        transition: all 0.3s ease;
    }

    .feature:hover .feature-icon {
        transform: scale(1.1);
    }
</style>
<body class="bg-gray-50 min-h-screen flex flex-col">

<!-- Navigation -->
<nav class="bg-blue-600 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-6">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                </svg>
                <h1 class="text-2xl font-bold">WellU</h1>
            </div>
            <div class="hidden md:flex space-x-6">
                <a href="riwayat.php" class="hover:text-blue-100 transition duration-300 flex items-center">
                    Dashboard
                </a>
                <a href="edukasi.php" class="hover:text-blue-100 transition duration-300 flex items-center">
                    Edukasi
                </a>
                <a href="konsultasi_user.php" class="hover:text-blue-100 transition duration-300 flex items-center">
                    Konsultasi
                </a>
            </div>
        </div>
        <div class="flex items-center space-x-6">
            <span class="font-medium"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="logout.php" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition duration-300">Logout</a>
        </div>
    </div>
</nav>

<!-- [Bagian mobile menu tetap sama, hanya hapus link daftar/login] -->
<div class="md:hidden bg-blue-600 text-white p-2">
    <div class="container mx-auto flex justify-between items-center">
        <button id="mobileMenuButton" class="p-2 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
    <div id="mobileMenu" class="hidden bg-blue-700 px-4 py-2">
        <a href="dashboard.html" class="block py-2 hover:text-blue-100 transition duration-300 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            Dashboard
        </a>
        <a href="edukasi.php" class="block py-2 hover:text-blue-100 transition duration-300 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            Edukasi
        </a>
        <a href="konsultasi_user.php" class="block py-2 hover:text-blue-100 transition duration-300 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            Konsultasi
        </a>
    </div>
</div>

<!-- [Hapus modal login karena tidak diperlukan lagi] -->

<!-- Main Content -->
<main class="flex-grow container mx-auto px-4 py-8">
    <!-- Hero Section -->
    <section class="hero bg-blue-500 text-white rounded-xl p-8 mb-12 relative overflow-hidden">
        <div class="relative z-10 max-w-2xl">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 animate__animated animate__fadeIn">Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <p class="mb-6 text-blue-100 animate__animated animate__fadeIn animate__delay-1s">Platform komprehensif untuk memantau dan meningkatkan kesehatan mental mahasiswa secara berkala</p>
            <div class="animate__animated animate__fadeIn animate__delay-2s">
                <a href="assessment.php" class="inline-block bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold button-animate hover:shadow-lg transition duration-300">
                    Mulai Self-Assessment
                </a>
            </div>
        </div>
        <div class="absolute right-0 bottom-0 opacity-10 md:opacity-20">
            <svg xmlns="http://www.w3.org/2000/svg" width="300" height="300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                <line x1="9" y1="9" x2="9.01" y2="9"></line>
                <line x1="15" y1="9" x2="15.01" y2="9"></line>
            </svg>
        </div>
    </section>
  <!-- Features Section -->
    <section class="mb-16">
        <h2 class="text-2xl font-bold text-center mb-2 text-gray-800">Mengapa Memilih WellU?</h2>
        <p class="text-gray-600 text-center mb-8 max-w-2xl mx-auto">Solusi lengkap untuk kesehatan mental mahasiswa dengan pendekatan berbasis data</p>
        
        <div class="features grid md:grid-cols-3 gap-8 mb-8">
            <div class="feature bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Self-Assessment</h3>
                <p class="text-gray-600">Kuesioner interaktif dengan analisis otomatis untuk mengevaluasi kondisi mental Anda secara berkala</p>
            </div>
            
            <div class="feature bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Dashboard Personal</h3>
                <p class="text-gray-600">Pantau perkembangan kesehatan mental Anda dengan visualisasi data yang mudah dipahami</p>
            </div>
            
            <div class="feature bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Sumber Edukasi</h3>
                <p class="text-gray-600">Akses artikel, video, dan panduan praktis untuk mengelola kesehatan mental sehari-hari</p>
            </div>
        </div>
    </section>
</main>
    <!-- Testimonial Section -->
    <section class="bg-white rounded-xl shadow-md p-8 mb-12">
        <h2 class="text-2xl font-bold text-center mb-8 text-gray-800">Apa Kata Mereka?</h2>
        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-blue-50 p-6 rounded-lg relative">
                <div class="absolute -top-4 -left-4 bg-blue-600 text-white w-10 h-10 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>
                <p class="text-gray-700 mb-4">"WellU membantu saya lebih memahami kondisi mental saya melalui fitur assessment yang sangat informatif."</p>
                <div class="flex items-center">
                    <div class="bg-blue-200 w-8 h-8 rounded-full mr-3"></div>
                    <div>
                        <p class="font-medium text-gray-800">Mila Amelia</p>
                        <p class="text-sm text-gray-500">Mahasiswa Ilmu Komputer</p>
                    </div>
                </div>
            </div>
            <div class="bg-blue-50 p-6 rounded-lg relative">
                <div class="absolute -top-4 -left-4 bg-blue-600 text-white w-10 h-10 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>
                <p class="text-gray-700 mb-4">"Dashboard yang interaktif memudahkan saya melacak perkembangan kesehatan mental dari waktu ke waktu."</p>
                <div class="flex items-center">
                    <div class="bg-blue-200 w-8 h-8 rounded-full mr-3"></div>
                    <div>
                        <p class="font-medium text-gray-800">Wahyu Mardhatullah</p>
                        <p class="text-sm text-gray-500">Mahasiswa Ilmu Komputer</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- Footer -->
<footer class="bg-gray-800 text-white p-6">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                    <span class="text-xl font-bold">WellU</span>
                </div>
                <p class="text-sm text-gray-400 mt-2">Layanan Kesehatan Mental Mahasiswa</p>
            </div>
            <div class="flex space-x-6">
            </div>
        </div>
        <div class="border-t border-gray-700 mt-6 pt-6 text-center text-sm text-gray-400">
            <p>© 2023 WellU - Layanan Kesehatan Mental Mahasiswa. All rights reserved.</p>
        </div>
    </div>
</footer>

<script>
    // Mobile menu toggle
    document.getElementById('mobileMenuButton').addEventListener('click', function() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
    });

    // Fungsi assessment langsung mengarahkan ke halaman assessment
    function checkLoginBeforeAssessment() {
        window.location.href = 'assessment.php';
    }
</script>
</body>
</html>