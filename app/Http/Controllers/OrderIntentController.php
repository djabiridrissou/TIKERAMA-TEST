<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderIntent;
use App\Models\TicketType;
use App\Models\Event;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderIntentController extends Controller
{
    private function generateUniqueTicketKey()
    {
        return strtoupper(uniqid('TICKET-', true));
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $orders = OrderIntent::all();
            $events = Event::all();
            $ticketTypes = TicketType::all();
            return view('vendeur.order_intent.index', compact('orders', 'events', 'ticketTypes'));
        } else if ($user->role === 'vendeur') {
            $orders = OrderIntent::where('user_email', $user->email)->get();
            $events = Event::all();
            $ticketTypes = TicketType::all();
            return view('vendeur.order_intent.index', compact('orders', 'events', 'ticketTypes'));
        } else {
            return redirect()->route('login')->with('error', 'Vous n\'avez pas les droits d\'accès à cette page.');
        }
    }

    // Affiche une intention de commande spécifique
    public function show($id)
    {
        $orderIntent = OrderIntent::findOrFail($id);
        return view('orders_intents.show', compact('orderIntent'));
    }

    // Affiche le formulaire de création d'une intention de commande
    public function create($ticket_type_id)
    {
        $ticketType = TicketType::findOrFail($ticket_type_id);
        return view('vendeur.order_intent.create', compact('ticketType'));
    }

    // Enregistre une nouvelle intention de commande
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $ticketType = TicketType::findOrFail($data['ticket_type_id']);
        $orderIntent = new OrderIntent();

        $orderIntent->order_intent_price = $data['total_price'];
        $orderIntent->order_intent_type = $ticketType->ticket_type_id;
        $orderIntent->user_email = $user->email;
        $orderIntent->user_phone = $user->address;
        $orderIntent->expiration_date = date('Y-m-d', strtotime('+1 week'));
        $orderIntent->statut = 'En attente de validation';
        $orderIntent->quantity = $data['quantity'];

        $ticketType->ticket_type_quantity = $ticketType->ticket_type_quantity - $data['quantity'];
        $ticketType->save();
        $orderIntent->save();

        return redirect()->route('order_intent.index')->with('success', 'Intention de commande créée avec succès.');
    }

    // Affiche le formulaire d'édition d'une intention de commande
    public function edit($id)
    {
        $orderIntent = OrderIntent::findOrFail($id);
        return view('orders_intents.edit', compact('orderIntent'));
    }

    // Met à jour une intention de commande existante
    public function accept($order_intent_id)
    {
        $orderIntent = OrderIntent::findOrFail($order_intent_id);
        $orderIntent->statut = 'Validé';
        $ticketType = TicketType::findOrFail($orderIntent->order_intent_type);
        $ticketType->ticket_type_real_quantity = $ticketType->ticket_type_real_quantity - $orderIntent->quantity;
        $ticketType->save();
        $orderIntent->save();

        $event = Event::findOrFail($ticketType->ticket_type_event_id);
        $order = Order::create([
            'order_number' => $orderIntent->order_intent_id,
            'order_event_id' => $event->event_id,
            'order_price' => $orderIntent->order_intent_price,
            'order_type' => $orderIntent->order_intent_type,
            'order_payment' => 'Card',
            'order_info' => $orderIntent->statut,
        ]);

        for ($i = 0; $i < $orderIntent->quantity; $i++) {
            $ticket = Ticket::create([
                'ticket_event_id' => $event->event_id,
                'ticket_email' => $orderIntent->user_email,
                'ticket_phone' => $orderIntent->user_phone,
                'ticket_price' => $ticketType->ticket_type_price,
                'ticket_order_id' => $order->order_id,
                'ticket_key' => $this->generateUniqueTicketKey(),
                'ticket_ticket_type_id' => $ticketType->ticket_type_id,
                'ticket_status' => 'active',
                'ticket_created_on' => date('Y-m-d'),
            ]);
        }
        return redirect()->route('order_intent.index')->with('success', 'Intention de commande validée avec succès.');
    }

    public function reject($order_intent_id)
    {
        $orderIntent = OrderIntent::findOrFail($order_intent_id);
        $orderIntent->statut = 'Rejete';
        $orderIntent->save();
        $ticketType = TicketType::findOrFail($orderIntent->order_intent_type);
        $ticketType->ticket_type_quantity = $ticketType->ticket_type_quantity + $orderIntent->quantity;
        $ticketType->save();
        return redirect()->route('order_intent.index')->with('success', 'Intention de commande rejeteée avec succès.');
    }

    // Supprime une intention de commande
    public function destroy($id)
    {
        $orderIntent = OrderIntent::findOrFail($id);
        $orderIntent->delete();

        return redirect()->route('orders_intents.index')->with('success', 'Intention de commande supprimée avec succès.');
    }
}
