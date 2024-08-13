<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Liste toutes les commandes
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    // Affiche une commande spécifique
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.show', compact('order'));
    }

    // Affiche le formulaire de création d'une commande
    public function create()
    {
        return view('orders.create');
    }

    // Enregistre une nouvelle commande
    public function store(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string|max:50',
            'order_event_id' => 'required|integer',
            'order_price' => 'required|integer|min:0',
            'order_type' => 'required|string|max:50',
            'order_payment' => 'required|string|max:100',
            'order_info' => 'nullable|string',
        ]);

        Order::create($request->all());

        return redirect()->route('orders.index')->with('success', 'Commande créée avec succès.');
    }

    // Affiche le formulaire d'édition d'une commande
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    // Met à jour une commande existante
    public function update(Request $request, $id)
    {
        $request->validate([
            'order_number' => 'required|string|max:50',
            'order_event_id' => 'required|integer',
            'order_price' => 'required|integer|min:0',
            'order_type' => 'required|string|max:50',
            'order_payment' => 'required|string|max:100',
            'order_info' => 'nullable|string',
        ]);

        $order = Order::findOrFail($id);
        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Commande mise à jour avec succès.');
    }

    // Supprime une commande
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Commande supprimée avec succès.');
    }
}