<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketType;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;


class TicketTypeController extends Controller
{
    // Liste tous les types de tickets en fonction de event
    public function index($event_id)
    {
        $user = Auth::user();
        if ($user->role === 'admin' || $user->role === 'vendeur') {
            $event = Event::findOrFail($event_id);
            $ticketTypes = TicketType::where('ticket_type_event_id', $event_id)->get();
            return view('admin.tickets_type.index', compact('ticketTypes', 'event'));
        }
        return redirect()->route('login')->with('error', 'Vous n\'avez pas les droits d\'accès à cette page.'); 
    }

    // Affiche un type de ticket spécifique
    public function show($id)
    {
        $ticketType = TicketType::findOrFail($id);
        return view('ticket_types.show', compact('ticketType'));
    }

    // Affiche le formulaire de création d'un type de ticket
    public function create($event_id)
    {
        $event = Event::findOrFail($event_id);
        return view('admin.tickets_type.create', compact('event'));
    }
    
    

    // Enregistre un nouveau type de ticket
    public function store(Request $request)
    {
        $request->validate([
            'ticket_type_name' => 'required|string|max:255',
            'ticket_type_price' => 'required|numeric|min:0',
            'ticket_type_quantity' => 'required|integer|min:1',
            'ticket_type_description' => 'required|string|max:1000',
        ]);

        TicketType::create([
            'ticket_type_event_id' => $request->input('ticket_type_event_id'),
            'ticket_type_name' => $request->input('ticket_type_name'),
            'ticket_type_price' => $request->input('ticket_type_price'),
            'ticket_type_quantity' => $request->input('ticket_type_quantity'),
            'ticket_type_real_quantity' => $request->input('ticket_type_quantity'),
            'ticket_type_total_quantity' => $request->input('ticket_type_quantity'),
            'ticket_type_description' => $request->input('ticket_type_description'),
        ]);
        return redirect()->route('tickets_type.index', ['event_id' => $request->input('ticket_type_event_id')])
                     ->with('success', 'Ticket créé avec succès.');
    }

    // Affiche le formulaire d'édition d'un type de ticket
    public function edit($id)
    {
        $ticket_type = TicketType::findOrFail($id);
        return view('admin.tickets_type.edit', compact('ticket_type'));
    }

    // Met à jour un type de ticket existant
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $ticketType = TicketType::findOrFail($id);
        $ticket_type['ticket_type_name'] = $data['ticket_type_name'];
        $ticket_type['ticket_type_price'] = $data['ticket_type_price'];
        $ticket_type['ticket_type_description'] = $data['ticket_type_description'];
        $ticketType->update($request->all());
        $ticket_type_event_id = $ticketType->ticket_type_event_id;

        return redirect()->route('tickets_type.index', ['event_id' => $ticket_type_event_id])
                     ->with('success', 'Ticket créé avec succès.');
    }

    // Supprime un type de ticket
    public function destroy($id)
    {
        $ticketType = TicketType::findOrFail($id);
        $ticketType->delete();

        return redirect()->route('ticket_types.index')->with('success', 'Type de ticket supprimé avec succès.');
    }
}
