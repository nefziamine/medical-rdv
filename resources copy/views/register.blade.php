<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inscription - RDV Médical</title>
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
          <a href="/login" class="text-gray-600 hover:text-red-500 transition">Connexion</a>
          <a href="/register" class="text-red-500 font-semibold">Inscription</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Register Section -->
  <section class="min-h-screen flex items-center justify-center py-12">
    <div class="max-w-2xl w-full">
      <div class="bg-white rounded-lg shadow-md p-8">
        <div class="text-center mb-8">
          <h1 class="text-3xl font-bold text-gray-900 mb-2">Créer un compte</h1>
          <p class="text-gray-600">Rejoignez RDV Médical</p>
        </div>

        @if ($errors->any())
          <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc list-inside">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
          @csrf
          
          <!-- Hidden field to ensure user_type is always submitted -->
          <input type="hidden" name="user_type" id="user_type_hidden" value="{{ old('user_type', 'patient') }}">
          
          <!-- User Type Selection -->
          <div class="mb-8">
            <label class="block text-sm font-medium text-gray-700 mb-4">Type de compte</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:border-red-500 transition">
                <input type="radio" name="user_type_radio" value="patient" class="h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300" {{ old('user_type', 'patient') == 'patient' ? 'checked' : '' }}>
                <div class="ml-3">
                  <div class="font-semibold">Patient</div>
                  <div class="text-sm text-gray-600">Prendre des rendez-vous</div>
                </div>
              </label>
              <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:border-red-500 transition">
                <input type="radio" name="user_type_radio" value="doctor" class="h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300" {{ old('user_type') == 'doctor' ? 'checked' : '' }}>
                <div class="ml-3">
                  <div class="font-semibold">Médecin</div>
                  <div class="text-sm text-gray-600">Gérer vos consultations</div>
                </div>
              </label>
            </div>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
              <input type="text" name="first_name" value="{{ old('first_name') }}" required class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
              <input type="text" name="last_name" value="{{ old('last_name') }}" required class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
            <input type="tel" name="phone" value="{{ old('phone') }}" maxlength="20" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Date de naissance</label>
            <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
            <textarea name="address" rows="3" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">{{ old('address') }}</textarea>
          </div>

          <!-- Doctor specific fields -->
          <div id="doctor-fields" class="hidden space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Spécialité</label>
              <select name="specialty_id" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                <option value="">Choisissez une spécialité</option>
                @foreach(\App\Models\Specialty::all() as $specialty)
                  <option value="{{ $specialty->id }}" {{ old('specialty_id') == $specialty->id ? 'selected' : '' }}>
                    {{ $specialty->name }}
                  </option>
                @endforeach
              </select>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Années d'expérience</label>
              <input type="number" name="experience_years" value="{{ old('experience_years') }}" min="0" max="50" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Frais de consultation (DT)</label>
              <input type="number" name="consultation_fee" value="{{ old('consultation_fee') }}" min="0" step="0.01" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
              <textarea name="description" rows="3" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">{{ old('description') }}</textarea>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Formation</label>
              <textarea name="education" rows="2" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">{{ old('education') }}</textarea>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Certifications</label>
              <textarea name="certifications" rows="2" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">{{ old('certifications') }}</textarea>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Langues parlées</label>
              <div class="space-y-2">
                <label class="flex items-center">
                  <input type="checkbox" name="languages[]" value="arabe" {{ in_array('arabe', old('languages', [])) ? 'checked' : '' }} class="h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300 rounded">
                  <span class="ml-2">Arabe</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" name="languages[]" value="français" {{ in_array('français', old('languages', [])) ? 'checked' : '' }} class="h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300 rounded">
                  <span class="ml-2">Français</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" name="languages[]" value="anglais" {{ in_array('anglais', old('languages', [])) ? 'checked' : '' }} class="h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300 rounded">
                  <span class="ml-2">Anglais</span>
                </label>
              </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Heure de début</label>
                <input type="time" name="start_time" value="{{ old('start_time', '09:00') }}" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Heure de fin</label>
                <input type="time" name="end_time" value="{{ old('end_time', '17:00') }}" class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
              </div>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Jours de travail</label>
              <div class="grid grid-cols-2 gap-2">
                <label class="flex items-center">
                  <input type="checkbox" name="available_days[]" value="lundi" {{ in_array('lundi', old('available_days', ['lundi', 'mardi', 'mercredi', 'jeudi'])) ? 'checked' : '' }} class="h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300 rounded">
                  <span class="ml-2">Lundi</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" name="available_days[]" value="mardi" {{ in_array('mardi', old('available_days', ['lundi', 'mardi', 'mercredi', 'jeudi'])) ? 'checked' : '' }} class="h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300 rounded">
                  <span class="ml-2">Mardi</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" name="available_days[]" value="mercredi" {{ in_array('mercredi', old('available_days', ['lundi', 'mardi', 'mercredi', 'jeudi'])) ? 'checked' : '' }} class="h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300 rounded">
                  <span class="ml-2">Mercredi</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" name="available_days[]" value="jeudi" {{ in_array('jeudi', old('available_days', ['lundi', 'mardi', 'mercredi', 'jeudi'])) ? 'checked' : '' }} class="h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300 rounded">
                  <span class="ml-2">Jeudi</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" name="available_days[]" value="vendredi" {{ in_array('vendredi', old('available_days', ['lundi', 'mardi', 'mercredi', 'jeudi'])) ? 'checked' : '' }} class="h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300 rounded">
                  <span class="ml-2">Vendredi</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" name="available_days[]" value="samedi" {{ in_array('samedi', old('available_days', ['lundi', 'mardi', 'mercredi', 'jeudi'])) ? 'checked' : '' }} class="h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300 rounded">
                  <span class="ml-2">Samedi</span>
                </label>
              </div>
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
            <input type="password" name="password" required class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" required class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
          </div>

          <div class="flex items-center">
            <input type="checkbox" name="terms" id="terms" required class="h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300 rounded">
            <label for="terms" class="ml-2 text-sm text-gray-600">
              J'accepte les <a href="/terms" class="text-red-500 hover:text-red-600">conditions d'utilisation</a> et la <a href="/privacy" class="text-red-500 hover:text-red-600">politique de confidentialité</a>
            </label>
          </div>

          <button type="submit" class="w-full bg-red-500 text-white py-3 rounded-lg font-semibold hover:bg-red-600 transition">
            Créer mon compte
          </button>
        </form>

        <div class="mt-6">
          <div class="relative">
            <div class="absolute inset-0 flex items-center">
              <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
              <span class="px-2 bg-white text-gray-500">Ou</span>
            </div>
          </div>

          <div class="mt-6 grid grid-cols-2 gap-3">
            <button class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
              <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
              </svg>
              Google
            </button>
            <button class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
              </svg>
              Facebook
            </button>
          </div>
        </div>

        <div class="mt-8 text-center">
          <p class="text-gray-600">Déjà un compte ? 
            <a href="/login" class="text-red-500 hover:text-red-600 font-semibold">Se connecter</a>
          </p>
        </div>
      </div>
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

  <script>
    // Toggle doctor fields based on user type selection
    document.querySelectorAll('input[name="user_type_radio"]').forEach(radio => {
      radio.addEventListener('change', function() {
        const userTypeHidden = document.getElementById('user_type_hidden');
        userTypeHidden.value = this.value;

        const doctorFields = document.getElementById('doctor-fields');
        if (this.value === 'doctor') {
          doctorFields.classList.remove('hidden');
        } else {
          doctorFields.classList.add('hidden');
        }
      });
    });

    // Show doctor fields if doctor is already selected (for form validation errors)
    document.addEventListener('DOMContentLoaded', function() {
      const selectedType = document.querySelector('input[name="user_type_radio"]:checked');
      if (selectedType && selectedType.value === 'doctor') {
        document.getElementById('doctor-fields').classList.remove('hidden');
      }
    });
  </script>
</body>
</html> 