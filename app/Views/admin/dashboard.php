<?= $this->extend('layouts/admin_layout') ?>
<?= $this->section('title') ?>Dashboard Admin<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Panel Filter dan Pencarian Terintegrasi -->
<div class="card mb-4">
    <div class="card-body">
        <form action="<?= base_url('admin') ?>" method="get" class="d-flex flex-column flex-md-row align-items-md-center gap-3">
            
            <!-- Filter Waktu -->
            <div class="btn-group" role="group">
                <a href="<?= site_url('admin?filter=today&keyword='.urlencode($keyword ?? '')) ?>" class="btn btn-sm <?= ($active_filter == 'today') ? 'btn-dark' : 'btn-outline-dark' ?>">Hari Ini</a>
                <a href="<?= site_url('admin?filter=this_week&keyword='.urlencode($keyword ?? '')) ?>" class="btn btn-sm <?= ($active_filter == 'this_week') ? 'btn-dark' : 'btn-outline-dark' ?>">Minggu Ini</a>
                <a href="<?= site_url('admin?filter=this_month&keyword='.urlencode($keyword ?? '')) ?>" class="btn btn-sm <?= ($active_filter == 'this_month') ? 'btn-dark' : 'btn-outline-dark' ?>">Bulan Ini</a>
                <a href="<?= site_url('admin?filter=this_year&keyword='.urlencode($keyword ?? '')) ?>" class="btn btn-sm <?= ($active_filter == 'this_year') ? 'btn-dark' : 'btn-outline-dark' ?>">Tahun Ini</a>
            </div>

            <!-- Spacer untuk memisahkan di layar besar -->
            <div class="ms-md-auto"></div>

            <!-- Input Pencarian -->
            <!-- Input Pencarian dengan Tombol Teks -->
<div class="input-group input-group-sm" style="max-width:300px">
    <input type="text" name="keyword" class="form-control" placeholder="Cari Nama / ID..." value="<?= esc($keyword ?? '') ?>">
    <input type="hidden" name="filter" value="<?= esc($active_filter ?? 'today') ?>">
    
    <!-- TOMBOL CARI DENGAN TEKS -->
    <button class="btn btn-primary" type="submit">Cari</button>
    
    <!-- TOMBOL RESET DENGAN TEKS -->
    <a href="<?= site_url('admin?filter=' . esc($active_filter ?? 'today')) ?>" class="btn btn-outline-secondary">Reset</a>
</div>

<a href="<?= site_url('admin/dashboard/download?filter='.esc($active_filter ?? 'today').'&keyword='.urlencode($keyword ?? '')) ?>" 
               class="btn btn-sm btn-success ms-md-2" target="_blank">
                <i class="fas fa-file-pdf me-1"></i> Download Laporan
            </a>
        </form>
    </div>
</div>

<!-- Kartu Statistik -->
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-primary shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0"><?= $orders_count ?? 0 ?></h4>
                        <p class="mb-0">Total Pesanan</p>
                    </div>
                    <i class="fas fa-shopping-cart fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card text-dark bg-warning shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0"><?= $new_orders ?? 0 ?></h4>
                        <p class="mb-0">Pesanan Baru</p>
                    </div>
                    <i class="fas fa-bell fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-success shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">Rp <?= number_format($total_revenue ?? 0, 0, ',', '.') ?></h4>
                        <p class="mb-0">Pendapatan (Selesai)</p>
                    </div>
                    <i class="fas fa-dollar-sign fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Pesanan Terbaru -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Daftar Pesanan di Periode Ini</h5>
    </div>
    <div class="card-body">
        <?php if (empty($recent_orders)): ?>
            <p class="text-center text-muted">Tidak ada pesanan yang cocok dengan filter Anda.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($recent_orders as $order): ?>
                            <tr>
                                <td>#<?= $order['id'] ?></td>
                                <td><?= esc($order['customer_name']) ?></td>
                                <td>Rp <?= number_format($order['total_price']) ?></td>
                                <td><span class="badge bg-info text-dark"><?= $order['status'] ?></span></td>
                                <td><?= date('d M Y, H:i', strtotime($order['created_at'])) ?> WIB</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>