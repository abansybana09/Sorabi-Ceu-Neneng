<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container my-5 pt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-body">
                    <h4 class="mb-0">Edit Menu : <?= esc($item['nama_menu']) ?></h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/menu/update/' . $item['id']) ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <div class="mb-3">
                            <label for="nama_menu" class="form-label">Nama Menu</label>
                            <input type="text" class="form-control" id="nama_menu" name="nama_menu" value="<?= esc($item['nama_menu']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_menu" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi_menu" name="deskripsi_menu" rows="3"><?= esc($item['deskripsi_menu']) ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" id="harga" name="harga" value="<?= esc($item['harga']) ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" value="<?= esc($item['stok']) ?>" required>
                            </div>
                        </div>

                        <div class="mb-4">
        <label for="foto" class="form-label">Ganti Foto (Opsional)</label>
        <input type="file" class="form-control" id="foto" name="foto">
        <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
        <br>
        <img src="<?= base_url('img/menu/' . esc($item['foto'])) ?>" alt="Current Foto" class="img-thumbnail mt-2" width="150" onerror="this.style.display='none'">
    </div>

                        <div class="d-flex justify-content-end">
                            <a href="<?= base_url('admin/menu') ?>" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>