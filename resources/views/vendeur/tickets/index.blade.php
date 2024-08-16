
@extends('layouts.app')

@section('title', 'Tickets')

@section('content')
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2 text-left">Evenement</th>
                    <th class="border px-4 py-2 text-left">Type de ticket</th>
                    <th class="border px-4 py-2 text-left">Prix</th>
                    <th class="border px-4 py-2 text-left">Clé unique</th>
                    <th class="border px-4 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $ticket)
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4 py-2">{{ $ticket->event->event_title }}</td>
                        <td class="border px-4 py-2">{{ $ticket->ticketType->ticket_type_name }}</td>
                        <td class="border px-4 py-2">{{ $ticket->ticket_price }}</td>
                        <td class="border px-4 py-2">{{ $ticket->ticket_key }}</td>
                        <td class="border px-4 py-2">{{ $ticket->ticket_status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="border px-4 py-2 text-center">Aucun ticket à afficher pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
