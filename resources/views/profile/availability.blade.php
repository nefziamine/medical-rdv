<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestion de la disponibilité - RDV Médical</title>
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
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <section class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      
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

      <!-- Header -->
      <div class="mb-8">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-3xl font-bold text-gray-900">Gestion de la disponibilité</h1>
            <p class="text-gray-600 mt-2">Définissez vos créneaux de consultation</p>
          </div>
          <a href="{{ route('profile') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
            Retour au profil
          </a>
        </div>
      </div>

      <!-- Availability Form -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <form method="POST" action="{{ route('profile.availability.update') }}" id="availabilityForm">
          @csrf
          
          <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Créneaux de disponibilité</h3>
            <p class="text-sm text-gray-600 mb-4">Ajoutez vos créneaux de consultation pour chaque jour de la semaine.</p>
          </div>

          <div id="availabilitySlots" class="space-y-4">
            @if(isset($availability) && count($availability) > 0)
              @foreach($availability as $index => $slot)
                <div class="availability-slot border border-gray-200 rounded-lg p-4">
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-2">Jour</label>
                      <select name="availability[{{ $index }}][day]" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        <option value="monday" {{ isset($slot['day']) && $slot['day'] == 'monday' ? 'selected' : '' }}>Lundi</option>
                        <option value="tuesday" {{ isset($slot['day']) && $slot['day'] == 'tuesday' ? 'selected' : '' }}>Mardi</option>
                        <option value="wednesday" {{ isset($slot['day']) && $slot['day'] == 'wednesday' ? 'selected' : '' }}>Mercredi</option>
                        <option value="thursday" {{ isset($slot['day']) && $slot['day'] == 'thursday' ? 'selected' : '' }}>Jeudi</option>
                        <option value="friday" {{ isset($slot['day']) && $slot['day'] == 'friday' ? 'selected' : '' }}>Vendredi</option>
                        <option value="saturday" {{ isset($slot['day']) && $slot['day'] == 'saturday' ? 'selected' : '' }}>Samedi</option>
                        <option value="sunday" {{ isset($slot['day']) && $slot['day'] == 'sunday' ? 'selected' : '' }}>Dimanche</option>
                      </select>
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-2">De</label>
                      <input type="time" name="availability[{{ $index }}][from]" value="{{ isset($slot['from']) ? $slot['from'] : '' }}" 
                             class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-2">À</label>
                      <input type="time" name="availability[{{ $index }}][to]" value="{{ isset($slot['to']) ? $slot['to'] : '' }}" 
                             class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    </div>
                  </div>
                  <button type="button" class="remove-slot mt-3 text-red-500 hover:text-red-700 text-sm font-medium">
                    Supprimer ce créneau
                  </button>
                </div>
              @endforeach
            @else
              <div class="availability-slot border border-gray-200 rounded-lg p-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jour</label>
                    <select name="availability[0][day]" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                      <option value="">Sélectionner un jour</option>
                      <option value="monday">Lundi</option>
                      <option value="tuesday">Mardi</option>
                      <option value="wednesday">Mercredi</option>
                      <option value="thursday">Jeudi</option>
                      <option value="friday">Vendredi</option>
                      <option value="saturday">Samedi</option>
                      <option value="sunday">Dimanche</option>
                    </select>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">De</label>
                    <input type="time" name="availability[0][from]" 
                           class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">À</label>
                    <input type="time" name="availability[0][to]" 
                           class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                  </div>
                </div>
                <button type="button" class="remove-slot mt-3 text-red-500 hover:text-red-700 text-sm font-medium">
                  Supprimer ce créneau
                </button>
              </div>
            @endif
          </div>

          <div class="mt-6">
            <button type="button" id="addSlot" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
              <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
              Ajouter un créneau
            </button>
          </div>

          <div class="mt-8 flex space-x-4">
            <button type="submit" class="bg-red-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-600 transition">
              Sauvegarder la disponibilité
            </button>
            <a href="{{ route('profile') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-600 transition">
              Annuler
            </a>
          </div>
        </form>
      </div>

      <!-- Current Availability Display -->
      @if(isset($availability) && count($availability) > 0)
        <div class="mt-8 bg-white rounded-lg shadow-md p-6">
          <h3 class="text-lg font-semibold text-gray-900 mb-4">Disponibilité actuelle</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
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
            @foreach($availability as $slot)
              <div class="border border-gray-200 rounded-lg p-3">
                <div class="font-medium text-gray-900">{{ isset($days[$slot['day']]) ? $days[$slot['day']] : ucfirst($slot['day']) }}</div>
                <div class="text-sm text-gray-600">{{ isset($slot['from']) ? $slot['from'] : '' }} - {{ isset($slot['to']) ? $slot['to'] : '' }}</div>
              </div>
            @endforeach
          </div>
        </div>
      @endif
    </div>
  </section>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let slotIndex = {{ isset($availability) && count($availability) > 0 ? count($availability) : 1 }};
      
      // Function to get next available day
      function getNextAvailableDay() {
        const days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        const existingDays = [];
        
        // Get all existing selected days
        document.querySelectorAll('select[name*="[day]"]').forEach(select => {
          if (select.value && select.value !== '') {
            existingDays.push(select.value);
          }
        });
        
        // Find the first day that's not already selected
        for (let day of days) {
          if (!existingDays.includes(day)) {
            return day;
          }
        }
        
        // If all days are selected, return empty
        return '';
      }
      
      // Add new slot
      document.getElementById('addSlot').addEventListener('click', function() {
        const container = document.getElementById('availabilitySlots');
        const newSlot = document.createElement('div');
        newSlot.className = 'availability-slot border border-gray-200 rounded-lg p-4';
        
        const nextDay = getNextAvailableDay();
        const selectedAttribute = nextDay ? `selected` : '';
        
        newSlot.innerHTML = `
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Jour</label>
              <select name="availability[${slotIndex}][day]" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                <option value="">Sélectionner un jour</option>
                <option value="monday" ${nextDay === 'monday' ? 'selected' : ''}>Lundi</option>
                <option value="tuesday" ${nextDay === 'tuesday' ? 'selected' : ''}>Mardi</option>
                <option value="wednesday" ${nextDay === 'wednesday' ? 'selected' : ''}>Mercredi</option>
                <option value="thursday" ${nextDay === 'thursday' ? 'selected' : ''}>Jeudi</option>
                <option value="friday" ${nextDay === 'friday' ? 'selected' : ''}>Vendredi</option>
                <option value="saturday" ${nextDay === 'saturday' ? 'selected' : ''}>Samedi</option>
                <option value="sunday" ${nextDay === 'sunday' ? 'selected' : ''}>Dimanche</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">De</label>
              <input type="time" name="availability[${slotIndex}][from]" 
                     class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">À</label>
              <input type="time" name="availability[${slotIndex}][to]" 
                     class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
            </div>
          </div>
          <button type="button" class="remove-slot mt-3 text-red-500 hover:text-red-700 text-sm font-medium">
            Supprimer ce créneau
          </button>
        `;
        container.appendChild(newSlot);
        slotIndex++;
      });
      
      // Remove slot
      document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-slot')) {
          const slots = document.querySelectorAll('.availability-slot');
          if (slots.length > 1) {
            e.target.closest('.availability-slot').remove();
          } else {
            alert('Vous devez avoir au moins un créneau de disponibilité.');
          }
        }
      });
    });
  </script>
</body>
</html> 