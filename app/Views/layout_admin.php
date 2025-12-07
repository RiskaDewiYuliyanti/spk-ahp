<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK KIP Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; }
        
        /* SIDEBAR STYLE */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #2c3e50;
            color: white;
            padding-top: 20px;
            overflow-y: auto;
            z-index: 1000;
        }
        .sidebar a {
            padding: 12px 25px;
            text-decoration: none;
            font-size: 15px;
            color: #b0b8c1;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            color: #fff;
            background-color: #34495e;
            border-left: 5px solid #3498db;
        }
        .sidebar i { margin-right: 10px; width: 20px; text-align: center; }
        .sidebar .brand-logo {
            font-size: 22px; 
            font-weight: bold; 
            text-align: center; 
            margin-bottom: 20px; 
            color: #fff;
            padding-bottom: 10px;
            border-bottom: 1px solid #3e5871;
        }
        .sidebar small { color: #5c7c93; }

        /* CONTENT STYLE */
        .main-content {
            margin-left: 250px; /* Memberi ruang untuk sidebar */
            padding: 30px;
            min-height: 100vh;
        }
        
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand-logo">
            <i class="fas fa-graduation-cap"></i> SPK KIP
        </div>
        
        <a href="<?= base_url('/') ?>" class="<?= (uri_string() == '/' || uri_string() == '') ? 'active' : '' ?>">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        <hr style="border-color: #555; margin: 10px 0;">
        <small class="text-uppercase fw-bold ms-3" style="font-size: 11px;">Master Data</small>

        <a href="<?= base_url('/data-mahasiswa') ?>" class="<?= (uri_string() == 'data-mahasiswa') ? 'active' : '' ?>">
            <i class="fas fa-users"></i> Data Alternatif
        </a>
        <a href="<?= base_url('/data-kriteria') ?>" class="<?= (uri_string() == 'data-kriteria') ? 'active' : '' ?>">
            <i class="fas fa-list-ul"></i> Data Kriteria
        </a>
        <a href="<?= base_url('/data-sub') ?>" class="<?= (uri_string() == 'data-sub') ? 'active' : '' ?>">
            <i class="fas fa-tags"></i> Data Sub Kriteria
        </a>

        <hr style="border-color: #555; margin: 10px 0;">
        <small class="text-uppercase fw-bold ms-3" style="font-size: 11px;">Analisa</small>

        <a href="<?= base_url('/proses-hitung') ?>" class="<?= (uri_string() == 'proses-hitung') ? 'active' : '' ?>">
            <i class="fas fa-calculator"></i> Proses Hitung
        </a>
        <a href="<?= base_url('/info-metode') ?>" class="<?= (uri_string() == 'info-metode') ? 'active' : '' ?>">
            <i class="fas fa-book-open"></i> Tentang AHP
        </a>
        
        <div class="mt-5 text-center">
            <a href="<?= base_url('/input') ?>" class="btn btn-primary btn-sm mx-3 text-white rounded-pill">
                <i class="fas fa-plus"></i> Input Baru
            </a>
        </div>
    </div>

    <div class="main-content">
        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>