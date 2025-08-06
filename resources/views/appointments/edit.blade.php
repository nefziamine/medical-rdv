<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Modifier rendez-vous - RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Tajawal', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  <!-- Edit Form -->
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if(session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <strong>Erreur :</strong> {{ session('error') }}
        <a href="{{ route('appointments.index') }}" class="text-red-600 hover:text-red-800 underline ml-2">Retour aux rendez-vous</a>
      </div>
    @endif

    @if($appointment && $appointment->id)
      <div class="bg-white rounded-lg shadow-md p-8">
        <div class="mb-8">
          <h1 class="text-3xl font-bold text-gray-900 mb-2">Modifier le rendez-vous</h1>
          <p class="text-gray-600">Modifiez les détails de votre rendez-vous</p>
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
        <form method="POST" action="{{ route('appointments.update', $appointment->id) }}" class="space-y-6">
          @csrf
          @method('PUT')
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="appointment_date" class="block text-sm font-medium text-gray-700 mb-2">
                Nouvelle date *
              </label>
              <input type="date" 
                     id="appointment_date" 
                     name="appointment_date" 
                     value="{{ $appointment->appointment_date->format('Y-m-d') }}"
                     min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                     class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                     required>
              @error('appointment_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="appointment_time" class="block text-sm font-medium text-gray-700 mb-2">
                Nouvelle heure *
              </label>
              <select id="appointment_time" 
                      name="appointment_time" 
                      class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                      required>
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
              @error('appointment_time')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div>
            <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">
              Motif de la consultation *
            </label>
            <textarea id="reason" 
                      name="reason" 
                      rows="4" 
                      placeholder="Décrivez brièvement le motif de votre consultation..."
                      class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500">{{ $appointment->notes }}</textarea>
            @error('reason')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
              Notes supplémentaires (optionnel)
            </label>
            <textarea id="notes" 
                      name="notes" 
                      rows="3" 
                      placeholder="Ajoutez des informations supplémentaires..."
                      class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500">{{ $appointment->notes }}</textarea>
            @error('notes')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="flex items-center justify-between pt-6">
            <a href="{{ route('appointments.index') }}" 
               class="text-gray-600 hover:text-gray-800 transition">
              ← Retour aux rendez-vous
            </a>
            <button type="submit" 
                    class="bg-red-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-600 transition">
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