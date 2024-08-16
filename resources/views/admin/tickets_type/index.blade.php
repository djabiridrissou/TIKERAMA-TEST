@extends('layouts.app')

@section('title', 'Gestion des tickets')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Gestion des tickets pour <span class="text-green-500">{{ $event->event_title }}</span></h1>
        @if(Auth::user()->role == 'admin')
        <a href="{{ route('tickets_type.create', $event->event_id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Créer ticket
        </a>
        @endif
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2 text-left">Nom</th>
                    <th class="border px-4 py-2 text-left">Prix</th>
                    <th class="border px-4 py-2 text-left">Description</th>
                    <th class="border px-4 py-2 text-left">Quantité Totale</th>
                    <th class="border px-4 py-2 text-left">Quantité Restante</th>
                    <th class="border px-4 py-2 text-left">Quantité Disponible</th>
                    <th class="border px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ticketTypes as $ticket)
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4 py-2">{{ $ticket->ticket_type_name }}</td>
                        <td class="border px-4 py-2">{{ $ticket->ticket_type_price }}</td>
                        <td class="border px-4 py-2">{{ $ticket->ticket_type_description }}</td>
                        <td class="border px-4 py-2">{{ $ticket->ticket_type_total_quantity }}</td>
                        <td class="border px-4 py-2">{{ $ticket->ticket_type_real_quantity }}</td>
                        <td class="border px-4 py-2">{{ $ticket->ticket_type_quantity}}</td>
                        <td class="border px-4 py-2 text-left">
                            @if(Auth::user()->role == 'admin')
                            <a href="{{ route('tickets_type.edit', $ticket->ticket_type_id) }}" class="text-yellow-500 hover:text-blue-300" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endif
                            @if(Auth::user()->role == 'vendeur')
                            <a href="javascript:void(0);" class="text-blue-500 hover:text-blue-300 order-btn" 
                               data-event-status="{{ $event->event_status }}" 
                               data-ticket-quantity="{{ $ticket->ticket_type_quantity }}"
                               data-order-url="{{ route('order_intent.create', $ticket->ticket_type_id) }}" 
                               title="Commander">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="border px-4 py-2 text-center">Aucun ticket enregistré pour cet Événement.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Structure -->
    <div id="statusModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-lg font-semibold mb-4" id="modalMessage"></h2>
                <button id="closeModal" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Fermer</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const orderButtons = document.querySelectorAll('.order-btn');
            const modal = document.getElementById('statusModal');
            const modalMessage = document.getElementById('modalMessage');
            const closeModal = document.getElementById('closeModal');

            orderButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const eventStatus = this.getAttribute('data-event-status');
                    const ticketQuantity = this.getAttribute('data-ticket-quantity');
                    const orderUrl = this.getAttribute('data-order-url');

                    if (eventStatus !== 'Upcoming') {
                        modalMessage.textContent = "Cet événement est passé.";
                        modal.classList.remove('hidden');
                    } else if (ticketQuantity <= 0) {
                        modalMessage.textContent = "Plus de tickets disponibles pour cet événement.";
                        modal.classList.remove('hidden');
                    } else {
                        window.location.href = orderUrl;
                    }
                });
            });

            closeModal.addEventListener('click', function () {
                modal.classList.add('hidden');
            });
        });
    </script>
@endsection