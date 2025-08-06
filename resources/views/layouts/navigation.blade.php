<nav class="w-full bg-white/90 backdrop-blur-lg shadow-lg py-3 px-6 flex items-center justify-between border-b border-gray-200 sticky top-0 z-50">
    <div class="flex items-center gap-2">
        <img src="https://img.icons8.com/ios-filled/40/4e73df/stethoscope.png" alt="Logo" class="h-8 w-8">
        <span class="text-xl font-bold text-blue-700">Medical RDV</span>
    </div>
    <div class="flex gap-6 items-center">
        <a href="/" class="text-gray-700 hover:text-blue-700 font-medium transition">Accueil</a>
        <a href="{{ route('profile.doctor') }}#infos" class="text-gray-700 hover:text-blue-700 font-medium transition">Profil</a>
        @auth
            <div class="flex items-center space-x-2 bg-transparent">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <span class="text-gray-800 font-medium">{{ Auth::user()->first_name }}</span>
                <svg class="w-4 h-4 text-gray-500 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        @endauth
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-red-600 hover:underline font-medium transition bg-transparent border-0 cursor-pointer">Déconnexion</button>
        </form>
    </div>
</nav> 