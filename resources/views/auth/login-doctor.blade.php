<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Connexion Médecin - RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body { font-family: 'Inter', sans-serif; }
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
          <span class="text-sm text-gray-600 hidden sm:block">Professionnel de santé ?</span>
          <a href="/register-doctor" class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-4 py-2 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105 font-medium">
            <i class="fas fa-user-plus mr-2"></i>Inscription gratuite
          </a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="bg-white py-20 relative overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-md mx-auto">
        <div class="bg-gray-50 rounded-3xl p-8 border border-gray-200 shadow-2xl">
          <!-- Header -->
          <div class="flex items-center justify-between mb-8">
            <button onclick="history.back()" class="flex items-center space-x-2 text-gray-600 hover:text-gray-800 transition-colors">
              <i class="fas fa-arrow-left"></i>
              <span>Retour</span>
            </button>
            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-2xl flex items-center justify-center">
              <i class="fas fa-user-md text-white text-xl"></i>
            </div>
          </div>

          <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Connexion Médecin</h1>
            <p class="text-gray-600">Accédez à votre espace professionnel</p>
          </div>

          <!-- Login Form -->
          <form method="POST" action="{{ route('login.doctor') }}" class="space-y-6">
            @csrf

            <!-- Email Field -->
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-3">
                <i class="fas fa-envelope mr-2 text-blue-400"></i>Adresse email
              </label>
              <div class="relative">
                <input type="email" name="email" required
                       class="w-full bg-white border border-gray-300 rounded-xl px-4 py-4 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-green-400 focus:border-transparent transition-all duration-300"
                       placeholder="votre@email.com"
                       value="{{ old('email') }}">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                  <i class="fas fa-envelope text-gray-400"></i>
                </div>
              </div>
              @error('email')
                <p class="text-red-300 text-sm mt-2 flex items-center">
                  <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
              @enderror
            </div>

            <!-- Password Field -->
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-3">
                <i class="fas fa-lock mr-2 text-green-400"></i>Mot de passe
              </label>
              <div class="relative">
                <input type="password" id="password-doctor" name="password" required
                       class="w-full bg-white border border-gray-300 rounded-xl px-4 py-4 pr-12 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition-all duration-300"
                       placeholder="Votre mot de passe">
                <button type="button" onclick="togglePasswordDoctor()" class="absolute inset-y-0 right-0 pr-3 flex items-center hover:text-gray-600 transition-colors">
                  <i id="password-icon-doctor" class="fas fa-eye text-gray-400"></i>
                </button>
              </div>
              @error('password')
                <p class="text-red-300 text-sm mt-2 flex items-center">
                  <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
              @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <input type="checkbox" id="remember" name="remember"
                       class="h-4 w-4 bg-white border-gray-300 rounded focus:ring-green-400 text-green-400">
                <label for="remember" class="ml-2 text-sm text-gray-600">Se souvenir de moi</label>
              </div>
              <a href="{{ route('password.request') }}" class="text-sm text-green-500 hover:text-green-700 transition-colors">
                Mot de passe oublié ?
              </a>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="login-btn-doctor" class="w-full bg-gradient-to-r from-green-500 to-teal-500 text-white py-4 rounded-xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
              <i class="fas fa-sign-in-alt mr-2"></i>
              <span id="btn-text-doctor">Se connecter</span>
              <div id="loading-spinner-doctor" class="hidden ml-2">
                <i class="fas fa-spinner fa-spin"></i>
              </div>
            </button>
          </form>

          <!-- Social Login -->
          <div class="mt-8">
            <div class="relative">
              <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
              </div>
              <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-white text-gray-500">Ou continuer avec</span>
              </div>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-4">
              <button class="w-full flex items-center justify-center px-4 py-3 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-all duration-300">
                <i class="fab fa-google text-red-400 mr-2"></i>
                <span class="text-gray-900">Google</span>
              </button>
              <button class="w-full flex items-center justify-center px-4 py-3 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-all duration-300">
                <i class="fab fa-facebook text-blue-400 mr-2"></i>
                <span class="text-gray-900">Facebook</span>
              </button>
            </div>
          </div>

          <!-- Register Link -->
          <div class="mt-8 text-center">
            <p class="text-gray-600 mb-4">Pas encore de compte médecin ?</p>
            <a href="{{ route('register.doctor') }}" class="inline-flex items-center space-x-2 bg-green-600 text-white px-6 py-3 rounded-xl hover:bg-green-700 transition-all duration-300 font-medium">
              <i class="fas fa-user-plus"></i>
              <span>S'inscrire gratuitement</span>
            </a>
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
          <a href="#" class="flex items-center space-x-2 hover:text-emerald-200 transition">
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
    function togglePasswordDoctor() {
      const passwordInput = document.getElementById('password-doctor');
      const passwordIcon = document.getElementById('password-icon-doctor');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.className = 'fas fa-eye-slash text-gray-400';
      } else {
        passwordInput.type = 'password';
        passwordIcon.className = 'fas fa-eye text-gray-400';
      }
    }

    // Add loading state to form submission
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.querySelector('form');
      if (form) {
        form.addEventListener('submit', function() {
          const btn = document.getElementById('login-btn-doctor');
          const btnText = document.getElementById('btn-text-doctor');
          const spinner = document.getElementById('loading-spinner-doctor');

          if (btn && btnText && spinner) {
            btn.disabled = true;
            btnText.textContent = 'Connexion en cours...';
            spinner.classList.remove('hidden');
          }
        });
      }

      // Add smooth scroll animations
      const inputs = document.querySelectorAll('input');
      inputs.forEach(input => {
        input.addEventListener('focus', function() {
          this.parentElement.parentElement.classList.add('animate-pulse');
        });
        input.addEventListener('blur', function() {
          this.parentElement.parentElement.classList.remove('animate-pulse');
        });
      });
    });
  </script>
</body>
</html>