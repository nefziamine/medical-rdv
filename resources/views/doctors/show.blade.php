<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dr. {{ $doctor->full_name }} - RDV Médical</title>
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
          <a href="/" class="text-red-500 font-semibold">Accueil</a>
          <a href="/doctors" class="text-gray-600 hover:text-red-500 transition">Médecins</a>
          <a href="/specialties" class="text-gray-600 hover:text-red-500 transition">Spécialités</a>
          <a href="/contact" class="text-gray-600 hover:text-red-500 transition">Contact</a>
        </div>
        <div class="flex items-center space-x-4">
          @auth
            <a href="/profile" class="text-gray-600 hover:text-red-500 transition">Profil</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
              @csrf
              <button type="submit" class="text-gray-600 hover:text-red-500 transition">Déconnexion</button>
            </form>
          @else
            <a href="/login" class="text-gray-600 hover:text-red-500 transition">Connexion</a>
            <a href="/register" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">Inscription</a>
          @endauth
        </div>
      </div>
    </div>
  </nav>

  <!-- Doctor Details -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Doctor Info -->
      <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-md p-6">
          <div class="flex items-start space-x-6">
            <div class="w-24 h-24 bg-red-100 rounded-full flex items-center justify-center">
              <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
              </svg>
            </div>
            <div class="flex-1">
              <h1 class="text-3xl font-bold text-gray-900 mb-2">Dr. {{ $doctor->full_name }}</h1>
              <p class="text-lg text-gray-600 mb-4">{{ $doctor->specialty->name }}</p>
              <div class="flex items-center space-x-4 mb-4">
                <div class="flex items-center">
                  @for($i = 1; $i <= 5; $i++)
                    @if($i <= $doctor->rating)
                      <span class="text-yellow-400">★</span>
                    @else
                      <span class="text-gray-300">★</span>
                    @endif
                  @endfor
                  <span class="ml-2 text-sm text-gray-600">({{ $doctor->total_reviews }} avis)</span>
                </div>
                <span class="text-green-600 font-semibold">{{ $doctor->consultation_fee }} DT</span>
              </div>
            </div>
          </div>

          @if($doctor->bio)
          <div class="mt-6">
            <h3 class="text-lg font-semibold mb-3">À propos</h3>
            <p class="text-gray-600">{{ $doctor->bio }}</p>
          </div>
          @endif

          <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <h3 class="text-lg font-semibold mb-3">Informations</h3>
              <div class="space-y-2">
                <div class="flex items-center">
                  <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  <span class="text-gray-600">{{ $doctor->clinic_address }}</span>
                </div>
                @if($doctor->clinic_phone)
                <div class="flex items-center">
                  <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                  </svg>
                  <span class="text-gray-600">{{ $doctor->clinic_phone }}</span>
                </div>
                @endif
                <div class="flex items-center">
                  <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span class="text-gray-600">{{ $doctor->consultation_duration }} minutes</span>
                </div>
              </div>
            </div>

            <div>
              <h3 class="text-lg font-semibold mb-3">Disponibilité</h3>
              <div class="space-y-2">
                @if($doctor->is_available)
                  <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Disponible
                  </span>
                @else
                  <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    Non disponible
                  </span>
                @endif
              </div>
            </div>
          </div>
        </div>

        <!-- Reviews Section -->
        @if($reviews->count() > 0)
        <div class="bg-white rounded-lg shadow-md p-6 mt-6">
          <h3 class="text-lg font-semibold mb-4">Avis des patients</h3>
          <div class="space-y-4">
            @foreach($reviews as $review)
            <div class="border-b border-gray-200 pb-4 last:border-b-0">
              <div class="flex items-center justify-between mb-2">
                <div class="flex items-center">
                  <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                    <span class="text-sm font-semibold text-red-600">{{ substr($review->patient->first_name, 0, 1) }}</span>
                  </div>
                  <span class="font-medium">{{ $review->patient->full_name }}</span>
                </div>
                <div class="flex items-center">
                  @for($i = 1; $i <= 5; $i++)
                    @if($i <= $review->rating)
                      <span class="text-yellow-400">★</span>
                    @else
                      <span class="text-gray-300">★</span>
                    @endif
                  @endfor
                </div>
              </div>
              @if($review->comment)
                <p class="text-gray-600">{{ $review->comment }}</p>
              @endif
              <p class="text-sm text-gray-500 mt-2">{{ $review->created_at->format('d/m/Y') }}</p>
            </div>
            @endforeach
          </div>
          {{ $reviews->links() }}
        </div>
        @endif
      </div>

      <!-- Booking Section -->
      <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
          <h3 class="text-lg font-semibold mb-4">Prendre rendez-vous</h3>
          
          @auth
            @if(Auth::user()->isDoctor())
              <div class="text-center">
                <p class="text-gray-600 mb-4">Les médecins ne peuvent pas prendre de rendez-vous</p>
                <div class="w-full bg-gray-300 text-gray-500 py-3 px-4 rounded-lg font-semibold cursor-not-allowed">
                  Non disponible
                </div>
              </div>
            @else
              @if($doctor->is_available)
                <a href="{{ route('appointments.create', $doctor->id) }}" 
                   class="w-full bg-red-500 text-white py-3 px-4 rounded-lg font-semibold hover:bg-red-600 transition text-center block">
                  Réserver maintenant
                </a>
              @else
                <button disabled class="w-full bg-gray-300 text-gray-500 py-3 px-4 rounded-lg font-semibold cursor-not-allowed">
                  Non disponible
                </button>
              @endif
            @endif
          @else
            <div class="text-center">
              <p class="text-gray-600 mb-4">Connectez-vous pour prendre rendez-vous</p>
              <a href="/login" class="bg-red-500 text-white py-2 px-4 rounded-lg font-semibold hover:bg-red-600 transition">
                Se connecter
              </a>
            </div>
          @endauth

          <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <h4 class="font-semibold mb-2">Informations importantes</h4>
            <ul class="text-sm text-gray-600 space-y-1">
              <li>• Rendez-vous de {{ $doctor->consultation_duration }} minutes</li>
              <li>• Consultation : {{ $doctor->consultation_fee }} DT</li>
              <li>• Annulation gratuite jusqu'à 24h avant</li>
              <li>• Paiement sécurisé en ligne</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-gradient-to-r from-red-500 to-pink-500 text-white py-12 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <p>&copy; 2025 RDV Médical. Tous droits réservés.</p>
    </div>
  </footer>
</body>
</html> 