<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<header class="page-header text-center" style="padding-top: 120px;">
    <h1>Menu Pilihan Kami</h1>
    <p>Semua hidangan dibuat dengan bahan segar setiap hari.</p>
</header>

<section class="section-padding">
    <div class="container">
        <!-- BARIS UNTUK JUDUL DAN TOMBOL KERANJANG -->
        <div class="row mb-5 text-center">
    <div class="col-12">
        <!-- Judul -->
        <div class="section-title mb-4">
            <h2 class="mb-0">Daftar Menu</h2>
        </div>
        <!-- Tombol Keranjang -->
        <div class="text-end">
                <button class="btn btn-primary position-relative" data-bs-toggle="modal" data-bs-target="#cartModal" style="padding: 10px 15px;">
    <i class="fas fa-shopping-cart fs-5"></i>
    <span id="cart-count-page" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        0
        <span class="visually-hidden">items in cart</span>
    </span>
</button>
        </div>
    </div>
</div>

        <!-- GRID UNTUK DAFTAR MENU -->
        <div class="row gy-4" id="menu-list">
            <?php if (!empty($menu)): ?>
              <?php foreach ($menu as $item): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card-custom menu-item h-100" 
                         data-id="<?= $item['id'] ?>" 
                         data-name="<?= esc($item['nama_menu']) ?>" 
                         data-price="<?= $item['harga'] ?>" 
                         data-image="<?= base_url('img/menu/' . esc($item['foto'])) ?>">
                        
                        <img src="<?= base_url('img/menu/' . esc($item['foto'])) ?>" class="card-custom-img" alt="<?= esc($item['nama_menu']) ?>">
                        
                        <div class="card-custom-body d-flex flex-column">
                            <h4 class="card-custom-title"><?= esc($item['nama_menu']) ?></h4>
                            <p class="text-muted small flex-grow-1"><?= esc($item['deskripsi_menu']) ?></p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <p class="card-custom-price mb-0">Rp <?= number_format($item['harga']) ?></p>
                                <button class="btn btn-add-to-cart add-to-cart-btn">
    <i class="fas fa-cart-plus me-1"></i> Tambah
</button>
                            </div>
                        </div>
                    </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <div class="col-12 text-center"><p>Menu belum tersedia.</p></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>