<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Expenses Tracking') }}</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])<!-- Force HTTPS assets -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50" x-data="{ 
            isMobile: window.innerWidth < 768 
        }" 
        x-init="
            window.addEventListener('resize', () => { 
                isMobile = window.innerWidth < 768; 
            });
        ">
            @include('layouts.sidebar')
            
            <div 
                class="min-h-screen transition-all duration-300"
                :class="isMobile ? 'ml-0' : 'ml-64'"
            >
                @include('layouts.navigation')
                
                <main class="p-6">
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>

