<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Dashboard')</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://unpkg.com/heroicons@1.0.6/dist/heroicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Scripts -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">
        @stack('styles')
        <!-- Include Alpine.js -->
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    </head>
    <body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main content -->
        <div class="flex-1 p-6">
            @yield('content')
            <div x-data="{ open: @json(session('status') ? true : false) }" x-show="open" @click.away="open = false" class="fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
                    <div class="flex justify-between items-center border-b pb-2">
                        <h5 class="text-lg font-bold">Confirmation</h5>
                        <button @click="open = false" class="text-gray-500 hover:text-gray-700">&times;</button>
                    </div>
                    <div class="py-4">
                        Les informations ont été envoyées à l'utilisateur sur son mail renseigné.
                    </div>
                    <div class="flex justify-end">
                        <button @click="open = false" class="bg-blue-500 text-white py-2 px-4 rounded">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
