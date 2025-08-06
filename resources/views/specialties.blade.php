<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Spécialités - RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Tajawal', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  <!-- Navigation Header (copiée de la page d'accueil) -->
  <nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center py-4">
        <div class="flex items-center">
          <a href="/" class="text-2xl font-bold text-red-500">RDV Médical</a>
        </div>
        <div class="hidden md:flex items-center space-x-8">
          <a href="/" class="text-gray-600 hover:text-red-500 transition">Accueil</a>
          <a href="/doctors" class="text-gray-600 hover:text-red-500 transition">Médecins</a>
          <a href="/specialties" class="text-red-500 font-semibold">Spécialités</a>
          <a href="/contact" class="text-gray-600 hover:text-red-500 transition">Contact</a>
        </div>
        <div class="flex items-center space-x-4">
          @auth
            <div class="relative" x-data="{ open: false }">
              <button @click="open = !open" class="flex items-center space-x-2 bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>{{ Auth::user()->name }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
              <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Mon profil
                  </div>
                </a>
                @if(Auth::user()->isDoctor())
                <a href="/profile/availability" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Disponibilité
                  </div>
                </a>
                @endif
                <a href="/appointments" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Mes rendez-vous
                  </div>
                </a>
                <hr class="my-1">
                <form method="POST" action="{{ route('logout') }}" class="block">
                  @csrf
                  <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                    <div class="flex items-center">
                      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                      </svg>
                      Déconnexion
                    </div>
                  </button>
                </form>
              </div>
            </div>
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
      <h1 class="text-3xl font-bold text-center mb-8">Spécialités médicales</h1>
      <p class="text-center text-gray-600 mb-8">Trouvez la spécialité qui correspond à vos besoins</p>
    </div>
  </section>

  <!-- Specialties List -->
  <section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($specialties as $specialty)
          <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                <!-- icône -->
              </div>
              <div>
                <h3 class="font-semibold text-lg">{{ $specialty->name }}</h3>
                <p class="text-gray-600 text-sm">{{ $specialty->subtitle ?? '' }}</p>
              </div>
            </div>
            <p class="text-gray-600 mb-4">{{ $specialty->description ?? '' }}</p>
            <a href="{{ route('specialties.show', $specialty->slug) }}" class="text-blue-600 hover:underline text-sm font-semibold">Voir les détails</a>
          </div>
        @endforeach
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