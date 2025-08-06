<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Choisir le type de connexion - RDV Médical</title>
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
          <span class="text-sm text-gray-600">Je suis un professionnel de santé (Inscription gratuite!)</span>
          <a href="/login" class="text-red-500 font-semibold">Connexion</a>
          <a href="/register" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">S'inscrire</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      
      <!-- Logo -->
      <div class="text-center">
        <div class="flex justify-center mb-6">
          <div class="relative w-20 h-20">
            <!-- Black figure -->
            <div class="absolute left-0 w-10 h-16 bg-black rounded-full transform rotate-12"></div>
            <!-- Red figure -->
            <div class="absolute right-0 w-10 h-16 bg-red-500 rounded-full transform -rotate-12"></div>
            <!-- Heart shape -->
            <div class="absolute inset-0 flex items-center justify-center">
              <div class="w-8 h-8 bg-red-500 transform rotate-45 rounded-sm"></div>
            </div>
          </div>
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Choisir le type d'utilisateur</h2>
        <p class="text-gray-600">Sélectionnez votre type de compte pour vous connecter</p>
      </div>

      <!-- Choice Cards -->
      <div class="space-y-4">
        
        <!-- Patient Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-2 border-transparent hover:border-red-500 transition-all duration-300 cursor-pointer" 
             onclick="window.location.href='{{ route('login.patient') }}'">
          <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
              <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
              </svg>
            </div>
            <div class="flex-1">
              <h3 class="text-lg font-semibold text-gray-900">Patient</h3>
              <p class="text-sm text-gray-600">Je veux accéder à mon compte patient</p>
            </div>
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </div>
        </div>

        <!-- Doctor Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-2 border-transparent hover:border-red-500 transition-all duration-300 cursor-pointer" 
             onclick="window.location.href='{{ route('login.doctor') }}'">
          <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
              <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <div class="flex-1">
              <h3 class="text-lg font-semibold text-gray-900">Médecin</h3>
              <p class="text-sm text-gray-600">Je suis un professionnel de santé</p>
            </div>
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </div>
        </div>

      </div>

      <!-- Back to Register -->
      <div class="text-center">
        <p class="text-gray-600">
          Pas encore de compte ? 
          <a href="{{ route('register') }}" class="text-red-500 hover:text-red-600 font-semibold">
            S'inscrire ici
          </a>
        </p>
      </div>

    </div>
  </div>

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