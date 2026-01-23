<nav class="w-full bg-white/95 dark:bg-gray-900/95 backdrop-blur-md shadow-lg border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-green-600 to-emerald-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-stethoscope text-white text-lg"></i>
                </div>
                <a href="/" class="text-2xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">RDV Médical</a>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 font-medium transition-colors duration-200 relative group">
                    <i class="fas fa-home mr-2 text-green-500"></i>Accueil
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="/doctors" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 font-medium transition-colors duration-200 relative group">
                    <i class="fas fa-user-md mr-2 text-emerald-500"></i>Médecins
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="/specialties" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 font-medium transition-colors duration-200 relative group">
                    <i class="fas fa-stethoscope mr-2 text-teal-500"></i>Spécialités
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="/health-tips" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 font-medium transition-colors duration-200 relative group">
                    <i class="fas fa-heartbeat mr-2 text-lime-500"></i>Conseils Santé
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="/contact" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 font-medium transition-colors duration-200 relative group">
                    <i class="fas fa-envelope mr-2 text-green-400"></i>Contact
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
                </a>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Dark Mode Toggle -->
                <button @click="toggleDarkMode()" class="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-moon text-gray-600 dark:hidden"></i>
                    <i class="fas fa-sun text-yellow-500 hidden dark:inline"></i>
                </button>

                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 bg-gradient-to-r from-green-600 to-emerald-600 text-white px-5 py-2.5 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <span class="font-medium">{{ Auth::user()->first_name }}</span>
                            <i class="fas fa-chevron-down text-white text-sm transition-transform duration-200" :class="{'rotate-180': open}"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="absolute right-0 mt-3 w-64 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl py-3 z-50 border border-gray-100 dark:border-gray-700">
                            <a href="/profile" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-green-900/50 transition-colors duration-200">
                                <i class="fas fa-user-circle text-green-500"></i>
                                <span>Mon profil</span>
                            </a>
                            @if(Auth::user()->isDoctor())
                            <a href="/profile/availability" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-green-900/50 transition-colors duration-200">
                                <i class="fas fa-calendar-alt text-green-500"></i>
                                <span>Disponibilité</span>
                            </a>
                            @endif
                            <a href="/appointments" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-emerald-900/50 transition-colors duration-200">
                                <i class="fas fa-calendar-check text-emerald-500"></i>
                                <span>Mes rendez-vous</span>
                            </a>
                            <hr class="my-2 border-gray-200 dark:border-gray-600">
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/50 transition-colors duration-200">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Déconnexion</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="/login" class="text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 font-medium transition-colors duration-200 hidden sm:block">Connexion</a>
                    <a href="/register" class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-2.5 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105 font-medium">
                        <i class="fas fa-user-plus mr-2"></i>Inscription
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden border-t border-gray-200 dark:border-gray-700 bg-white/95 dark:bg-gray-900/95 backdrop-blur-md">
        <div class="px-4 py-3 space-y-1">
            <a href="/" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/50 rounded-lg transition-colors">
                <i class="fas fa-home mr-2 text-blue-500"></i>Accueil
            </a>
            <a href="/doctors" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/50 rounded-lg transition-colors">
                <i class="fas fa-user-md mr-2 text-green-500"></i>Médecins
            </a>
            <a href="/specialties" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/50 rounded-lg transition-colors">
                <i class="fas fa-stethoscope mr-2 text-purple-500"></i>Spécialités
            </a>
            <a href="/health-tips" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/50 rounded-lg transition-colors">
                <i class="fas fa-heartbeat mr-2 text-red-500"></i>Conseils Santé
            </a>
            <a href="/contact" class="block px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/50 rounded-lg transition-colors">
                <i class="fas fa-envelope mr-2 text-orange-500"></i>Contact
            </a>
        </div>
    </div>
</nav>

<!-- Chatbot -->
@include('components.chatbot')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check for saved theme preference or default to light mode
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
            document.documentElement.classList.add('dark');
        }

        // Toggle function
        window.toggleDarkMode = function() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');

            if (isDark) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        };
    });
</script>