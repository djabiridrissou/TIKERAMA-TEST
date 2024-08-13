<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    // Liste tous les types de tickets
    public function index()
    {
        $ticketTypes = TicketType::all();
        return view('ticket_types.index', compact('ticketTypes'));
    }

    // Affiche un type de ticket spécifique
    public function show($id)
    {
        $ticketType = TicketType::findOrFail($id);
        return view('ticket_types.show', compact('ticketType'));
    }

    // Affiche le formulaire de création d'un type de ticket
    public function create()
    {
        return view('ticket_types.create');
    }

    // Enregistre un nouveau type de ticket
    public function store(Request $request)
    {
        $request->validate([
            'ticket_type_event_id' => 'required|integer|exists:events,event_id',
            'ticket_type_name' => 'required|string|max:50',
            'ticket_type_price' => 'required|integer|min:0',
            'ticket_type_quantity' => 'required|integer|min:0',
            'ticket_type_real_quantity' => 'required|integer|min:0',
            'ticket_type_total_quantity' => 'required|integer|min:0',
            'ticket_type_description' => 'required|string',
        ]);

        TicketType::create($request->all());

        return redirect()->route('ticket_types.index')->with('success', 'Type de ticket créé avec succès.');
    }

    // Affiche le formulaire d'édition d'un type de ticket
    public function edit($id)
    {
        $ticketType = TicketType::findOrFail($id);
        return view('ticket_types.edit', compact('ticketType'));
    }

    // Met à jour un type de ticket existant
    public function update(Request $request, $id)
    {
        $request->validate([
            'ticket_type_event_id' => 'required|integer|exists:events,event_id',
            'ticket_type_name' => 'required|string|max:50',
            'ticket_type_price' => 'required|integer|min:0',
            'ticket_type_quantity' => 'required|integer|min:0',
            'ticket_type_real_quantity' => 'required|integer|min:0',
            'ticket_type_total_quantity' => 'required|integer|min:0',
            'ticket_type_description' => 'required|string',
        ]);

        $ticketType = TicketType::findOrFail($id);
        $ticketType->update($request->all());

        return redirect()->route('ticket_types.index')->with('success', 'Type de ticket mis à jour avec succès.');
    }

    // Supprime un type de ticket
    public function destroy($id)
    {
        $ticketType = TicketType::findOrFail($id);
        $ticketType->delete();

        return redirect()->route('ticket_types.index')->with('success', 'Type de ticket supprimé avec succès.');
    }
}
