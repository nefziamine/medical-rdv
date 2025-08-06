<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Prendre rendez-vous - RDV Médical</title>
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
          <a href="/doctors" class="text-red-500 font-semibold">Médecins</a>
          <a href="/specialties" class="text-gray-600 hover:text-red-500 transition">Spécialités</a>
          <a href="/contact" class="text-gray-600 hover:text-red-500 transition">Contact</a>
        </div>
        <div class="flex items-center space-x-4">
          @auth
            <div class="relative">
              <button class="flex items-center space-x-2 text-gray-600 hover:text-red-500 transition">
                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                  <span class="text-red-500 font-bold text-sm">{{ substr(Auth::user()->first_name, 0, 1) }}</span>
                </div>
                <span>{{ Auth::user()->first_name }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="inline">
              @csrf
              <button type="submit" class="text-gray-600 hover:text-red-500 transition bg-transparent border-0 cursor-pointer">Déconnexion</button>
            </form>
          @else
            <a href="/login" class="text-gray-600 hover:text-red-500 transition">Connexion</a>
            <a href="/register" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">Inscription</a>
          @endauth
        </div>
      </div>
    </div>
  </nav>
  <!-- Booking Form -->
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-md p-8">
      <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Prendre rendez-vous</h1>
        <p class="text-gray-600">Réservez votre consultation avec Dr. {{ $doctor->user->first_name }} {{ $doctor->user->last_name }}</p>
      </div>

      <!-- Doctor Info -->
      <div class="bg-gray-50 rounded-lg p-6 mb-8">
        <div class="flex items-center space-x-4">
          <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Dr. {{ $doctor->user->first_name }} {{ $doctor->user->last_name }}</h3>
            <p class="text-gray-600">{{ $doctor->specialty ? $doctor->specialty->name : 'Spécialité non définie' }}</p>
            <p class="text-sm text-gray-500">{{ $doctor->clinic_address ?? 'Adresse non disponible' }}</p>
          </div>
          <div class="ml-auto text-right">
            <p class="text-2xl font-bold text-green-600">{{ $doctor->consultation_fee ?? 50 }} DT</p>
            <p class="text-sm text-gray-500">30 minutes</p>
          </div>
        </div>
        <div class="mt-4">
          <h4 class="font-semibold mb-1">Disponibilité du médecin</h4>
          @if($doctor->availability)
            @php
              $days = [
                'monday' => 'Lundi',
                'tuesday' => 'Mardi', 
                'wednesday' => 'Mercredi',
                'thursday' => 'Jeudi',
                'friday' => 'Vendredi',
                'saturday' => 'Samedi',
                'sunday' => 'Dimanche'
              ];
            @endphp
            <p><strong>Jours disponibles :</strong> 
              @foreach($doctor->availability as $slot)
                {{ $days[$slot['day']] ?? ucfirst($slot['day']) }}{{ !$loop->last ? ', ' : '' }}
              @endforeach
            </p>
          @else
            <p class="text-gray-500">Disponibilité non définie</p>
          @endif
        </div>
      </div>

      <!-- Booking Form -->
      <form method="POST" action="{{ route('appointments.store', $doctor->id) }}" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="appointment_date" class="block text-sm font-medium text-gray-700 mb-2">
              Date du rendez-vous *
            </label>
            <input type="date" id="appointment_date" name="appointment_date" lang="fr" placeholder="jj/mm/aaaa"
                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                   required>
            @error('appointment_date')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="appointment_time" class="block text-sm font-medium text-gray-700 mb-2">
              Heure du rendez-vous *
            </label>
            <select id="appointment_time" name="appointment_time" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
              <option value="">Sélectionnez d'abord une date</option>
            </select>
            <input type="time" id="manual_time" name="manual_time" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 mt-2 hidden" step="900">
            <div id="loading-slots" class="hidden mt-2 text-sm text-gray-600">
              <svg class="animate-spin h-4 w-4 inline mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              Chargement des créneaux disponibles...
            </div>
            @error('appointment_time')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div>
          <label for="appointment_type" class="block text-sm font-medium text-gray-700 mb-2">
            Type de consultation *
          </label>
          <div class="space-y-3">
            <label class="flex items-center">
              <input type="radio" 
                     name="appointment_type" 
                     value="in_person" 
                     class="text-red-500 focus:ring-red-500"
                     checked>
              <span class="ml-3 text-gray-700">Consultation en personne</span>
            </label>
            <label class="flex items-center">
              <input type="radio" 
                     name="appointment_type" 
                     value="online" 
                     class="text-red-500 focus:ring-red-500">
              <span class="ml-3 text-gray-700">Consultation en ligne</span>
            </label>
          </div>
          @error('appointment_type')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
            Notes (optionnel)
          </label>
          <textarea id="notes" 
                    name="notes" 
                    rows="4" 
                    placeholder="Décrivez brièvement le motif de votre consultation..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500">{{ request('message') }}</textarea>
          @error('notes')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Summary -->
        <div class="bg-gray-50 rounded-lg p-6">
          <h3 class="text-lg font-semibold text-gray-900 mb-4">Récapitulatif</h3>
          <div class="space-y-2">
            <div class="flex justify-between">
              <span class="text-gray-600">Consultation</span>
              <span class="font-medium">{{ $doctor->consultation_fee ?? 50 }} DT</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Durée</span>
              <span class="font-medium">30 minutes</span>
            </div>
            <hr class="my-2">
            <div class="flex justify-between text-lg font-semibold">
              <span>Total</span>
              <span class="text-green-600">{{ $doctor->consultation_fee ?? 50 }} DT</span>
            </div>
          </div>
        </div>

        <div class="flex items-center justify-between pt-6">
          <a href="{{ route('doctors.index') }}" 
             class="text-gray-600 hover:text-gray-800 transition">
            ← Retour aux médecins
          </a>
          <button type="submit" 
                  class="bg-red-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-600 transition">
            Confirmer le rendez-vous
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-gradient-to-r from-red-500 to-pink-500 text-white py-12 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <p>&copy; 2025 RDV Médical. Tous droits réservés.</p>
    </div>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const dateInput = document.getElementById('appointment_date');
      const timeSelect = document.getElementById('appointment_time');
      const manualTime = document.getElementById('manual_time');
      const loadingDiv = document.getElementById('loading-slots');
      const doctorId = {{ $doctor->id }};
      
      // Fonction pour charger les créneaux disponibles
      function loadAvailableSlots(date) {
        loadingDiv.classList.remove('hidden');
        timeSelect.innerHTML = '<option value="">Chargement...</option>';
        manualTime.classList.add('hidden');
        
        fetch(`/doctors/${doctorId}/available-slots?date=${date}`)
          .then(response => response.json())
          .then(data => {
            loadingDiv.classList.add('hidden');
            timeSelect.innerHTML = '<option value="">Choisir une heure</option>';
            if (data.slots && data.slots.length > 0) {
              data.slots.forEach(slot => {
                const option = document.createElement('option');
                option.value = slot;
                option.textContent = slot;
                timeSelect.appendChild(option);
              });
              manualTime.classList.add('hidden');
              timeSelect.required = true;
              manualTime.required = false;
              timeSelect.disabled = false;
              manualTime.disabled = true;
              document.querySelector('button[type=submit]').disabled = false;
            } else {
              timeSelect.innerHTML = '<option value="">Aucun créneau disponible pour cette date</option>';
              manualTime.classList.add('hidden');
              timeSelect.required = false;
              manualTime.required = false;
              timeSelect.disabled = true;
              manualTime.disabled = true;
              document.querySelector('button[type=submit]').disabled = true;
            }
          })
          .catch(error => {
            loadingDiv.classList.add('hidden');
            timeSelect.innerHTML = '<option value="">Erreur lors du chargement</option>';
            manualTime.classList.add('hidden');
            timeSelect.required = false;
            manualTime.required = false;
            timeSelect.disabled = true;
            manualTime.disabled = true;
            document.querySelector('button[type=submit]').disabled = true;
          });
      }
      
      // Ajout d'un datepicker natif/français
      const dateDisplay = document.getElementById('appointment_date');
      dateDisplay.addEventListener('click', function() {
        const picker = document.createElement('input');
        picker.type = 'date';
        picker.style.position = 'absolute';
        picker.style.opacity = 0;
        picker.style.pointerEvents = 'none';
        document.body.appendChild(picker);
        picker.focus();
        picker.onchange = function() {
          if (picker.value) {
            // yyyy-mm-dd -> jj/mm/aaaa
            const parts = picker.value.split('-');
            const fr = parts[2] + '/' + parts[1] + '/' + parts[0];
            dateDisplay.value = fr;
            dateInput.value = picker.value;
            dateInput.dispatchEvent(new Event('change'));
          }
          document.body.removeChild(picker);
        };
      });

      // S'assurer que la date envoyée à loadAvailableSlots est toujours au format yyyy-mm-dd
      dateInput.addEventListener('change', function() {
        const selectedDate = this.value;
        if (selectedDate) {
          loadAvailableSlots(selectedDate); // selectedDate est toujours yyyy-mm-dd
        } else {
          timeSelect.innerHTML = '<option value="">Sélectionnez d\'abord une date</option>';
          manualTime.classList.add('hidden');
        }
      });
      
      // Charger les créneaux pour aujourd'hui si une date est déjà sélectionnée
      if (dateInput.value) {
        loadAvailableSlots(dateInput.value);
      }
    });
  </script>
</body>
</html> 