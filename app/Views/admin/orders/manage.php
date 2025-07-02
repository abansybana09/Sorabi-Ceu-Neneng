<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('title') ?>Kelola Pesanan Aktif<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Pesanan Aktif (Baru & Diproses)</h5>
        <form action="<?= base_url('admin/orders') ?>" method="get" class="d-flex me-3 mb-2">
            <!-- <input type="text" name="keyword" class="form-control form-control-sm" placeholder="Cari Nama / ID Pesanan..." value="<?= esc($keyword) ?>">
            <button type="submit" class="btn btn-sm btn-primary ms-2">Cari</button> -->
        </form>
        
        <a href="<?= base_url('admin/orders/history') ?>" class="btn btn-sm btn-outline-secondary mb-2">
            <i class="fas fa-history me-1"></i> Riwayat
        </a>
    </div>
    <div class="card-body">
        <?php if(empty($orders)): ?>
            <div class="text-center p-5">
                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                <p class="h5">Tidak ada pesanan aktif saat ini.</p>
                <p class="text-muted">Semua pesanan sudah selesai diproses.</p>
            </div>
        <?php else: ?>
            <div class="accordion" id="ordersAccordion">
                <?php foreach($orders as $order): ?>
                    <div class="accordion-item mb-2">
                        <h2 class="accordion-header" id="heading<?= $order['id'] ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $order['id'] ?>">
                                <div class="w-100 d-flex justify-content-between pe-3">
                                    <span><strong>#<?= $order['id'] ?> - <?= esc($order['customer_name']) ?></strong></span>
                                    <span>Rp <?= number_format($order['total_price']) ?>
                                        <span class="badge ms-3 <?= $order['status'] == 'Baru' ? 'bg-primary' : 'bg-warning text-dark' ?>"><?= $order['status'] ?></span>
                                    </span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse<?= $order['id'] ?>" class="accordion-collapse collapse" data-bs-parent="#ordersAccordion">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <h6>Detail Item:</h6>
                                        <table class="table table-sm"><tbody>
                                            <?php foreach($order['items'] as $item): ?>
                                            <tr>
                                                <td><?= esc($item['menu_name']) ?></td>
                                                <td class="text-center">x <?= $item['quantity'] ?></td>
                                                <td class="text-end">Rp <?= number_format($item['price'] * $item['quantity']) ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody></table>
                                    </div>
                                    <div class="col-md-5">
                                        <h6>Info Pemesan:</h6>
                                        <p class="mb-1"><i class="fas fa-user fa-fw me-2"></i><?= esc($order['customer_name']) ?></p>
                                        <p class="mb-1"><i class="fab fa-whatsapp fa-fw me-2"></i><?= esc($order['customer_whatsapp']) ?></p>
                                        <p class="mb-1"><i class="fas fa-calendar-alt fa-fw me-2"></i><?= date('d M Y, H:i', strtotime($order['created_at'])) ?> WIB</p>
                                        <div class="mt-3 d-grid d-md-block">
                                            <div class="btn-group">
                                                <?php if($order['status'] == 'Baru'): ?>
                                                    <a href="<?= base_url('admin/orders/update/'.$order['id'].'/Diproses') ?>" class="btn btn-sm btn-info">Terima & Proses</a>
                                                <?php endif; ?>
                                                <?php if($order['status'] == 'Diproses'): ?>
                                                    <a href="<?= base_url('admin/orders/update/'.$order['id'].'/Selesai') ?>" class="btn btn-sm btn-success">Tandai Selesai</a>
                                                <?php endif; ?>
                                                <a href="<?= base_url('admin/orders/update/'.$order['id'].'/Dibatalkan') ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')">Batalkan</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>