<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pesanan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; }
        .header p { margin: 0; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Pesanan</h1>
        <p>Sorabi Ceu Neneng</p>
        <p>Periode: <?= date('d M Y', strtotime($dateRange['start'])) ?> - <?= date('d M Y', strtotime($dateRange['end'])) ?></p>
        <?php if (!empty($keyword)): ?>
            <p>Pencarian: "<?= esc($keyword) ?>"</p>
        <?php endif; ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Nama Pelanggan</th>
                <th>Item Dipesan</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($orders)): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data pesanan.</td>
                </tr>
            <?php else: ?>
                <?php $grandTotal = 0; ?>
                <?php foreach($orders as $order): ?>
                    <tr>
                        <td>#<?= $order['id'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                        <td><?= esc($order['customer_name']) ?></td>
                        <td>
                            <?php foreach($order['items'] as $item): ?>
                                - <?= esc($item['menu_name']) ?> (x<?= $item['quantity'] ?>)<br>
                            <?php endforeach; ?>
                        </td>
                        <td><?= $order['status'] ?></td>
                        <td style="text-align: right;">Rp <?= number_format($order['total_price']) ?></td>
                    </tr>
                    <?php if($order['status'] == 'Selesai') $grandTotal += $order['total_price']; ?>
                <?php endforeach; ?>
                <tr class="total">
                    <td colspan="5" style="text-align: right;">Total Pendapatan (Selesai)</td>
                    <td style="text-align: right;">Rp <?= number_format($grandTotal) ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>