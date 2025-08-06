<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inscription du médecin - RDV Médical</title>
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
          <a href="/contact" class="text-gray-600 hover:text-red-500 transition">Contact</a>
        </div>
        <div class="flex items-center space-x-4">
          <span class="text-sm text-gray-600">Je suis un professionnel de santé (Inscription gratuite!)</span>
          <a href="/login" class="text-gray-600 hover:text-red-500 transition">Connexion</a>
          <a href="/register" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">S'inscrire</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Breadcrumb -->
  <div class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
      <nav class="text-sm">
        <ol class="list-none p-0 inline-flex">
          <li class="flex items-center">
            <a href="/" class="text-gray-500 hover:text-red-500">Accueil</a>
            <svg class="w-3 h-3 mx-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
          </li>
          <li class="text-gray-900">Inscription du médecin</li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- Main Content -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      
      <!-- Contact Information Panel -->
      <div class="lg:col-span-1">
        <div class="bg-gradient-to-br from-red-500 to-pink-500 text-white rounded-lg p-6 h-fit">
          <h3 class="text-xl font-bold mb-6">Contactez-nous</h3>
          <div class="space-y-4">
            <div class="flex items-start">
              <svg class="w-5 h-5 mt-1 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
              <div>
                <p class="font-semibold">Adresse</p>
                <p class="text-sm">Rue du congrès 37, 1000 Bruxelles</p>
              </div>
            </div>
            <div class="flex items-start">
              <svg class="w-5 h-5 mt-1 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
              </svg>
              <div>
                <p class="font-semibold">Téléphone</p>
                <p class="text-sm">Belgique: +32 28080227</p>
                <p class="text-sm">France: +33 183642895</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Registration Form -->
      <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-md p-8">
          <h1 class="text-3xl font-bold text-gray-900 mb-8">Inscription du médecin</h1>
          
          <form method="POST" action="{{ route('register.doctor') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- Personal Information -->
            <div class="border-b border-gray-200 pb-6">
              <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations personnelles</h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Nom *</label>
                  <input type="text" id="last_name" name="last_name" required
                         class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  @error('last_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>
                <div>
                  <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">Prénom *</label>
                  <input type="text" id="first_name" name="first_name" required
                         class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  @error('first_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>
                <div>
                  <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone *</label>
                  <div class="flex">
                    <select name="phone_country_code" class="border border-gray-300 border-r-0 px-3 py-3 rounded-l-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                      <option value="+216">+216</option>
                      <option value="+32">+32</option>
                      <option value="+33">+33</option>
                      <option value="+1">+1</option>
                    </select>
                    <input type="tel" id="phone" name="phone" required
                           class="flex-1 border border-gray-300 px-4 py-3 rounded-r-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  </div>
                  @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>
                <div>
                  <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Courriel *</label>
                  <input type="email" id="email" name="email" required
                         class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>
                <div>
                  <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Pays *</label>
                  <select id="country" name="country" required
                          class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    <option value="">Sélectionner un pays</option>
                    <option value="Tunisie">Tunisie</option>
                    <option value="Belgique">Belgique</option>
                    <option value="France">France</option>
                    <option value="Canada">Canada</option>
                    <option value="Suisse">Suisse</option>
                  </select>
                  @error('country')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>
                <div>
                  <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Ville *</label>
                  <input type="text" id="city" name="city" required
                         class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  @error('city')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>
                <div>
                  <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-2">Code postal</label>
                  <input type="text" id="postal_code" name="postal_code"
                         class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  @error('postal_code')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="mt-4">
                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Adresse complète</label>
                <textarea id="address" name="address" rows="3"
                          class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"></textarea>
                @error('address')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>
            </div>

            <!-- Academic Information -->
            <div class="border-b border-gray-200 pb-6">
              <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations académiques</h3>
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                  <label for="diploma_number" class="block text-sm font-medium text-gray-700 mb-2">Nº de diplôme universitaire</label>
                  <input type="text" id="diploma_number" name="diploma_number"
                         class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  @error('diploma_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>
                <div>
                  <label for="university" class="block text-sm font-medium text-gray-700 mb-2">Université</label>
                  <input type="text" id="university" name="university"
                         class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  @error('university')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>
                <div>
                  <label for="graduation_year" class="block text-sm font-medium text-gray-700 mb-2">Année d'obtention</label>
                  <input type="number" id="graduation_year" name="graduation_year" min="1950" max="2030"
                         class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  @error('graduation_year')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Informations professionnelles -->
            <div class="border-b border-gray-200 pb-6">
              <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations professionnelles</h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label for="specialty_id" class="block text-sm font-medium text-gray-700 mb-2">Spécialité *</label>
                  <select id="specialty_id" name="specialty_id" required class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" onchange="toggleNewSpecialty(this)">
                    <option value="">Sélectionner une spécialité</option>
                    <option value="other">+ Ajouter une nouvelle spécialité</option>
                    @foreach($specialties as $specialty)
                      <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                    @endforeach
                  </select>
                  @error('specialty_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>
                <div id="new-specialty-field" style="display:none;">
                  <label for="new_specialty" class="block text-sm font-medium text-gray-700 mb-2">Nouvelle spécialité</label>
                  <input type="text" id="new_specialty" name="new_specialty" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                </div>
                <div>
                  <label for="experience_years" class="block text-sm font-medium text-gray-700 mb-2">Années d'expérience</label>
                  <input type="number" id="experience_years" name="experience_years" min="0" max="50" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  @error('experience_years')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>
                <div>
                  <label for="consultation_fee" class="block text-sm font-medium text-gray-700 mb-2">Tarif de consultation (DT)</label>
                  <input type="number" id="consultation_fee" name="consultation_fee" step="0.01" min="0" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  @error('consultation_fee')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>
                <div>
                  <label for="clinic_address" class="block text-sm font-medium text-gray-700 mb-2">Adresse de la clinique</label>
                  <input type="text" id="clinic_address" name="clinic_address" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  @error('clinic_address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>
                <div>
                  <label for="clinic_phone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone de la clinique</label>
                  <input type="tel" id="clinic_phone" name="clinic_phone" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  @error('clinic_phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>
                <div>
                  <label for="is_available" class="block text-sm font-medium text-gray-700 mb-2">Disponibilité</label>
                  <select id="is_available" name="is_available" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    <option value="1">Disponible</option>
                    <option value="0">Non disponible</option>
                  </select>
                  @error('is_available')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Password -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe *</label>
                <div class="relative">
                  <input type="password" id="password" name="password" required
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
              <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmer le mot de passe *</label>
                <div class="relative">
                  <input type="password" id="password_confirmation" name="password_confirmation" required
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
            </div>

            <!-- Terms and Conditions -->
            <div class="flex items-start">
              <input type="checkbox" id="terms" name="terms" required
                     class="mt-1 h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300 rounded">
              <label for="terms" class="ml-2 text-sm text-gray-700">
                J'accepte les conditions de la 
                <a href="/privacy-policy" class="text-red-500 hover:text-red-600 underline">Politique de confidentialité</a>.
              </label>
              @error('terms')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- GDPR Information -->
            <div class="bg-gray-50 p-4 rounded-lg">
              <p class="text-sm text-gray-600">
                Conformément au Règlement Général sur la Protection des Données (RGPD), nous nous engageons à protéger vos données personnelles. 
                Vos informations ne seront utilisées que dans le cadre de votre inscription et pour vous contacter concernant nos services.
              </p>
            </div>

            <!-- reCAPTCHA -->
            <div class="flex items-center">
              <input type="checkbox" id="recaptcha" name="recaptcha" required
                     class="h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300 rounded">
              <label for="recaptcha" class="ml-2 text-sm text-gray-700">
                Je ne suis pas un robot
              </label>
              <img src="https://www.gstatic.com/recaptcha/api2/logo_48.png" alt="reCAPTCHA" class="ml-2 h-6">
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
                    class="w-full bg-red-500 text-white py-4 px-6 rounded-lg font-semibold text-lg hover:bg-red-600 transition">
              Envoyer un message
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Contact Information Cards -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center mb-4">
          <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
          </svg>
          <h3 class="text-lg font-semibold">Numéro de contact</h3>
        </div>
        <p class="text-gray-600">Belgique: +32 28080227</p>
        <p class="text-gray-600">France: +33 183642895</p>
      </div>
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center mb-4">
          <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
          <h3 class="text-lg font-semibold">Adresse Mediasatcom</h3>
        </div>
        <p class="text-gray-600">Rue du congrès 37, 1000 Bruxelles</p>
      </div>
    </div>
  </div>

  <!-- App Download Section -->
  <section class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h2 class="text-2xl font-bold text-gray-900 mb-6">
        Trouvez un praticien près de chez vous, disponible sur iOS et Android.
      </h2>
      <div class="flex justify-center space-x-4">
        <a href="#" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition">
          <div class="flex items-center">
            <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="currentColor">
              <path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.61 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.5,12.92 20.16,13.19L17.89,14.5L15.39,12L17.89,9.5L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z"/>
            </svg>
            Google Play
          </div>
        </a>
        <a href="#" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition">
          <div class="flex items-center">
            <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="currentColor">
              <path d="M18.71,19.5C17.88,20.74 17,21.95 15.66,21.97C14.32,22 13.89,21.18 12.37,21.18C10.84,21.18 10.37,21.95 9.1,22C7.79,22.05 6.8,20.68 5.96,19.47C4.25,17 2.94,12.45 4.7,9.39C5.57,7.87 7.13,6.91 8.82,6.88C10.1,6.86 11.32,7.75 12.11,7.75C12.89,7.75 14.37,6.68 15.92,6.84C16.57,6.87 18.39,7.1 19.56,8.82C19.47,8.88 17.39,10.1 17.41,12.63C17.44,15.65 20.06,16.66 20.09,16.67C20.06,16.74 19.67,18.11 18.71,19.5M13,3.5C13.73,2.67 14.94,2.04 15.94,2C16.07,3.17 15.6,4.35 14.9,5.19C14.21,6.04 13.07,6.7 11.95,6.61C11.8,5.46 12.36,4.26 13,3.5Z"/>
            </svg>
            App Store
          </div>
        </a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gradient-to-r from-red-500 to-pink-500 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Payment Methods -->
      <div class="flex justify-center mb-8">
        <div class="flex space-x-4">
          <img src="https://via.placeholder.com/60x40/1a1a1a/ffffff?text=VISA" alt="Visa" class="h-10">
          <img src="https://via.placeholder.com/60x40/1a1a1a/ffffff?text=MC" alt="Mastercard" class="h-10">
          <img src="https://via.placeholder.com/60x40/1a1a1a/ffffff?text=BC" alt="Bancontact" class="h-10">
        </div>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- RDV MÉDICAL Section -->
        <div>
          <h5 class="font-bold mb-4">RDV MÉDICAL</h5>
          <p class="text-sm mb-4">Votre solution numérique pour les rendez-vous médicaux en Tunisie et ailleurs.</p>
          <div class="flex space-x-4 mb-4">
            <a href="#" class="hover:text-red-200 transition">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
              </svg>
            </a>
            <a href="#" class="hover:text-red-200 transition">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
              </svg>
            </a>
            <a href="#" class="hover:text-red-200 transition">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
              </svg>
            </a>
          </div>
          <div class="flex">
            <input type="email" placeholder="S'inscrire" class="flex-1 px-3 py-2 rounded-l-lg text-gray-900">
            <button class="bg-red-600 px-4 py-2 rounded-r-lg hover:bg-red-700 transition">Envoyer</button>
          </div>
        </div>
        
        <!-- Quick Links -->
        <div>
          <h5 class="font-bold mb-4">Liens rapides</h5>
          <ul class="text-sm space-y-2">
            <li><a href="#" class="hover:text-red-200 transition">À propos</a></li>
            <li><a href="#" class="hover:text-red-200 transition">Je suis un professionnel de santé (Inscription gratuite!)</a></li>
            <li><a href="#" class="hover:text-red-200 transition">Support</a></li>
            <li><a href="#" class="hover:text-red-200 transition">FAQ</a></li>
            <li><a href="#" class="hover:text-red-200 transition">Politique de confidentialité</a></li>
          </ul>
        </div>
        
        <!-- Contact Us -->
        <div>
          <h5 class="font-bold mb-4">Contactez-nous</h5>
          <ul class="text-sm space-y-2">
            <li>Rue du congrès 37, 1000 Bruxelles</li>
            <li>Belgique: +32 28080227</li>
            <li>France: +33 183642895</li>
          </ul>
        </div>
        
        <!-- Services -->
        <div>
          <h5 class="font-bold mb-4">Nos services</h5>
          <ul class="text-sm space-y-2">
            <li><a href="#" class="hover:text-red-200 transition">Télé-secrétariat</a></li>
            <li><a href="#" class="hover:text-red-200 transition">Site web professionnel</a></li>
            <li><a href="#" class="hover:text-red-200 transition">Photo/Vidéo shooting</a></li>
            <li><a href="#" class="hover:text-red-200 transition">Affichage dynamique</a></li>
            <li><a href="#" class="hover:text-red-200 transition">Rappels WhatsApp</a></li>
          </ul>
        </div>
      </div>
      
      <div class="text-center mt-8 text-sm">
        Tous les droits sont réservés © 2025 RDV MÉDICAL By MediaSatCom
      </div>
    </div>
  </footer>

  <script>
    function togglePassword(fieldId) {
      const field = document.getElementById(fieldId);
      const type = field.type === 'password' ? 'text' : 'password';
      field.type = type;
    }

    function toggleNewSpecialty(select) {
      document.getElementById('new-specialty-field').style.display = (select.value === 'other') ? 'block' : 'none';
    }
  </script>
</body>
</html> 