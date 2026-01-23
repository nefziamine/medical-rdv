<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mot de passe oublié - RDV Médical</title>
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
          <a href="/login" class="text-red-500 font-semibold">Connexion</a>
          <a href="/register" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">S'inscrire</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Forgot Password Section -->
  <section class="min-h-screen flex items-center justify-center py-12">
    <div class="max-w-md w-full">
      <div class="bg-white rounded-lg shadow-md p-8">
        
        <!-- Header -->
        <div class="flex items-center mb-6">
          <button onclick="history.back()" class="flex items-center text-gray-600 hover:text-gray-800 transition mr-4">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Retour
          </button>
          <h1 class="text-2xl font-bold text-gray-900">Mot de passe oublié</h1>
        </div>

        <div class="text-center mb-8">
          <div class="flex justify-center mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
              <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
              </svg>
            </div>
          </div>
          <p class="text-gray-600">Réinitialisez votre mot de passe</p>
        </div>

        @if (session('status'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-800">{{ session('status') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required 
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                       placeholder="votre@email.com">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Account Type Field -->
            <div>
                <label for="account_type" class="block text-sm font-medium text-gray-700 mb-2">Type de compte</label>
                <select id="account_type" name="account_type" required 
                        class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Sélectionner un type de compte</option>
                    <option value="patient" {{ old('account_type') == 'patient' ? 'selected' : '' }}>Patient</option>
                    <option value="doctor" {{ old('account_type') == 'doctor' ? 'selected' : '' }}>Médecin</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg font-semibold hover:bg-blue-600 transition">
                Envoyer le lien de réinitialisation
            </button>
        </form>

        <!-- Additional Links -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="text-center space-y-4">
                <div class="text-sm text-gray-500">
                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-600 font-medium">
                        ← Retour à la connexion
                    </a>
                </div>
                
                <div class="text-sm text-gray-500">
                    Pas encore de compte ? 
                    <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-600 font-medium">
                        Créer un compte
                    </a>
                </div>
                
                <div class="text-sm text-gray-500">
                    Besoin d'aide ? 
                    <a href="{{ route('contact') }}" class="text-blue-500 hover:text-blue-600 font-medium">
                        Contactez-nous
                    </a>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gradient-to-r from-blue-500 to-blue-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
          <h5 class="font-bold mb-4 text-lg">RDV Médical</h5>
          <p class="text-sm text-blue-100 leading-relaxed">
            Votre solution numérique pour les rendez-vous médicaux en Tunisie.
          </p>
        </div>
        <div>
          <h5 class="font-bold mb-4 text-lg">Contact</h5>
          <ul class="text-sm text-blue-100 space-y-2">
            <li class="flex items-center">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"><path d="M3 8l7.89 4.26..." /></svg>
              support@rdvmedical.tn
            </li>
            <li class="flex items-center">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"><path d="M3 5a2 2..." /></svg>
              +216 00 000 000
            </li>
            <li class="flex items-center">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"><path d="M17.657 16.657..." /></svg>
              Tunis, Tunisie
            </li>
          </ul>
        </div>
        <div>
          <h5 class="font-bold mb-4 text-lg">Suivez-nous</h5>
          <div class="flex space-x-4">
            <a href="#" class="hover:text-blue-200 flex items-center space-x-2"><svg class="w-5 h-5" fill="currentColor"><path d="..." /></svg><span>Facebook</span></a>
            <a href="#" class="hover:text-blue-200 flex items-center space-x-2"><svg class="w-5 h-5" fill="currentColor"><path d="..." /></svg><span>Instagram</span></a>
            <a href="#" class="hover:text-blue-200 flex items-center space-x-2"><svg class="w-5 h-5" fill="currentColor"><path d="..." /></svg><span>Twitter</span></a>
          </div>
        </div>
      </div>
      <div class="text-center mt-8 pt-8 border-t border-blue-400 text-blue-100 text-sm">
        &copy; 2025 RDV Médical. Tous droits réservés.<br/>
        <span class="text-xs text-blue-200">Conçu avec ❤️ pour simplifier vos rendez-vous médicaux</span>
      </div>
    </div>
  </footer>
</body>
</html>
