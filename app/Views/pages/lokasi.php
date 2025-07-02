<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<header class="page-header text-center" style="padding-top: 120px;">
    <h1>Lokasi Kami</h1>
    <p>Temukan Sorabi Ceu Neneng sesuai lokasi Anda.</p>
</header>

<section class="section-padding">
    <div class="container">
        <div class="row gy-4 justify-content-center">
            
            <?php if (!empty($data)): ?>
              <?php foreach ($data as $cabang): ?>
                <div class="col-lg-5 col-md-6">
                    <div class="card-custom">
                        <!-- Gambar Cabang -->
                        <img src="<?= base_url(esc($cabang['image'])) ?>" class="card-custom-img" alt="Foto <?= esc($cabang['title']) ?>">
                        
                        <div class="card-custom-body text-center">
                            <!-- Judul Cabang -->
                            <h3 class="card-custom-title"><?= esc($cabang['title']) ?></h3>
                            
                            <!-- Informasi Tambahan (Contoh) -->
                            <p class="text-muted">
                                <i class="fas fa-map-marker-alt me-2"></i>Belakang Bale Desa Karang Muncang, Kuningan, Jawa Barat
                            </p>
                            
                            <!-- Tombol ke Peta -->
                            <a href="<?= esc($cabang['maps_url']) ?>" target="_blank" class="btn btn-primary mt-2">
                                Buka di Google Maps
                                <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>Informasi cabang belum tersedia.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<?= $this->endSection() ?>