<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Barang Gudang Material</title>
    
    <!-- Load Tailwind CSS CDN for Layout -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Inter font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Load Lucide Icons for vector graphics -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Existing Bootstrap CSS for Table/Buttons (Kept for styling) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        /* Sidebar transition for responsive hiding/showing */
        .sidebar { transition: transform 0.3s ease-in-out, width 0.3s ease-in-out; }

        /* Ensure Bootstrap container content adapts to the new Tailwind layout */
        .dashboard-content-wrapper .container {
            max-width: 100%;
            padding: 0;
            margin-top: 0 !important;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- 1. Sidebar -->
    <aside id="sidebar" class="fixed z-40 inset-y-0 left-0 w-64 bg-white shadow-lg transform lg:translate-x-0 -translate-x-full transition-all duration-300 ease-in-out flex flex-col">
        <!-- Sidebar Header -->
        <div class="h-16 flex items-center p-4 border-b border-gray-200">
            <h1 class="text-xl font-bold text-indigo-700">Gudang Material</h1>
            <!-- Menu toggle for mobile (close button) -->
            <button id="menu-close-button" onclick="document.getElementById('menu-button').click()" class="lg:hidden ml-auto text-gray-500 hover:text-gray-700 p-2 rounded-full hover:bg-gray-100">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 overflow-y-auto p-4 space-y-2">
            <!-- Dashboard (Inactive) -->
            <a href="<?= base_url('dashboard') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
                Dashboard
            </a>

            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider pt-4 pb-2">MASTER</h3>
            <!-- Barang (Active) -->
            <a href="<?= base_url('products') ?>" class="flex items-center p-3 text-sm font-semibold text-white bg-indigo-600 rounded-lg shadow-md transition-colors hover:bg-indigo-700">
                <i data-lucide="package" class="w-5 h-5 mr-3"></i>
                Barang
            </a>

            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider pt-4 pb-2">TRANSAKSI</h3>
            <a href="<?= base_url('barang-masuk') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                <i data-lucide="download" class="w-5 h-5 mr-3"></i>
                Barang Masuk
            </a>
            <a href="<?= base_url('barang-keluar') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                <i data-lucide="upload" class="w-5 h-5 mr-3"></i>
                Barang Keluar
            </a>

            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider pt-4 pb-2">LAPORAN</h3>
            <a href="#" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                <i data-lucide="file-text" class="w-5 h-5 mr-3"></i>
                Laporan Stok
            </a>
            <a href="#" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                <i data-lucide="clipboard-list" class="w-5 h-5 mr-3"></i>
                Laporan Barang Masuk
            </a>
            <a href="#" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                <i data-lucide="clipboard-check" class="w-5 h-5 mr-3"></i>
                Laporan Barang Keluar
            </a>

            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider pt-4 pb-2">PENGATURAN</h3>
            <a href="#" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                <i data-lucide="users" class="w-5 h-5 mr-3"></i>
                Manajemen User
            </a>

            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider pt-4 pb-2">BANTUAN</h3>
            <a href="#" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                <i data-lucide="help-circle" class="w-5 h-5 mr-3"></i>
                Bantuan
            </a>
        </nav>
    </aside>

    <!-- 2. Main Content Area -->
    <div id="main-content" class="transition-all duration-300 ease-in-out lg:ml-64 p-4 lg:p-8">
        
        <!-- Top Navbar/Header (Visible on Mobile/Tablet) -->
        <header class="h-16 flex items-center justify-between bg-white shadow-md rounded-xl p-4 mb-6 sticky top-0 z-20 lg:hidden">
            <button id="menu-button" class="text-gray-500 hover:text-gray-700 p-2 rounded-full hover:bg-gray-100">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
            <h1 class="text-xl font-bold text-indigo-700">Gudang Material</h1>
            <button onclick="openUserMenu()" class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 text-white font-semibold hover:opacity-90">
                IS
            </button>
        </header>

        <!-- Page Header -->
        <div class="flex items-center mb-6">
            <i data-lucide="package" class="w-6 h-6 text-gray-600 mr-2"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Master Barang</h2>
        </div>

        <!-- Product List Content (Adapted Bootstrap content) -->
        <div class="dashboard-content-wrapper bg-white p-6 rounded-xl shadow-lg overflow-x-auto">
            
            <!-- Removed .container and .mt-5 to fit dashboard layout -->
            <a href="<?= base_url('products/create') ?>" class="btn btn-primary mb-3">Tambah Barang Baru</a>

            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <table class="table table-striped table-bordered mt-3">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Stok</th> <!-- Added Stock Header -->
                    <th>Harga Beli</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($products as $index => $product): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $product['code'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['category'] ?? '-' ?></td>
                        <td><?= $product['unit'] ?></td>
                        
                        <!-- Added Stock Column with conditional styling -->
                        <td class="<?= $product['stock'] < 10 ? 'text-danger fw-bold' : 'text-success fw-bold' ?>">
                            <?= $product['stock'] ?>
                        </td>

                        <td>Rp <?= number_format($product['default_price'], 0, ',', '.') ?></td>
                        <td><?= ucfirst($product['status']) ?></td>
                        <td>
                            <a href="<?= base_url('products/edit/'.$product['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                            <?php if($product['status'] === 'active'): ?>
                                <a href="<?= base_url('products/deactivate/'.$product['id']) ?>" class="btn btn-sm btn-danger">Nonaktifkan</a>
                            <?php else: ?>
                                <a href="<?= base_url('products/activate/'.$product['id']) ?>" class="btn btn-sm btn-success">Aktifkan</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Existing Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- 3. JavaScript and Firebase Setup -->
    <script type="module">
        // Firebase Imports (Used for Auth/User ID context, even if no Firestore ops here)
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
        import { getAuth, signInAnonymously, signInWithCustomToken, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
        import { getFirestore } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";
        import { setLogLevel } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

        // Set Firebase Log Level to Debug
        setLogLevel('Debug');

        let app, db, auth, userId = null;
        
        // UI Element References
        const sidebarElement = document.getElementById('sidebar');
        const mainContentElement = document.getElementById('main-content');
        const menuButton = document.getElementById('menu-button');
        
        // --- Firebase Initialization and Authentication ---
        const initFirebase = async () => {
            try {
                const firebaseConfig = JSON.parse(typeof __firebase_config !== 'undefined' ? __firebase_config : '{}');
                app = initializeApp(firebaseConfig);
                db = getFirestore(app);
                auth = getAuth(app);
                
                const initialAuthToken = typeof __initial_auth_token !== 'undefined' ? __initial_auth_token : null;

                onAuthStateChanged(auth, async (user) => {
                    if (user) {
                        userId = user.uid;
                    } else {
                        // Attempt sign-in if not authenticated
                        if (initialAuthToken) {
                            await signInWithCustomToken(auth, initialAuthToken);
                        } else {
                            await signInAnonymously(auth);
                        }
                    }
                    // Update the user ID display regardless of successful sign-in
                    // document.getElementById('user-id-display').textContent = userId || 'N/A';
                });
            } catch (error) {
                console.error("Firebase initialization failed:", error);
            }
        };

        // --- UI Interactions (Sidebar Toggle) ---
        const toggleSidebar = () => {
            const isHidden = sidebarElement.classList.toggle('-translate-x-full');
            
            // Adjust main content margin for desktop view
            if (!isHidden) {
                mainContentElement.classList.add('lg:ml-64');
            } else {
                mainContentElement.classList.remove('lg:ml-64');
            }
        };

        // Sidebar toggle on mobile menu button click
        if (menuButton) {
            menuButton.addEventListener('click', toggleSidebar);
        }

        // --- Initialization ---
        window.addEventListener('load', () => {
            // Initial state for desktop: sidebar visible, content offset
            if (window.innerWidth >= 1024) {
                sidebarElement.classList.remove('-translate-x-full');
                mainContentElement.classList.add('lg:ml-64');
            } else {
                // Initial state for mobile: sidebar hidden, content full width
                sidebarElement.classList.add('-translate-x-full');
                mainContentElement.classList.remove('lg:ml-64');
            }
            initFirebase();
            // Create lucide icons on load
            lucide.createIcons();
        });

        // Dummy function for user menu click (since the menu UI isn't fully implemented)
        window.openUserMenu = () => {
            console.log("User menu clicked! (Placeholder)");
        }
    </script>
</body>
</html>