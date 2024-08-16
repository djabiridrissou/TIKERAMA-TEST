<!-- resources/views/dashboard/events.blade.php -->
@extends('layouts.app')

@section('title', 'Gestion des Événements')

@section('content')
    @if(Auth::user()->role !== 'vendeur')
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Gestion des Événements</h1>
            <a href="{{ route('events.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Ajouter événement
            </a>
        </div>
    @endif

    
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2 text-left">Titre</th>
                    <th class="border px-4 py-2 text-left">Catégorie</th>
                    <th class="border px-4 py-2 text-left">Description</th>
                    <th class="border px-4 py-2 text-left">Date</th>
                    <th class="border px-4 py-2 text-left">Lieu</th>
                    <th class="border px-4 py-2 text-left">Status</th>
                    <th class="border px-4 py-2 text-left">Date de création</th>
                    <th class="border px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4 py-2">{{ $event->event_title }}</td>
                        <td class="border px-4 py-2">{{ $event->event_category }}</td>
                        <td class="border px-4 py-2">{{ $event->event_description }}</td>
                        <td class="border px-4 py-2">{{ $event->event_date }}</td>
                        <td class="border px-4 py-2">{{ $event->event_city }}, {{ $event->event_address }}</td>
                        <td class="border px-4 py-2">{{ $event->event_status }}</td>
                        <td class="border px-4 py-2">{{ $event->event_created_on }}</td>
                        <td class="border px-4 ml-2 py-2 text-left">
                            @if(Auth::user()->role !== 'vendeur')
                                <a href="{{ route('events.edit', $event->event_id) }}" class="text-yellow-500 hover:text-blue-300" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('tickets_type.index', $event->event_id) }}" class="text-green-500 hover:text-green-400" title="Tickets">
                                    <i class="fas fa-ticket-alt mr-2"></i>
                                </a>
                            @else
                                <a href="{{ route('tickets_type.index', $event->event_id) }}" class="text-green-500 hover:text-green-400" title="Tickets">
                                    <i class="fas fa-eye mr-2"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="border px-4 py-2 text-center">Aucun événement à afficher.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
