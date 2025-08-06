<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profil Patient - RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Tajawal', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  
  <!-- Profile Section -->
  <section class="py-12 flex flex-col md:flex-row">
    <!-- Sidebar Menu -->
    <aside class="w-full md:w-1/4 mb-8 md:mb-0 md:mr-8">
      <nav class="bg-white rounded-lg shadow-md p-6 flex md:flex-col gap-4 justify-between">
        <a href="{{ route('profile.patient') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
        <a href="{{ route('profile.password') }}" class="block px-4 py-2 rounded-lg hover:bg-blue-50 {{ request()->routeIs('profile.password') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-700' }}">Changer le mot de passe</a>
        <a href="{{ route('appointments.index') }}" class="block px-4 py-2 rounded-lg hover:bg-blue-50 {{ request()->routeIs('appointments.index') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-700' }}">Mes Rendez-vous</a>
        <a href="{{ route('profile.history') }}" class="block px-4 py-2 rounded-lg hover:bg-blue-50 {{ request()->routeIs('profile.history') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-700' }}">Historique</a>
      </nav>
    </aside>
    <!-- Fin Sidebar Menu -->
    <div class="flex-1">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <div>
              <h1 id="infos" class="text-3xl font-bold text-gray-900">Informations personnelles</h1>
              <p class="text-gray-600 mt-2">Gérez vos informations personnelles</p>
            </div>
            <a href="{{ route('profile') }}" class="inline-flex items-center mb-6 text-red-500 hover:text-red-700 font-semibold">
                <svg class="w-5 h-5 mr-2 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a1 1 0 01-1-1V5.414l5.293 5.293a1 1 0 01-1.414 1.414l-7-7a1 1 0 010-1.414l7-7a1 1 0 011.414 1.414L9 4.586V17a1 1 0 01-1 1z" clip-rule="evenodd"/></svg>
                Retour au profil
            </a>
          </div>
        </div>

        <!-- Messages de succès/erreur -->
        @if(session('success'))
          <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
          </div>
        @endif

        @if(session('error'))
          <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            {{ session('error') }}
          </div>
        @endif

        @if($errors->any())
          <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <!-- Profile Photo Section -->
        <div class="flex flex-col items-center mb-8">
          <div class="relative w-32 h-32 mb-4">
            <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->first_name . ' ' . Auth::user()->last_name) . '&background=0D8ABC&color=fff&size=128' }}" alt="Photo de profil" class="w-32 h-32 rounded-full object-cover border-4 border-blue-200 shadow">
          </div>
          <label class="block mb-2 text-sm font-medium text-gray-700" for="profile_photo">Changer la photo de profil</label>
          <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="mb-4 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
          @error('profile_photo')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <!-- Fin Profile Photo Section -->

        <!-- Profile Form -->
        <div class="bg-white rounded-lg shadow-md p-8">
          <form method="POST" action="{{ route('profile.patient.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              
              <!-- Prénom -->
              <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">Prénom *</label>
                <input type="text" id="first_name" name="first_name" required
                       value="{{ old('first_name', Auth::user()->first_name) }}"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('first_name')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Nom -->
              <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Nom *</label>
                <input type="text" id="last_name" name="last_name" required
                       value="{{ old('last_name', Auth::user()->last_name) }}"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('last_name')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Email -->
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                <input type="email" id="email" name="email" required
                       value="{{ old('email', Auth::user()->email) }}"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('email')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Téléphone -->
              <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                <input type="tel" id="phone" name="phone"
                       value="{{ old('phone', Auth::user()->phone) }}"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('phone')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Date de naissance -->
              <div>
                <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Date de naissance</label>
                <input type="date" id="birth_date" name="birth_date"
                       value="{{ old('birth_date', Auth::user()->birth_date ? Auth::user()->birth_date->format('Y-m-d') : '') }}"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('birth_date')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Genre -->
              <div>
                <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Genre</label>
                <select id="gender" name="gender"
                        class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                  <option value="">Sélectionner un genre</option>
                  <option value="homme" {{ old('gender', Auth::user()->gender) === 'homme' ? 'selected' : '' }}>Homme</option>
                  <option value="femme" {{ old('gender', Auth::user()->gender) === 'femme' ? 'selected' : '' }}>Femme</option>
                  <option value="autre" {{ old('gender', Auth::user()->gender) === 'autre' ? 'selected' : '' }}>Autre</option>
                </select>
                @error('gender')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

            </div>

            <!-- Adresse -->
            <div>
              <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
              <textarea id="address" name="address" rows="3"
                        class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('address', Auth::user()->address) }}</textarea>
              @error('address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
              <button type="submit" 
                      class="bg-blue-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-600 transition">
                Mettre à jour
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-white border-t mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="text-center text-sm text-gray-500">
        Tous les droits sont réservés © 2025 
        <a href="/" class="text-blue-500 hover:text-blue-600 font-semibold">RDV MÉDICAL</a>
      </div>
    </div>
  </footer>
</body>
</html> 