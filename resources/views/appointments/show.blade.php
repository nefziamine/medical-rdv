<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Détails du rendez-vous - RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Tajawal', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  <!-- Appointment Details -->
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
          <h1 class="text-3xl font-bold text-gray-900 mb-2">Détails du rendez-vous</h1>
          <p class="text-gray-600">Informations complètes sur votre rendez-vous</p>
        </div>

        <!-- Status Badge -->
        <div class="mb-6">
          <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
            @if($appointment->status === 'confirmed') bg-green-100 text-green-800
            @elseif($appointment->status === 'completed') bg-blue-100 text-blue-800
            @elseif($appointment->status === 'cancelled') bg-red-100 text-red-800
            @else bg-yellow-100 text-yellow-800 @endif">
            {{ ucfirst($appointment->status) }}
          </span>
        </div>

        <!-- Patient Information -->
        <div class="bg-gray-50 rounded-lg p-6 mb-6">
          <h3 class="text-lg font-semibold mb-4">Informations du patient</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <p class="text-sm text-gray-600">Nom</p>
              <p class="font-medium">{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</p>
            </div>
            <div>
              <p class="text-sm text-gray-600">Email</p>
              <p class="font-medium">{{ $appointment->patient->email }}</p>
            </div>
            <div>
              <p class="text-sm text-gray-600">Téléphone</p>
              <p class="font-medium">{{ $appointment->patient->phone ?? 'Non renseigné' }}</p>
            </div>
            <div>
              <p class="text-sm text-gray-600">Adresse</p>
              <p class="font-medium">{{ $appointment->patient->address ?? 'Non renseignée' }}</p>
            </div>
          </div>
        </div>

        <!-- Appointment Details -->
        <div class="bg-gray-50 rounded-lg p-6 mb-6">
          <h3 class="text-lg font-semibold mb-4">Détails du rendez-vous</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <p class="text-sm text-gray-600">Date</p>
              <p class="font-medium">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</p>
            </div>
            <div>
              <p class="text-sm text-gray-600">Heure</p>
              <p class="font-medium">{{ $appointment->appointment_time }}</p>
            </div>
            <div>
              <p class="text-sm text-gray-600">Type de consultation</p>
              <p class="font-medium">{{ $appointment->appointment_type === 'in_person' ? 'En personne' : 'En ligne' }}</p>
            </div>
            <div>
              <p class="text-sm text-gray-600">Frais de consultation</p>
              <p class="font-medium">{{ $appointment->fee }} DT</p>
            </div>
          </div>
        </div>

        <!-- Notes -->
        @if($appointment->notes)
        <div class="bg-gray-50 rounded-lg p-6 mb-6">
          <h3 class="text-lg font-semibold mb-4">Notes</h3>
          <p class="text-gray-700">{{ $appointment->notes }}</p>
        </div>
        @endif

        <!-- Actions -->
        <div class="flex items-center justify-between pt-6">
          <a href="{{ route('appointments.index') }}" 
             class="text-gray-600 hover:text-gray-800 transition">
            ← Retour aux rendez-vous
          </a>
          
          <div class="flex space-x-3">
            @if($appointment->status === 'pending')
              <a href="{{ route('appointments.edit', $appointment->id) }}" 
                 class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">
                Modifier
              </a>
              <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        onclick="return confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous ?')"
                        class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition">
                  Annuler
                </button>
              </form>
            @endif
          </div>
        </div>
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