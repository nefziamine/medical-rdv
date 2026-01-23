<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Conseils Santé - RDV Médical</title>
    <meta name="description" content="Découvrez nos conseils santé pour prendre soin de votre bien-être. Prévention, alimentation, activité physique et bien plus.">
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
                    <a href="/health-tips" class="text-green-600 font-medium transition-colors duration-200 relative group">
                        Conseils Santé
                        <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-green-600 transition-all duration-300"></span>
                    </a>
                    <a href="/contact" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 relative group">
                        Contact
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 bg-gradient-to-r from-green-600 to-emerald-600 text-white px-5 py-2.5 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <span class="font-medium">{{ Auth::user()->first_name }}</span>
                                <i class="fas fa-chevron-down text-white text-sm transition-transform duration-200" :class="{'rotate-180': open}"></i>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-2xl py-2 z-50 border border-gray-100">
                                <a href="/profile" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <i class="fas fa-user-circle text-blue-500"></i>
                                    <span>Mon profil</span>
                                </a>
                                @if(Auth::user()->isDoctor())
                                <a href="/profile/availability" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <i class="fas fa-calendar-alt text-green-500"></i>
                                    <span>Disponibilité</span>
                                </a>
                                @endif
                                <a href="/appointments" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <i class="fas fa-calendar-check text-purple-500"></i>
                                    <span>Mes rendez-vous</span>
                                </a>
                                <hr class="my-2 border-gray-200">
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Déconnexion</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                    <a href="/login" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 hidden sm:block">Connexion</a>
                    <a href="/register" class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-2.5 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105 font-medium">
                        <i class="fas fa-user-plus mr-2"></i>Inscription
                    </a>
                    @endauth
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
                    <i class="fas fa-heartbeat text-red-400"></i>
                    <span class="text-white font-medium">Conseils Santé - Prévention & Bien-être</span>
                </div>

                <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    Prenez soin de votre <span class="bg-gradient-to-r from-green-400 to-blue-500 bg-clip-text text-transparent">santé</span> au quotidien
                </h1>

                <p class="text-xl text-white/90 mb-8 leading-relaxed max-w-3xl mx-auto">
                    Découvrez nos conseils pratiques pour maintenir une bonne santé, prévenir les maladies et améliorer votre qualité de vie.
                    Des astuces simples pour un quotidien plus sain.
                </p>
            </div>
        </div>
    </section>

    <!-- Health Tips Categories -->
    <section class="py-20 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Nos Conseils Santé par Catégorie</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Explorez nos recommandations personnalisées pour chaque aspect de votre santé</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Nutrition -->
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-8 rounded-3xl shadow-lg border border-green-100 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 group">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-600 to-emerald-600 rounded-3xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-apple-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Nutrition & Alimentation</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Découvrez comment adopter une alimentation équilibrée pour maintenir votre santé et votre vitalité.</p>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-gray-700">Régime méditerranéen</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-gray-700">Hydratation quotidienne</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-gray-700">Contrôle des portions</span>
                        </li>
                    </ul>
                    <a href="#nutrition" class="inline-flex items-center space-x-2 bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        <span>En savoir plus</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Exercise -->
                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-8 rounded-3xl shadow-lg border border-blue-100 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 group">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-3xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-running text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Activité Physique</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">L'importance du mouvement dans la prévention des maladies et le maintien de la forme physique.</p>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-blue-500"></i>
                            <span class="text-gray-700">Exercice quotidien</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-blue-500"></i>
                            <span class="text-gray-700">Activités adaptées</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-blue-500"></i>
                            <span class="text-gray-700">Bienfaits cardiovasculaires</span>
                        </li>
                    </ul>
                    <a href="#exercise" class="inline-flex items-center space-x-2 bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        <span>En savoir plus</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Prevention -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-8 rounded-3xl shadow-lg border border-purple-100 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 group">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-600 to-pink-600 rounded-3xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Prévention & Dépistage</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Les examens de santé essentiels et les dépistages recommandés pour une prévention efficace.</p>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-purple-500"></i>
                            <span class="text-gray-700">Bilans de santé annuels</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-purple-500"></i>
                            <span class="text-gray-700">Vaccinations à jour</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-purple-500"></i>
                            <span class="text-gray-700">Dépistages précoces</span>
                        </li>
                    </ul>
                    <a href="#prevention" class="inline-flex items-center space-x-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        <span>En savoir plus</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Detailed Health Tips Sections -->
    <!-- Nutrition Section -->
    <section id="nutrition" class="py-20 bg-gradient-to-br from-gray-50 to-green-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Nutrition & Alimentation Saine</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Une alimentation équilibrée est la base d'une bonne santé</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Les 5 piliers d'une alimentation saine</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <span class="text-white font-bold">1</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">Variété des aliments</h4>
                                    <p class="text-gray-600">Consommez des aliments de tous les groupes : fruits, légumes, protéines, glucides et matières grasses saines.</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <span class="text-white font-bold">2</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">Équilibre des repas</h4>
                                    <p class="text-gray-600">Chaque repas doit contenir des protéines, des légumes et des glucides complexes.</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <span class="text-white font-bold">3</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">Hydratation</h4>
                                    <p class="text-gray-600">Buvez au moins 1,5 litre d'eau par jour pour maintenir une bonne hydratation.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Conseils pratiques</h3>
                        <ul class="space-y-3">
                            <li class="flex items-center space-x-3">
                                <i class="fas fa-leaf text-green-500"></i>
                                <span class="text-gray-700">Privilégiez les aliments frais et de saison</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <i class="fas fa-utensils text-green-500"></i>
                                <span class="text-gray-700">Cuisinez vous-même pour contrôler les ingrédients</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <i class="fas fa-clock text-green-500"></i>
                                <span class="text-gray-700">Prenez le temps de manger lentement</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="relative">
                    <img src="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&w=600&q=80" alt="Alimentation saine" class="w-full rounded-3xl shadow-2xl">
                    <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-2xl shadow-xl">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-heartbeat text-red-500 text-2xl"></i>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">80%</div>
                                <div class="text-sm text-gray-600">des maladies chroniques sont liées à l'alimentation</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Detailed Activity Section -->
    <section id="exercise" class="py-20 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Activité Physique & Sport</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Bouger est essentiel pour maintenir un corps et un esprit sains</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1 relative">
                    <img src="https://images.pexels.com/photos/40751/running-runner-long-distance-runner-marathon-40751.jpeg?auto=compress&w=600&q=80" alt="Activité physique" class="w-full rounded-3xl shadow-2xl">
                    <div class="absolute -bottom-6 -right-6 bg-white p-6 rounded-2xl shadow-xl">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-walking text-blue-500 text-2xl"></i>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">30 min</div>
                                <div class="text-sm text-gray-600">Par jour suffisent !</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2 space-y-8">
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-8 rounded-3xl shadow-lg border border-blue-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Les bienfaits du sport</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-heart text-white text-xs"></i>
                                </div>
                                <p class="text-gray-700 font-medium">Réduit les risques de maladies cardiovasculaires et de diabète.</p>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-smile text-white text-xs"></i>
                                </div>
                                <p class="text-gray-700 font-medium">Améliore le sommeil et réduit le stress et l'anxiété.</p>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-weight text-white text-xs"></i>
                                </div>
                                <p class="text-gray-700 font-medium">Aide au maintien d'un poids santé et renforce les muscles.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Nos recommandations</h3>
                        <ul class="space-y-3">
                            <li class="flex items-center space-x-3">
                                <i class="fas fa-check-circle text-blue-500"></i>
                                <span class="text-gray-700">Favorisez la marche ou le vélo pour vos trajets</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <i class="fas fa-check-circle text-blue-500"></i>
                                <span class="text-gray-700">Pratiquez au moins 150 min de sport modéré par semaine</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <i class="fas fa-check-circle text-blue-500"></i>
                                <span class="text-gray-700">Restez hydraté avant, pendant et après l'effort</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Detailed Prevention Section -->
    <section id="prevention" class="py-20 bg-gradient-to-br from-purple-50 to-pink-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Prévention & Dépistage</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Mieux vaut prévenir que guérir : les clés d'un suivi médical efficace</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Examens incontournables</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 bg-purple-50 rounded-2xl border border-purple-100">
                                <h4 class="font-bold text-purple-700 mb-1">Bilan sanguin</h4>
                                <p class="text-sm text-gray-600">Une fois par an pour vérifier cholestérol, glycémie, etc.</p>
                            </div>
                            <div class="p-4 bg-pink-50 rounded-2xl border border-pink-100">
                                <h4 class="font-bold text-pink-700 mb-1">Tension artérielle</h4>
                                <p class="text-sm text-gray-600">À surveiller régulièrement pour prévenir l'hypertension.</p>
                            </div>
                            <div class="p-4 bg-indigo-50 rounded-2xl border border-indigo-100">
                                <h4 class="font-bold text-indigo-700 mb-1">Ophtalmologie</h4>
                                <p class="text-sm text-gray-600">Un contrôle tous les 2 ans après 45 ans.</p>
                            </div>
                            <div class="p-4 bg-blue-50 rounded-2xl border border-blue-100">
                                <h4 class="font-bold text-blue-700 mb-1">Dentiste</h4>
                                <p class="text-sm text-gray-600">Une visite de contrôle et détartrage annuelle.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-purple-600 to-pink-600 p-8 rounded-3xl shadow-xl text-white">
                        <h3 class="text-2xl font-bold mb-4">L'importance du dépistage</h3>
                        <p class="mb-6 opacity-90">De nombreuses maladies, comme certains cancers, peuvent être guéries si elles sont détectées tôt.</p>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-shield-virus text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold italic">Le saviez-vous ?</h4>
                                <p class="text-sm opacity-80">Un dépistage précoce multiplie les chances de guérison par 10.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <img src="https://images.pexels.com/photos/4225880/pexels-photo-4225880.jpeg?auto=compress&w=600&q=80" alt="Prévention médicale" class="w-full rounded-3xl shadow-2xl">
                    <div class="absolute -top-6 -left-6 bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-calendar-check text-green-500 text-2xl"></i>
                            <div>
                                <div class="text-lg font-bold text-gray-900">À jour ?</div>
                                <div class="text-sm text-gray-600">Vérifiez vos vaccins</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-gradient-to-br from-green-600 to-emerald-600 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-20 left-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Prêt à prendre rendez-vous ?</h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                Appliquez ces conseils santé et consultez nos médecins partenaires pour un suivi personnalisé.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/register-patient" class="inline-flex items-center space-x-2 bg-white text-blue-600 px-8 py-4 rounded-2xl font-semibold shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-calendar-plus"></i>
                    <span>Réserver un rendez-vous</span>
                </a>
                <a href="/doctors" class="inline-flex items-center space-x-2 bg-blue-500/20 text-white px-8 py-4 rounded-2xl font-semibold border border-white/30 hover:bg-white/10 transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-search"></i>
                    <span>Trouver un médecin</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-green-900 to-emerald-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-20 left-20 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
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
                            <li><a href="/health-tips" class="text-white hover:text-blue-400 transition-colors duration-200 font-semibold">Conseils Santé</a></li>
                            <li><a href="/contact" class="text-white/70 hover:text-white transition-colors duration-200">Contact</a></li>
                        </ul>
                    </div>

                    <!-- Support -->
                    <div>
                        <h4 class="text-lg font-semibold mb-6 text-white">Support</h4>
                        <ul class="space-y-3">
                            <li class="flex items-center space-x-3">
                                <i class="fas fa-envelope text-blue-400"></i>
                                <span class="text-white/70">support@rdvmedical.tn</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <i class="fas fa-phone text-green-400"></i>
                                <span class="text-white/70">+216 00 000 000</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <i class="fas fa-clock text-purple-400"></i>
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
</body>
</html>