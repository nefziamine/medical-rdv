<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Médecins - RDV Médical</title>
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
          <a href="/doctors" class="text-red-500 font-semibold">Médecins</a>
          <a href="/specialties" class="text-gray-600 hover:text-red-500 transition">Spécialités</a>
          <a href="/contact" class="text-gray-600 hover:text-red-500 transition">Contact</a>
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
      <h1 class="text-3xl font-bold text-center mb-8">Trouvez votre médecin</h1>
      
      <!-- Search Form -->
      <div class="max-w-4xl mx-auto">
        <form method="GET" action="{{ route('doctors.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 relative" autocomplete="off">
          <select name="specialty" class="border border-gray-300 px-4 py-3 rounded-lg">
            <option value="">Toutes les spécialités</option>
            @foreach($specialties as $specialty)
              <option value="{{ $specialty->slug }}" {{ request('specialty') == $specialty->slug ? 'selected' : '' }}>
                {{ $specialty->name }}
              </option>
            @endforeach
          </select>
          <div class="relative">
            <input type="text" id="doctor-search" name="search" value="{{ request('search') }}" placeholder="Nom du médecin" class="border border-gray-300 px-4 py-3 rounded-lg w-full" autocomplete="off">
            <ul id="autocomplete-list" class="absolute left-0 right-0 bg-white border border-gray-200 rounded-lg shadow-lg z-50 hidden"></ul>
          </div>
          <button type="submit" class="bg-red-500 text-white py-3 rounded-lg font-semibold hover:bg-red-600 transition">
            Rechercher
          </button>
        </form>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('doctor-search');
            const list = document.getElementById('autocomplete-list');
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
      </div>
    </div>
  </section>

  <!-- Doctors List -->
  <section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      @if(isset($doctors) && $doctors->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
          @foreach($doctors as $doctor)
            <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center">
              <img src="{{ $doctor->photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(($doctor->user->first_name ?? 'D') . ' ' . ($doctor->user->last_name ?? '')) }}" class="w-24 h-24 rounded-full object-cover mb-4 border-4 border-gray-100 shadow" alt="Photo de {{ $doctor->user->first_name ?? 'Docteur' }}">
              <h3 class="text-lg font-bold text-red-500 mb-1 text-center">{{ $doctor->user->first_name ?? '' }} {{ $doctor->user->last_name ?? '' }}</h3>
              <div class="flex items-center justify-center mb-2">
                @php $rating = $doctor->rating ?? 0; @endphp
                <div class="flex text-yellow-400">
                  @for($i = 1; $i <= 5; $i++)
                    @if($i <= $rating)
                      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    @else
                      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    @endif
                  @endfor
                </div>
                <span class="text-xs text-gray-500 ml-2">({{ $doctor->total_reviews ?? 0 }})</span>
              </div>
              <div class="text-sm text-gray-500 mb-2 text-center">{{ $doctor->clinic_address ?? '' }}</div>
              <div class="flex flex-wrap justify-center gap-2 mb-4">
                @if($doctor->specialty)
                  <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">{{ $doctor->specialty->name }}</span>
                @endif
                @if($doctor->additional_specialties)
                  @foreach(explode(',', $doctor->additional_specialties) as $spec)
                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">{{ trim($spec) }}</span>
                  @endforeach
                @endif
              </div>
              <form class="w-full flex flex-col gap-2 mt-auto">
                <input type="text" name="message" placeholder="Laisser un message" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200" id="message-{{ $doctor->id }}">
                <a href="#" onclick="event.preventDefault(); var msg = document.getElementById('message-{{ $doctor->id }}').value; window.location.href='{{ route('appointments.create', $doctor->id) }}' + '?message=' + encodeURIComponent(msg);" class="bg-red-500 text-white rounded-lg px-4 py-2 font-semibold hover:bg-red-600 transition text-center">Prendre rendez-vous</a>
              </form>
            </div>
          @endforeach
        </div>
        
        <div class="mt-8">
          {{ $doctors->links() }}
        </div>
      @else
        <div class="text-center py-12">
          <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
          </svg>
          <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun médecin trouvé</h3>
          <p class="text-gray-600">Aucun médecin ne correspond à vos critères de recherche.</p>
        </div>
      @endif
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