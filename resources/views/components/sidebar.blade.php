<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-64 h-full bg-gray-800 text-white flex flex-col">
        <!-- Logo Section -->
        <div class="p-4 flex items-center justify-center bg-gray-900">
            <img src="path/to/your/logo.png" alt="Logo" class="w-24 h-auto">
        </div>
        <!-- Menu -->
        <div class="flex-1 overflow-y-auto">
            <div class="p-4">
                <h2 class="text-xl font-semibold">Menu</h2>
                <ul class="mt-4 space-y-2">
                    <!-- Admin Dashboard Link -->
                    <li>
                        <a href="admin-dashboard.html" class="block px-4 py-2 hover:bg-gray-700 rounded">Dashboard Admin</a>
                    </li>
                    <!-- Vendeur Dashboard Link -->
                    <li>
                        <a href="vendeur-dashboard.html" class="block px-4 py-2 hover:bg-gray-700 rounded">Dashboard Vendeur</a>
                    </li>
                    <!-- Client Dashboard Link -->
                    <li>
                        <a href="client-dashboard.html" class="block px-4 py-2 hover:bg-gray-700 rounded">Dashboard Client</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Logout Button -->
        <div class="p-4 mt-auto bg-gray-900">
            <form method="POST" action="logout">
                <button type="submit" class="w-full text-left px-4 py-2 bg-red-600 hover:bg-red-700 rounded text-white">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main content -->
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold">Admin Dashboard</h1>
        <!-- Contenu spécifique à l'admin -->
    </div>
</div>
