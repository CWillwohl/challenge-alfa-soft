<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            @if(session('success'))
                <div class="w-full flex justify-center mt-4">
                    <p class="w-2/3 p-4 bg-green-500/20 border border-green-700 shadow-lg shadow-green-100 text-green-700 rounded font-semibold">{{ session('success') }}</p>
                </div>
            @elseif(session('error'))
                <div class="w-full flex justify-center mt-4">
                    <p class="w-2/3 p-4 bg-red-500/20 border border-red-700 shadow-lg shadow-red-100 text-red-700 rounded font-semibold">{{ session('error') }}</p>
                </div>
            @endif
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
