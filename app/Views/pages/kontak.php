<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<header class="page-header text-center" style="padding-top: 120px;">
    <h1>Hubungi Kami</h1>
    <p>Kami senang mendengar dari Anda. Kirimkan pertanyaan atau pesan Anda di bawah ini.</p>
</header>

<section class="section-padding">
    <div class="container">
        <div class="card-custom" style="background-color: white;">
            <div class="row g-0">
                <!-- Kolom Kiri: Info & Peta -->
                <div class="col-lg-5" style="background-color: var(--color-bg-light); padding: 40px; border-top-left-radius: var(--border-radius); border-bottom-left-radius: var(--border-radius);">
                    <h3 class="mb-4">Informasi Lengkap</h3>
                    <div class="d-flex align-items-start mb-4">
                        <i class="fas fa-map-marker-alt fa-fw mt-1 me-3 fs-4 text-primary"></i>
                        <div>
                            <strong>Alamat</strong><br>
                            Jl. Manis Rt 005 Rw 002 Desa KarangMuncang, Kabupaten Kuningan, Jawa Barat.
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-4">
                        <i class="fas fa-phone fa-fw mt-1 me-3 fs-4 text-primary"></i>
                        <div>
                            <strong>Telepon / WhatsApp</strong><br>
                            0831-5699-6256
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-4">
                        <i class="fas fa-clock fa-fw mt-1 me-3 fs-4 text-primary"></i>
                        <div>
                            <strong>Jam Buka</strong><br>
                            Setiap Hari: 02.00 - 08.00 WIB
                        </div>
                    </div>

                    <!-- Peta Google Maps -->
                    <div class="ratio ratio-1x1 mt-4" style="border-radius: var(--border-radius); overflow: hidden;">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d528.985337965294!2d108.52033065610708!3d-6.889554353117989!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f19ff128d706f%3A0x3a3c31f869730055!2s4G6C%2B69M%2C%20Jl.%20Karang%20Muncang%20-%20Japara%2C%20Karangmuncang%2C%20Kec.%20Cigandamekar%2C%20Kabupaten%20Kuningan%2C%20Jawa%20Barat%2045556!5e1!3m2!1sid!2sid!4v1750768131590!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                <!-- Kolom Kanan: Formulir -->
                <div class="col-lg-7" style="padding: 40px;">
                    <h3 class="mb-4">Kirim Pesan</h3>
                    
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    
                    <form action="<?= base_url('kontak') ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Anda</label>
                                <input type="text" class="form-control" name="name" value="<?= old('name') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Anda</label>
                                <input type="email" class="form-control" name="email" value="<?= old('email') ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" name="telephone" value="<?= old('telephone') ?>" required>
                        </div>
                         <div class="mb-3">
                            <label for="purpose" class="form-label">Tujuan</label>
                            <select name="purpose" class="form-select" required>
                                <option value="">-- Pilih Tujuan --</option>
                                <option value="Pesan Antar" <?= old('purpose') == 'Pesan Antar' ? 'selected' : '' ?>>Pesan Antar</option>
                                <option value="Kritik & Saran" <?= old('purpose') == 'Kritik & Saran' ? 'selected' : '' ?>>Kritik & Saran</option>
                                <option value="Lainnya" <?= old('purpose') == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea name="message" rows="5" class="form-control" required><?= old('message') ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Kirim Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>