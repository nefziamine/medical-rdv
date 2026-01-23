<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Prendre rendez-vous - RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  <!-- Header Section -->
  <section class="bg-gradient-to-br from-green-600 via-emerald-600 to-teal-700 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
      <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full blur-3xl animate-pulse"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative">
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-3xl lg:text-4xl font-bold mb-2">
            <i class="fas fa-calendar-plus mr-3"></i>
            Prendre rendez-vous
          </h1>
          <p class="text-white/90 text-lg">
            Réservez votre consultation avec Dr. {{ $doctor->user->first_name }} {{ $doctor->user->last_name }}
          </p>
        </div>
        <div class="hidden md:block">
          <a href="{{ route('doctors.index') }}" class="inline-flex items-center bg-white/20 backdrop-blur-md text-white px-6 py-3 rounded-xl hover:bg-white/30 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Retour aux médecins
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Booking Form -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Doctor Info Sidebar -->
      <aside class="lg:col-span-1">
        <div class="bg-white rounded-3xl shadow-xl p-6 sticky top-8">
          <div class="text-center mb-6">
            <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-emerald-500 rounded-3xl flex items-center justify-center mx-auto mb-4">
              <i class="fas fa-user-md text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Dr. {{ $doctor->user->first_name }} {{ $doctor->user->last_name }}</h3>
            <p class="text-emerald-600 font-medium">{{ $doctor->specialty ? $doctor->specialty->name : 'Spécialité' }}</p>
          </div>

          <div class="space-y-4">
            <div class="flex items-center space-x-3 p-3 bg-emerald-50 rounded-xl">
              <i class="fas fa-map-marker-alt text-emerald-500"></i>
              <div>
                <p class="text-sm text-gray-600">Adresse</p>
                <p class="font-medium text-gray-900">{{ $doctor->clinic_address ?? 'En attente' }}</p>
              </div>
            </div>

            <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-xl">
              <i class="fas fa-money-bill-wave text-green-500"></i>
              <div>
                <p class="text-sm text-gray-600">Tarif</p>
                <p class="font-bold text-green-600">{{ $doctor->consultation_fee ?? 50 }} DT</p>
              </div>
            </div>

            <div class="flex items-center space-x-3 p-3 bg-emerald-50 rounded-xl">
              <i class="fas fa-clock text-emerald-500"></i>
              <div>
                <p class="text-sm text-gray-600">Durée</p>
                <p class="font-medium text-gray-900">30 minutes</p>
              </div>
            </div>
          </div>

          <div class="mt-6">
            <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
              <i class="fas fa-calendar-check mr-2 text-green-500"></i>
              Disponibilité
            </h4>
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
              <div class="space-y-2">
                @foreach($doctor->availability as $slot)
                  <div class="flex items-center space-x-2 text-sm">
                    <i class="fas fa-check-circle text-green-500"></i>
                    <span>{{ $days[$slot['day']] ?? ucfirst($slot['day']) }}</span>
                  </div>
                @endforeach
              </div>
            @else
              <p class="text-gray-500 text-sm">Disponibilité non définie</p>
            @endif
          </div>
        </div>
      </aside>

      <!-- Main Form -->
      <div class="lg:col-span-2">
        <div class="bg-white rounded-3xl shadow-xl p-8">

          <!-- Booking Form -->
          <form method="POST" action="{{ route('appointments.store', $doctor->id) }}" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
              <!-- Date Field -->
              <div class="space-y-2">
                <label for="appointment_date" class="block text-sm font-semibold text-gray-700 flex items-center">
                  <i class="fas fa-calendar-alt mr-2 text-green-500"></i>Date du rendez-vous <span class="text-red-500 ml-1">*</span>
                </label>
                <div class="relative">
                  <input type="date" id="appointment_date" name="appointment_date" min="{{ date('Y-m-d') }}"
                         class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 hover:bg-white">
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
                  <i class="fas fa-clock mr-2 text-green-500"></i>Heure du rendez-vous <span class="text-red-500 ml-1">*</span>
                </label>
                <div class="relative">
                  <select id="appointment_time" name="appointment_time"
                          class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 hover:bg-white appearance-none">
                    <option value="">Sélectionnez d'abord une date</option>
                  </select>
                  <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <i class="fas fa-chevron-down text-gray-400"></i>
                  </div>
                </div>
                <input type="time" id="manual_time" name="manual_time" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 mt-2 hidden" step="900">
                <div id="loading-slots" class="hidden mt-2 text-sm text-gray-600 flex items-center">
                  <i class="fas fa-spinner fa-spin mr-2"></i>
                  Chargement des créneaux disponibles...
                </div>
                @error('appointment_time')
                  <p class="text-red-500 text-sm mt-2 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                  </p>
                @enderror
              </div>
            </div>

            <!-- Appointment Type -->
            <div class="space-y-4">
              <label class="block text-sm font-semibold text-gray-700 flex items-center">
                <i class="fas fa-video mr-2 text-purple-500"></i>Type de consultation <span class="text-red-500 ml-1">*</span>
              </label>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="relative flex items-center p-4 bg-gray-50 rounded-xl hover:bg-green-50 cursor-pointer transition-all duration-300 border-2 border-transparent hover:border-green-200">
                  <input type="radio" name="appointment_type" value="in_person" class="text-green-500 focus:ring-green-500" checked>
                  <div class="ml-3">
                    <div class="flex items-center">
                      <i class="fas fa-building mr-2 text-green-500"></i>
                      <span class="font-medium text-gray-900">En personne</span>
                    </div>
                    <p class="text-sm text-gray-600">Consultation au cabinet médical</p>
                  </div>
                </label>
                <label class="relative flex items-center p-4 bg-gray-50 rounded-xl hover:bg-green-50 cursor-pointer transition-all duration-300 border-2 border-transparent hover:border-green-200">
                  <input type="radio" name="appointment_type" value="online" class="text-green-500 focus:ring-green-500">
                  <div class="ml-3">
                    <div class="flex items-center">
                      <i class="fas fa-video mr-2 text-green-500"></i>
                      <span class="font-medium text-gray-900">En ligne</span>
                    </div>
                    <p class="text-sm text-gray-600">Consultation vidéo sécurisée</p>
                  </div>
                </label>
              </div>
              @error('appointment_type')
                <p class="text-red-500 text-sm mt-2 flex items-center">
                  <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
              @enderror
            </div>

            <!-- Notes -->
            <div class="space-y-2">
              <label for="notes" class="block text-sm font-semibold text-gray-700 flex items-center">
                <i class="fas fa-sticky-note mr-2 text-orange-500"></i>Notes (optionnel)
              </label>
              <div class="relative">
                <textarea id="notes" name="notes" rows="4"
                          placeholder="Décrivez brièvement le motif de votre consultation..."
                          class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300 hover:bg-white resize-none">{{ request('message') }}</textarea>
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

            <!-- Summary -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100">
              <div class="flex items-center mb-4">
                <div class="w-10 h-10 bg-gradient-to-r from-green-600 to-emerald-600 rounded-xl flex items-center justify-center mr-3">
                  <i class="fas fa-receipt text-white"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Récapitulatif</h3>
              </div>
              <div class="space-y-3">
                <div class="flex justify-between items-center">
                  <span class="text-gray-600 flex items-center">
                    <i class="fas fa-stethoscope mr-2 text-green-500"></i>Consultation
                  </span>
                  <span class="font-semibold text-gray-900">{{ $doctor->consultation_fee ?? 50 }} DT</span>
                </div>
                <div class="flex justify-between items-center">
                  <span class="text-gray-600 flex items-center">
                    <i class="fas fa-clock mr-2 text-emerald-500"></i>Durée
                  </span>
                  <span class="font-semibold text-gray-900">30 minutes</span>
                </div>
                <hr class="my-3 border-gray-200">
                <div class="flex justify-between items-center text-lg font-bold">
                  <span class="text-gray-900">Total</span>
                  <span class="text-green-600">{{ $doctor->consultation_fee ?? 50 }} DT</span>
                </div>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
              <a href="{{ route('doctors.index') }}"
                 class="inline-flex items-center text-gray-600 hover:text-gray-800 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour aux médecins
              </a>
              <button type="submit"
                      class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-8 py-4 rounded-2xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                <i class="fas fa-calendar-check mr-2"></i>
                Confirmer le rendez-vous
              </button>
            </div>
      </form>
    </div>
  </div>


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
              timeSelect.innerHTML = '<option value="">Aucun créneau disponible - Entrez manuellement</option>';
              manualTime.classList.remove('hidden');
              timeSelect.required = false;
              manualTime.required = true;
              timeSelect.disabled = true;
              manualTime.disabled = false;
              document.querySelector('button[type=submit]').disabled = false;
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