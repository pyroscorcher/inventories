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

            <a href="<?= base_url('products') ?>" class="flex items-center p-3 text-sm text-white bg-indigo-600 rounded-lg">
                <i data-lucide="package" class="w-5 h-5 mr-3"></i> Barang
            </a>

            <h3 class="text-xs font-semibold text-gray-400 pt-4 pb-2">TRANSAKSI</h3>

            <a href="<?= base_url('barang-masuk') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50">
                <i data-lucide="package-check" class="w-5 h-5 mr-3"></i> Barang Masuk
            </a>

            <a href="<?= base_url('barang-keluar') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50">
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
    <div id="main-content" class="transition-all duration-300 ease-in-out lg:ml-64 p-4 lg:p-8">
        
        <!-- Mobile Header -->
        <header class="h-16 flex items-center justify-between bg-white shadow-md rounded-xl p-4 mb-6 sticky top-0 z-20 lg:hidden">
            <button id="menu-button" class="text-gray-500 hover:text-gray-700 p-2 rounded-full hover:bg-gray-100">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
            <h1 class="text-xl font-bold text-indigo-700">Gudang Material</h1>
            <button onclick="openUserMenu()" class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 text-white font-semibold hover:opacity-90">
                IS
            </button>
        </header>

        <div class="flex items-center mb-6">
            <i data-lucide="package" class="w-6 h-6 text-gray-600 mr-2"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Master Barang</h2>
        </div>

        <div class="dashboard-content-wrapper bg-white p-6 rounded-xl shadow-lg overflow-x-auto">

            <a href="<?= base_url('products/create') ?>"
            class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition mb-3">
                Tambah Barang Baru
            </a>

            <?php if(session()->getFlashdata('success')): ?>
                <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 border border-green-300">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <table class="min-w-full border border-gray-300 rounded-lg text-left text-sm">
                <thead class="bg-gray-100">
                <tr>
                    <th class="px-3 py-2 border">No</th>
                    <th class="px-3 py-2 border">Kode</th>
                    <th class="px-3 py-2 border">Nama</th>
                    <th class="px-3 py-2 border">Kategori</th>
                    <th class="px-3 py-2 border">Satuan</th>
                    <th class="px-3 py-2 border">Stok</th>
                    <th class="px-3 py-2 border">Harga Beli</th>
                    <th class="px-3 py-2 border">Status</th>
                    <th class="px-3 py-2 border">Aksi</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach($products as $index => $product): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-2 border"><?= $index + 1 ?></td>
                        <td class="px-3 py-2 border"><?= $product['code'] ?></td>
                        <td class="px-3 py-2 border"><?= $product['name'] ?></td>
                        <td class="px-3 py-2 border"><?= $product['category'] ?? '-' ?></td>
                        <td class="px-3 py-2 border"><?= $product['unit'] ?></td>

                        <td class="px-3 py-2 border font-bold 
                            <?= $product['stock'] < 10 ? 'text-red-600' : 'text-green-600' ?>">
                            <?= $product['stock'] ?>
                        </td>

                        <td class="px-3 py-2 border">
                            Rp <?= number_format($product['default_price'], 0, ',', '.') ?>
                        </td>

                        <td class="px-3 py-2 border">
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                <?= $product['status'] === 'active'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-gray-200 text-gray-700' ?>">
                                <?= ucfirst($product['status']) ?>
                            </span>
                        </td>

                        <td class="px-3 py-2 border space-x-1">
                            <a href="<?= base_url('products/edit/'.$product['id']) ?>"
                            class="inline-block bg-yellow-400 text-white px-3 py-1 rounded text-xs font-medium hover:bg-yellow-500 transition">
                                Edit
                            </a>

                            <?php if($product['status'] === 'active'): ?>
                                <a href="<?= base_url('products/deactivate/'.$product['id']) ?>"
                                class="inline-block bg-red-500 text-white px-3 py-1 rounded text-xs font-medium hover:bg-red-600 transition">
                                    Nonaktifkan
                                </a>
                            <?php else: ?>
                                <a href="<?= base_url('products/activate/'.$product['id']) ?>"
                                class="inline-block bg-green-500 text-white px-3 py-1 rounded text-xs font-medium hover:bg-green-600 transition">
                                    Aktifkan
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
<script>
    lucide.createIcons();
</script>

</body>
</html>
