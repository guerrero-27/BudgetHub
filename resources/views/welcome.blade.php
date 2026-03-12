<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Track Your Finances Effortlessly - Manage your expenses, budgets, and financial goals with our intuitive expense tracking application.">

    <title>{{ config('app.name', 'BudgetHub') }} - Track Your Finances Effortlessly</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(79, 70, 229, 0.3); }
            50% { box-shadow: 0 0 40px rgba(79, 70, 229, 0.6); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-pulse-glow { animation: pulse-glow 2s ease-in-out infinite; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        html { scroll-behavior: smooth; }
        .feature-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .feature-card:hover { transform: translateY(-8px) scale(1.02); box-shadow: 0 20px 40px rgba(79, 70, 229, 0.15); }
        .btn-primary { transition: all 0.3s ease; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(79, 70, 229, 0.4); }
        .btn-secondary { transition: all 0.3s ease; }
        .btn-secondary:hover { transform: translateY(-2px); background-color: #1f2937; }
        .footer-link { position: relative; }
        .footer-link::after { content: ''; position: absolute; width: 0; height: 2px; bottom: -2px; left: 0; background-color: #4F46E5; transition: width 0.3s ease; }
        .footer-link:hover::after { width: 100%; }
        .bg-pattern { background-image: radial-gradient(circle at 20% 80%, rgba(79, 70, 229, 0.05) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(79, 70, 229, 0.05) 0%, transparent 50%), radial-gradient(circle at 40% 40%, rgba(79, 70, 229, 0.03) 0%, transparent 30%); }
        
        /* Mobile menu */
        .mobile-menu { transition: transform 0.3s ease-in-out; }
        .mobile-menu.open { transform: translateX(0); }
        .mobile-menu.closed { transform: translateX(100%); }
        .mobile-overlay { transition: opacity 0.3s ease-in-out; }
        .mobile-overlay.open { opacity: 1; pointer-events: auto; }
        .mobile-overlay.closed { opacity: 0; pointer-events: none; }
        
        /* Burger menu animation */
        .burger-line { transition: all 0.3s ease; }
        .burger-open .burger-line-1 { transform: rotate(45deg) translate(5px, 6px); }
        .burger-open .burger-line-2 { opacity: 0; }
        .burger-open .burger-line-3 { transform: rotate(-45deg) translate(5px, -6px); }
        
        /* Mobile nav link */
        .mobile-nav-link { position: relative; }
        .mobile-nav-link::before { content: ''; position: absolute; width: 0; height: 2px; bottom: -4px; left: 0; background-color: #4F46E5; transition: width 0.3s ease; }
        .mobile-nav-link:hover::before { width: 100%; }
    </style>
</head>
<body class="bg-white text-gray-900 font-sans antialiased">
    
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100 overflow-x-hidden">
        <div class="max-w-7xl  mx-auto px-3 sm:px-6 lg:px-8 overflow-x-hidden">
            <div class="flex justify-between items-center h-16">
                
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('welcome') }}" class="flex items-center space-x-2">
                        
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-indigo-600 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>

                        <span class="text-base sm:text-xl font-bold text-gray-900 truncate">
                            BudgetHub
                        </span>

                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8 overflow-x-hidden">
                    <a href="#features" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Features</a>
                    <a href="#about" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">About</a>
                </div>

                <!-- Desktop Buttons -->
                <div class="hidden md:flex items-center space-x-4 overflow-x-hidden">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">
                            Sign In
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                                Get Started
                            </a>
                        @endif
                    @endauth
                </div>

                <!-- Burger Button -->
                <button id="burgerBtn"
                    class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    aria-label="Toggle menu">

                    <div class="w-6 h-5 flex flex-col justify-between">
                        <span class="burger-line w-full h-0.5 bg-gray-700 rounded-full"></span>
                        <span class="burger-line w-full h-0.5 bg-gray-700 rounded-full"></span>
                        <span class="burger-line w-full h-0.5 bg-gray-700 rounded-full"></span>
                    </div>

                </button>
            </div>
        </div>
    </nav>





<!-- Mobile Menu -->
<div id="mobileMenu"
    class="fixed top-0 right-0 h-full w-[85%] max-w-xs bg-white z-50 md:hidden shadow-2xl transform translate-x-full transition-transform duration-300">

    <div class="p-6">

        <div class="flex items-center justify-between mb-8">
            <span class="text-lg font-bold text-gray-900">Menu</span>

            <button id="closeMenuBtn"
                class="p-2 rounded-lg hover:bg-gray-100 transition-colors"
                aria-label="Close menu">

                <svg class="w-6 h-6 text-gray-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12">
                    </path>

                </svg>

            </button>
        </div>

        <!-- Mobile Links -->
        <div class="space-y-4 mb-8">

            <a href="#features"
                class="block text-lg font-medium text-gray-700 hover:text-indigo-600 py-2">
                Features
            </a>

            <a href="#about"
                class="block text-lg font-medium text-gray-700 hover:text-indigo-600 py-2">
                About
            </a>

        </div>

        <!-- Mobile Buttons -->
        <div class="space-y-3">

            @auth

                <a href="{{ url('/dashboard') }}"
                    class="block w-full text-center px-5 py-3 bg-indigo-600 text-white rounded-xl font-medium hover:bg-indigo-700 transition-colors">
                    Dashboard
                </a>

            @else

                <a href="{{ route('login') }}"
                    class="block w-full text-center px-5 py-3 border-2 border-indigo-600 text-indigo-600 rounded-xl font-medium hover:bg-indigo-50 transition-colors">
                    Sign In
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="block w-full text-center px-5 py-3 bg-indigo-600 text-white rounded-xl font-medium hover:bg-indigo-700 transition-colors">
                        Get Started
                    </a>
                @endif

            @endauth

        </div>

    </div>
</div>
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center pt-20 bg-pattern overflow-hidden">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 relative z-10">

            <div class="grid lg:grid-cols-2 gap-8 md:gap-12 items-center">

            <!-- LEFT CONTENT -->
            <div class="text-center lg:text-left">

                <span class="inline-block px-4 py-2 bg-indigo-100 text-indigo-700 rounded-full text-sm font-medium mb-6">
                ✨ Smart Financial Management
                </span>

                <h1 class="text-3xl sm:text-7xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                Track Your Finances
                <span class="text-indigo-600">Effortlessly</span>
                </h1>

                <p class="text-base sm:text-lg text-gray-600 mb-8 max-w-xl mx-auto lg:mx-0">
                Take control of your money with our intuitive expense tracking application.
                Monitor income, expenses, and budgets all in one place.
                </p>

                <!-- BUTTONS -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">

                    @auth
                        <a href="{{ url('/dashboard') }}"
                        class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 transition">
                        Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                        class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 transition">
                        Get Started
                        </a>

                        <a href="{{ route('login') }}"
                        class="px-6 py-3 bg-gray-900 text-white rounded-xl font-semibold hover:bg-black transition">
                        Sign In
                        </a>
                    @endauth

                </div>

                <!-- STATS -->
                <div class="mt-10 flex flex-wrap items-center justify-center lg:justify-start gap-6">

                <div class="text-center">
                    <p class="text-2xl md:text-3xl font-bold text-indigo-600">10K+</p>
                    <p class="text-sm text-gray-500">Active Users</p>
                </div>

                <div class="text-center">
                    <p class="text-2xl md:text-3xl font-bold text-indigo-600">$2M+</p>
                    <p class="text-sm text-gray-500">Tracked</p>
                </div>

                <div class="text-center">
                    <p class="text-2xl md:text-3xl font-bold text-indigo-600">4.9</p>
                    <p class="text-sm text-gray-500">Rating</p>
                </div>

                </div>

            </div>


            <!-- RIGHT CARD -->
            <div class="relative">

                <div class="bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-3xl p-5 md:p-8 shadow-2xl">

                <div class="bg-white rounded-2xl p-5 md:p-6 shadow-xl">

                    <!-- BALANCE -->
                    <div class="flex items-center justify-between mb-6">

                    <div>
                        <p class="text-sm text-gray-500">Total Balance</p>
                        <p class="text-2xl md:text-3xl font-bold text-gray-900">$12,450.00</p>
                    </div>

                    <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-xl flex items-center justify-center">

                        <svg class="w-5 h-5 md:w-6 md:h-6 text-green-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />

                        </svg>

                    </div>

                    </div>


                    <!-- MINI CHART -->
                    <div class="flex items-end gap-1 md:gap-2 h-20 md:h-24 mb-4">
                    <div class="flex-1 bg-indigo-200 rounded-t-lg h-[40%]"></div>
                    <div class="flex-1 bg-indigo-300 rounded-t-lg h-[60%]"></div>
                    <div class="flex-1 bg-indigo-400 rounded-t-lg h-[45%]"></div>
                    <div class="flex-1 bg-indigo-500 rounded-t-lg h-[75%]"></div>
                    <div class="flex-1 bg-indigo-600 rounded-t-lg h-[55%]"></div>
                    <div class="flex-1 bg-indigo-700 rounded-t-lg h-[85%]"></div>
                    </div>


                    <!-- TRANSACTIONS -->
                    <div class="space-y-3">

                    <!-- Shopping -->
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">

                        <div class="flex items-center gap-3">

                        <div class="w-8 h-8 md:w-10 md:h-10 bg-orange-100 rounded-full flex items-center justify-center">

                            <svg class="w-4 h-4 md:w-5 md:h-5 text-orange-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />

                            </svg>

                        </div>

                        <div>
                            <p class="font-medium text-gray-900 text-sm md:text-base">Shopping</p>
                            <p class="text-xs text-gray-500">Today</p>
                        </div>

                        </div>

                        <span class="font-semibold text-red-600 text-sm md:text-base">-$125</span>

                    </div>


                    <!-- Salary -->
                    <div class="flex items-center justify-between py-2">

                        <div class="flex items-center gap-3">

                        <div class="w-8 h-8 md:w-10 md:h-10 bg-green-100 rounded-full flex items-center justify-center">

                            <svg class="w-4 h-4 md:w-5 md:h-5 text-green-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2" />

                            </svg>

                        </div>

                        <div>
                            <p class="font-medium text-gray-900 text-sm md:text-base">Salary</p>
                            <p class="text-xs text-gray-500">Yesterday</p>
                        </div>

                        </div>

                        <span class="font-semibold text-green-600 text-sm md:text-base">+$3500</span>

                    </div>

                    </div>

                </div>

                </div>

            </div>

            </div>

        </div>

        </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-50 overflow-x-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-x-hidden">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Everything You Need to Manage Your Money</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Explore all the powerful features designed to help you track, analyze, and improve your financial health.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Dashboard</h3>
                    <p class="text-gray-600 mb-4">Get a comprehensive overview of your finances with instant insights into income, expenses, and budget progress.</p>
                </div>
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div class="w-14 h-14 bg-red-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Expenses</h3>
                    <p class="text-gray-600 mb-4">Easily add, view, and categorize your expenses. Track spending habits and identify areas to save money.</p>
                </div>
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Categories</h3>
                    <p class="text-gray-600 mb-4">Organize expenses with custom categories. Use color-coded badges for quick visual identification.</p>
                </div>
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Reports & Analytics</h3>
                    <p class="text-gray-600 mb-4">Visualize your spending habits with interactive charts and graphs. Make data-driven financial decisions.</p>
                </div>
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div class="w-14 h-14 bg-yellow-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Budgets</h3>
                    <p class="text-gray-600 mb-4">Set budget limits for different categories and receive alerts when you're approaching your spending limits.</p>
                </div>
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div class="w-14 h-14 bg-pink-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Profile & Settings</h3>
                    <p class="text-gray-600 mb-4">Manage your account preferences, update profile information, and customize your experience.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 md:py-20 bg-white">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <!-- LEFT CONTENT -->
            <div>

                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
                    Take Control of Your Financial Future
                </h2>

                <p class="text-base sm:text-lg text-gray-600 mb-6">
                    ExpenseTracker is designed to simplify your financial management.
                    Whether you're tracking daily expenses, planning budgets,
                    or analyzing spending patterns, we've got you covered.
                </p>

                <p class="text-base sm:text-lg text-gray-600 mb-8">
                    Our mission is to empower individuals and families
                    to make smarter financial decisions through intuitive
                    tools and clear insights.
                </p>

                <!-- FEATURES GRID -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    <!-- Item -->
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-900">Easy to Use</h4>
                            <p class="text-sm text-gray-600">
                                Intuitive interface for all skill levels
                            </p>
                        </div>
                    </div>

                    <!-- Item -->
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-900">Secure & Private</h4>
                            <p class="text-sm text-gray-600">
                                Your data is encrypted and safe
                            </p>
                        </div>
                    </div>

                    <!-- Item -->
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-900">Real-time Updates</h4>
                            <p class="text-sm text-gray-600">
                                Track expenses as they happen
                            </p>
                        </div>
                    </div>

                    <!-- Item -->
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-900">Smart Reports</h4>
                            <p class="text-sm text-gray-600">
                                Detailed analytics and insights
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- RIGHT CARD -->
            <div class="relative">

                <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl p-6 sm:p-8 shadow-2xl">

                    <div class="bg-white rounded-2xl p-6">

                        <!-- Header -->
                        <div class="flex items-center justify-between mb-6">

                            <div>
                                <p class="text-sm text-gray-500">Monthly Savings</p>
                                <p class="text-2xl sm:text-3xl font-bold text-green-600">
                                    +$850.00
                                </p>
                            </div>

                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6">
                                    </path>

                                </svg>
                            </div>

                        </div>

                        <!-- Progress Bars -->
                        <div class="space-y-4">

                            <!-- Food -->
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-gray-600">Food & Dining</span>
                                    <span class="font-medium">75%</span>
                                </div>

                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-600 h-2 rounded-full w-[75%]"></div>
                                </div>
                            </div>

                            <!-- Transport -->
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-gray-600">Transportation</span>
                                    <span class="font-medium">45%</span>
                                </div>

                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-600 h-2 rounded-full w-[45%]"></div>
                                </div>
                            </div>

                            <!-- Entertainment -->
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-gray-600">Entertainment</span>
                                    <span class="font-medium">30%</span>
                                </div>

                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-600 h-2 rounded-full w-[30%]"></div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-indigo-600 to-indigo-800 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-64 h-64 bg-white/10 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/10 rounded-full translate-x-1/2 translate-y-1/2"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">Ready to Take Control of Your Finances?</h2>
            <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">Join thousands of users who are already tracking their expenses and saving money. Start your free account today!</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-8 py-4 bg-white text-indigo-600 rounded-xl font-semibold text-lg hover:bg-gray-100 transition-colors">Go to Dashboard</a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-indigo-600 rounded-xl font-semibold text-lg hover:bg-gray-100 transition-colors">Get Started for Free</a>
                    <a href="{{ route('login') }}" class="px-8 py-4 bg-indigo-500 text-white rounded-xl font-semibold text-lg border-2 border-white/30 hover:bg-indigo-400 transition-colors">Sign In</a>
                @endauth
            </div>
            <p class="mt-6 text-indigo-200 text-sm">No credit card required • Free forever plan available</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="text-xl font-bold text-white">BudgetHub</span>
                    </div>
                    <p class="text-gray-400">Track your finances effortlessly and make smarter money decisions.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="#features" class="footer-link hover:text-indigo-400 transition-colors">Features</a></li>
                        <li><a href="#about" class="footer-link hover:text-indigo-400 transition-colors">About</a></li>
                        <li><a href="{{ route('login') }}" class="footer-link hover:text-indigo-400 transition-colors">Sign In</a></li>
                        <li><a href="{{ route('register') }}" class="footer-link hover:text-indigo-400 transition-colors">Register</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Pages</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ url('/expenses') }}" class="footer-link hover:text-indigo-400 transition-colors">Expenses</a></li>
                        <li><a href="{{ url('/categories') }}" class="footer-link hover:text-indigo-400 transition-colors">Categories</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Contact</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span>support@BudgetHub.com</span>
                        </li>
                    </ul>
                </div>
            <div class="pt-8 border-t border-gray-800 flex flex-col sm:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} BudgetHub. All rights reserved.</p>
            </div>
        </div>
    </div>
    </footer>

    <script>
        // Mobile menu functionality
        const burgerBtn = document.getElementById("burgerBtn");
        const mobileMenu = document.getElementById("mobileMenu");
        const mobileOverlay = document.getElementById("mobileOverlay");
        const closeMenuBtn = document.getElementById("closeMenuBtn");

        function openMenu(){
            mobileMenu.classList.remove("translate-x-full");
            mobileOverlay.classList.remove("opacity-0","pointer-events-none");
        }

        function closeMenu(){
            mobileMenu.classList.add("translate-x-full");
            mobileOverlay.classList.add("opacity-0","pointer-events-none");
        }

        burgerBtn.addEventListener("click",openMenu);
        closeMenuBtn.addEventListener("click",closeMenu);
        mobileOverlay.addEventListener("click",closeMenu);

        burgerBtn.addEventListener('click', function() {
            if (mobileMenu.classList.contains('open')) {
                closeMenu();
            } else {
                openMenu();
            }
        });

        closeMenuBtn.addEventListener('click', closeMenu);
        mobileOverlay.addEventListener('click', closeMenu);

        // Close menu when clicking on a link
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(function(link) {
            link.addEventListener('click', closeMenu);
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenu.classList.contains('open')) {
                closeMenu();
            }
        });
    </script>
</body>
</html>
