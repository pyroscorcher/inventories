<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Opname</title>

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

            <a href="<?= base_url('barang-keluar') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50">
                <i data-lucide="package-minus" class="w-5 h-5 mr-3"></i> Barang Keluar
            </a>

            <a href="<?= base_url('stockopname') ?>" class="flex items-center p-3 text-sm text-white bg-indigo-600 rounded-lg">
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
            <i data-lucide="download" class="w-6 h-6 text-gray-600 mr-2"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Stok Opname</h2>
        </div>

        <!-- SUCCESS ALERT -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-4 p-4 rounded-md bg-green-50 border border-green-200 text-green-700 text-sm">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- FORM -->
        <form action="<?= base_url('stockopname/process') ?>" method="POST" class="space-y-4">

            <!-- TABLE WRAPPER -->
            <div class="overflow-x-auto rounded-lg shadow-sm border border-gray-200 bg-white">
                <table class="w-full text-left border-collapse">
                    
                    <!-- TABLE HEADER -->
                    <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                        <tr>
                            <th class="px-4 py-3 border-b">Product</th>
                            <th class="px-4 py-3 border-b">System Stock</th>
                            <th class="px-4 py-3 border-b">Physical Stock</th>
                            <th class="px-4 py-3 border-b">Difference</th>
                        </tr>
                    </thead>

                    <!-- TABLE BODY -->
                    <tbody class="text-gray-800">
                        <?php foreach ($products as $p): ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 border-b">
                                    <div class="font-medium"><?= $p['name'] ?></div>
                                    <div class="text-sm text-gray-500"><?= $p['code'] ?></div>
                                </td>

                                <td class="px-4 py-3 border-b text-gray-700">
                                    <?= $p['stock'] ?>
                                </td>

                                <td class="px-4 py-3 border-b">
                                    <input type="number"
                                        name="opname[<?= $p['id'] ?>]"
                                        data-system="<?= $p['stock'] ?>"
                                        class="physical-input w-32 px-3 py-2 border rounded-md text-sm focus:ring focus:ring-blue-200 focus:border-blue-500"
                                        required>
                                </td>

                                <td class="difference px-4 py-3 border-b text-gray-700 font-semibold">0</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- SUBMIT BUTTON -->
            <button class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow-sm text-sm font-medium transition">
                Update Stock
            </button>

        </form>
    </div>

<script>
    // Auto-calc difference
    document.querySelectorAll('.physical-input').forEach(input => {
        input.addEventListener('input', function() {
            const system = parseInt(this.dataset.system);
            const physical = parseInt(this.value || 0);
            const diff = physical - system;

            this.closest('tr').querySelector('.difference').textContent = diff;
        });
    });

    lucide.createIcons();
</script>

</body>
</html>
