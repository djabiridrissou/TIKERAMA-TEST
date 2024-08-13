<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    // lister events
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    // afficher un event
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    // afficher formulaire d'un event
    public function create()
    {
        return view('events.create');
    }

    // enregister event
    public function store(Request $request)
    {
        $request->validate([
            'event_category' => 'required|in:Autre,Concert-Spectacle,Diner Gala,Festival,Formation',
            'event_title' => 'required|string|max:30',
            'event_description' => 'required|string',
            'event_date' => 'required|date',
            'event_image' => 'nullable|string|max:200',
            'event_city' => 'required|string|max:100',
            'event_address' => 'required|string|max:200',
            'event_status' => 'required|in:upcoming,completed,cancelled',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Événement créé avec succès.');
    }

    // edition
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    // Met à jour un événement existant
    public function update(Request $request, $id)
    {
        $request->validate([
            'event_category' => 'required|in:Autre,Concert-Spectacle,Diner Gala,Festival,Formation',
            'event_title' => 'required|string|max:30',
            'event_description' => 'required|string',
            'event_date' => 'required|date',
            'event_image' => 'nullable|string|max:200',
            'event_city' => 'required|string|max:100',
            'event_address' => 'required|string|max:200',
            'event_status' => 'required|in:upcoming,completed,cancelled',
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Événement mis à jour avec succès.');
    }

    // Supprime un événement
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Événement supprimé avec succès.');
    }
}
