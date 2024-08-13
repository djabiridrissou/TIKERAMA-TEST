<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderIntentController extends Controller
{
    public function index()
    {
        $orderIntents = OrderIntent::all();
        return view('orders_intents.index', compact('orderIntents'));
    }

    // Affiche une intention de commande spécifique
    public function show($id)
    {
        $orderIntent = OrderIntent::findOrFail($id);
        return view('orders_intents.show', compact('orderIntent'));
    }

    // Affiche le formulaire de création d'une intention de commande
    public function create()
    {
        return view('orders_intents.create');
    }

    // Enregistre une nouvelle intention de commande
    public function store(Request $request)
    {
        $request->validate([
            'order_intent_price' => 'required|integer|min:0',
            'order_intent_type' => 'required|string|max:50',
            'user_email' => 'required|string|email|max:100',
            'user_phone' => 'required|string|max:20',
            'expiration_date' => 'required|date',
        ]);

        OrderIntent::create($request->all());

        return redirect()->route('orders_intents.index')->with('success', 'Intention de commande créée avec succès.');
    }

    // Affiche le formulaire d'édition d'une intention de commande
    public function edit($id)
    {
        $orderIntent = OrderIntent::findOrFail($id);
        return view('orders_intents.edit', compact('orderIntent'));
    }

    // Met à jour une intention de commande existante
    public function update(Request $request, $id)
    {
        $request->validate([
            'order_intent_price' => 'required|integer|min:0',
            'order_intent_type' => 'required|string|max:50',
            'user_email' => 'required|string|email|max:100',
            'user_phone' => 'required|string|max:20',
            'expiration_date' => 'required|date',
        ]);

        $orderIntent = OrderIntent::findOrFail($id);
        $orderIntent->update($request->all());

        return redirect()->route('orders_intents.index')->with('success', 'Intention de commande mise à jour avec succès.');
    }

    // Supprime une intention de commande
    public function destroy($id)
    {
        $orderIntent = OrderIntent::findOrFail($id);
        $orderIntent->delete();

        return redirect()->route('orders_intents.index')->with('success', 'Intention de commande supprimée avec succès.');
    }
}
