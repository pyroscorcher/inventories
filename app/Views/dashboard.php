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

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed z-40 inset-y-0 left-0 w-64 bg-white shadow-lg transform lg:translate-x-0 -translate-x-full transition-all duration-300 ease-in-out flex flex-col">
        <div class="h-16 flex items-center p-4 border-b border-gray-200">
            <h1 class="text-xl font-bold text-indigo-700">Gudang Material</h1>
            <button id="menu-close-button" onclick="document.getElementById('menu-button').click()" class="lg:hidden ml-auto text-gray-500 hover:text-gray-700 p-2 rounded-full hover:bg-gray-100">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 overflow-y-auto p-4 space-y-2">
            <a href="#" class="flex items-center p-3 text-sm font-semibold text-white bg-indigo-600 rounded-lg shadow-md transition-colors hover:bg-indigo-700">
                <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
                Dashboard
            </a>

            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider pt-4 pb-2">MASTER</h3>
            <a href="<?= base_url('products') ?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                <i data-lucide="package" class="w-5 h-5 mr-3"></i>
                Barang
            </a>

            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider pt-4 pb-2">TRANSAKSI</h3>
            <a href="<?= base_url("barang-masuk")?>" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                <i data-lucide="box" class="w-5 h-5 mr-3"></i>
                Barang Masuk
            </a>
            <a href="#" class="flex items-center p-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                <i data-lucide="archive" class="w-5 h-5 mr-3"></i>
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

    <!-- Main Content Area -->
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

        <!-- Dashboard Header -->
        <div class="flex items-center mb-6">
            <i data-lucide="layout-dashboard" class="w-6 h-6 text-gray-600 mr-2"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
        </div>

        <!-- Dashboard Content -->
        <main class="space-y-6">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-indigo-100 rounded-full text-indigo-600">
                            <i data-lucide="package" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Data Barang</p>
                            <p id="data-barang" class="text-3xl font-bold text-gray-900">10</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-green-100 rounded-full text-green-600">
                            <i data-lucide="download" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Data Barang Masuk</p>
                            <p id="data-barang-masuk" class="text-3xl font-bold text-gray-900">11</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-yellow-100 rounded-full text-yellow-600">
                            <i data-lucide="upload" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Data Barang Keluar</p>
                            <p id="data-barang-keluar" class="text-3xl font-bold text-gray-900">14</p>
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
                        <p id="data-jenis-barang" class="text-xl font-bold text-gray-900">14</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center space-x-4">
                    <div class="p-3 bg-blue-100 rounded-lg text-blue-600">
                        <i data-lucide="folder" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Data Satuan</p>
                        <p id="data-satuan" class="text-xl font-bold text-gray-900">10</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center space-x-4">
                    <div class="p-3 bg-green-100 rounded-lg text-green-600">
                        <i data-lucide="user-plus" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Data User</p>
                        <p id="data-user" class="text-xl font-bold text-gray-900">3</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-lg border-l-4 border-red-500 flex items-center space-x-3">
                <i data-lucide="alert-triangle" class="w-5 h-5 text-red-500 flex-shrink-0"></i>
                <p class="text-sm font-medium text-gray-700">Stok barang telah mencapai batas minimum</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg overflow-x-auto">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-4 space-y-3 sm:space-y-0">
                    <div class="flex items-center space-x-2">
                        <label for="show-data" class="text-sm text-gray-600">Tampilkan</label>
                        <select id="show-data" class="rounded-lg border-gray-300 shadow-sm text-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option>10</option>
                            <option>25</option>
                            <option>50</option>
                        </select>
                        <span class="text-sm text-gray-600">data</span>
                    </div>
                    <div class="flex items-center space-x-2 w-full sm:w-auto">
                        <label for="search" class="text-sm text-gray-600 flex-shrink-0">Cari:</label>
                        <input type="text" id="search" placeholder="Cari..." class="w-full sm:w-64 rounded-lg border-gray-300 shadow-sm text-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">No.</div>
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">ID Barang</div>
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">Nama Barang</div>
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">Jenis Barang</div>
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">Stok</div>
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">Satuan</div>
                            </th>
                            <th scope="col" class="p-4 relative px-6">
                                <span class="sr-only">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="inventory-table-body" class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $index => $product): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-4 text-sm text-gray-500">
                                        <?= $index + 1 ?>
                                    </td>
                                    <td class="p-4 text-sm font-medium text-gray-900">
                                        <?= esc($product['code']) ?>
                                    </td>
                                    <td class="p-4 text-sm text-gray-700">
                                        <?= esc($product['name']) ?>
                                    </td>
                                    <td class="p-4 text-sm text-gray-500">
                                        <span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                                            <?= esc($product['category'] ?? '-') ?>
                                        </span>
                                    </td>
                                    <td class="p-4 text-sm font-bold <?= $product['stock'] < 10 ? 'text-red-600' : 'text-green-600' ?>">
                                        <?= esc($product['stock']) ?>
                                    </td>
                                    <td class="p-4 text-sm text-gray-500">
                                        <?= esc($product['unit']) ?>
                                    </td>
                                    <td class="p-4 text-right text-sm font-medium">
                                        <a href="<?= base_url('products/delete/' . $product['id']) ?>" 
                                           onclick="return confirm('Yakin ingin menghapus barang ini?')"
                                           class="text-red-600 hover:text-red-900 flex items-center justify-end gap-1">
                                           <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="p-8 text-center text-gray-400">
                                    Tidak ada data barang ditemukan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Table Footer/Pagination -->
                <div class="flex flex-col sm:flex-row justify-between items-center mt-4 space-y-3 sm:space-y-0">
                    <p id="row-summary" class="text-sm text-gray-700">
                    </p>
                    <div class="flex items-center space-x-1">
                        <button class="p-2 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-100 disabled:opacity-50" disabled>
                            <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        </button>
                        <span class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg">1</span>
                        <button class="p-2 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-100 disabled:opacity-50" disabled>
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- JavaScript and Firebase Setup -->
    <script type="module">
        // Firebase Imports
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
        import { getAuth, signInAnonymously, signInWithCustomToken, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
        import { getFirestore, collection, onSnapshot, query, setDoc, doc, addDoc } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";
        import { setLogLevel } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

        // Set Firebase Log Level to Debug
        setLogLevel('Debug');

        let app, db, auth, userId = null;
        
        // UI Element References
        const sidebarElement = document.getElementById('sidebar');
        const mainContentElement = document.getElementById('main-content');
        const menuButton = document.getElementById('menu-button');
        
        // --- Mock Data State ---
        // This data would typically come from Firestore in a real app
        const dataState = {
            summary: { barang: 10, barangMasuk: 11, barangKeluar: 14, jenisBarang: 14, satuan: 10, user: 3 },
            inventory: [
                { id: 'B0004', name: 'Gesapax 500 SC', type: 'Herbisida', stock: 10, unit: 'Liter' },
                { id: 'B0005', name: 'Amonia Cair', type: 'Bahan Kimia Pengolahan', stock: 1, unit: 'Liter' },
            ]
        };


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
                    document.getElementById('user-id-display').textContent = userId || 'N/A';
                    if (userId) {
                        setupDataListener();
                    }
                });
            } catch (error) {
                console.error("Firebase initialization failed:", error);
            }
        };

        // --- Data Rendering ---
        const renderDashboard = () => {
            // Update summary cards
            document.getElementById('data-barang').textContent = dataState.summary.barang;
            document.getElementById('data-barang-masuk').textContent = dataState.summary.barangMasuk;
            document.getElementById('data-barang-keluar').textContent = dataState.summary.barangKeluar;
            document.getElementById('data-jenis-barang').textContent = dataState.summary.jenisBarang;
            document.getElementById('data-satuan').textContent = dataState.summary.satuan;
            document.getElementById('data-user').textContent = dataState.summary.user;

            // Update inventory table
            const tableBody = document.getElementById('inventory-table-body');
            tableBody.innerHTML = '';
            dataState.inventory.forEach((item, index) => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50';
                const stockColor = item.stock <= 5 ? 'bg-orange-500' : 'bg-green-500'; // Match the image color scheme

                row.innerHTML = `
                    <td class="p-4 whitespace-nowrap text-sm font-medium text-gray-900">${index + 1}</td>
                    <td class="p-4 whitespace-nowrap text-sm text-gray-500">${item.id}</td>
                    <td class="p-4 whitespace-nowrap text-sm text-gray-900">${item.name}</td>
                    <td class="p-4 whitespace-nowrap text-sm text-gray-500">${item.type}</td>
                    <td class="p-4 whitespace-nowrap text-sm">
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${stockColor} text-white">
                            ${item.stock}
                        </span>
                    </td>
                    <td class="p-4 whitespace-nowrap text-sm text-gray-500">${item.unit}</td>
                    <td class="p-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-indigo-600 hover:text-indigo-900" title="Edit Item">
                            <i data-lucide="edit" class="w-4 h-4"></i>
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
            });

            // Update summary of displayed rows
            document.getElementById('row-summary').textContent = `Menampilkan 1 sampai ${dataState.inventory.length} dari ${dataState.inventory.length} data`;

            // Replace lucide icons
            lucide.createIcons();
        };

        const setupDataListener = () => {
            // In a real application, you would set up Firestore listeners here to get real-time data.
            // For now, we just render the mock data.
            renderDashboard();

            // Example Firestore listener setup (Uncomment to use real public data):
            /*
            const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';
            // Collection path for public data: /artifacts/{appId}/public/data/inventory
            const publicCollectionPath = `/artifacts/${appId}/public/data/inventory`;
            const q = query(collection(db, publicCollectionPath));

            onSnapshot(q, (snapshot) => {
                dataState.inventory = snapshot.docs.map(doc => ({ id: doc.id, ...doc.data() }));
                // You would also fetch and update dataState.summary from another collection/doc
                renderDashboard();
            }, (error) => {
                console.error("Error setting up data listener:", error);
            });
            */
        };

        // --- UI Interactions ---
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
            // Create icons on load
            lucide.createIcons();
        });

        // Dummy function for user menu click (since the menu UI isn't fully implemented)
        window.openUserMenu = () => {
            console.log("User menu clicked! (Placeholder)");
        }
    </script>
</body>
</html>