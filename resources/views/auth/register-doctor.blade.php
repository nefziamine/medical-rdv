<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inscription Médecin - RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body { font-family: 'Inter', sans-serif; }
    .hero-gradient { background: linear-gradient(135deg, #ffffff 0%, #10b981 50%, #34d399 100%); }
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
          <a href="/contact" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 relative group">
            Contact
            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
          </a>
          <a href="/health-tips" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 relative group">
            <i class="fas fa-heartbeat mr-1"></i>Conseils santé
            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
          </a>
        </div>
        <div class="flex items-center space-x-4">
          <a href="/login" class="text-gray-600 hover:text-green-600 transition-colors duration-200 hidden sm:block">Connexion</a>
          <a href="/register" class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-2.5 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105 font-medium">
            <i class="fas fa-user-plus mr-2"></i>Inscription
          </a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero-gradient py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-emerald-300/20 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">
          Rejoignez notre <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">réseau médical</span>
        </h1>
        <p class="text-xl text-white/90 max-w-2xl mx-auto">
          Inscrivez-vous gratuitement et commencez à recevoir des patients dès aujourd'hui
        </p>
      </div>
    </div>
  </section>

  <!-- Registration Form -->
  <section class="py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="bg-white rounded-3xl shadow-2xl p-8">
        <div class="text-center mb-8">
          <h2 class="text-3xl font-bold text-gray-900 mb-2">Inscription Médecin</h2>
          <p class="text-gray-600">Remplissez vos informations professionnelles</p>
        </div>

        <form method="POST" action="{{ route('register.doctor') }}" enctype="multipart/form-data" class="space-y-8">
          @csrf

          <!-- Personal Information -->
          <div class="bg-gray-50 rounded-2xl p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
              <i class="fas fa-user mr-3 text-blue-600"></i>Informations personnelles
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                  <i class="fas fa-user-tag mr-2 text-orange-500"></i>Nom *
                </label>
                <input type="text" name="last_name" required
                       class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-orange-400 focus:border-transparent transition-all duration-300"
                       value="{{ old('last_name') }}">
                @error('last_name')
                  <p class="text-red-300 text-sm mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                  </p>
                @enderror
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                  <i class="fas fa-user mr-2 text-blue-500"></i>Prénom *
                </label>
                <input type="text" name="first_name" required
                       class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300"
                       value="{{ old('first_name') }}">
                @error('first_name')
                  <p class="text-red-300 text-sm mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                  </p>
                @enderror
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                  <i class="fas fa-phone mr-2 text-green-500"></i>Téléphone *
                </label>
                <div class="flex">
                  <select name="phone_country_code" class="bg-white border border-gray-200 border-r-0 px-3 py-4 rounded-l-xl focus:ring-2 focus:ring-green-400 focus:border-transparent">
                    <option value="+216">🇹🇳 +216</option>
                    <option value="+32">🇧🇪 +32</option>
                    <option value="+33">🇫🇷 +33</option>
                    <option value="+1">🇺🇸 +1</option>
                  </select>
                  <input type="tel" name="phone" required
                         class="flex-1 bg-white border border-gray-200 px-4 py-4 rounded-r-xl focus:ring-2 focus:ring-green-400 focus:border-transparent transition-all duration-300"
                         value="{{ old('phone') }}">
                </div>
                @error('phone')
                  <p class="text-red-300 text-sm mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                  </p>
                @enderror
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                  <i class="fas fa-envelope mr-2 text-purple-500"></i>Email *
                </label>
                <input type="email" name="email" required
                       class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-purple-400 focus:border-transparent transition-all duration-300"
                       value="{{ old('email') }}">
                @error('email')
                  <p class="text-red-300 text-sm mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                  </p>
                @enderror
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                  <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>Pays *
                </label>
                <select name="country"
                        class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all duration-300">
                  <option value="">Sélectionner un pays</option>
                  <option value="Tunisie" {{ old('country') == 'Tunisie' ? 'selected' : '' }}>🇹🇳 Tunisie</option>
                  <option value="Belgique" {{ old('country') == 'Belgique' ? 'selected' : '' }}>🇧🇪 Belgique</option>
                  <option value="France" {{ old('country') == 'France' ? 'selected' : '' }}>🇫🇷 France</option>
                  <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>🇨🇦 Canada</option>
                  <option value="Suisse" {{ old('country') == 'Suisse' ? 'selected' : '' }}>🇨🇭 Suisse</option>
                </select>
                @error('country')
                  <p class="text-red-300 text-sm mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                  </p>
                @enderror
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                  <i class="fas fa-city mr-2 text-cyan-500"></i>Ville *
                </label>
                <input type="text" name="city"
                       class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300"
                       value="{{ old('city') }}">
                @error('city')
                  <p class="text-red-300 text-sm mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                  </p>
                @enderror
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                  <i class="fas fa-mail-bulk mr-2 text-indigo-500"></i>Code postal
                </label>
                <input type="text" name="postal_code"
                       class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-all duration-300"
                       value="{{ old('postal_code') }}">
                @error('postal_code')
                  <p class="text-red-300 text-sm mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                  </p>
                @enderror
              </div>
            </div>
            <div class="mt-6">
              <label class="block text-sm font-semibold text-gray-700 mb-3">
                <i class="fas fa-home mr-2 text-teal-500"></i>Adresse complète
              </label>
              <textarea name="address" rows="3"
                        class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-teal-400 focus:border-transparent transition-all duration-300 resize-none">{{ old('address') }}</textarea>
              @error('address')
                <p class="text-red-300 text-sm mt-2 flex items-center">
                  <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
              @enderror
            </div>
          </div>

          <!-- Professional Information -->
          <div class="bg-gray-50 rounded-2xl p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
              <i class="fas fa-briefcase mr-3 text-green-600"></i>Informations professionnelles
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                  <i class="fas fa-stethoscope mr-2 text-blue-500"></i>Spécialité *
                </label>
                <select name="specialty_id" required onchange="toggleNewSpecialty(this)"
                        class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300">
                  <option value="">Sélectionner une spécialité</option>
                  <option value="other">+ Ajouter une nouvelle spécialité</option>
                  @foreach($specialties as $specialty)
                    <option value="{{ $specialty->id }}" {{ old('specialty_id') == $specialty->id ? 'selected' : '' }}>{{ $specialty->name }}</option>
                  @endforeach
                </select>
                @error('specialty_id')
                  <p class="text-red-300 text-sm mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                  </p>
                @enderror
              </div>
              <div id="new-specialty-field" style="display:none;">
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                  <i class="fas fa-plus mr-2 text-purple-500"></i>Nouvelle spécialité
                </label>
                <input type="text" name="new_specialty"
                       class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-purple-400 focus:border-transparent transition-all duration-300"
                       value="{{ old('new_specialty') }}">
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                  <i class="fas fa-clock mr-2 text-orange-500"></i>Années d'expérience
                </label>
                <input type="number" name="experience_years" min="0" max="50"
                       class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-orange-400 focus:border-transparent transition-all duration-300"
                       value="{{ old('experience_years') }}">
                @error('experience_years')
                  <p class="text-red-300 text-sm mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                  </p>
                @enderror
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                  <i class="fas fa-money-bill mr-2 text-green-500"></i>Tarif de consultation (DT)
                </label>
                <input type="number" name="consultation_fee" step="0.01" min="0"
                       class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-green-400 focus:border-transparent transition-all duration-300"
                       value="{{ old('consultation_fee') }}">
                @error('consultation_fee')
                  <p class="text-red-300 text-sm mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                  </p>
                @enderror
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                  <i class="fas fa-building mr-2 text-cyan-500"></i>Adresse de la clinique
                </label>
                <input type="text" name="clinic_address"
                       class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300"
                       value="{{ old('clinic_address') }}">
                @error('clinic_address')
                  <p class="text-red-300 text-sm mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                  </p>
                @enderror
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                  <i class="fas fa-phone mr-2 text-indigo-500"></i>Téléphone de la clinique
                </label>
                <input type="tel" name="clinic_phone"
                       class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-all duration-300"
                       value="{{ old('clinic_phone') }}">
                @error('clinic_phone')
                  <p class="text-red-300 text-sm mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                  </p>
                @enderror
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                  <i class="fas fa-toggle-on mr-2 text-teal-500"></i>Disponibilité
                </label>
                <select name="is_available"
                        class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-teal-400 focus:border-transparent transition-all duration-300">
                  <option value="1" {{ old('is_available', '1') == '1' ? 'selected' : '' }}>Disponible</option>
                  <option value="0" {{ old('is_available') == '0' ? 'selected' : '' }}>Non disponible</option>
                </select>
                @error('is_available')
                  <p class="text-red-300 text-sm mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                  </p>
                @enderror
              </div>
            </div>
          </div>

          <!-- Password Section -->
          <div class="bg-gray-50 rounded-2xl p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
              <i class="fas fa-lock mr-3 text-red-600"></i>Sécurité du compte
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                  <i class="fas fa-key mr-2 text-purple-500"></i>Mot de passe *
                </label>
                <div class="relative">
                  <input type="password" id="password" name="password" required
                         class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 pr-12 focus:ring-2 focus:ring-purple-400 focus:border-transparent transition-all duration-300">
                  <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                    <i class="fas fa-eye text-gray-400 hover:text-gray-600 transition-colors"></i>
                  </button>
                </div>
                @error('password')
                  <p class="text-red-300 text-sm mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                  </p>
                @enderror
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                  <i class="fas fa-key mr-2 text-pink-500"></i>Confirmer mot de passe *
                </label>
                <div class="relative">
                  <input type="password" id="password_confirmation" name="password_confirmation" required
                         class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 pr-12 focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all duration-300">
                  <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                    <i class="fas fa-eye text-gray-400 hover:text-gray-600 transition-colors"></i>
                  </button>
                </div>
                @error('password_confirmation')
                  <p class="text-red-300 text-sm mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                  </p>
                @enderror
              </div>
            </div>
          </div>

          <!-- Terms and Privacy -->
          <div class="space-y-4">
            <div class="flex items-start">
              <input type="checkbox" id="terms" name="terms" required
                     class="mt-1 h-4 w-4 bg-white border-gray-200 rounded focus:ring-blue-400 text-blue-400">
              <label for="terms" class="ml-2 text-sm text-gray-700">
                J'accepte les conditions de la
                <a href="/privacy-policy" class="text-blue-600 hover:text-blue-800 underline">Politique de confidentialité</a>.
              </label>
              @error('terms')
                <p class="text-red-300 text-sm mt-2 flex items-center">
                  <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
              @enderror
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
              <h4 class="font-semibold text-blue-900 mb-2 flex items-center">
                <i class="fas fa-shield-alt mr-2 text-blue-600"></i>Protection des données
              </h4>
              <p class="text-sm text-blue-800">
                Conformément au RGPD, nous nous engageons à protéger vos données personnelles.
                Vos informations ne seront utilisées que dans le cadre de votre inscription.
              </p>
            </div>
          </div>



          <!-- Submit Button -->
          <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-4 rounded-xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
            <i class="fas fa-user-plus mr-2"></i>
            Créer mon compte médecin
          </button>
        </form>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gradient-to-r from-green-600 to-emerald-600 text-white py-12">
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
          <a href="#" class="flex items-center space-x-2 hover:text-green-200 transition">
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