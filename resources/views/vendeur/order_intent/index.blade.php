
@extends('layouts.app')

@section('title', 'Commandes')

@section('content')
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                @if(Auth::user()->role == 'admin')
                    <th class="border px-4 py-2 text-left">Client</th>
                @endif
                    <th class="border px-4 py-2 text-left">Evenement</th>
                    <th class="border px-4 py-2 text-left">Type de ticket</th>
                    <th class="border px-4 py-2 text-left">Quantité totale</th>
                    <th class="border px-4 py-2 text-left">Prix</th>
                    <th class="border px-4 py-2 text-left">Status</th>
                    <th class="border px-4 py-2 text-left">Date de commande</th>
                    @if(Auth::user()->role == 'admin')
                        <th class="border px-4 py-2 text-left">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr class="hover:bg-gray-100">
                    @if(Auth::user()->role == 'admin')
                        <td class="border px-4 py-2">{{ $order->user_email }}</td>
                    @endif
                        <td class="border px-4 py-2">{{ $order->typeTicket->event->event_title }}</td>
                        <td class="border px-4 py-2">{{ $order->typeTicket->ticket_type_name }}</td>
                        <td class="border px-4 py-2">{{ $order->quantity }}</td>
                        <td class="border px-4 py-2">{{ $order->order_intent_price }}</td>
                        <td class="border px-4 py-2">{{ $order->statut }}</td>
                        <td class="border px-4 py-2">{{ $order->created_at }}</td>
                        @if(Auth::user()->role == 'admin')
                        <td class="border px-4 ml-2 py-2 text-left">
                                @if($order->statut == 'n attente de validation')
                                <a href="{{ route('accept', $order->order_intent_id) }}" class="text-white hover:text-blue-300" title="Modifier">
                                    <span class="text-white hover:text-blue-300 bg-blue-500 px-2 py-1 rounded">Valider</span>
                                </a>

                                <a href="{{ route('reject', $order->order_intent_id) }}" class="text-yellow-500 hover:text-blue-300" title="Modifier">
                                    <span class="text-white hover:text-blue-300 bg-red-500 px-2 py-1 rounded">Refuser</span>
                                </a>
                                @else
                                    <span class="text-blue-500 hover:text-blue-300  px-2 py-1 rounded">{{ $order->statut }}</span>
                                @endif
                        </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="border px-4 py-2 text-center">Aucune intention de commande enregistrée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
