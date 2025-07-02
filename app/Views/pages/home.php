<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="hero-section section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-text">
                    <h1>Rasa Otentik <span class="text-highlight">Sorabi & Tempe</span></h1>
                    <p class="lead">Nikmati kehangatan sorabi yang dibuat langsung di atas tungku dan tempe goreng renyah yang bikin ketagihan.</p>
                    <a href="<?= base_url('menu') ?>" class="btn btn-primary">Lihat Menu Kami</a>
                </div>
            </div>
            
            <div class="col-lg-6">
                <img src="<?= base_url('img/menu/serabi6.webp') ?>" alt="Sorabi dan Tempe" class="img-fluid hero-image">
            </div>
        </div>
    </div>
</section>

<!-- Anda bisa menambahkan section lain di sini, misal "Menu Unggulan" -->

<?= $this->endSection() ?>