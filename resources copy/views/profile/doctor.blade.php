<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profil Médecin - RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Tajawal', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  
  <!-- Profile Section -->
  <section class="py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Header -->
      <div class="mb-8">
        <div class="flex items-center justify-between">
          <div>
            <h1 id="infos" class="text-3xl font-bold text-gray-900">Informations personnelles</h1>
            <p class="text-gray-600 mt-2">Gérez vos informations personnelles et professionnelles</p>
          </div>
          <a href="/profile" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
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

      <!-- Profile Form -->
      <div class="bg-white rounded-lg shadow-md p-8">
        <form method="POST" action="{{ route('profile.doctor.update') }}" class="space-y-8">
          @csrf
          @method('PUT')
          
          <!-- Informations personnelles -->
          <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Informations personnelles</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              
              <!-- Prénom -->
              <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">Prénom *</label>
                <input type="text" id="first_name" name="first_name" required
                       value="{{ old('first_name', $user->first_name) }}"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                @error('first_name')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Nom -->
              <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Nom *</label>
                <input type="text" id="last_name" name="last_name" required
                       value="{{ old('last_name', $user->last_name) }}"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                @error('last_name')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Email -->
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                <input type="email" id="email" name="email" required
                       value="{{ old('email', $user->email) }}"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                @error('email')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Téléphone -->
              <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                <input type="tel" id="phone" name="phone"
                       value="{{ old('phone', $user->phone) }}"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                @error('phone')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Date de naissance -->
              <div>
                <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Date de naissance</label>
                <input type="date" id="birth_date" name="birth_date"
                       value="{{ old('birth_date', $user->birth_date ? $user->birth_date->format('Y-m-d') : '') }}"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                @error('birth_date')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Genre -->
              <div>
                <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Genre</label>
                <select id="gender" name="gender"
                        class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  <option value="">Sélectionner un genre</option>
                  <option value="homme" {{ old('gender', $user->gender) === 'homme' ? 'selected' : '' }}>Homme</option>
                  <option value="femme" {{ old('gender', $user->gender) === 'femme' ? 'selected' : '' }}>Femme</option>
                  <option value="autre" {{ old('gender', $user->gender) === 'autre' ? 'selected' : '' }}>Autre</option>
                </select>
                @error('gender')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

            </div>

            <!-- Adresse -->
            <div class="mt-6">
              <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
              <textarea id="address" name="address" rows="3"
                        class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">{{ old('address', $user->address) }}</textarea>
              @error('address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <!-- Informations professionnelles -->
          <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Informations professionnelles</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              
              <!-- Spécialité -->
              <div>
                <label for="specialty_id" class="block text-sm font-medium text-gray-700 mb-2">Spécialité *</label>
                <select id="specialty_id" name="specialty_id" required class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" onchange="toggleNewSpecialty(this)">
                  <option value="">Sélectionner une spécialité</option>
                  <option value="other">+ Ajouter une nouvelle spécialité</option>
                  @foreach($specialties as $specialty)
                    <option value="{{ $specialty->id }}" {{ old('specialty_id', $user->doctor ? $user->doctor->specialty_id : '') == $specialty->id ? 'selected' : '' }}>{{ $specialty->name }}</option>
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
              <script>
                function toggleNewSpecialty(select) {
                  document.getElementById('new-specialty-field').style.display = (select.value === 'other') ? 'block' : 'none';
                }
              </script>

              <!-- Années d'expérience -->
              <div>
                <label for="experience_years" class="block text-sm font-medium text-gray-700 mb-2">Années d'expérience</label>
                <input type="number" id="experience_years" name="experience_years" min="0" max="50"
                       value="{{ old('experience_years', $user->doctor->experience_years ?? '') }}"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                @error('experience_years')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Tarif de consultation -->
              <div>
                <label for="consultation_fee" class="block text-sm font-medium text-gray-700 mb-2">Tarif de consultation (DT)</label>
                <input type="number" id="consultation_fee" name="consultation_fee" step="0.01" min="0"
                       value="{{ old('consultation_fee', $user->doctor->consultation_fee ?? '') }}"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                @error('consultation_fee')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Adresse de la clinique -->
              <div>
                <label for="clinic_address" class="block text-sm font-medium text-gray-700 mb-2">Adresse de la clinique</label>
                <input type="text" id="clinic_address" name="clinic_address"
                       value="{{ old('clinic_address', $user->doctor->clinic_address ?? '') }}"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                @error('clinic_address')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Téléphone de la clinique -->
              <div>
                <label for="clinic_phone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone de la clinique</label>
                <input type="tel" id="clinic_phone" name="clinic_phone"
                       value="{{ old('clinic_phone', $user->doctor->clinic_phone ?? '') }}"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                @error('clinic_phone')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

              <!-- Disponibilité -->
              <div>
                <label for="is_available" class="block text-sm font-medium text-gray-700 mb-2">Disponibilité</label>
                <select id="is_available" name="is_available"
                        class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  <option value="1" {{ old('is_available', $user->doctor->is_available ?? true) ? 'selected' : '' }}>Disponible</option>
                  <option value="0" {{ old('is_available', $user->doctor->is_available ?? true) ? '' : 'selected' }}>Non disponible</option>
                </select>
                @error('is_available')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>

            </div>

          </div>

          <!-- Submit Button -->
          <div class="flex justify-end">
            <button type="submit" 
                    class="bg-red-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-600 transition">
              Mettre à jour
            </button>
          </div>

        </form>
      </div>

      <!-- Rendez-vous patients (cartes) -->
      @if(isset($doctorAppointments) && $doctorAppointments->count())
        <div class="mt-12">
          <h2 class="text-2xl font-bold mb-6 text-gray-900">Rendez-vous patients</h2>
          @foreach($doctorAppointments as $appointment)
            <div class="bg-white rounded-lg shadow-md p-6 mb-4">
              <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                  <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                </div>
                <div>
                  <div class="font-bold text-gray-900">
                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }} à {{ $appointment->appointment_time }}
                  </div>
                  <div class="text-gray-700">
                    {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }} ({{ ucfirst($appointment->status) }})
                  </div>
                  <div class="text-gray-500 text-sm">
                    {{ $appointment->patient->email }}<br>
                    {{ $appointment->patient->phone ?? 'Non renseigné' }}
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif

    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-white border-t mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="text-center text-sm text-gray-500">
        Tous les droits sont réservés © 2025 
        <a href="/" class="text-red-500 hover:text-red-600 font-semibold">RDV MÉDICAL</a>
      </div>
    </div>
  </footer>
</body>
</html> 