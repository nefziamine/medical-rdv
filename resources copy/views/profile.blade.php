<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mon Profil - RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
          <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center space-x-2 text-gray-600 hover:text-red-500 transition">
              <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                <span class="text-red-500 font-bold text-sm">{{ substr(Auth::user()->first_name, 0, 1) }}</span>
              </div>
              <span>{{ Auth::user()->first_name }}</span>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            
            <!-- Dropdown Menu -->
            <div x-show="open" @click.away="open = false" 
                 class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
              <a href="{{ Auth::user()->isDoctor() ? route('profile.doctor') : route('profile.patient') }}" 
                 class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                  Informations personnelles
                </div>
              </a>
              <a href="{{ route('profile.password') }}" 
                 class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                  </svg>
                  Changer mot de passe
                </div>
              </a>
              <hr class="my-1">
              <a href="{{ route('profile.delete.confirm') }}" 
                 class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                  </svg>
                  Supprimer le compte
                </div>
              </a>
              <hr class="my-1">
              <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Déconnexion
                  </div>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Profile Section -->
  <section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
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
      
      <!-- Dashboard Section -->
      <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Tableau de bord</h2>
        
        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          @php
            if(Auth::check() && Auth::user()->isDoctor()) {
              $totalAppointments = Auth::user()->doctor->appointments()->count();
              $pendingAppointments = Auth::user()->doctor->appointments()->where('status', 'pending')->count();
              $confirmedAppointments = Auth::user()->doctor->appointments()->where('status', 'confirmed')->count();
              $completedAppointments = Auth::user()->doctor->appointments()->where('status', 'completed')->count();
            } else if(Auth::check() && Auth::user()->isPatient()) {
              $totalAppointments = Auth::user()->patientAppointments()->count();
              $pendingAppointments = Auth::user()->patientAppointments()->where('status', 'pending')->count();
              $confirmedAppointments = Auth::user()->patientAppointments()->where('status', 'confirmed')->count();
              $completedAppointments = Auth::user()->patientAppointments()->where('status', 'completed')->count();
            } else {
              $totalAppointments = 0;
              $pendingAppointments = 0;
              $confirmedAppointments = 0;
              $completedAppointments = 0;
            }
          @endphp
          
          <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
              <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-600">Total RDV</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalAppointments }}</p>
              </div>
            </div>
          </div>
          
          <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
              <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-600">En attente</p>
                <p class="text-2xl font-bold text-gray-900">{{ $pendingAppointments }}</p>
              </div>
            </div>
          </div>
          
          <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
              <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-600">Confirmés</p>
                <p class="text-2xl font-bold text-gray-900">{{ $confirmedAppointments }}</p>
              </div>
            </div>
          </div>
          
          <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
              <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-600">Terminés</p>
                <p class="text-2xl font-bold text-gray-900">{{ $completedAppointments }}</p>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Actions rapides -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
          @if(Auth::user()->isDoctor())
            <a href="/profile/availability" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
              <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                  <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900">Gérer disponibilité</h3>
                  <p class="text-sm text-gray-600">Définir mes créneaux</p>
                </div>
              </div>
            </a>
          @else
            <a href="/doctors" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
              <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                  <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900">Trouver un médecin</h3>
                  <p class="text-sm text-gray-600">Prendre un rendez-vous</p>
                </div>
              </div>
            </a>
          @endif
          
          <a href="/appointments" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
            <div class="flex items-center">
              <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
              </div>
              <div>
                <h3 class="font-semibold text-gray-900">Mes rendez-vous</h3>
                <p class="text-sm text-gray-600">Voir tous mes RDV</p>
              </div>
            </div>
          </a>
          
          <a href="{{ route('profile.patient') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
            <div class="flex items-center">
              <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
              </div>
              <div>
                <h3 class="font-semibold text-gray-900">Mon profil</h3>
                <p class="text-sm text-gray-600">Modifier mes infos</p>
              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-center mb-6">
              <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-red-500 font-bold text-2xl">{{ substr(Auth::user()->first_name, 0, 1) }}</span>
              </div>
              <h2 class="text-xl font-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
              <p class="text-gray-600">{{ ucfirst(Auth::user()->user_type) }}</p>
            </div>
            
            <nav class="space-y-2">
              <a href="{{ route('profile.patient') }}" class="flex items-center px-4 py-2 text-red-500 bg-red-50 rounded-lg">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Mon Profil
              </a>
              <a href="#password" class="flex items-center px-4 py-2 text-gray-600 hover:text-red-500 hover:bg-red-50 rounded-lg transition">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                Mot de passe
              </a>
              <a href="#appointments" class="flex items-center px-4 py-2 text-gray-600 hover:text-red-500 hover:bg-red-50 rounded-lg transition">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Mes Rendez-vous
              </a>
              <a href="#history" class="flex items-center px-4 py-2 text-gray-600 hover:text-red-500 hover:bg-red-50 rounded-lg transition">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Historique
              </a>
            </nav>
          </div>
        </div>

        <!-- Main Content (Réorganisé) -->
        <div class="lg:col-span-2">
          <!-- Section Notifications -->
          @if(Auth::user()->unreadNotifications->count() > 0)
              <div class="mb-6">
                  <div class="bg-blue-100 border border-blue-400 text-blue-800 px-4 py-3 rounded">
                      <strong>Notifications :</strong>
                      <ul class="mt-2">
                          @foreach(Auth::user()->unreadNotifications as $notification)
                              <li class="mb-1">
                                  @if(isset($notification->data['date']) && isset($notification->data['time']))
                                      Nouveau rendez-vous le <strong>{{ \Carbon\Carbon::parse($notification->data['date'])->format('d/m/Y') }}</strong> à <strong>{{ $notification->data['time'] }}</strong>
                                  @else
                                      {{ $notification->data['message'] ?? 'Nouvelle notification' }}
                                  @endif
                                  <form method="POST" action="{{ route('notifications.read', $notification->id) }}" class="inline">
                                      @csrf
                                      <button type="submit" class="ml-2 text-xs text-blue-600 hover:underline">Marquer comme lue</button>
                                  </form>
                              </li>
                          @endforeach
                      </ul>
                  </div>
              </div>
          @endif

          <!-- Section Rendez-vous (Doctor) -->
          @if(Auth::user()->isDoctor())
              @if($errors->any())
                  <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                      <ul class="list-disc list-inside">
                          @foreach($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              @if(session('success'))
                  <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                      {{ session('success') }}
                  </div>
              @endif
              <!-- Section rendez-vous patients à confirmer -->
              <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                  <h3 class="text-xl font-bold mb-6">Rendez-vous patients</h3>
                  @php
                      $doctorAppointments = Auth::check() && Auth::user()->doctor ? Auth::user()->doctor->appointments()->with('patient')->latest()->get() : collect();
                  @endphp
                  @if($doctorAppointments->count() > 0)
                      <ul>
                          @foreach($doctorAppointments as $appointment)
                              <li class="mb-4 border-b pb-2">
                                  <div>
                                      <strong>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }} à {{ $appointment->appointment_time }}</strong>
                                      - {{ $appointment->patient->full_name }}
                                      ({{ ucfirst($appointment->status) }})
                                  </div>
                                  @if($appointment->status === 'pending')
                                      <div class="flex space-x-2 mt-2">
                                          <form method="POST" action="{{ route('appointments.confirm', $appointment->id) }}" class="inline">
                                              @csrf
                                              <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-600 transition">
                                                  Confirmer
                                              </button>
                                          </form>
                                          <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" class="inline">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir refuser ce rendez-vous ?')" class="bg-orange-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-orange-600 transition">
                                                  Refuser
                                              </button>
                                          </form>
                                      </div>
                                  @endif
                              </li>
                          @endforeach
                      </ul>
                  @else
                      <p>Aucun rendez-vous patient.</p>
                  @endif
              </div>
          @endif

          <!-- Section Rendez-vous (Patient) -->
          @if(Auth::user()->isPatient())
              <div id="appointments" class="bg-white rounded-lg shadow-md p-6 mb-6">
                  <div class="flex justify-between items-center mb-6">
                      <h3 class="text-xl font-bold">Mes Rendez-vous</h3>
                      <a href="{{ route('doctors.index') }}" class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                          </svg>
                          Prendre un rendez-vous
                      </a>
                  </div>
                  @php
                      $userAppointments = Auth::user()->patientAppointments()->with('doctor.user', 'doctor.specialty')->latest()->limit(5)->get();
                  @endphp
                  @if($userAppointments->count() > 0)
                      <div class="space-y-4">
                          @foreach($userAppointments as $appointment)
                          <div class="border border-gray-200 rounded-lg p-4">
                              <!-- Debug temporaire -->
                              <div class="mb-2 text-xs text-gray-400">
                                  <strong>Debug:</strong> Mon ID: {{ Auth::user()->id }} | Patient du RDV: {{ $appointment->patient_id }}
                              </div>
                              <div class="flex justify-between items-start">
                                  <div>
                                      <h4 class="font-semibold">Dr. {{ $appointment->doctor && $appointment->doctor->user ? $appointment->doctor->user->first_name . ' ' . $appointment->doctor->user->last_name : 'Nom non disponible' }}</h4>
                                      <p class="text-gray-600">{{ $appointment->doctor->specialty ? $appointment->doctor->specialty->name : 'Spécialité non disponible' }}</p>
                                      <p class="text-sm text-gray-500">📍 {{ $appointment->doctor->clinic_address ?? 'Adresse non disponible' }}</p>
                                  </div>
                                  <div class="text-right">
                                      <p class="font-semibold text-green-600">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }} à {{ $appointment->appointment_time }}</p>
                                      <p class="text-sm text-gray-500">💰 {{ $appointment->fee }} DT</p>
                                  </div>
                              </div>
                              <div class="mt-4 flex space-x-2">
                                  <!-- Bouton Voir les détails pour tous les rendez-vous -->
                                  <a href="{{ route('appointments.show', $appointment->id) }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-600 transition">
                                      Voir les détails
                                  </a>
                                  
                                  @if($appointment->status === 'pending')
                                      <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" class="inline">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous ?')" class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600 transition">
                                              Annuler
                                          </button>
                                      </form>
                                  @endif
                              </div>
                          </div>
                          @endforeach
                      </div>
                  @else
                      <div class="text-center py-8">
                          <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                          </svg>
                          <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun rendez-vous</h3>
                          <p class="text-gray-600 mb-4">Vous n'avez pas encore de rendez-vous programmés.</p>
                      </div>
                  @endif
              </div>
          @endif

          <!-- Section Historique Médical -->
          <div id="history" class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold mb-6">Historique médical</h3>
            @php
                $completedAppointments = Auth::user()->patientAppointments()->with('doctor.user', 'doctor.specialty')->where('status', 'completed')->latest()->limit(5)->get();
            @endphp
            
            @if($completedAppointments->count() > 0)
              <div class="space-y-4">
                @foreach($completedAppointments as $appointment)
                <div class="border border-gray-200 rounded-lg p-4">
                  <div class="flex justify-between items-start">
                    <div>
                      <h4 class="font-semibold">Consultation - {{ $appointment->doctor->specialty ? $appointment->doctor->specialty->name : 'Spécialité non disponible' }}</h4>
                      <p class="text-gray-600">Dr. {{ $appointment->doctor && $appointment->doctor->user ? $appointment->doctor->user->first_name . ' ' . $appointment->doctor->user->last_name : 'Nom non disponible' }}</p>
                      <p class="text-sm text-gray-500">📍 {{ $appointment->doctor->clinic_address ?? 'Adresse non disponible' }}</p>
                    </div>
                    <div class="text-right">
                      <p class="font-semibold text-gray-600">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</p>
                      <p class="text-sm text-gray-500">💰 {{ $appointment->fee }} DT</p>
                    </div>
                  </div>
                  <div class="mt-2">
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Terminé</span>
                  </div>
                </div>
                @endforeach
              </div>
            @else
              <div class="text-center py-8">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun historique</h3>
                <p class="text-gray-600">Vous n'avez pas encore de consultations terminées.</p>
              </div>
            @endif
          </div>

          <!-- Section Disponibilité (Doctor) -->
          @if(Auth::user()->isDoctor())
              <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                  <div class="flex justify-between items-center mb-4">
                      <h3 class="text-xl font-bold">Disponibilité</h3>
                      <a href="{{ route('profile.availability') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Gérer ma disponibilité</a>
                  </div>
                  <table class="min-w-full text-sm text-left border">
                      <thead>
                          <tr>
                              <th class="px-4 py-2 border-b">Jour</th>
                              <th class="px-4 py-2 border-b">De</th>
                              <th class="px-4 py-2 border-b">À</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach(Auth::user()->doctor->availability ?? [] as $slot)
                              <tr>
                                  <td class="px-4 py-2 border-b">{{ ucfirst($slot['day']) }}</td>
                                  <td class="px-4 py-2 border-b">{{ $slot['from'] }}</td>
                                  <td class="px-4 py-2 border-b">{{ $slot['to'] }}</td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          @endif
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
    // Navigation fluide par ancres
    document.addEventListener('DOMContentLoaded', function() {
      const navLinks = document.querySelectorAll('nav a[href^="#"]');
      
      navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          const targetId = this.getAttribute('href').substring(1);
          const targetElement = document.getElementById(targetId);
          
          if (targetElement) {
            targetElement.scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            });
          }
        });
      });

      // Mise à jour de l'onglet actif dans la navigation
      function updateActiveNav() {
        const sections = document.querySelectorAll('div[id]');
        const navLinks = document.querySelectorAll('nav a[href^="#"]');
        
        let current = '';
        sections.forEach(section => {
          const sectionTop = section.offsetTop;
          const sectionHeight = section.clientHeight;
          if (window.pageYOffset >= sectionTop - 200) {
            current = section.getAttribute('id');
          }
        });

        navLinks.forEach(link => {
          link.classList.remove('text-red-500', 'bg-red-50');
          link.classList.add('text-gray-600', 'hover:text-red-500', 'hover:bg-red-50');
        });

        const activeLink = document.querySelector(`nav a[href="#${current}"]`);
        if (activeLink) {
          activeLink.classList.remove('text-gray-600', 'hover:text-red-500', 'hover:bg-red-50');
          activeLink.classList.add('text-red-500', 'bg-red-50');
        }
      }

      window.addEventListener('scroll', updateActiveNav);
      updateActiveNav();
    });

    // Validation des formulaires
    document.addEventListener('DOMContentLoaded', function() {
      const profileForm = document.querySelector('form[action*="profile.update"]');
      const passwordForm = document.querySelector('form[action*="profile.password"]');
      
      if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
          const requiredFields = this.querySelectorAll('input[required], textarea[required]');
          let isValid = true;
          
          requiredFields.forEach(field => {
            if (!field.value.trim()) {
              field.classList.add('border-red-500');
              isValid = false;
            } else {
              field.classList.remove('border-red-500');
            }
          });
          
          if (!isValid) {
            e.preventDefault();
            alert('Veuillez remplir tous les champs obligatoires.');
          }
        });
      }
      
      if (passwordForm) {
        passwordForm.addEventListener('submit', function(e) {
          const password = this.querySelector('input[name="password"]');
          const confirmPassword = this.querySelector('input[name="password_confirmation"]');
          
          if (password.value !== confirmPassword.value) {
            e.preventDefault();
            alert('Les mots de passe ne correspondent pas.');
            return;
          }
          
          if (password.value.length < 8) {
            e.preventDefault();
            alert('Le mot de passe doit contenir au moins 8 caractères.');
            return;
          }
        });
      }
    });
  </script>
</body>
</html> 