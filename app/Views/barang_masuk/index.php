<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Masuk</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- SIDEBAR -->
    <aside class="fixed z-40 inset-y-0 left-0 w-64 bg-white shadow-lg flex flex-col">
        <div class="h-16 flex items-center p-4 border-b border-gray-200">
            <h1 class="text-xl font-bold text-indigo-700">Gudang Material</h1>
        </div>

        <nav class="flex-1 overflow-y-auto p-4 space-y-2">

            <a href="<?= base_url('dashboard') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50">
                <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i> Dashboard
            </a>

            <h3 class="text-xs font-semibold text-gray-400 pt-4 pb-2">MASTER</h3>

            <a href="<?= base_url('products') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50">
                <i data-lucide="package" class="w-5 h-5 mr-3"></i> Barang
            </a>

            <h3 class="text-xs font-semibold text-gray-400 pt-4 pb-2">TRANSAKSI</h3>

            <a href="<?= base_url('barang-masuk') ?>" class="flex items-center p-3 text-sm text-white bg-indigo-600 rounded-lg">
                <i data-lucide="download" class="w-5 h-5 mr-3"></i> Barang Masuk
            </a>

            <a href="<?= base_url('barang-keluar') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50">
                <i data-lucide="upload" class="w-5 h-5 mr-3"></i> Barang Keluar
            </a>

        </nav>
    </aside>

    <!-- MAIN -->
    <div class="lg:ml-64 p-6">

        <!-- TITLE -->
        <div class="flex items-center mb-6">
            <i data-lucide="download" class="w-6 h-6 text-gray-600 mr-2"></i>
            <h2 class="text-2xl font-semibold">Barang Masuk</h2>
        </div>

        <!-- FORM -->
        <form action="<?= base_url('barang-masuk/store') ?>" method="POST" class="space-y-4">

            <div>
                <label class="text-sm font-medium">Barang</label>
                <select name="product_id" class="w-full border rounded-lg p-2 mt-1">
                    <?php foreach ($products as $p): ?>
                        <option value="<?= $p['id'] ?>">
                            <?= $p['name'] ?> (<?= $p['code'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="text-sm font-medium">Supplier</label>
                <input type="text" name="supplier_name" class="w-full border rounded-lg p-2 mt-1" required>
            </div>

            <div>
                <label class="text-sm font-medium">Jumlah</label>
                <input type="number" name="qty" class="w-full border rounded-lg p-2 mt-1" required>
            </div>

            <div>
                <label class="text-sm font-medium">Harga Beli</label>
                <input type="number" step="0.01" name="price" class="w-full border rounded-lg p-2 mt-1" required>
            </div>


            <div>
                <label class="text-sm font-medium">Tanggal Masuk</label>
                <input type="date" name="purchase_date" class="w-full border rounded-lg p-2 mt-1" required>
            </div>

            <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Simpan</button>
        </form>

        <!-- TABLE -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h3 class="text-lg font-semibold mb-4">Riwayat Barang Masuk</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-4 text-left text-xs font-semibold text-gray-500">#</th>
                            <th class="p-4 text-left text-xs font-semibold text-gray-500">Nama Barang</th>
                            <th class="p-4 text-left text-xs font-semibold text-gray-500">Jumlah</th>
                            <th class="p-4 text-left text-xs font-semibold text-gray-500">Tanggal Masuk</th>
                            <th class="p-4"></th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($barang_masuk)): $no = 1; ?>
                            <?php foreach ($barang_masuk as $b): ?>
                                <tr>
                                    <td class="p-4"><?= $no++ ?></td>
                                    <td class="p-4"><?= $b['name'] ?></td>
                                    <td class="p-4"><?= $b['qty'] ?></td>
                                    <td class="p-4"><?= $b['purchase_date'] ?></td>
                                    <td class="p-4 text-right">
                                        <a href="<?= base_url('barang-masuk/delete/'.$b['id']) ?>"
                                           class="text-red-600 hover:text-red-800">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-500">Belum ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

<script>
    lucide.createIcons();
</script>

</body>
</html>
