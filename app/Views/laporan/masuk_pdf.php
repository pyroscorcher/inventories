<!DOCTYPE html>
<html>
<head>
    <title>Laporan Barang Masuk</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px; text-align: center; }
        h2 { text-align: center; }
    </style>
</head>
<body>

<h2>Laporan Barang Masuk</h2>

<table>
    <thead>
        <tr>
            <th>Produk</th>
            <th>Supplier</th>
            <th>Tanggal</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($barang_masuk as $b): ?>
        <tr>
            <td><?= $b['product_name'] ?></td>
            <td><?= $b['supplier_name'] ?></td>
            <td><?= $b['purchase_date'] ?></td>
            <td><?= $b['qty'] ?></td>
            <td>Rp <?= number_format($b['price']) ?></td>
            <td>Rp <?= number_format($b['subtotal']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h3>Total Transaksi: Rp <?= number_format($total_transaksi) ?></h3>

</body>
</html>
