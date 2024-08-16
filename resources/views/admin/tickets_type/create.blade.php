@extends('layouts.app')

@section('title', 'Créer un ticket')

@section('content')
<style>
    body {
        font-family: 'Nunito', sans-serif;
    }
    .input-container {
        position: relative;
        margin-bottom: 1rem;
    }
    .input-container input,
    .input-container textarea,
    .input-container select {
        border-radius: 0.375rem;
        border: 1px solid #e2e8f0;
        padding: 0.5rem 1rem;
        width: 100%;
    }
    .btn {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        border-radius: 0.375rem;
        background-color: #3182ce;
        color: #fff;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.2s ease;
        width: 100%;
    }
    .btn:hover {
        background-color: #2b6cb0;
    }
    .error-message {
        color: #e3342f;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }
    .form-container {
        display: flex;
        flex-wrap: wrap;
    }
    .form-left {
        flex: 1;
        padding-right: 1rem;
    }
    .form-right {
        flex: 1;
        padding-left: 1rem;
    }
    @media (max-width: 768px) {
        .form-left,
        .form-right {
            flex: 100%;
            padding: 0;
        }
    }
</style>

<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="max-w-6xl mx-auto flex flex-col items-center justify-center sm:px-6 lg:px-8">
        <div class="bg-slate-100 w-full p-8 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">Créer un ticket pour <span class="text-green-500">{{ $event->event_title }}</span></h1>

            <form action="{{ route('tickets_type.add') }}" method="POST" class="mt-4 flex flex-col space-y-4">
                @csrf
                <input type="hidden" name="ticket_type_event_id" value="{{ $event->event_id }}">
                
                <div class="input-container">
                    <label for="ticket_type_name" class="block text-gray-700">Nom du ticket</label>
                    <input type="text" name="ticket_type_name" id="ticket_type_name" class="w-full border border-gray-300 px-4 py-2 rounded">
                </div>

                <div class="input-container">
                    <label for="ticket_type_price" class="block text-gray-700">Prix du ticket</label>
                    <input type="number" name="ticket_type_price" id="ticket_type_price" class="w-full border border-gray-300 px-4 py-2 rounded">
                </div>

                <div class="input-container">
                    <label for="ticket_type_quantity" class="block text-gray-700">Quantité totale de tickets</label>
                    <input type="number" name="ticket_type_quantity" id="ticket_type_quantity" class="w-full border border-gray-300 px-4 py-2 rounded">
                </div>

                <div class="input-container">
                    <label for="ticket_type_description" class="block text-gray-700">Description du ticket</label>
                    <textarea name="ticket_type_description" id="ticket_type_description" class="w-full border border-gray-300 px-4 py-2 rounded"></textarea>
                </div>

                <button type="submit" class="btn">Enregistrer le ticket</button>
            </form>
        </div>
    </div>
</div>
@endsection
