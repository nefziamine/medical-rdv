<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact - RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Tajawal', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  <!-- Navigation Header -->
  <nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center py-4">
        <div class="flex items-center">
          <a href="/" class="text-2xl font-bold text-red-500">RDV Médical</a>
        </div>
        <div class="hidden md:flex items-center space-x-8">
          <a href="/" class="text-gray-600 hover:text-red-500 transition">Accueil</a>
          <a href="/doctors" class="text-gray-600 hover:text-red-500 transition">Médecins</a>
          <a href="/specialties" class="text-gray-600 hover:text-red-500 transition">Spécialités</a>
          <a href="/contact" class="text-red-500 font-semibold">Contact</a>
        </div>
        <div class="flex items-center space-x-4">
          @auth
            <div class="relative">
              <button class="flex items-center space-x-2 text-gray-600 hover:text-red-500 transition">
                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                  <span class="text-red-500 font-bold text-sm">{{ substr(Auth::user()->first_name, 0, 1) }}</span>
                </div>
                <span>{{ Auth::user()->first_name }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="inline">
              @csrf
              <button type="submit" class="text-gray-600 hover:text-red-500 transition bg-transparent border-0 cursor-pointer">Déconnexion</button>
            </form>
          @else
            <a href="/login" class="text-gray-600 hover:text-red-500 transition">Connexion</a>
            <a href="/register" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">Inscription</a>
          @endauth
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold text-center mb-8">Contactez-nous</h1>
      <p class="text-center text-gray-600 mb-8">Nous sommes là pour vous aider</p>
    </div>
  </section>

  <!-- Contact Content -->
  <section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg shadow">{{ session('success') }}</div>
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
                <input type="text" name="first_name" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                <input type="text" name="last_name" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
              <input type="email" name="email" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Sujet</label>
              <select name="subject" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                <option>Choisissez un sujet</option>
                <option>Question générale</option>
                <option>Problème technique</option>
                <option>Réclamation</option>
                <option>Partenariat</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
              <textarea rows="5" name="message" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"></textarea>
            </div>
            <button type="submit" class="bg-red-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-600 transition">
              Envoyer le message
            </button>
          </form>
        </div>

        <!-- Contact Info -->
        <div>
          <h2 class="text-2xl font-bold mb-6">Informations de contact</h2>
          <div class="space-y-6">
            <div class="flex items-start">
              <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
              </div>
              <div>
                <h3 class="font-semibold text-lg">Téléphone</h3>
                <p class="text-gray-600">+216 00 000 000</p>
                <p class="text-gray-600">Lun-Ven: 8h-18h</p>
              </div>
            </div>

            <div class="flex items-start">
              <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
              </div>
              <div>
                <h3 class="font-semibold text-lg">Email</h3>
                <p class="text-gray-600">support@rdvmedical.tn</p>
                <p class="text-gray-600">Réponse sous 24h</p>
              </div>
            </div>

            <div class="flex items-start">
              <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
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
  <footer class="bg-gradient-to-r from-red-500 to-pink-500 text-white py-12">
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
          <a href="#" class="flex items-center space-x-2 hover:text-red-200 transition">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
            <span>Facebook</span>
          </a>
          <a href="#" class="flex items-center space-x-2 hover:text-red-200 transition">
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