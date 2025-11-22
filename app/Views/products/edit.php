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
            <i data-lucide="edit" class="w-6 h-6 text-gray-600 mr-2"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Edit Barang</h2>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg">
            <form action="<?= base_url('products/update/'.$product['id']) ?>" method="post" class="space-y-5">

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
                    <input type="text" id="name" name="name"
                        value="<?= $product['name'] ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        required>
                </div>

                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Kode Barang</label>
                    <input type="text" id="code" name="code"
                        value="<?= $product['code'] ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        required>
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <input type="text" id="category" name="category"
                        value="<?= $product['category'] ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label for="unit" class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
                    <input type="text" id="unit" name="unit"
                        value="<?= $product['unit'] ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        required>
                </div>
                <div>
                    <label for="default_price" class="block text-sm font-medium text-gray-700 mb-1">Harga Beli</label>
                    <input type="number" id="default_price" name="default_price"
                        value="<?= $product['default_price'] ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        required>
                </div>

                <div class="flex space-x-3">
                    <button type="submit"
                            class="px-5 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition">
                        Update
                    </button>

                    <a href="<?= base_url('products') ?>"
                    class="px-5 py-2 bg-gray-300 text-gray-800 rounded-lg font-medium hover:bg-gray-400 transition">
                        Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>

<script>
    lucide.createIcons();
</script>

</body>
</html>
