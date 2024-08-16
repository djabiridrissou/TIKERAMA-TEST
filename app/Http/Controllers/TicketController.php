<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
   // Liste tous les tickets
   public function index()
   {
        $user = Auth::user();
        $tickets = Ticket::where('ticket_email', $user->email)->get();
        return view('vendeur.tickets.index', compact('tickets'));
   }

   // Affiche un ticket spécifique
   public function show($id)
   {
       $ticket = Ticket::findOrFail($id);
       return view('tickets.show', compact('ticket'));
   }

   // Affiche le formulaire de création d'un ticket
   public function create()
   {
       return view('tickets.create');
   }

   // Enregistre un nouveau ticket
   public function store(Request $request)
   {
       $request->validate([
           'ticket_event_id' => 'required|integer|exists:events,event_id',
           'ticket_email' => 'required|string|max:255',
           'ticket_phone' => 'required|string|max:20',
           'ticket_price' => 'required|integer|min:0',
           'ticket_order_id' => 'nullable|integer',
           'ticket_key' => 'required|string|max:100|unique:tickets,ticket_key',
           'ticket_ticket_type_id' => 'required|integer|exists:ticket_types,ticket_type_id',
           'ticket_status' => 'required|in:active,validated,expired,cancelled',
       ]);

       Ticket::create($request->all());

       return redirect()->route('tickets.index')->with('success', 'Ticket créé avec succès.');
   }

   // Affiche le formulaire d'édition d'un ticket
   public function edit($id)
   {
       $ticket = Ticket::findOrFail($id);
       return view('tickets.edit', compact('ticket'));
   }

   // Met à jour un ticket existant
   public function update(Request $request, $id)
   {
       $request->validate([
           'ticket_event_id' => 'required|integer|exists:events,event_id',
           'ticket_email' => 'required|string|max:255',
           'ticket_phone' => 'required|string|max:20',
           'ticket_price' => 'required|integer|min:0',
           'ticket_order_id' => 'nullable|integer',
           'ticket_key' => 'required|string|max:100|unique:tickets,ticket_key,' . $id . ',ticket_id',
           'ticket_ticket_type_id' => 'required|integer|exists:ticket_types,ticket_type_id',
           'ticket_status' => 'required|in:active,validated,expired,cancelled',
       ]);

       $ticket = Ticket::findOrFail($id);
       $ticket->update($request->all());

       return redirect()->route('tickets.index')->with('success', 'Ticket mis à jour avec succès.');
   }

   // Supprime un ticket
   public function destroy($id)
   {
       $ticket = Ticket::findOrFail($id);
       $ticket->delete();

       return redirect()->route('tickets.index')->with('success', 'Ticket supprimé avec succès.');
   }
}
