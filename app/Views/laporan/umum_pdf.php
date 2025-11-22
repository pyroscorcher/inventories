<!DOCTYPE html>
<html>
<head>
    <title>Laporan Umum</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px; text-align: center; }
        h2 { text-align: center; }
    </style>
</head>
<body>

<h2>Laporan Umum</h2>

<table>
    <tr>
        <th>Total Qty Barang Masuk</th>
        <th>Total Transaksi Pembelian</th>
        <th>Total Qty Barang Keluar</th>
        <th>Total Transaksi Penjualan</th>
        <th>Grand Total</th>
    </tr>
    <tr>
        <td><?= $total_qty_masuk ?></td>
        <td>Rp <?= number_format($total_transaksi_masuk) ?></td>
        <td><?= $total_qty_keluar ?></td>
        <td>Rp <?= number_format($total_transaksi_keluar) ?></td>
        <td>Rp <?= number_format($grand_total) ?></td>
    </tr>
</table>

</body>
</html>
