<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Supprimer le compte - RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Tajawal', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

  <!-- Delete Account Section -->
  <section class="py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Header -->
      <div class="mb-8">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-3xl font-bold text-gray-900">Supprimer le compte</h1>
            <p class="text-gray-600 mt-2">Cette action est irréversible</p>
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

      <!-- Warning Box -->
      <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-8">
        <div class="flex items-center">
          <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
          </svg>
          <div>
            <h3 class="text-lg font-semibold text-red-800">Attention !</h3>
            <p class="text-red-700 mt-1">La suppression de votre compte est définitive et irréversible. Toutes vos données seront perdues.</p>
          </div>
        </div>
      </div>

      <!-- Delete Account Form -->
      <div class="bg-white rounded-lg shadow-md p-8">
        <form method="POST" action="{{ route('profile.delete') }}" class="space-y-6">
          @csrf
          @method('DELETE')
          
          <!-- Mot de passe de confirmation -->
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
              Confirmer avec votre mot de passe *
            </label>
            <div class="relative">
              <input type="password" id="password" name="password" required
                     class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent pr-10 @error('password') border-red-500 @enderror"
                     placeholder="Entrez votre mot de passe pour confirmer">
              <button type="button" onclick="togglePassword('password')" 
                      class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
              </button>
            </div>
            @error('password')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Checkbox de confirmation -->
          <div class="flex items-center">
            <input type="checkbox" id="confirm_delete" name="confirm_delete" required
                   class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
            <label for="confirm_delete" class="ml-2 block text-sm text-gray-900">
              Je comprends que cette action est irréversible et que toutes mes données seront supprimées définitivement
            </label>
          </div>

          <!-- Submit Button -->
          <div class="flex justify-end space-x-4">
            <a href="/profile" 
               class="bg-gray-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-600 transition">
              Annuler
            </a>
            <button type="submit" 
                    class="bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition">
              Supprimer définitivement mon compte
            </button>
          </div>

        </form>
      </div>

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

  <script>
    function togglePassword(inputId) {
      const input = document.getElementById(inputId);
      const type = input.type === 'password' ? 'text' : 'password';
      input.type = type;
    }
  </script>
</body>
</html> 