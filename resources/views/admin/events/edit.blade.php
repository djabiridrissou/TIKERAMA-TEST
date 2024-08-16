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
            <p class="border-b-2 border-black text-center text-lg font-semibold mb-4">Modifier l'événement</p>
            <span class="text-xs text-gray-600">Modifiez les informations ci-dessous pour mettre à jour l'événement</span>
            
            <div class="form-container">
                <div class="form-left">
                    <form action="{{ route('events.update', $event->event_id) }}" method="POST" enctype="multipart/form-data" class="mt-4 flex flex-col space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="input-container">
                            <select id="event_category" name="event_category" required>
                                <option value="Concert-Spectacle" {{ $event->event_category == 'Concert-Spectacle' ? 'selected' : '' }}>Concert-Spectacle</option>
                                <option value="Dîner" {{ $event->event_category == 'Dîner' ? 'selected' : '' }}>Dîner</option>
                                <option value="Gala" {{ $event->event_category == 'Gala' ? 'selected' : '' }}>Gala</option>
                                <option value="Festival" {{ $event->event_category == 'Festival' ? 'selected' : '' }}>Festival</option>
                                <option value="Formation" {{ $event->event_category == 'Formation' ? 'selected' : '' }}>Formation</option>
                                <option value="Autre" {{ $event->event_category == 'Autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                            <p id="categoryError" class="error-message"></p>
                        </div>

                        <div class="input-container">
                            <input id="event_title" name="event_title" type="text" value="{{ $event->event_title }}" required placeholder="Titre de l'événement">
                            <p id="titleError" class="error-message"></p>
                        </div>

                        <div class="input-container">
                            <textarea id="event_description" name="event_description" required placeholder="Description de l'événement">{{ $event->event_description }}</textarea>
                            <p id="descriptionError" class="error-message"></p>
                        </div>

                        <div class="input-container">
                            <input id="event_date" name="event_date" type="datetime-local" value="{{ date('Y-m-d\TH:i', strtotime($event->event_date)) }}" required placeholder="Date de l'événement">
                            <p id="dateError" class="error-message"></p>
                        </div>

                        <div class="input-container">
                            <input id="event_city" name="event_city" type="text" value="{{ $event->event_city }}" required placeholder="Ville de l'événement">
                            <p id="cityError" class="error-message"></p>
                        </div>

                        <div class="input-container">
                            <input id="event_address" name="event_address" type="text" value="{{ $event->event_address }}" required placeholder="Adresse de l'événement">
                            <p id="addressError" class="error-message"></p>
                        </div>

                        <div class="input-container">
                            <label for="event_status" class="block text-gray-700 font-bold mb-2">Statut</label>
                            <div class="flex items-center">
                                <label class="mr-4">
                                    <input type="radio" name="event_status" value="Upcoming" {{ $event->event_status == 'Upcoming' ? 'checked' : '' }} class="mr-2">
                                    Upcoming
                                </label>
                                <label class="mr-4">
                                    <input type="radio" name="event_status" value="Completed" {{ $event->event_status == 'Completed' ? 'checked' : '' }} class="mr-2">
                                    Completed
                                </label>
                                <label>
                                    <input type="radio" name="event_status" value="Cancelled" {{ $event->event_status == 'Cancelled' ? 'checked' : '' }} class="mr-2">
                                    Cancelled
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn">Mettre à jour l'événement</button>
                        <span>
                            <a href="{{ route('events.index') }}" class="cancel-link">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 10.293L18.707 3.586 21.414 6.293 14.707 13 21.414 19.707 18.707 22.414 12 15.707 5.293 22.414 2.586 19.707 9.293 13 2.586 6.293 5.293 3.586 12 10.293z"/></svg>
                                Annuler
                            </a>
                        </span>
                    </form>
                </div>
                <div class="form-right">
                    @if($event->event_image)
                        <img src="{{ asset('storage/'.$event->event_image) }}" alt="{{ $event->event_title }}" class="mb-2 w-full max-w-xs mx-auto">
                    @endif
                    <input id="event_image" name="event_image" type="file" accept="image/*" placeholder="Image de l'événement">
                    <p id="imageError" class="error-message"></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
