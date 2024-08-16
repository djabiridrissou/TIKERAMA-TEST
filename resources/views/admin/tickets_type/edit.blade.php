@extends('layouts.app')

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
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.5);
        justify-content: center;
        align-items: center;
    }
    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        width: 80%;
        max-width: 500px;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    .cancel-link {
        display: inline-flex;
        align-items: center;
        font-size: 0.875rem;
        color: #3182ce;
        text-decoration: none;
        font-weight: 600;
        padding: 0.5rem;
        border-radius: 0.375rem;
        background-color: #f1f5f9;
        transition: background-color 0.2s ease, color 0.2s ease;
    }
    .cancel-link:hover {
        background-color: #e2e8f0;
        color: #2b6cb0;
    }
    .cancel-link svg {
        margin-right: 0.5rem;
        width: 1.25rem;
        height: 1.25rem;
        fill: currentColor;
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
            <p class="border-b-2 border-black text-center text-lg font-semibold mb-4">Modifier Ticket</p>
            <span class="text-xs text-gray-600">Modifiez les informations ci-dessous pour mettre à jour les détails du ticket</span>
            
            <div class="form-container">
                <div class="form-left">
                    <form action="{{ route('tickets_type.update', $ticket_type->ticket_type_id) }}" method="POST" enctype="multipart/form-data" class="mt-4 flex flex-col space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="input-container">
                            <input id="ticket_type_name" name="ticket_type_name" type="text" value="{{ $ticket_type->ticket_type_name }}" required placeholder="Nom du ticket">
                            
                        </div>

                        <div class="input-container">
                            <input id="ticket_type_price" name="ticket_type_price" type="number" value="{{ $ticket_type->ticket_type_price }}" required placeholder="Prix du ticket">
                            
                        </div>

                        <div class="input-container">
                            <textarea id="ticket_type_description" name="ticket_type_description" required placeholder="Description du ticket">{{ $ticket_type->ticket_type_description }}</textarea>
                        </div>
                        <button type="submit" class="btn">Mettre à jour le ticket</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
