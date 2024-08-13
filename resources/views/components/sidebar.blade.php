<div class="w-64 h-full bg-gray-800 text-white">
    <div class="p-4">
        <h2 class="text-xl font-semibold">Menu</h2>
        <ul class="mt-4 space-y-2">
            @if(Auth::user()->role === 'admin')
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">Dashboard Admin</a>
                </li>
               
            @elseif(Auth::user()->role === 'vendeur')
                <li>
                    <a href="{{ route('vendeur.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">Dashboard Vendeur</a>
                </li>
               
            @else
                <li>
                    <a href="{{ route('client.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">Dashboard Client</a>
                </li>
               
            @endif
        </ul>

        <!-- Bouton de déconnexion -->
        <div class="mt-8">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 bg-red-600 hover:bg-red-700 rounded text-white">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
