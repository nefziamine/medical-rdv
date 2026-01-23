<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact - RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body { font-family: 'Inter', sans-serif; }
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
          <a href="/contact" class="text-green-600 font-semibold relative">
            Contact
            <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-green-600"></span>
          </a>
          <a href="/health-tips" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 relative group">
            <i class="fas fa-heartbeat mr-1"></i>Conseils santé
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
                <a href="{{ route('profile') }}" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                  <i class="fas fa-tachometer-alt text-blue-500"></i>
                  <span>Tableau de bord</span>
                </a>
                @if(Auth::user()->isDoctor())
                <a href="{{ route('profile.availability') }}" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                  <i class="fas fa-calendar-alt text-green-500"></i>
                  <span>Disponibilité</span>
                </a>
                @endif
                <a href="{{ route('appointments.index') }}" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
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
          <a href="/login" class="text-gray-600 hover:text-green-600 transition-colors duration-200 hidden sm:block">Connexion</a>
          <a href="/register" class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-2.5 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105 font-medium">
            <i class="fas fa-user-plus mr-2"></i>Inscription
          </a>
          @endauth
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="bg-white py-20 relative overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
          Contactez-<span class="text-green-600">nous</span>
        </h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
          Nous sommes là pour vous aider. N'hésitez pas à nous contacter pour toute question ou assistance.
        </p>
      </div>
    </div>
  </section>

  <!-- Contact Content -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
          {{ session('success') }}
        </div>
      @endif
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Contact Form -->
        <div>
          <h2 class="text-2xl font-bold mb-6">Envoyez-nous un message</h2>
          <form class="space-y-6" method="POST" action="{{ route('contact.send') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                <input type="text" name="first_name" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                <input type="text" name="last_name" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
              <input type="email" name="email" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Sujet</label>
              <select name="subject" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                <option>Choisissez un sujet</option>
                <option>Question générale</option>
                <option>Problème technique</option>
                <option>Réclamation</option>
                <option>Partenariat</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
              <textarea rows="5" name="message" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"></textarea>
            </div>
            <button type="submit" class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
              Envoyer le message
            </button>
          </form>
        </div>

        <!-- Contact Info -->
        <div>
          <h2 class="text-2xl font-bold mb-6">Informations de contact</h2>
          <div class="space-y-6">
            <div class="flex items-start">
              <div class="w-12 h-12 bg-gradient-to-r from-green-600 to-emerald-600 rounded-lg flex items-center justify-center mr-4">
                <i class="fas fa-phone text-white"></i>
              </div>
              <div>
                <h3 class="font-semibold text-lg">Téléphone</h3>
                <p class="text-gray-600">+216 00 000 000</p>
                <p class="text-gray-600">Lun-Ven: 8h-18h</p>
              </div>
            </div>

            <div class="flex items-start">
              <div class="w-12 h-12 bg-gradient-to-r from-green-600 to-teal-600 rounded-lg flex items-center justify-center mr-4">
                <i class="fas fa-envelope text-white"></i>
              </div>
              <div>
                <h3 class="font-semibold text-lg">Email</h3>
                <p class="text-gray-600">support@rdvmedical.tn</p>
                <p class="text-gray-600">Réponse sous 24h</p>
              </div>
            </div>

            <div class="flex items-start">
              <div class="w-12 h-12 bg-gradient-to-r from-red-600 to-pink-600 rounded-lg flex items-center justify-center mr-4">
                <i class="fas fa-map-marker-alt text-white"></i>
              </div>
              <div>
                <h3 class="font-semibold text-lg">Adresse</h3>
                <p class="text-gray-600">123 Avenue Habib Bourguiba</p>
                <p class="text-gray-600">1001 Tunis, Tunisie</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
      <div>
        <h5 class="font-bold mb-4">RDV Médical</h5>
        <p class="text-sm">Votre solution numérique pour les rendez-vous médicaux en Tunisie et ailleurs.</p>
      </div>
      <div>
        <h5 class="font-bold mb-4">Contact</h5>
        <ul class="text-sm space-y-1">
          <li>Email: support@rdvmedical.tn</li>
          <li>Tél: +216 00 000 000</li>
        </ul>
      </div>
      <div>
        <h5 class="font-bold mb-4">Suivez-nous</h5>
        <div class="flex space-x-4">
          <a href="#" class="flex items-center space-x-2 hover:text-green-200 transition">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
            <span>Facebook</span>
          </a>
          <a href="#" class="flex items-center space-x-2 hover:text-blue-200 transition">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
            </svg>
            <span>Instagram</span>
          </a>
        </div>
      </div>
    </div>
    <div class="text-center mt-8 text-sm">
      &copy; 2025 RDV Médical. Tous droits réservés.
    </div>
  </footer>
</body>
</html>