<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion Patient - RDV Médical</title>
    <meta name="description" content="Connectez-vous à votre compte patient RDV Médical pour gérer vos rendez-vous médicaux.">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #ffffff 0%, #10b981 100%); }
        .hero-gradient { background: linear-gradient(135deg, #ffffff 0%, #10b981 50%, #34d399 100%); }
        .animate-fade-in { animation: fadeIn 1s ease-in; }
        .animate-slide-up { animation: slideUp 0.8s ease-out; }
        .animate-float { animation: float 6s ease-in-out infinite; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp { from { transform: translateY(30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Navigation Header -->
    <nav class="bg-white/95 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-green-600 to-emerald-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-stethoscope text-white text-lg"></i>
                    </div>
                    <a href="/" class="text-2xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">RDV Médical</a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 relative group">
                        Accueil
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/doctors" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 relative group">
                        Médecins
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/specialties" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 relative group">
                        Spécialités
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/health-tips" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 relative group">
                        Conseils Santé
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="/contact" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 relative group">
                        Contact
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/login" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 hidden sm:block">Connexion</a>
                    <a href="/register" class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-2.5 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105 font-medium">
                        <i class="fas fa-user-plus mr-2"></i>Inscription
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-emerald-300/20 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="animate-slide-up">
                <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 mb-6">
                    <i class="fas fa-user-shield text-green-400"></i>
                    <span class="text-white font-medium">Connexion Sécurisée</span>
                </div>

                <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    Bienvenue sur <span class="bg-gradient-to-r from-green-400 to-emerald-500 bg-clip-text text-transparent">RDV Médical</span>
                </h1>

                <p class="text-xl text-white/90 mb-8 leading-relaxed max-w-2xl mx-auto">
                    Connectez-vous à votre compte patient pour gérer vos rendez-vous médicaux,
                    consulter votre historique et prendre de nouveaux rendez-vous en toute sécurité.
                </p>
            </div>
        </div>
    </section>

    <!-- Login Section -->
    <section class="py-20 bg-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-20 left-20 w-64 h-64 bg-green-100/50 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-emerald-100/30 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-md mx-auto">
                <!-- Login Card -->
                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-8 py-6 text-center">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user text-white text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-white mb-2">Connexion Patient</h2>
                        <p class="text-white/90 text-sm">Accédez à votre espace personnel</p>
                    </div>

                    <!-- Form -->
                    <div class="px-8 py-8">
                        <form method="POST" action="{{ route('login.patient') }}" class="space-y-6">
                            @csrf

                            <!-- Email Field -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-envelope mr-2 text-blue-500"></i>Adresse email
                                </label>
                                <div class="relative">
                                    <input type="email" name="email" required
                                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-4 pl-12 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-green-500 focus:border-transparent focus:bg-white transition-all duration-300"
                                           placeholder="votre@email.com"
                                           value="{{ old('email') }}">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                    </div>
                                </div>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-lock mr-2 text-green-500"></i>Mot de passe
                                </label>
                                <div class="relative">
                                    <input type="password" id="password-patient" name="password" required
                                           class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-4 pl-12 pr-12 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-emerald-500 focus:border-transparent focus:bg-white transition-all duration-300"
                                           placeholder="Votre mot de passe">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <button type="button" onclick="togglePasswordPatient()" class="absolute inset-y-0 right-0 pr-4 flex items-center hover:text-gray-600 transition-colors">
                                        <i id="password-icon-patient" class="fas fa-eye text-gray-400"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input type="checkbox" id="remember" name="remember"
                                            class="h-4 w-4 bg-white border-gray-300 rounded focus:ring-green-500 text-green-500">
                                    <label for="remember" class="ml-2 text-sm text-gray-600">Se souvenir de moi</label>
                                </div>
                                <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:text-green-800 font-medium transition-colors">
                                    Mot de passe oublié ?
                                </a>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" id="login-btn-patient" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-4 rounded-xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                <span id="btn-text-patient">Se connecter</span>
                                <div id="loading-spinner-patient" class="hidden ml-2">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </div>
                            </button>
                        </form>

                        <!-- Social Login -->
                        <div class="mt-8">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-200"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-4 bg-white text-gray-500">Ou continuer avec</span>
                                </div>
                            </div>

                            <div class="mt-6 grid grid-cols-2 gap-4">
                                <button class="w-full flex items-center justify-center px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl hover:bg-gray-100 transition-all duration-300">
                                    <i class="fab fa-google text-red-500 mr-2"></i>
                                    <span class="text-gray-700 font-medium">Google</span>
                                </button>
                                <button class="w-full flex items-center justify-center px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl hover:bg-gray-100 transition-all duration-300">
                                    <i class="fab fa-facebook text-blue-600 mr-2"></i>
                                    <span class="text-gray-700 font-medium">Facebook</span>
                                </button>
                            </div>
                        </div>

                        <!-- Register Link -->
                        <div class="mt-8 text-center">
                            <p class="text-gray-600">
                                Pas encore de compte ?
                                <a href="{{ route('register.patient') }}" class="text-green-600 hover:text-green-800 font-semibold transition-colors">S'inscrire maintenant</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Back to Login Choice -->
                <div class="text-center mt-8">
                    <a href="{{ route('login') }}" class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-800 transition-colors">
                        <i class="fas fa-arrow-left"></i>
                        <span>Retour au choix de connexion</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-green-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Pourquoi choisir RDV Médical ?</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Votre plateforme de confiance pour tous vos besoins médicaux</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-600 to-emerald-600 rounded-3xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-calendar-check text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Réservation Express</h3>
                    <p class="text-gray-600">Prenez rendez-vous en quelques clics, disponible 24h/24 et 7j/7</p>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-600 to-teal-600 rounded-3xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Données Sécurisées</h3>
                    <p class="text-gray-600">Vos informations médicales sont protégées selon les normes RGPD</p>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-teal-600 to-cyan-600 rounded-3xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-user-md text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Médecins Vérifiés</h3>
                    <p class="text-gray-600">Tous nos professionnels de santé sont certifiés et expérimentés</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-green-900 to-emerald-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-20 left-20 w-64 h-64 bg-green-500/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative">
            <!-- Main Footer Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="lg:col-span-2">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-600 to-emerald-600 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-stethoscope text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold bg-gradient-to-r from-green-400 to-emerald-400 bg-clip-text text-transparent">RDV Médical</h3>
                                <p class="text-sm text-white/60">Tunisie</p>
                            </div>
                        </div>
                        <p class="text-white/80 mb-6 leading-relaxed max-w-md">
                            Votre plateforme de confiance pour prendre rendez-vous avec les meilleurs médecins en Tunisie.
                            Sécurité, rapidité et qualité au service de votre santé.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-colors duration-300">
                                <i class="fab fa-facebook-f text-white"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-colors duration-300">
                                <i class="fab fa-instagram text-white"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-colors duration-300">
                                <i class="fab fa-linkedin-in text-white"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-colors duration-300">
                                <i class="fab fa-twitter text-white"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="text-lg font-semibold mb-6 text-white">Liens Rapides</h4>
                        <ul class="space-y-3">
                            <li><a href="/" class="text-white/70 hover:text-white transition-colors duration-200">Accueil</a></li>
                            <li><a href="/doctors" class="text-white/70 hover:text-white transition-colors duration-200">Trouver un médecin</a></li>
                            <li><a href="/specialties" class="text-white/70 hover:text-white transition-colors duration-200">Spécialités</a></li>
                            <li><a href="/health-tips" class="text-white/70 hover:text-white transition-colors duration-200">Conseils Santé</a></li>
                            <li><a href="/contact" class="text-white/70 hover:text-white transition-colors duration-200">Contact</a></li>
                        </ul>
                    </div>

                    <!-- Support -->
                    <div>
                        <h4 class="text-lg font-semibold mb-6 text-white">Support</h4>
                        <ul class="space-y-3">
                            <li class="flex items-center space-x-3">
                                <i class="fas fa-envelope text-green-400"></i>
                                <span class="text-white/70">support@rdvmedical.tn</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <i class="fas fa-phone text-green-400"></i>
                                <span class="text-white/70">+216 00 000 000</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <i class="fas fa-clock text-emerald-400"></i>
                                <span class="text-white/70">24/7 Support</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-white/10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <p class="text-white/60 text-sm">
                            &copy; 2025 RDV Médical. Tous droits réservés.
                        </p>
                        <div class="flex space-x-6 mt-4 md:mt-0">
                            <a href="#" class="text-white/60 hover:text-white text-sm transition-colors duration-200">Confidentialité</a>
                            <a href="#" class="text-white/60 hover:text-white text-sm transition-colors duration-200">Conditions</a>
                            <a href="#" class="text-white/60 hover:text-white text-sm transition-colors duration-200">RGPD</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function togglePasswordPatient() {
            const passwordInput = document.getElementById('password-patient');
            const passwordIcon = document.getElementById('password-icon-patient');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.className = 'fas fa-eye-slash text-gray-400';
            } else {
                passwordInput.type = 'password';
                passwordIcon.className = 'fas fa-eye text-gray-400';
            }
        }

        // Add loading state to form submission
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function() {
                    const btn = document.getElementById('login-btn-patient');
                    const btnText = document.getElementById('btn-text-patient');
                    const spinner = document.getElementById('loading-spinner-patient');

                    if (btn && btnText && spinner) {
                        btn.disabled = true;
                        btnText.textContent = 'Connexion en cours...';
                        spinner.classList.remove('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html>