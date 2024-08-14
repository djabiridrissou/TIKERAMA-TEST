<!-- resources/views/dashboard/admin.blade.php -->
@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Inscription en attente</h1>

    <div class="overflow-x-auto">
        <table id="inscriptions-table" class="display w-full border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2 text-left">Nom</th>
                    <th class="border px-4 py-2 text-left">Prenom</th>
                    <th class="border px-4 py-2 text-left">Entreprise</th>
                    <th class="border px-4 py-2 text-left">Email</th>
                    <th class="border px-4 py-2 text-left">Adresse</th>
                    <th class="border px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inscriptions as $inscription)
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4 py-2">{{ $inscription->name }}</td>
                        <td class="border px-4 py-2">{{ $inscription->surname }}</td>
                        <td class="border px-4 py-2">{{ $inscription->enterprise }}</td>
                        <td class="border px-4 py-2">{{ $inscription->email }}</td>
                        <td class="border px-4 py-2">{{ $inscription->address }}</td>
                        <td class="border px-4 py-2 text-left">
                            <a href="{{ route('admin.dashboard.approve', $inscription->id) }}" class="text-blue-500 hover:text-blue-700" title="Valider">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border px-4 py-2 text-center">Il n'y a rien à valider.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $inscriptions->links() }}
    </div>

     <!-- Modal -->
     <div id="confirmationModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4">
        <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-semibold">Confirmation</h3>
            <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="px-4 py-3">
            <p>Les informations ont été envoyées à l'utilisateur sur son mail renseigné.</p>
        </div>
        <div class="px-4 py-3 border-t border-gray-200 flex justify-end">
            <button id="closeModalBtn" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Fermer</button>
        </div>
    </div>
</div>
    
@endsection

@push('styles')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <!-- Include jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" integrity="sha512-e06VVcxy0XERpYdo0+uk1u3mGeHIMK7+3q8GpN6nV5jfzIkA1Mx+gA8q5LCCY9vJ6j6H9Vbqx93+m2WS/qWQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/dashboards/admin.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
@endpush
