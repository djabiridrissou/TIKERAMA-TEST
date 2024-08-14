
<div class="w-64 min-h-screen bg-white border border-r-2 border-gray-300 shadow-2xl text-black flex flex-col">
    <!-- Logo Section -->
    <div class="p-4 flex items-center justify-center bg-gray-900">
        <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" class="w-24 h-auto">
    </div>
    <!-- Menu -->
    <div class="flex-1 overflow-y-auto">
        <div class="p-4">
            <!-- <h2 class="text-xl font-semibold">Menu</h2> -->
            <ul class="mt-4 space-y-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-blue-400 rounded">Inscription en attente</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Logout Button -->
    <div class="p-4 mt-auto bg-gray-900">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 bg-red-600 hover:bg-red-700 rounded text-white">
                Logout
            </button>
        </form>
    </div>
</div>
