<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Enregistrement Patient - RDV Médical</title>
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
      <div class="max-w-2xl mx-auto">
        <div class="bg-white/10 backdrop-blur-md rounded-3xl p-8 border border-white/20 shadow-2xl">
          <!-- Header -->
          <div class="flex items-center justify-between mb-8">
            <button onclick="history.back()" class="flex items-center space-x-2 text-white/80 hover:text-white transition-colors">
              <i class="fas fa-arrow-left"></i>
              <span>Retour</span>
            </button>
            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center">
              <i class="fas fa-user text-white text-xl"></i>
            </div>
          </div>

          <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">Créer un compte patient</h1>
            <p class="text-white/80">Rejoignez notre plateforme pour prendre rendez-vous facilement</p>
          </div>

          <!-- Registration Form -->
          <form method="POST" action="{{ route('register.patient') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Left Column -->
              <div class="space-y-4">
                <!-- Prénom -->
                <div>
                  <label class="block text-sm font-semibold text-white mb-3">
                    <i class="fas fa-user mr-2 text-blue-400"></i>Prénom *
                  </label>
                  <div class="relative">
                    <input type="text" name="first_name" required
                           class="w-full bg-white/10 backdrop-blur-md border border-white/20 rounded-xl px-4 py-4 text-white placeholder-white/60 focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300"
                           placeholder="Votre prénom"
                           value="{{ old('first_name') }}">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                      <i class="fas fa-user text-white/40"></i>
                    </div>
                  </div>
                  @error('first_name')
                    <p class="text-red-300 text-sm mt-2 flex items-center">
                      <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                  @enderror
                </div>

                <!-- Contact -->
                <div>
                  <label class="block text-sm font-semibold text-white mb-3">
                    <i class="fas fa-phone mr-2 text-green-400"></i>Contact *
                  </label>
                  <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <span class="text-white/60">🇹🇳 +216</span>
                    </div>
                    <input type="tel" name="phone" required
                           class="w-full bg-white/10 backdrop-blur-md border border-white/20 pl-20 pr-4 py-4 rounded-xl text-white placeholder-white/60 focus:ring-2 focus:ring-green-400 focus:border-transparent transition-all duration-300"
                           placeholder="Votre numéro"
                           value="{{ old('phone') }}">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                      <i class="fas fa-phone text-white/40"></i>
                    </div>
                  </div>
                  @error('phone')
                    <p class="text-red-300 text-sm mt-2 flex items-center">
                      <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                  @enderror
                </div>

                <!-- Mot de passe -->
                <div>
                  <label class="block text-sm font-semibold text-white mb-3">
                    <i class="fas fa-lock mr-2 text-purple-400"></i>Mot de passe *
                  </label>
                  <div class="relative">
                    <input type="password" id="password" name="password" required
                           class="w-full bg-white/10 backdrop-blur-md border border-white/20 rounded-xl px-4 py-4 pr-12 text-white placeholder-white/60 focus:ring-2 focus:ring-purple-400 focus:border-transparent transition-all duration-300"
                           placeholder="Votre mot de passe">
                    <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                      <i class="fas fa-eye text-white/40 hover:text-white/60 transition-colors"></i>
                    </button>
                  </div>
                  @error('password')
                    <p class="text-red-300 text-sm mt-2 flex items-center">
                      <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                  @enderror
                </div>

                <!-- Genre -->
                <div>
                  <label class="block text-sm font-semibold text-white mb-3">
                    <i class="fas fa-venus-mars mr-2 text-pink-400"></i>Genre *
                  </label>
                  <div class="relative">
                    <select name="gender" required
                            class="w-full bg-white/10 backdrop-blur-md border border-white/20 rounded-xl px-4 py-4 text-white focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all duration-300 appearance-none">
                      <option value="" class="text-gray-900">Choisissez votre genre</option>
                      <option value="homme" class="text-gray-900" {{ old('gender') == 'homme' ? 'selected' : '' }}>Homme</option>
                      <option value="femme" class="text-gray-900" {{ old('gender') == 'femme' ? 'selected' : '' }}>Femme</option>
                      <option value="autre" class="text-gray-900" {{ old('gender') == 'autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                      <i class="fas fa-chevron-down text-white/40"></i>
                    </div>
                  </div>
                  @error('gender')
                    <p class="text-red-300 text-sm mt-2 flex items-center">
                      <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                  @enderror
                </div>
              </div>

              <!-- Right Column -->
              <div class="space-y-4">
                <!-- Nom -->
                <div>
                  <label class="block text-sm font-semibold text-white mb-3">
                    <i class="fas fa-user-tag mr-2 text-orange-400"></i>Nom *
                  </label>
                  <div class="relative">
                    <input type="text" name="last_name" required
                           class="w-full bg-white/10 backdrop-blur-md border border-white/20 rounded-xl px-4 py-4 text-white placeholder-white/60 focus:ring-2 focus:ring-orange-400 focus:border-transparent transition-all duration-300"
                           placeholder="Votre nom"
                           value="{{ old('last_name') }}">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                      <i class="fas fa-user-tag text-white/40"></i>
                    </div>
                  </div>
                  @error('last_name')
                    <p class="text-red-300 text-sm mt-2 flex items-center">
                      <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                  @enderror
                </div>

                <!-- Email -->
                <div>
                  <label class="block text-sm font-semibold text-white mb-3">
                    <i class="fas fa-envelope mr-2 text-cyan-400"></i>Email *
                  </label>
                  <div class="relative">
                    <input type="email" name="email" required
                           class="w-full bg-white/10 backdrop-blur-md border border-white/20 rounded-xl px-4 py-4 text-white placeholder-white/60 focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300"
                           placeholder="votre@email.com"
                           value="{{ old('email') }}">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                      <i class="fas fa-envelope text-white/40"></i>
                    </div>
                  </div>
                  @error('email')
                    <p class="text-red-300 text-sm mt-2 flex items-center">
                      <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                  @enderror
                </div>

                <!-- Confirmer mot de passe -->
                <div>
                  <label class="block text-sm font-semibold text-white mb-3">
                    <i class="fas fa-lock mr-2 text-indigo-400"></i>Confirmer mot de passe *
                  </label>
                  <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           class="w-full bg-white/10 backdrop-blur-md border border-white/20 rounded-xl px-4 py-4 pr-12 text-white placeholder-white/60 focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-all duration-300"
                           placeholder="Confirmer votre mot de passe">
                    <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                      <i class="fas fa-eye text-white/40 hover:text-white/60 transition-colors"></i>
                    </button>
                  </div>
                  @error('password_confirmation')
                    <p class="text-red-300 text-sm mt-2 flex items-center">
                      <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                  @enderror
                </div>

                <!-- Date de naissance -->
                <div>
                  <label class="block text-sm font-semibold text-white mb-3">
                    <i class="fas fa-calendar mr-2 text-yellow-400"></i>Date de naissance *
                  </label>
                  <div class="relative">
                    <input type="date" name="birth_date" required
                           class="w-full bg-white/10 backdrop-blur-md border border-white/20 rounded-xl px-4 py-4 text-white focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition-all duration-300"
                           value="{{ old('birth_date') }}">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                      <i class="fas fa-calendar text-white/40"></i>
                    </div>
                  </div>
                  @error('birth_date')
                    <p class="text-red-300 text-sm mt-2 flex items-center">
                      <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Terms and Privacy -->
            <div class="space-y-4">
              <!-- Privacy Policy Checkbox -->
              <div class="flex items-start">
                <input type="checkbox" id="terms" name="terms" required
                       class="mt-1 h-4 w-4 bg-white/10 border-white/20 rounded focus:ring-blue-400 text-blue-400">
                <label for="terms" class="ml-2 text-sm text-white/80">
                  J'accepte les conditions de la
                  <a href="/privacy-policy" class="text-blue-300 hover:text-blue-200 underline">Politique de confidentialité</a>.
                </label>
                @error('terms')
                  <p class="text-red-300 text-sm mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                  </p>
                @enderror
              </div>

              <!-- GDPR Information -->
              <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20">
                <h4 class="font-semibold text-white mb-2 flex items-center">
                  <i class="fas fa-shield-alt mr-2 text-green-400"></i>Protection des données
                </h4>
                <p class="text-sm text-white/80">
                  Vos données personnelles sont protégées selon le RGPD. Nous nous engageons à assurer la transparence
                  concernant la collecte, la gestion et l'utilisation de vos données.
                </p>
              </div>
            </div>



            <!-- Submit Button -->
            <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-4 rounded-xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
              <i class="fas fa-user-plus mr-2"></i>
              Créer mon compte
            </button>
          </form>

          <!-- Login Links -->
          <div class="mt-8 space-y-3 text-center">
            <p class="text-white/80">
              Avez-vous déjà un compte ?
              <a href="{{ route('login') }}" class="text-blue-300 hover:text-blue-200 font-semibold transition-colors">Se connecter</a>
            </p>
            <p class="text-white/80">
              Vous êtes médecin ?
              <a href="{{ route('register.doctor') }}" class="text-green-300 hover:text-green-200 font-semibold transition-colors">Créer un compte médecin</a>
            </p>
          </div>
        </div>
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
  </script>
</body>
</html>