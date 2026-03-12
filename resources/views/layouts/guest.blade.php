<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BudgetHub') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }

            @keyframes pulse-glow {
                0%, 100% { box-shadow: 0 0 20px rgba(79, 70, 229, 0.3); }
                50% { box-shadow: 0 0 40px rgba(79, 70, 229, 0.6); }
            }

            .animate-fade-in {
                animation: fadeIn 0.6s ease-out forwards;
            }

            .animate-float {
                animation: float 6s ease-in-out infinite;
            }

            .animate-pulse-glow {
                animation: pulse-glow 2s ease-in-out infinite;
            }

            .bg-pattern {
                background-image: 
                    radial-gradient(circle at 20% 80%, rgba(79, 70, 229, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(79, 70, 229, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 40% 40%, rgba(79, 70, 229, 0.05) 0%, transparent 30%);
            }

            .floating-shape {
                position: absolute;
                border-radius: 50%;
                opacity: 0.5;
                z-index: 0;
            }

            .input-dark:focus {
                border-color: #4F46E5;
                box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
            }

            .btn-primary {
                transition: all 0.3s ease;
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 30px rgba(79, 70, 229, 0.4);
            }

            .auth-card {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .auth-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            }

            /* Responsive adjustments */
            @media (max-width: 640px) {
                .floating-shape {
                    display: none;
                }

                .auth-card {
                    margin: 0 1rem;
                }

                .brand-text {
                    font-size: 1.5rem;
                }

                .brand-icon {
                    width: 2.5rem;
                    height: 2.5rem;
                }

                .brand-icon svg {
                    width: 1.5rem;
                    height: 1.5rem;
                }
            }

            @media (min-width: 641px) and (max-width: 768px) {
                .floating-shape:nth-child(3),
                .floating-shape:nth-child(4) {
                    display: none;
                }
            }

            /* Ensure minimum touch target sizes on mobile */
            @media (max-width: 480px) {
                .auth-card input {
                    padding: 0.875rem 1rem;
                }

                .auth-card button {
                    padding: 0.875rem 1rem;
                }
            }
        </style>
    </head>
    <body class="font-sans text-white antialiased">
        <div class="min-h-screen bg-white bg-pattern relative overflow-hidden flex flex-col items-center justify-center px-4 py-8">
            <!-- Floating Shapes - Hidden on small mobile -->
            <div class="floating-shape w-64 h-64 bg-indigo-500/20 animate-float hidden md:block" style="top: 10%; left: 5%;"></div>
            <div class="floating-shape w-48 h-48 bg-indigo-400/30 animate-float hidden md:block" style="top: 70%; right: 10%; animation-delay: 1s;"></div>
            <div class="floating-shape w-32 h-32 bg-indigo-300/20 animate-float hidden lg:block" style="top: 40%; right: 25%; animation-delay: 2s;"></div>
            <div class="floating-shape w-40 h-40 bg-indigo-600/20 animate-float hidden lg:block" style="bottom: 20%; left: 15%; animation-delay: 3s;"></div>

            <!-- Logo Section -->
            <div class="mb-6 sm:mb-8 z-10 animate-fade-in">
                <a href="{{ route('welcome') }}" class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 bg-indigo-600 rounded-xl lg:rounded-2xl flex items-center justify-center shadow-lg animate-pulse-glow">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 lg:w-8 lg:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xl sm:text-2xl lg:text-3xl font-bold text-black brand-text">BudgetHub</span>
                </a>
            </div>

            <!-- Main Card -->
            <div class="w-full sm:max-w-md z-10 animate-fade-in" style="animation-delay: 0.2s;">
                <div class="auth-card bg-gray-800/80 backdrop-blur-sm border border-gray-700/50 rounded-2xl sm:rounded-3xl shadow-2xl">
                    <div class="p-6 sm:p-8 lg:p-10">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            <!-- Back to Home -->
            {{-- <div class="mt-6 sm:mt-8 z-10 animate-fade-in" style="animation-delay: 0.4s;">
                <a href="{{ route('welcome') }}" class="flex items-center text-gray-400 hover:text-indigo-400 transition-colors text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span class="hidden xs:inline">Back to Home</span>
                    <span class="xs:hidden">Home</span>
                </a>
            </div> --}}

            <!-- Footer -->
            <div class="absolute bottom-2 sm:bottom-4 left-0 right-0 text-center z-10 px-4">
                <p class="text-gray-500 text-xs sm:text-sm">
                    &copy; {{ date('Y') }} BudgetHub. All rights reserved.
                </p>
            </div>
        </div>
    </body>
</html>

