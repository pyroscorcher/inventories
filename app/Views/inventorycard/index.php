<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gudang Material Dashboard</title>
    <!-- Load Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Inter font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Load Lucide Icons for vector graphics -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        /* Sidebar transition for responsive hiding/showing */
        .sidebar { transition: transform 0.3s ease-in-out, width 0.3s ease-in-out; }
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

            <a href="<?= base_url('barang-keluar') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50">
                <i data-lucide="package-minus" class="w-5 h-5 mr-3"></i> Barang Keluar
            </a>

            <a href="<?= base_url('stockopname') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50">
                <i data-lucide="warehouse" class="w-5 h-5 mr-3"></i> Opname
            </a>

            <a href="<?= base_url('kartu-persediaan') ?>" class="flex items-center p-3 text-sm text-white bg-indigo-600 rounded-lg">
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

    <!--Konten-->
    <div class="p-6 lg:ml-64">

        <h2 class="text-2xl font-semibold mb-6 flex items-center">
            <i data-lucide="file-text" class="w-6 h-6 mr-2 text-gray-600"></i>
            Kartu Persediaan Barang
        </h2>

        <!-- FILTER FORM -->
        <form action="<?= base_url('kartu-persediaan/filter') ?>" method="POST"
            class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-white p-4 rounded-lg shadow">

            <div>
                <label class="text-sm font-medium text-gray-700">Periode Dari</label>
                <input type="date" name="from" class="mt-1 w-full border rounded p-2" required>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Sampai</label>
                <input type="date" name="to" class="mt-1 w-full border rounded p-2" required>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Pilih Barang</label>
                <select name="product_id" class="mt-1 w-full border rounded p-2" required>
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach ($products as $p): ?>
                        <option value="<?= $p['id'] ?>">
                            <?= $p['name'] ?> (<?= $p['code'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="md:col-span-3">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Tampilkan
                </button>
            </div>
        </form>

        <?php if ($result): ?>
            <!-- RESULT CARD -->
            <div class="mt-6 bg-white shadow rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4">
                    Hasil Kartu Persediaan – <?= $result['product']['name'] ?> (<?= $result['product']['code'] ?>)
                </h3>

                <table class="w-full text-left border-collapse">
                    <tbody class="text-gray-800 text-sm">
                        <tr>
                            <td class="py-2 font-medium">Periode</td>
                            <td><?= $result['from'] ?> → <?= $result['to'] ?></td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Stok Awal</td>
                            <td><?= $result['stock_awal'] ?></td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Total Masuk</td>
                            <td><?= $result['total_masuk'] ?></td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Total Keluar</td>
                            <td><?= $result['total_keluar'] ?></td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Selisih Opname</td>
                            <td class="<?= $result['selisih_opname'] < 0 ? 'text-red-600' : 'text-green-600' ?>">
                                <?= $result['selisih_opname'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Saldo Akhir</td>
                            <td class="font-bold text-blue-700 text-lg">
                                <?= $result['saldo_akhir'] ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    </div>
    <script>      
    lucide.createIcons();
    </script>
</body>
</html>