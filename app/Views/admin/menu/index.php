<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<header class="page-header text-center" style="padding-top: 120px;">
    <h1>Manajemen Menu</h1>
    <p>Area untuk mengelola daftar menu yang ditampilkan di website.</p>
</header>

<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card admin-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Menu Tersedia</h5>
                        <a href="<?= base_url('admin/menu/new') ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah Menu
                        </a>
                    </div>
                    <div class="card-body">
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Gambar</th>
                                        <th>Nama Menu</th>
                                        <th>Harga</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach ($menu_items as $item): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><img src="<?= base_url('img/menu/' . esc($item['foto'])) ?>" width="70" class="rounded"></td>
                                        <td><strong><?= esc($item['nama_menu']) ?></strong></td>
                                        <td>Rp <?= number_format($item['harga']) ?></td>
                                        <td class="text-center"><?= $item['stok'] ?></td>
                                        <td class="text-end">
                                            <a href="<?= base_url('admin/menu/edit/' . $item['id']) ?>" class="btn btn-sm btn-outline-dark"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url('admin/menu/delete/' . $item['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>