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

            <a href="<?= base_url('dashboard') ?>" class="flex items-center p-3 text-sm text-white bg-indigo-600 rounded-lg">
                <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i> Dashboard
            </a>

            <h3 class="text-xs font-semibold text-gray-400 pt-4 pb-2">MASTER</h3>

            <a href="<?= base_url('products') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50">
                <i data-lucide="package" class="w-5 h-5 mr-3"></i> Barang
            </a>

            <h3 class="text-xs font-semibold text-gray-400 pt-4 pb-2">TRANSAKSI</h3>

            <a href="<?= base_url('barang-masuk') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50">
                <i data-lucide="upload" class="w-5 h-5 mr-3"></i> Barang Masuk
            </a>

            <a href="<?= base_url('barang-keluar') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50">
                <i data-lucide="upload" class="w-5 h-5 mr-3"></i> Barang Keluar
            </a>

            <a href="<?= base_url('stockopname') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50">
                <i data-lucide="download" class="w-5 h-5 mr-3"></i> Opname
            </a>

        </nav>
    </aside>

    <!--Konten-->
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

        <!-- header-->
        <div class="flex items-center mb-6">
            <i data-lucide="layout-dashboard" class="w-6 h-6 text-gray-600 mr-2"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
        </div>

        <!-- Isi dashboard -->
        <main class="space-y-6">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-indigo-100 rounded-full text-indigo-600">
                            <i data-lucide="package" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Barang</p>
                            <p id="data-barang" class="text-3xl font-bold text-gray-900"><?= $totalProducts ?></p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-green-100 rounded-full text-green-600">
                            <i data-lucide="download" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Barang Masuk</p>
                            <p id="data-barang-masuk" class="text-3xl font-bold text-gray-900"><?= $totalPurchases ?></p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-yellow-100 rounded-full text-yellow-600">
                            <i data-lucide="upload" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Barang Keluar</p>
                            <p id="data-barang-keluar" class="text-3xl font-bold text-gray-900"><?= $totalSales ?></p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center space-x-4">
                    <div class="p-3 bg-orange-100 rounded-lg text-orange-600">
                        <i data-lucide="layers" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Data Jenis Barang</p>
                        <p id="data-jenis-barang" class="text-xl font-bold text-gray-900"><?= $totalCategories ?></p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center space-x-4">
                    <div class="p-3 bg-blue-100 rounded-lg text-blue-600">
                        <i data-lucide="folder" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Data Satuan</p>
                        <p id="data-satuan" class="text-xl font-bold text-gray-900"><?= $totalUnits ?></p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center space-x-4">
                    <div class="p-3 bg-green-100 rounded-lg text-green-600">
                        <i data-lucide="user-plus" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Data User</p>
                        <p id="data-user" class="text-xl font-bold text-gray-900"><?= $totalUsers ?></p>
                    </div>
                </div>
                
                
            </div>

        </main>
    </div>
    <script>      
    lucide.createIcons();
    </script>
</body>
</html>