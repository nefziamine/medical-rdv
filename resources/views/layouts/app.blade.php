<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Plateforme de prise de rendez-vous médical en Tunisie - RDV Médical">

        <title>{{ config('app.name', 'RDV Médical') }} - @yield('title', 'Prenez rendez-vous avec les meilleurs médecins')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { 
                font-family: 'Inter', sans-serif; 
                background: #f8fafc;
            }
            .premium-gradient { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
            .glass-card { 
                backdrop-filter: blur(10px); 
                background: rgba(255, 255, 255, 0.8); 
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
            .animate-slide-up { animation: slideUp 0.6s ease-out forwards; }
            @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
            
            /* Custom Scrollbar */
            ::-webkit-scrollbar { width: 8px; }
            ::-webkit-scrollbar-track { background: #f1f1f1; }
            ::-webkit-scrollbar-thumb { background: #10b981; border-radius: 4px; }
            ::-webkit-scrollbar-thumb:hover { background: #059669; }
        </style>
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="min-h-screen">
            @if (!request()->routeIs('home') && !request()->routeIs('login') && !request()->routeIs('register'))
                @include('layouts.navigation')
            @endif

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md shadow-lg border-b border-white/20 dark:border-gray-700/50">
                    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                        <div class="animate-fade-in">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="animate-fade-in">
                @yield('content')
            </main>

            <!-- Footer for authenticated pages -->
            @auth
            <footer class="bg-gradient-to-r from-gray-900 via-blue-900 to-purple-900 text-white mt-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="flex items-center space-x-3 mb-4 md:mb-0">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-stethoscope text-white"></i>
                            </div>
                            <div>
                                <p class="font-semibold">RDV Médical</p>
                                <p class="text-sm text-white/60">Votre santé, notre priorité</p>
                            </div>
                        </div>
                        <div class="flex space-x-6 text-sm">
                            <a href="/" class="text-white/70 hover:text-white transition-colors">Accueil</a>
                            <a href="/profile" class="text-white/70 hover:text-white transition-colors">Profil</a>
                            <a href="/appointments" class="text-white/70 hover:text-white transition-colors">Rendez-vous</a>
                        </div>
                    </div>
                    <div class="border-t border-white/10 mt-6 pt-6 text-center text-sm text-white/60">
                        &copy; 2025 RDV Médical. Tous droits réservés.
                    </div>
                </div>
            </footer>
            @endauth
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg z-50 animate-fade-in">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg z-50 animate-fade-in">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        @endif

        <script>
            // Auto-hide messages after 5 seconds
            setTimeout(() => {
                const messages = document.querySelectorAll('[class*="bg-green-500"], [class*="bg-red-500"]');
                messages.forEach(msg => {
                    msg.style.opacity = '0';
                    setTimeout(() => msg.remove(), 300);
                });
            }, 5000);
        </script>
    </body>
</html>
