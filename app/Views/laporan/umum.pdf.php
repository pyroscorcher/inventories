<h2 style="text-align:center;">Laporan Umum Inventaris</h2>
<hr>

<h3>Barang Masuk</h3>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <th>Nama Barang</th>
        <th>Jumlah</th>
        <th>Total Harga</th>
    </tr>
    <?php foreach($barang_masuk as $bm): ?>
    <tr>
        <td><?= $bm['nama_barang'] ?></td>
        <td><?= $bm['qty'] ?></td>
        <td>Rp <?= number_format($bm['total_harga'],0,',','.') ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<p><strong>Total Pembelian: Rp <?= number_format($total_masuk,0,',','.') ?></strong></p>

<br>

<h3>Barang Keluar</h3>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <th>Nama Barang</th>
        <th>Jumlah</th>
        <th>Total Harga</th>
    </tr>
    <?php foreach($barang_keluar as $bk): ?>
    <tr>
        <td><?= $bk['nama_barang'] ?></td>
        <td><?= $bk['qty'] ?></td>
        <td>Rp <?= number_format($bk['total_harga'],0,',','.') ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<p><strong>Total Penjualan: Rp <?= number_format($total_keluar,0,',','.') ?></strong></p>
