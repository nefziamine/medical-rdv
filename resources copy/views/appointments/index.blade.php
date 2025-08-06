<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mes rendez-vous - RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Tajawal', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  @php
    $user = Auth::user();
@endphp
<a href="{{ route('profile') }}" class="inline-flex items-center mb-6 text-red-500 hover:text-red-700 font-semibold">
    <svg class="w-5 h-5 mr-2 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a1 1 0 01-1-1V5.414l5.293 5.293a1 1 0 01-1.414 1.414l-7-7a1 1 0 010-1.414l7-7a1 1 0 011.414 1.414L9 4.586V17a1 1 0 01-1 1z" clip-rule="evenodd"/></svg>
    Retour au profil
</a>
  <!-- Appointments List -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-2">Mes rendez-vous</h1>
      <p class="text-gray-600">Gérez vos rendez-vous médicaux</p>
    </div>

    @if(session('success'))
      <div class="alert alert-success bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger bg-red-100 text-red-800 p-2 rounded mb-4">
        @foreach($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    @if($appointments->count() > 0)
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @foreach($appointments as $appointment)
        <div class="bg-white rounded-lg shadow-md p-6">
          <div class="flex items-start justify-between mb-4">
            <div class="flex items-center space-x-1">
              <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
              </div>
              <div>
                <h3 class="text-lg font-semibold text-gray-900">
                  {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}
                </h3>
                <p class="text-sm text-gray-600">
                  {{ $appointment->patient->email }}<br>
                  {{ $appointment->patient->phone ?? 'Non renseigné' }}<br>
                  {{ $appointment->patient->address ?? 'Non renseignée' }}
                </p>
              </div>
            </div>
            <div class="text-right">
              @if($appointment->status === 'pending')
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                  En attente
                </span>
              @elseif($appointment->status === 'confirmed')
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                  Confirmé
                </span>
              @elseif($appointment->status === 'completed')
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                  Terminé
                </span>
              @elseif($appointment->status === 'cancelled')
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                  Annulé
                </span>
              @endif
            </div>
          </div>

          <div class="space-y-3 mb-4">
            <div class="flex items-center text-sm text-gray-600">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
              @php
                $date = $appointment->appointment_date;
                $time = $appointment->appointment_time;
                $dayName = \Carbon\Carbon::parse($date)->locale('fr')->isoFormat('dddd');
                $slot = null;
                if ($appointment->doctor && $appointment->doctor->availability) {
                  foreach ($appointment->doctor->availability as $av) {
                    if (strtolower($av['day']) === strtolower($dayName)
                        && $time >= $av['from'] && $time < $av['to']) {
                      $slot = $av;
                      break;
                    }
                  }
                }
              @endphp
              {{ $date->format('d/m/Y') }} ({{ ucfirst($dayName) }}) à {{ is_string($time) ? $time : \Carbon\Carbon::parse($time)->format('H:i') }}
              @if($slot)
                <span class="ml-2 text-xs text-gray-500">[Dispo: {{ $slot['from'] }} - {{ $slot['to'] }}]</span>
              @endif
            </div>
            
            <div class="flex items-center text-sm text-gray-600">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
              @if(auth()->user()->isDoctor())
                {{ $appointment->patient->address ?? 'Adresse non renseignée' }}
              @else
                {{ $appointment->doctor->clinic_address }}
              @endif
            </div>

            <div class="flex items-center text-sm text-gray-600">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
              </svg>
              {{ $appointment->fee }} DT
            </div>

            @if($appointment->appointment_type === 'online')
            <div class="flex items-center text-sm text-blue-600">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
              </svg>
              Consultation en ligne
            </div>
            @endif
          </div>

          @if($appointment->notes)
          <div class="bg-gray-50 rounded-lg p-3 mb-4">
            <p class="text-sm text-gray-700">{{ $appointment->notes }}</p>
          </div>
          @endif

          <div class="flex items-center justify-between">
            <div class="flex space-x-2">
              <a href="{{ route('appointments.show', $appointment->id) }}" 
                 class="text-red-500 hover:text-red-600 text-sm font-medium">
                Voir détails
              </a>
              
              @if(auth()->user()->isDoctor() && $appointment->status === 'pending')
                <form method="POST" action="{{ route('appointments.confirm', $appointment->id) }}" class="inline">
                  @csrf
                  <button type="submit" class="text-green-500 hover:text-green-600 text-sm font-medium">
                    Confirmer
                  </button>
                </form>
              @endif
            </div>
            
            <div class="flex space-x-2">
              @if($appointment->status === 'pending' && auth()->user()->isPatient())
              <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        onclick="return confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous ?')"
                        class="text-red-500 hover:text-red-600 text-sm font-medium">
                  Annuler
                </button>
              </form>
              @endif
              
              @if($appointment->status === 'cancelled' && auth()->user()->isPatient())
              <form method="POST" action="{{ route('appointments.force-delete', $appointment->id) }}" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement ce rendez-vous ? Cette action est irréversible.')"
                        class="text-gray-500 hover:text-gray-700 text-sm font-medium">
                  Supprimer définitivement
                </button>
              </form>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <div class="mt-8">
        {{ $appointments->links() }}
      </div>
    @else
      <div class="text-center py-12">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Aucun rendez-vous</h3>
        <p class="text-gray-600 mb-6">
          @if(auth()->user()->isDoctor())
            Vous n'avez pas encore de rendez-vous programmés.
          @else
            Vous n'avez pas encore pris de rendez-vous.
          @endif
        </p>
        @if(!auth()->user()->isDoctor())
        <a href="/doctors" class="bg-red-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-600 transition">
          Prendre un rendez-vous
        </a>
        @else
        <a href="/profile/availability" class="bg-red-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-600 transition">
          Gérer ma disponibilité
        </a>
        @endif
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