<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> | Admin - Sorabi Ceu Neneng</title>
    
    <!-- Bootstrap & Font Awesome dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Memuat CSS Kustom Anda -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    
    <style>
        /* Beberapa gaya tambahan khusus untuk admin */
        body { 
            background-color: #f4f7f6; 
        }
        .admin-header {
            background-color: #a16207; /* Warna gelap yang elegan */
            color: white;
            padding: 1rem 1.5rem;
            margin-bottom: 30px;
        }
        .admin-header h5 {
            color: #ecf0f1;
        }
        .admin-header a {
            color: #ecf0f1;
        }
        
    </style>
</head>
<body>

<!-- Header khusus Admin yang Rapi -->
<header class="admin-header shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Kelola Pesanan Sorabi Ceu Neneng</h5>
        <div>
            <a href="<?= base_url('admin') ?>" class="btn btn-sm btn-outline-light">
            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
        </a>
            <a href="<?= base_url('admin/orders') ?>" class="btn btn-sm btn-outline-light">
                <i class="fas fa-receipt me-1"></i> Kelola Pesanan
            </a>
            <a href="<?= base_url('admin/menu') ?>" class="btn btn-sm btn-outline-light">
                <i class="fas fa-utensils me-1"></i> Kelola Menu
            </a>
            <a href="<?= base_url('logout') ?>" class="btn btn-sm btn-outline-light ms-2">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </a>
        </div>
    </div>
</header>

<!-- Konten utama dari setiap halaman admin -->
<main class="container">
    <?= $this->renderSection('content') ?>
</main>

<footer class="text-center text-muted small py-4 mt-auto">
    <p class="mb-0">© <?= date('Y') ?> Sorabi Ceu Neneng</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?= $this->renderSection('scripts') ?>
</body>
</html>