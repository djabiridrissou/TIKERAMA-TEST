<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Dashboard')</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer">
        <link href="https://unpkg.com/heroicons@1.0.6/dist/heroicons.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">
        <!-- Scripts -->
        @stack('styles')
        <!-- Alpine.js -->
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    </head>
    <body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main content -->
        <div class="flex-1 p-6">
            @yield('content')
           
        </div>
    </div>
</body>
</html>
