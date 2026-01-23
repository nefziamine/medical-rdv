<nav class="bg-white shadow-sm sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center py-4">
      <div class="flex items-center">
        <a href="/" class="text-2xl font-bold text-red-500">RDV Médical</a>
      </div>
      <div class="hidden md:flex items-center space-x-8">
        <a href="/" class="{{ request()->is('/') ? 'text-red-500 font-semibold' : 'text-gray-600 hover:text-red-500 transition' }}">Accueil</a>
        <a href="/doctors" class="{{ request()->is('doctors*') ? 'text-red-500 font-semibold' : 'text-gray-600 hover:text-red-500 transition' }}">Médecins</a>
        <a href="/specialties" class="{{ request()->is('specialties*') ? 'text-red-500 font-semibold' : 'text-gray-600 hover:text-red-500 transition' }}">Spécialités</a>
        <a href="/contact" class="{{ request()->is('contact') ? 'text-red-500 font-semibold' : 'text-gray-600 hover:text-red-500 transition' }}">Contact</a>
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
            <span class="text-sm text-gray-600">Je suis un professionnel de santé (Inscription gratuite!)</span>
            <a href="/login" class="text-gray-600 hover:text-red-500 transition">Connexion</a>
            <a href="/register" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">S'inscrire</a>
          @endauth
        </div>
    </div>
  </div>
</nav> 