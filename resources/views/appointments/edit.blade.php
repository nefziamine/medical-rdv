<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Modifier rendez-vous - RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  <!-- Header Section -->
  <section class="bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-3xl lg:text-4xl font-bold mb-2">
            <i class="fas fa-edit mr-3"></i>
            Modifier rendez-vous
          </h1>
          <p class="text-white/90 text-lg">
            Modifiez les détails de votre rendez-vous médical
          </p>
        </div>
        <div class="hidden md:block">
          <a href="{{ route('appointments.index') }}" class="inline-flex items-center bg-white/20 backdrop-blur-md text-white px-6 py-3 rounded-xl hover:bg-white/30 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Retour aux rendez-vous
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Edit Form -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if(session('error'))
      <div class="mb-6 bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-4 rounded-2xl shadow-lg flex items-center">
        <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
        <span class="font-medium">{{ session('error') }}</span>
      </div>
    @endif

    @if($appointment && $appointment->id)
      <div class="bg-white rounded-3xl shadow-xl p-8">
        <div class="flex items-center mb-8">
          <div class="w-12 h-12 bg-gradient-to-r from-orange-600 to-red-600 rounded-2xl flex items-center justify-center mr-4">
            <i class="fas fa-edit text-white text-xl"></i>
          </div>
          <div>
            <h1 class="text-2xl font-bold text-gray-900">Modifier le rendez-vous</h1>
            <p class="text-gray-600">Modifiez les détails de votre rendez-vous</p>
          </div>
        </div>

        <!-- Current Appointment Info -->
        <div class="bg-gray-50 rounded-lg p-6 mb-8">
          <h3 class="text-lg font-semibold mb-4">Rendez-vous actuel</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <p class="text-sm text-gray-600">Médecin</p>
              <p class="font-medium">{{ $appointment->doctor && $appointment->doctor->user ? $appointment->doctor->user->first_name . ' ' . $appointment->doctor->user->last_name : 'Nom non disponible' }}</p>
            </div>
            <div>
              <p class="text-sm text-gray-600">Spécialité</p>
              <p class="font-medium">{{ $appointment->doctor && $appointment->doctor->specialty ? $appointment->doctor->specialty->name : 'Spécialité non disponible' }}</p>
            </div>
            <div>
              <p class="text-sm text-gray-600">Date actuelle</p>
              <p class="font-medium">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</p>
            </div>
            <div>
              <p class="text-sm text-gray-600">Heure actuelle</p>
              <p class="font-medium">{{ $appointment->appointment_time }}</p>
            </div>
          </div>
        </div>

        <!-- Edit Form -->
        <form method="POST" action="{{ route('appointments.update', $appointment->id) }}" class="space-y-8">
          @csrf
          @method('PUT')

          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Date Field -->
            <div class="space-y-2">
              <label for="appointment_date" class="block text-sm font-semibold text-gray-700 flex items-center">
                <i class="fas fa-calendar-alt mr-2 text-orange-500"></i>Nouvelle date <span class="text-red-500 ml-1">*</span>
              </label>
              <div class="relative">
                <input type="date"
                       id="appointment_date"
                       name="appointment_date"
                       value="{{ $appointment->appointment_date->format('Y-m-d') }}"
                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                       class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300 hover:bg-white">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                  <i class="fas fa-calendar-alt text-gray-400"></i>
                </div>
              </div>
              @error('appointment_date')
                <p class="text-red-500 text-sm mt-2 flex items-center">
                  <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
              @enderror
            </div>

            <!-- Time Field -->
            <div class="space-y-2">
              <label for="appointment_time" class="block text-sm font-semibold text-gray-700 flex items-center">
                <i class="fas fa-clock mr-2 text-red-500"></i>Nouvelle heure <span class="text-red-500 ml-1">*</span>
              </label>
              <div class="relative">
                <select id="appointment_time"
                        name="appointment_time"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300 hover:bg-white appearance-none">
                  <option value="">Choisir une heure</option>
                  <option value="09:00" {{ $appointment->appointment_time == '09:00' ? 'selected' : '' }}>09:00</option>
                  <option value="09:30" {{ $appointment->appointment_time == '09:30' ? 'selected' : '' }}>09:30</option>
                  <option value="10:00" {{ $appointment->appointment_time == '10:00' ? 'selected' : '' }}>10:00</option>
                  <option value="10:30" {{ $appointment->appointment_time == '10:30' ? 'selected' : '' }}>10:30</option>
                  <option value="11:00" {{ $appointment->appointment_time == '11:00' ? 'selected' : '' }}>11:00</option>
                  <option value="11:30" {{ $appointment->appointment_time == '11:30' ? 'selected' : '' }}>11:30</option>
                  <option value="14:00" {{ $appointment->appointment_time == '14:00' ? 'selected' : '' }}>14:00</option>
                  <option value="14:30" {{ $appointment->appointment_time == '14:30' ? 'selected' : '' }}>14:30</option>
                  <option value="15:00" {{ $appointment->appointment_time == '15:00' ? 'selected' : '' }}>15:00</option>
                  <option value="15:30" {{ $appointment->appointment_time == '15:30' ? 'selected' : '' }}>15:30</option>
                  <option value="16:00" {{ $appointment->appointment_time == '16:00' ? 'selected' : '' }}>16:00</option>
                  <option value="16:30" {{ $appointment->appointment_time == '16:30' ? 'selected' : '' }}>16:30</option>
                  <option value="17:00" {{ $appointment->appointment_time == '17:00' ? 'selected' : '' }}>17:00</option>
                  <option value="17:30" {{ $appointment->appointment_time == '17:30' ? 'selected' : '' }}>17:30</option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                  <i class="fas fa-chevron-down text-gray-400"></i>
                </div>
              </div>
              @error('appointment_time')
                <p class="text-red-500 text-sm mt-2 flex items-center">
                  <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
              @enderror
            </div>
          </div>

          <!-- Notes -->
          <div class="space-y-2">
            <label for="notes" class="block text-sm font-semibold text-gray-700 flex items-center">
              <i class="fas fa-sticky-note mr-2 text-pink-500"></i>Motif de la consultation
            </label>
            <div class="relative">
              <textarea id="notes"
                        name="notes"
                        rows="4"
                        placeholder="Décrivez brièvement le motif de votre consultation..."
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300 hover:bg-white resize-none">{{ $appointment->notes }}</textarea>
              <div class="absolute bottom-3 right-3">
                <i class="fas fa-sticky-note text-gray-400"></i>
              </div>
            </div>
            @error('notes')
              <p class="text-red-500 text-sm mt-2 flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
              </p>
            @enderror
          </div>

          <!-- Submit Button -->
          <div class="flex items-center justify-between pt-6 border-t border-gray-200">
            <a href="{{ route('appointments.index') }}"
               class="inline-flex items-center text-gray-600 hover:text-gray-800 transition-colors">
              <i class="fas fa-arrow-left mr-2"></i>
              Retour aux rendez-vous
            </a>
            <button type="submit"
                    class="bg-gradient-to-r from-orange-600 to-red-600 text-white px-8 py-4 rounded-2xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center">
              <i class="fas fa-save mr-2"></i>
              Mettre à jour le rendez-vous
            </button>
          </div>
        </form>
      </div>
    @else
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <strong>Erreur :</strong> Rendez-vous non trouvé ou invalide.
        <a href="{{ route('appointments.index') }}" class="text-red-600 hover:text-red-800 underline ml-2">Retour aux rendez-vous</a>
      </div>
    @endif
  </div>

  <!-- Footer -->
  <footer class="bg-gradient-to-r from-red-500 to-pink-500 text-white py-12 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <p>&copy; 2025 RDV Médical. Tous droits réservés.</p>
    </div>
  </footer>
</body>
</html> 