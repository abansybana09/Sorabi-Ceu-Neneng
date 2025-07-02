<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container my-5 pt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-body">
                    <h4 class="mb-0">Tambah Menu Baru</h4>
                </div>
                <div class="card-body p-4">
                    <!-- Pastikan form action dan method-nya benar -->
                    <form action="<?= base_url('admin/menu') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <!-- 1. NAMA MENU (YANG BENAR) -->
                        <div class="mb-3">
                            <label for="nama_menu" class="form-label fw-bold">Nama Menu *</label>
                            <input type="text" class="form-control" id="nama_menu" name="nama_menu" placeholder="Masukkan Menu" required>
                        </div>

                        <!-- 2. DESKRIPSI -->
                        <div class="mb-3">
                            <label for="deskripsi_menu" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi_menu" name="deskripsi_menu" rows="3" placeholder="Jelaskan sedikit tentang menu ini..."></textarea>
                        </div>

                        <!-- 3. HARGA & STOK -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="harga" class="form-label fw-bold">Harga *</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stok" class="form-label fw-bold">Stok Awal *</label>
                                <input type="number" class="form-control" id="stok" name="stok" value="100" required>
                            </div>
                        </div>

                        <!-- 4. FOTO MENU -->
                        <div class="mb-4">
                            <label for="foto" class="form-label fw-bold">Foto Menu *</label>
                            <input type="file" class="form-control" id="foto" name="foto" required>
                            <small class="form-text text-muted">Pilih gambar untuk menu ini.</small>
                        </div>

                        <!-- TOMBOL AKSI -->
                        <div class="d-flex justify-content-end border-top pt-3">
                            <a href="<?= base_url('admin/menu') ?>" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Menu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>