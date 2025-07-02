<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<header class="page-header text-center" style="padding-top: 120px;">
    <h1>Profil Saya</h1>
    <p>Halo, <?= esc(session()->get('fullname')) ?>! Berikut adalah riwayat pesanan Anda.</p>
</header>

<section class="section-padding">
    <div class="container">
        <div class="row">
            <!-- Kolom Kiri: Menu Navigasi Profil -->
            <div class="col-lg-3">
                <div class="card card-custom">
                    <div class="card-body">
                        <h5 class="card-title">Navigasi</h5>
                        <hr>
                        <div class="list-group list-group-flush">
                            <a href="<?= site_url('profile') ?>" class="list-group-item list-group-item-action active">
                                <i class="fas fa-receipt fa-fw me-2"></i> Riwayat Pesanan
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fas fa-user-edit fa-fw me-2"></i> Edit Profil
                            </a>
                            <a href="<?= site_url('logout') ?>" class="list-group-item list-group-item-action text-danger">
                                <i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Konten Riwayat Pesanan -->
            <div class="col-lg-9">
                <div class="card card-custom">
                    <div class="card-custom-body">
                        <h4 class="mb-4">Riwayat Pesanan Anda</h4>

                        <?php if (empty($orders)): ?>
                            <div class="text-center p-5">
                                <p class="text-muted">Anda belum pernah melakukan pesanan.</p>
                                <a href="<?= site_url('menu') ?>" class="btn btn-primary">Mulai Belanja</a>
                            </div>
                        <?php else: ?>
                            <div class="accordion" id="historyAccordion">
                                <?php foreach ($orders as $order): ?>
                                    <div class="accordion-item mb-2">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $order['id'] ?>">
                                                <div class="w-100 d-flex justify-content-between pe-3">
                                                    <span>Pesanan #<?= $order['id'] ?> - <?= date('d M Y', strtotime($order['created_at'])) ?></span>
                                                    <span class="badge 
                                                        <?php 
                                                            if($order['status'] == 'Selesai') echo 'bg-success';
                                                            elseif($order['status'] == 'Diproses') echo 'bg-warning text-dark';
                                                            elseif($order['status'] == 'Dibatalkan') echo 'bg-secondary';
                                                            else echo 'bg-primary'; 
                                                        ?>">
                                                        <?= $order['status'] ?>
                                                    </span>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse<?= $order['id'] ?>" class="accordion-collapse collapse" data-bs-parent="#historyAccordion">
                                            <div class="accordion-body">
                                                <h6>Detail Item:</h6>
                                                <table class="table table-sm">
                                                    <?php foreach ($order['items'] as $item): ?>
                                                        <tr>
                                                            <td><?= esc($item['menu_name']) ?></td>
                                                            <td class="text-center">x<?= $item['quantity'] ?></td>
                                                            <td class="text-end">Rp <?= number_format($item['price'] * $item['quantity']) ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </table>
                                                <hr>
                                                <p class="text-end fw-bold">Total: Rp <?= number_format($order['total_price']) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>