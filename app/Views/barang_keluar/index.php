<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Keluar</title>
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

            <a href="<?= base_url('barang-masuk') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50">
                <i data-lucide="package-check" class="w-5 h-5 mr-3"></i> Barang Masuk
            </a>

            <a href="<?= base_url('barang-keluar') ?>" class="flex items-center p-3 text-sm text-white bg-indigo-600 rounded-lg">
                <i data-lucide="package-minus" class="w-5 h-5 mr-3"></i> Barang Keluar
            </a>

            <a href="<?= base_url('stockopname') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50">
                <i data-lucide="warehouse" class="w-5 h-5 mr-3"></i> Opname
            </a>

            <a href="<?= base_url('kartu-persediaan') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50">
                <i data-lucide="id-card" class="w-5 h-5 mr-3"></i> Kartu Persediaan
            </a>

            <h3 class="text-xs font-semibold text-gray-400 pt-4 pb-2">LAPORAN</h3>

            <a href="<?= base_url('laporan/umum') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50">
                <i data-lucide="clipboard" class="w-5 h-5 mr-3"></i> Laporan Umum
            </a>

            <a href="<?= base_url('laporan/barang-masuk') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50">
                <i data-lucide="clipboard-plus" class="w-5 h-5 mr-3"></i> Laporan Masuk
            </a>

            <a href="<?= base_url('laporan/barang-keluar') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50">
                <i data-lucide="clipboard-minus" class="w-5 h-5 mr-3"></i> Laporan Keluar
            </a>

        </nav>
    </aside>

    <!-- MAIN -->
    <div class="lg:ml-64 p-6">

        <!-- TITLE -->
        <div class="flex items-center mb-6">
            <i data-lucide="upload" class="w-6 h-6 text-gray-600 mr-2"></i>
            <h2 class="text-2xl font-semibold">Barang Keluar (Penjualan)</h2>
        </div>

        <!-- ALERTS -->
        <?php if(session()->getFlashdata('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- FORM -->
        <form action="<?= base_url('barang-keluar/store') ?>" method="POST" class="bg-white p-6 rounded-xl shadow-md mb-6 space-y-4">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium">Pilih Barang</label>
                    <select name="product_id" id="product_select" class="w-full border rounded-lg p-2 mt-1" required>
                        <option value="">-- Pilih Barang --</option>
                        <?php foreach ($products as $p): ?>
                            <option value="<?= $p['id'] ?>" data-price="<?= $p['default_price'] ?>" data-stock="<?= $p['stock'] ?>">
                                <?= $p['name'] ?> (Stock: <?= $p['stock'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="text-sm font-medium">Nama Customer / Tujuan</label>
                    <input type="text" name="customer_name" class="w-full border rounded-lg p-2 mt-1" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="text-sm font-medium">Jumlah Keluar</label>
                    <input type="number" name="qty" class="w-full border rounded-lg p-2 mt-1" required>
                </div>
                <div>
                    <label class="text-sm font-medium">Harga Jual (Per Unit)</label>
                    <input type="number" step="0.01" name="price" id="price_input" class="w-full border rounded-lg p-2 mt-1" required>
                </div>
                <div>
                    <label class="text-sm font-medium">Tanggal Keluar</label>
                    <input type="date" name="sale_date" value="<?= date('Y-m-d') ?>" class="w-full border rounded-lg p-2 mt-1" required>
                </div>
            </div>

            <div class="flex justify-end">
                <button class="px-6 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition">
                    Simpan Transaksi
                </button>
            </div>
        </form>

        <!-- TABLE -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h3 class="text-lg font-semibold mb-4">Riwayat Barang Keluar</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-4 text-left text-xs font-semibold text-gray-500">#</th>
                            <th class="p-4 text-left text-xs font-semibold text-gray-500">Tanggal</th>
                            <th class="p-4 text-left text-xs font-semibold text-gray-500">Barang</th>
                            <th class="p-4 text-left text-xs font-semibold text-gray-500">Customer</th>
                            <th class="p-4 text-left text-xs font-semibold text-gray-500">Qty</th>
                            <th class="p-4 text-left text-xs font-semibold text-gray-500">Subtotal</th>
                            <th class="p-4"></th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($barang_keluar)): $no = 1; ?>
                            <?php foreach ($barang_keluar as $b): ?>
                                <tr>
                                    <td class="p-4"><?= $no++ ?></td>
                                    <td class="p-4"><?= $b['sale_date'] ?></td>
                                    <td class="p-4">
                                        <div class="font-medium"><?= $b['name'] ?></div>
                                        <div class="text-xs text-gray-500"><?= $b['code'] ?></div>
                                    </td>
                                    <td class="p-4"><?= $b['customer_name'] ?></td>
                                    <td class="p-4 font-bold text-red-600">-<?= $b['qty'] ?></td>
                                    <td class="p-4"><?= number_format($b['subtotal'], 0, ',', '.') ?></td>
                                    <td class="p-4 text-right">
                                        <a href="<?= base_url('barang-keluar/delete/'.$b['id']) ?>" 
                                           onclick="return confirm('Are you sure? Stock will be restored.')"
                                           class="text-red-600 hover:text-red-800 text-sm">
                                           Batalkan
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="p-8 text-center text-gray-500">Belum ada data penjualan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

<script>
    lucide.createIcons();

    // Optional: Auto-fill price based on product selection
    const productSelect = document.getElementById('product_select');
    const priceInput = document.getElementById('price_input');

    productSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        if(price) {
            priceInput.value = price;
        }
    });
</script>

</body>
</html>