<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Syntess') }}</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100">
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-300 to-purple-500">
    <div class="grid grid-cols-1 md:grid-cols-2 w-full max-w-5xl bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <!-- Left Column (Text with Gradient Overlay) -->
        <div class="relative flex items-center justify-center p-8 md:p-12 lg:p-16 bg-gradient-to-br from-purple-700 to-purple-900 text-white">
            <div class="absolute inset-0 bg-opacity-70 bg-gradient-to-br from-purple-700 to-purple-900"></div>
            <div class="relative z-10 text-center">
                <h2 class="text-4xl font-bold">Welcome to Syntess</h2>
                <p class="mt-4 text-lg">Innovation and Excellence in Every Step</p>
            </div>
        </div>
        <!-- Right Column (Form) -->
        <div class="flex flex-col justify-center p-8 sm:p-12 lg:p-16">
            {{ $slot }}
        </div>
    </div>
</div>
</body>
</html>
