<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Enregistrement des patients - RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Tajawal', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  <!-- Main Content -->
  <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      
      <!-- Logo -->
      <div class="text-center">
        <div class="flex justify-center mb-6">
          <div class="relative w-20 h-20">
            <!-- Black figure -->
            <div class="absolute left-0 w-10 h-16 bg-black rounded-full transform rotate-12"></div>
            <!-- Red figure -->
            <div class="absolute right-0 w-10 h-16 bg-red-500 rounded-full transform -rotate-12"></div>
            <!-- Heart shape -->
            <div class="absolute inset-0 flex items-center justify-center">
              <div class="w-8 h-8 bg-red-500 transform rotate-45 rounded-sm"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Registration Form Card -->
      <div class="bg-white rounded-lg shadow-lg p-8">
        
        <!-- Header -->
        <div class="flex items-center mb-6">
          <button onclick="history.back()" class="flex items-center text-gray-600 hover:text-gray-800 transition mr-4">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Retour
          </button>
          <h1 class="text-2xl font-bold text-gray-900">Enregistrement des patients</h1>
        </div>

        <!-- Registration Form -->
        <form method="POST" action="{{ route('register.patient') }}" enctype="multipart/form-data" class="space-y-6">
          @csrf
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <!-- Left Column -->
            <div class="space-y-4">
              
              <!-- Prénom -->
              <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">Prénom *</label>
                <input type="text" id="first_name" name="first_name" required
                       placeholder="Prénom"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                @error('first_name')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Contact -->
              <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Contact *</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-sm text-gray-500">🇹🇳 +216</span>
                  </div>
                  <input type="tel" id="phone" name="phone" required
                         placeholder="Contact"
                         class="w-full border border-gray-300 pl-20 pr-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                </div>
                @error('phone')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Mot de passe -->
              <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe *</label>
                <div class="relative">
                  <input type="password" id="password" name="password" required
                         placeholder="Mot de passe"
                         class="w-full border border-gray-300 px-4 py-3 pr-10 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                  </button>
                </div>
                @error('password')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Genre -->
              <div>
                <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Genre *</label>
                <select id="gender" name="gender" required
                        class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  <option value="homme">Homme</option>
                  <option value="femme">Femme</option>
                  <option value="autre">Autre</option>
                </select>
                @error('gender')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

            </div>

            <!-- Right Column -->
            <div class="space-y-4">
              
              <!-- Nom -->
              <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
                <input type="text" id="last_name" name="last_name" required
                       placeholder="Nom"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                @error('last_name')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Courriel -->
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Courriel *</label>
                <input type="email" id="email" name="email" required
                       placeholder="Courriel"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                @error('email')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Confirmer le mot de passe -->
              <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe *</label>
                <div class="relative">
                  <input type="password" id="password_confirmation" name="password_confirmation" required
                         placeholder="Confirmer le mot de passe"
                         class="w-full border border-gray-300 px-4 py-3 pr-10 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                  </button>
                </div>
                @error('password_confirmation')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Naissance -->
              <div>
                <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">Naissance *</label>
                <div class="relative">
                  <input type="date" id="birth_date" name="birth_date" required
                         class="w-full border border-gray-300 px-4 py-3 pr-10 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                  </div>
                </div>
                @error('birth_date')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

            </div>

          </div>

          <!-- Terms and Privacy -->
          <div class="space-y-4">
            
            <!-- Privacy Policy Checkbox -->
            <div class="flex items-start">
              <input type="checkbox" id="terms" name="terms" required
                     class="mt-1 h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300 rounded">
              <label for="terms" class="ml-2 text-sm text-gray-700">
                J'accepte les conditions de la 
                <a href="/privacy-policy" class="text-blue-600 hover:text-blue-800 underline">Politique de confidentialité</a>.
              </label>
              @error('terms')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- GDPR Information -->
            <div class="bg-gray-50 p-4 rounded-lg">
              <h4 class="font-semibold text-gray-900 mb-2">Règlement général sur la protection des données</h4>
              <p class="text-sm text-gray-600">
                rdvmedical.be considère les données personnelles comme la propriété de l'utilisateur. 
                Nous nous engageons à protéger les informations conformément au RGPD, à assurer la transparence 
                concernant la collecte, la gestion et l'utilisation des données, et à souligner la responsabilité 
                de l'utilisateur pour ses données tout au long du processus.
              </p>
            </div>

          </div>

          <!-- Submit Button -->
          <div class="mb-4">
            <label for="profile_photo" class="block text-sm font-medium text-gray-700">Photo de profil</label>
            <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-lg" />
            @error('profile_photo')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          <button type="submit" 
                  class="w-full bg-blue-600 text-white py-4 px-6 rounded-lg font-semibold text-lg hover:bg-blue-700 transition">
            S'inscrire
          </button>

        </form>

        <!-- Login Links -->
        <div class="mt-6 space-y-2 text-center">
          <p class="text-sm text-gray-600">
            Avez-vous déjà un compte ? 
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
              Connectez-vous ici
            </a>
          </p>
          <p class="text-sm text-gray-600">
            Nouveau Médecin ici ? 
            <a href="{{ route('register.doctor') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
              Créer un compte
            </a>
          </p>
        </div>

      </div>

    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-white border-t mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="text-center text-sm text-gray-500">
        Tous les droits sont réservés © 2025 
        <a href="/" class="text-blue-600 hover:text-blue-800 font-semibold">RDV MÉDICAL</a>
      </div>
    </div>
  </footer>

  <script>
    function togglePassword(fieldId) {
      const field = document.getElementById(fieldId);
      const type = field.type === 'password' ? 'text' : 'password';
      field.type = type;
    }
  </script>
</body>
</html> 