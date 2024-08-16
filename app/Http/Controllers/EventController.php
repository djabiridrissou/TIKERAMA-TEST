<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // lister events
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin' || $user->role === 'vendeur') {
            $events = Event::all();
            return view('admin.events.index', compact('events'));
        }

        return redirect()->route('login')->with('error', 'Vous n\'avez pas les droits d\'accès à cette page.');
    }

    // afficher un event
    /* public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    } */


    public function store(Request $request)
    {
        try {
            $data = $request->all();
            if ($request->hasFile('event_image')) {
                $imagePath = $request->file('event_image')->store('event_images', 'public');
                $data['event_image'] = $imagePath;
            } else {
                $data['event_image'] = 'default-image.png';
            }
            Event::create($data);
            return redirect()->route('events.index')->with('event_created', 'Événement créé avec succès !');
        } catch (\Exception $e) {
            Log::error('Error creating event: ' . $e->getMessage());
            return redirect()->route('events.index')->with('error', 'Une erreur est survenue lors de la création de l\'événement.');
        }
    }
    

    public function create(Request $request)
    {
        return view('admin.events.create');
    }

    // edition
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        try {
            $event = Event::findOrFail($id);
            $data = $request->all();
    
            if ($request->hasFile('event_image')) {
                if ($event->event_image) {
                    Storage::delete('public/' . $event->event_image);
                }
                $imagePath = $request->file('event_image')->store('event_images', 'public');
                $data['event_image'] = $imagePath;
            }
            
            $event->update($data);
            return redirect()->route('events.index')->with('success', 'Événement mis à jour avec succès !');
        } catch (\Exception $e) {
            Log::error('Error updating event: ' . $e->getMessage());
            return redirect()->route('events.index')->with('error', 'Une erreur est survenue lors de la mise à jour de l\'événement.');
        }
    }

    // Supprime un événement
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.events.index')->with('destroy_success', 'Événement supprimé avec succès.');
    }
}
