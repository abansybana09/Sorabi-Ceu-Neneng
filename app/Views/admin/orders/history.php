<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('title') ?>Riwayat Pesanan<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Riwayat Pesanan (Selesai & Dibatalkan)</h5>
        <a href="<?= base_url('admin/orders') ?>" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Pesanan Aktif
        </a>
    </div>
    <div class="card-body">
        <?php if(empty($orders)): ?>
            <div class="text-center p-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <p class="h5">Belum ada riwayat pesanan.</p>
            </div>
        <?php else: ?>
            <div class="accordion" id="historyAccordion">
                <?php foreach($orders as $order): ?>
                    <div class="accordion-item mb-2">
                        <h2 class="accordion-header" id="heading<?= $order['id'] ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $order['id'] ?>">
                                <div class="w-100 d-flex justify-content-between pe-3">
                                    <span><strong>#<?= $order['id'] ?> - <?= esc($order['customer_name']) ?></strong></span>
                                    <span>Rp <?= number_format($order['total_price']) ?>
                                        <span class="badge ms-3 <?= $order['status'] == 'Selesai' ? 'bg-success' : 'bg-secondary' ?>"><?= $order['status'] ?></span>
                                    </span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse<?= $order['id'] ?>" class="accordion-collapse collapse" data-bs-parent="#historyAccordion">
                             <div class="accordion-body">
                                <p><strong>Info Pemesan:</strong> <?= esc($order['customer_name']) ?> (<?= esc($order['customer_whatsapp']) ?>) pada <?= date('d M Y, H:i', strtotime($order['created_at'])) ?></p>
                                <table class="table table-sm">
                                    <thead><tr><th>Item</th><th class="text-center">Jumlah</th><th class="text-end">Subtotal</th></tr></thead>
                                    <tbody>
                                    <?php foreach($order['items'] as $item): ?>
                                        <tr><td><?= esc($item['menu_name']) ?></td><td class="text-center">x<?= $item['quantity'] ?></td><td class="text-end">Rp <?= number_format($item['price'] * $item['quantity']) ?></td></tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>