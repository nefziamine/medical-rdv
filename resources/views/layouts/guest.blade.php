<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Connexion et inscription - RDV Médical">

        <title>{{ config('app.name', 'RDV Médical') }} - @yield('title', 'Connexion')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Inter', sans-serif; }
            .auth-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
            .glass-card { backdrop-filter: blur(20px); background: rgba(255, 255, 255, 0.95); }
            .animate-float { animation: float 6s ease-in-out infinite; }
            @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen auth-bg relative overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute inset-0">
                <div class="absolute top-20 left-20 w-64 h-64 bg-white/10 rounded-full blur-3xl animate-float"></div>
                <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-300/20 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-blue-300/10 rounded-full blur-3xl animate-float" style="animation-delay: 4s;"></div>
            </div>

            <!-- Navigation -->
            <nav class="relative z-10 w-full bg-white/10 backdrop-blur-md py-4">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center">
                        <a href="/" class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-stethoscope text-white text-lg"></i>
                            </div>
                            <span class="text-2xl font-bold text-white">RDV Médical</span>
                        </a>
                        <div class="flex space-x-4">
                            <a href="/" class="text-white/80 hover:text-white transition-colors px-4 py-2 rounded-lg hover:bg-white/10">
                                <i class="fas fa-home mr-2"></i>Accueil
                            </a>
                            <a href="/login" class="text-white/80 hover:text-white transition-colors px-4 py-2 rounded-lg hover:bg-white/10">
                                <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="relative z-10 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 min-h-[calc(100vh-80px)]">
                <div class="w-full max-w-md px-6">
                    <!-- Logo Section -->
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-md rounded-3xl mb-4">
                            <i class="fas fa-stethoscope text-white text-3xl"></i>
                        </div>
                        <h1 class="text-3xl font-bold text-white mb-2">RDV Médical</h1>
                        <p class="text-white/80">@yield('subtitle', 'Votre santé, notre priorité')</p>
                    </div>

                    <!-- Auth Card -->
                    <div class="glass-card rounded-3xl shadow-2xl p-8 border border-white/20">
                        @yield('content')
                    </div>

                    <!-- Footer Links -->
                    <div class="text-center mt-6">
                        <p class="text-white/80 text-sm">
                            @yield('footer-links')
                        </p>
                    </div>
                </div>
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
        </div>

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
