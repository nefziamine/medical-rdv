<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bienvenue sur RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
            <div class="relative" x-data="{ open: false }">
              <button @click="open = !open" class="flex items-center space-x-2 bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
              <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mon profil</a>
                @if(Auth::user()->isDoctor())
                <a href="/profile/availability" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Disponibilité</a>
                @endif
                <a href="/appointments" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mes rendez-vous</a>
                <hr class="my-1">
                <form method="POST" action="{{ route('logout') }}" class="block">
                  @csrf
                  <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Déconnexion</button>
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

  <!-- Hero Section (identique pour tous) -->
    <section class="bg-white py-16 shadow-sm">
      <div class="flex justify-center">
        <div class="bg-white rounded-3xl shadow-2xl p-0 w-full max-w-7xl flex flex-col lg:flex-row items-center gap-0 min-h-[500px]">
          <div class="flex-1 w-full">
          <h1 class="text-4xl font-bold text-gray-900 mb-6 leading-snug">
                Trouvez un médecin près de chez vous avec <span class="text-red-500">RDV Médical</span>
          </h1>
          <p class="text-lg text-gray-600 mb-8">
                Réservez facilement votre consultation chez un professionnel de santé proche de chez vous.
          </p>
              <form method="GET" action="{{ route('doctors.index') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6 relative" autocomplete="off">
                <select name="specialty" class="border border-gray-300 px-4 py-3 rounded-lg w-full">
                  <option value="">Toutes les spécialités</option>
                  @foreach($specialties as $specialty)
                    <option value="{{ $specialty->slug }}">{{ $specialty->name }}</option>
                  @endforeach
                </select>
                <div class="relative">
                  <input type="text" id="doctor-search-welcome" name="search" placeholder="Nom du médecin" class="border border-gray-300 px-4 py-3 rounded-lg w-full" autocomplete="off">
                  <ul id="autocomplete-list-welcome" class="absolute left-0 right-0 bg-white border border-gray-200 rounded-lg shadow-lg z-50 hidden"></ul>
                </div>
            <button type="submit" class="sm:col-span-2 bg-red-500 text-white py-3 rounded-lg font-semibold hover:bg-red-600 transition">
              Chercher un médecin
            </button>
          </form>
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  const input = document.getElementById('doctor-search-welcome');
                  const list = document.getElementById('autocomplete-list-welcome');
                  let debounceTimeout;
                  input.addEventListener('input', function() {
                    clearTimeout(debounceTimeout);
                    const query = this.value.trim();
                    if (query.length < 1) {
                      list.innerHTML = '';
                      list.classList.add('hidden');
                      return;
                    }
                    debounceTimeout = setTimeout(() => {
                      fetch(`/autocomplete/doctors?q=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {
                          if (data.length === 0) {
                            list.innerHTML = '';
                            list.classList.add('hidden');
                            return;
                          }
                          list.innerHTML = data.map(d => `<li class='px-4 py-2 cursor-pointer hover:bg-gray-100' data-name='${d.name}'>${d.name} <span class='text-xs text-gray-400'>${d.specialty}</span></li>`).join('');
                          list.classList.remove('hidden');
                        });
                    }, 200);
                  });
                  list.addEventListener('mousedown', function(e) {
                    if (e.target && e.target.matches('li[data-name]')) {
                      input.value = e.target.getAttribute('data-name');
                      list.innerHTML = '';
                      list.classList.add('hidden');
                    }
                  });
                  document.addEventListener('click', function(e) {
                    if (!input.contains(e.target) && !list.contains(e.target)) {
                      list.innerHTML = '';
                      list.classList.add('hidden');
                    }
                  });
                });
              </script>
            <div class="flex items-center space-x-4 text-sm text-gray-600 mt-4">
            <div class="flex items-center">
              <svg class="w-4 h-4 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
              <span>Gratuit</span>
            </div>
            <div class="flex items-center">
              <svg class="w-4 h-4 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
              <span>Sécurisé</span>
            </div>
            <div class="flex items-center">
              <svg class="w-4 h-4 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
              <span>24/7</span>
            </div>
          </div>
        </div>
          <div class="flex-1 flex justify-center items-center w-full h-full">
            <img src="https://www.rdvmedical.be/assets/front/images/home/home-page-image.webp" alt="Doctor" class="max-w-lg w-full h-[420px] rounded-3xl object-contain">
          </div>
        </div>
      </div>
    </section>

  <!-- Section Spécialités dynamique -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold mb-10 text-center">Nos Spécialités</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($specialties as $specialty)
          <div class="bg-gray-100 p-6 rounded-lg shadow hover:shadow-lg transition text-center flex flex-col items-center">
            <div class="text-4xl mb-4">🩺</div>
            <h3 class="text-xl font-semibold mb-2">{{ $specialty->name }}</h3>
            <p class="text-gray-600 mb-4">{{ $specialty->description ?? '' }}</p>
            <div class="w-full flex justify-center">
              <a href="{{ route('specialties.show', $specialty->slug) }}" class="bg-red-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-600 transition text-center w-full">Voir la spécialité</a>
            </div>
          </div>
        @endforeach
      </div>
      <div class="text-center mt-8">
        <a href="/specialties" class="text-red-500 font-semibold hover:underline">Voir toutes les spécialités</a>
      </div>
    </div>
  </section>

  <!-- SECTION 1 : Praticien de santé -->
  <section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
      <!-- Images -->
      <div class="grid grid-cols-2 gap-6">
        <img src="https://images.pexels.com/photos/8460157/pexels-photo-8460157.jpeg?auto=compress&w=400&q=80" class="rounded-2xl shadow-lg object-cover w-full h-40" alt="Visio médecin">
        <img src="https://images.pexels.com/photos/5452201/pexels-photo-5452201.jpeg?auto=compress&w=400&q=80" class="rounded-2xl shadow-lg object-cover w-full h-40" alt="Médecins">
        <div class="flex items-center justify-center bg-red-100 rounded-2xl h-40 text-3xl font-bold text-red-500 flex-col shadow-lg">
          <span>24/7</span>
          <span class="text-base font-normal text-gray-700 font-semibold">Support</span>
        </div>
        <img src="https://images.pexels.com/photos/5327580/pexels-photo-5327580.jpeg?auto=compress&w=400&q=80" class="rounded-2xl shadow-lg object-cover w-full h-40" alt="Consultation patient">
      </div>
      <!-- Texte -->
      <div>
        <h3 class="text-lg text-red-400 font-bold mb-2 uppercase tracking-wider">Êtes-vous un praticien de santé?</h3>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Ce que nous faisons réellement</h2>
        <p class="text-gray-700 mb-6">Chez rdvmedical.tn, nous sommes conscients des défis uniques et des exigences élevées de la gestion quotidienne de votre cabinet, de votre clinique et de votre hôpital. Notre engagement est de vous fournir des solutions innovantes et personnalisées pour simplifier cette gestion, vous laissant ainsi vous consacrer pleinement à votre expertise : prendre soin de vos patients. Et tout cela, <span class="font-semibold">à partir de 0€ par mois</span>.</p>
        <a href="{{ route('register.doctor') }}" class="inline-block bg-red-500 text-white px-8 py-3 rounded-lg font-semibold shadow hover:bg-red-600 transition">Je suis un professionnel de santé (Inscription gratuite!)</a>
      </div>
    </div>
  </section>

  <!-- SECTION 2 : Patient -->
  <section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
      <!-- Images -->
      <div class="grid grid-cols-2 gap-6 order-2 lg:order-1">
        <img src="https://images.pexels.com/photos/3845761/pexels-photo-3845761.jpeg?auto=compress&w=400&q=80" class="rounded-2xl shadow-lg object-cover w-full h-40" alt="Consultation patient">
        <img src="https://images.pexels.com/photos/1170979/pexels-photo-1170979.jpeg?auto=compress&w=400&q=80" class="rounded-2xl shadow-lg object-cover w-full h-40" alt="Médecins">
        <div class="flex items-center justify-center bg-red-100 rounded-2xl h-40 text-3xl font-bold text-red-500 flex-col shadow-lg">
          <span>24/7</span>
          <span class="text-base font-normal text-gray-700 font-semibold">Support</span>
        </div>
        <img src="https://images.pexels.com/photos/3845125/pexels-photo-3845125.jpeg?auto=compress&w=400&q=80" class="rounded-2xl shadow-lg object-cover w-full h-40" alt="Pédiatre">
      </div>
      <!-- Texte -->
      <div class="order-1 lg:order-2">
        <h3 class="text-lg text-red-400 font-bold mb-2 uppercase tracking-wider">Je suis un patient</h3>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Prenez soin de vous, simplement</h2>
        <p class="text-gray-700 mb-6">Avec rdvmedical.tn, accédez à un service rapide et pratique pour gérer vos rendez-vous médicaux. Trouvez facilement un professionnel de santé près de chez vous, réservez en quelques clics 24/7, et recevez des rappels pour ne rien oublier. Vos données sont précieuses : <span class="font-semibold">nous les protégeons avec soin et transparence</span>, conformément au RGPD, pour que vous restiez maître de votre santé.</p>
        <div class="flex gap-4">
          <a href="/login" class="inline-block bg-white border border-red-500 text-red-500 px-8 py-3 rounded-lg font-semibold shadow hover:bg-red-50 transition">Connexion</a>
          <a href="/register-patient" class="inline-block bg-red-500 text-white px-8 py-3 rounded-lg font-semibold shadow hover:bg-red-600 transition">S'inscrire</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Avantages -->
  <section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h2 class="text-3xl font-bold mb-12">Pourquoi choisir <span class="text-red-500">rdv_medical.tn</span> ?</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
          <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">Réservation rapide</h3>
          <p class="text-gray-600">Prenez rendez-vous en quelques clics, 24h/24 et 7j/7</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
          <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">Médecins vérifiés</h3>
          <p class="text-gray-600">Tous nos médecins sont certifiés et validés</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
          <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">Confirmation instantanée</h3>
          <p class="text-gray-600">Recevez immédiatement la confirmation de votre RDV</p>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Footer -->
  <footer class="bg-gradient-to-r from-red-500 to-pink-500 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
      <div>
        <h5 class="font-bold mb-4">RDV Médical.tn</h5>
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
