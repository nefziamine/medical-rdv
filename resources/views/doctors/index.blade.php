<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Médecins - RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body { font-family: 'Inter', sans-serif; }

    /* Enhanced animations and styles for doctors page */
    @keyframes slide-up {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fade-in {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes scale-in {
      from {
        opacity: 0;
        transform: scale(0.9);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    @keyframes float {
      0%, 100% {
        transform: translateY(0px);
      }
      50% {
        transform: translateY(-10px);
      }
    }

    @keyframes spin-slow {
      from {
        transform: rotate(0deg);
      }
      to {
        transform: rotate(360deg);
      }
    }

    @keyframes counter {
      from {
        opacity: 0;
        transform: scale(0.5);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    @keyframes progress {
      from {
        width: 0%;
      }
      to {
        width: var(--progress-width);
      }
    }

    @keyframes glow {
      0%, 100% {
        box-shadow: 0 0 5px rgba(59, 130, 246, 0.5);
      }
      50% {
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.8), 0 0 30px rgba(59, 130, 246, 0.4);
      }
    }

    @keyframes particle-float {
      0%, 100% {
        transform: translateY(0px) rotate(0deg);
        opacity: 0.7;
      }
      25% {
        transform: translateY(-5px) rotate(90deg);
        opacity: 1;
      }
      50% {
        transform: translateY(-10px) rotate(180deg);
        opacity: 0.8;
      }
      75% {
        transform: translateY(-5px) rotate(270deg);
        opacity: 0.9;
      }
    }

    @keyframes ripple {
      0% {
        transform: scale(0);
        opacity: 1;
      }
      100% {
        transform: scale(4);
        opacity: 0;
      }
    }

    .animate-slide-up {
      animation: slide-up 0.6s ease-out;
    }

    .animate-fade-in {
      animation: fade-in 0.8s ease-out;
    }

    .animate-scale-in {
      animation: scale-in 0.5s ease-out;
    }

    .animate-float {
      animation: float 3s ease-in-out infinite;
    }

    .animate-spin-slow {
      animation: spin-slow 8s linear infinite;
    }

    .animate-counter {
      animation: counter 0.8s ease-out;
    }

    .animate-progress {
      animation: progress 2s ease-out forwards;
    }

    .animate-glow {
      animation: glow 2s ease-in-out infinite;
    }

    .animate-particle-float {
      animation: particle-float 4s ease-in-out infinite;
    }

    .animate-ripple {
      animation: ripple 0.6s linear;
    }

    /* Enhanced visual effects */
    .glass-morphism {
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .neon-glow {
      box-shadow: 0 0 5px rgba(59, 130, 246, 0.5), 0 0 10px rgba(59, 130, 246, 0.3), 0 0 15px rgba(59, 130, 246, 0.2);
    }

    .gradient-border {
      position: relative;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      padding: 2px;
      border-radius: 16px;
    }

    .gradient-border::before {
      content: '';
      position: absolute;
      inset: 2px;
      background: white;
      border-radius: 14px;
    }

    .magnetic-hover {
      transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .magnetic-hover:hover {
      transform: scale(1.05) translateY(-2px);
    }

    /* Particle system */
    .particles-container {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      pointer-events: none;
    }

    .particle {
      position: absolute;
      width: 4px;
      height: 4px;
      background: rgba(59, 130, 246, 0.6);
      border-radius: 50%;
      animation: particle-float 6s ease-in-out infinite;
    }

    .particle:nth-child(2n) {
      background: rgba(139, 92, 246, 0.6);
      animation-delay: 1s;
    }

    .particle:nth-child(3n) {
      background: rgba(236, 72, 153, 0.6);
      animation-delay: 2s;
    }

    .particle:nth-child(4n) {
      background: rgba(34, 197, 94, 0.6);
      animation-delay: 3s;
    }

    /* Enhanced card hover effects */
    .doctor-card {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .doctor-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Progress bar animation */
    .progress-bar {
      transition: width 0.8s ease-in-out;
    }

    /* Button hover effects */
    .btn-professional {
      position: relative;
      overflow: hidden;
    }

    .btn-professional::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s;
    }

    .btn-professional:hover::before {
      left: 100%;
    }

    /* Status indicator animations */
    .status-indicator {
      animation: pulse 2s infinite;
    }

    .status-indicator.confirmed {
      animation: bounce 1s infinite;
    }

    .status-indicator.completed {
      animation: none;
    }

    /* Floating animation for empty state */
    @keyframes float {
      0%, 100% {
        transform: translateY(0px);
      }
      50% {
        transform: translateY(-10px);
      }
    }

    .floating-element {
      animation: float 3s ease-in-out infinite;
    }

    /* Gradient text effects */
    .gradient-text {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    /* Enhanced shadow effects */
    .shadow-enhanced {
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .shadow-enhanced:hover {
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Responsive enhancements */
    @media (max-width: 768px) {
      .doctor-card {
        margin: 0 16px;
      }

      .stats-card {
        margin: 0 8px;
      }
    }

    /* Loading states */
    .loading-shimmer {
      background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
      background-size: 200% 100%;
      animation: loading 1.5s infinite;
    }

    @keyframes loading {
      0% {
        background-position: 200% 0;
      }
      100% {
        background-position: -200% 0;
      }
    }

    /* Custom scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
      width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  <!-- Navigation Header -->
  <nav class="bg-white/95 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center py-4">
        <div class="flex items-center space-x-3">
          <div class="w-10 h-10 bg-gradient-to-r from-green-600 to-emerald-600 rounded-xl flex items-center justify-center">
            <i class="fas fa-stethoscope text-white text-lg"></i>
          </div>
          <a href="/" class="text-2xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">RDV Médical</a>
        </div>
        <div class="hidden md:flex items-center space-x-8">
          <a href="/" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 relative group">
            Accueil
            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
          </a>
          <a href="/doctors" class="text-green-600 font-semibold relative">
            Médecins
            <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-green-600"></span>
          </a>
          <a href="/specialties" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 relative group">
            Spécialités
            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
          </a>
          <a href="/contact" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 relative group">
            Contact
            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
          </a>
          <a href="/health-tips" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 relative group">
            <i class="fas fa-heartbeat mr-1"></i>Conseils santé
            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
          </a>
        </div>
        <div class="flex items-center space-x-4">
          @auth
            <div class="relative" x-data="{ open: false }">
              <button @click="open = !open" class="flex items-center space-x-2 bg-gradient-to-r from-green-600 to-emerald-600 text-white px-5 py-2.5 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                  <i class="fas fa-user text-white text-sm"></i>
                </div>
                <span class="font-medium">{{ Auth::user()->first_name }}</span>
                <i class="fas fa-chevron-down text-white text-sm transition-transform duration-200" :class="{'rotate-180': open}"></i>
              </button>
              <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-2xl py-2 z-50 border border-gray-100">
                <a href="{{ route('profile') }}" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                  <i class="fas fa-tachometer-alt text-blue-500"></i>
                  <span>Tableau de bord</span>
                </a>
                @if(Auth::user()->isDoctor())
                <a href="{{ route('profile.availability') }}" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                  <i class="fas fa-calendar-alt text-green-500"></i>
                  <span>Disponibilité</span>
                </a>
                @endif
                <a href="{{ route('appointments.index') }}" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                  <i class="fas fa-calendar-check text-purple-500"></i>
                  <span>Mes rendez-vous</span>
                </a>
                <hr class="my-2 border-gray-200">
                <form method="POST" action="{{ route('logout') }}" class="block">
                  @csrf
                  <button type="submit" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Déconnexion</span>
                  </button>
                </form>
              </div>
            </div>
          @else
          <a href="/login" class="text-gray-600 hover:text-green-600 transition-colors duration-200 hidden sm:block">Connexion</a>
          <a href="/register" class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-2.5 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105 font-medium">
            <i class="fas fa-user-plus mr-2"></i>Inscription
          </a>
          @endauth
        </div>
      </div>
    </div>
  </nav>

  <!-- Enhanced Hero Section -->
  <section class="bg-gradient-to-br from-green-600 via-emerald-600 to-teal-700 py-24 relative overflow-hidden">
    <!-- Animated background elements -->
    <div class="absolute inset-0">
      <div class="absolute top-10 left-10 w-32 h-32 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
      <div class="absolute bottom-10 right-10 w-48 h-48 bg-white/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center animate-slide-up">
        <div class="flex justify-center mb-8">
          <div class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-3xl flex items-center justify-center animate-bounce shadow-xl">
            <i class="fas fa-user-md text-4xl text-white"></i>
          </div>
        </div>

        <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6">
          Trouvez votre <span class="bg-gradient-to-r from-green-300 to-emerald-300 bg-clip-text text-transparent">médecin</span>
        </h1>

        <div class="w-24 h-1 bg-white/30 rounded-full mx-auto mb-8"></div>

        <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
          Découvrez notre réseau de <span class="font-semibold text-white">professionnels de santé qualifiés</span> et prenez rendez-vous en quelques clics
        </p>

        <!-- Enhanced stats display -->
        <div class="flex justify-center items-center space-x-12 mt-12 text-white">
          <div class="text-center">
            <div class="text-3xl font-bold mb-2 animate-counter" data-target="500">0</div>
            <div class="text-sm opacity-80 font-medium">Médecins actifs</div>
          </div>
          <div class="text-center">
            <div class="text-3xl font-bold mb-2 animate-counter" data-target="24">0</div>
            <div class="text-sm opacity-80 font-medium">Spécialités</div>
          </div>
          <div class="text-center">
            <div class="text-3xl font-bold mb-2 animate-counter" data-target="10000">0</div>
            <div class="text-sm opacity-80 font-medium">RDV réussis</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Search Section -->
  <section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <form method="GET" action="{{ route('doctors.index') }}" class="max-w-4xl mx-auto" autocomplete="off">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <select name="specialty" class="border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="">Toutes les spécialités</option>
            @foreach($specialties as $specialty)
              <option value="{{ $specialty->slug }}" {{ request('specialty') == $specialty->slug ? 'selected' : '' }}>
                {{ $specialty->name }}
              </option>
            @endforeach
          </select>
          <input type="text" id="doctor-search" name="search" value="{{ request('search') }}" placeholder="Nom du médecin" class="border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" autocomplete="off">
          <button type="submit" class="bg-gradient-to-r from-green-600 to-emerald-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
            <i class="fas fa-search mr-2"></i>Rechercher
          </button>
        </div>
      </form>

      <script>
        // Enhanced Doctors page interactions with advanced animations
        document.addEventListener('DOMContentLoaded', function() {
          // Counter animation for statistics
          function animateCounter(element, target) {
            let current = 0;
            const increment = target / 50;
            const timer = setInterval(() => {
              current += increment;
              if (current >= target) {
                current = target;
                clearInterval(timer);
              }
              element.textContent = Math.floor(current);
            }, 30);
          }

          // Animate counters when they come into view
          const counters = document.querySelectorAll('.animate-counter');
          const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
              if (entry.isIntersecting) {
                const target = parseInt(entry.target.getAttribute('data-target'));
                animateCounter(entry.target, target);
                counterObserver.unobserve(entry.target);
              }
            });
          });

          counters.forEach(counter => counterObserver.observe(counter));

          // Magnetic hover effect for doctor cards
          const doctorCards = document.querySelectorAll('.doctor-card');
          doctorCards.forEach(card => {
            card.addEventListener('mousemove', function(e) {
              const rect = this.getBoundingClientRect();
              const x = e.clientX - rect.left;
              const y = e.clientY - rect.top;

              const centerX = rect.width / 2;
              const centerY = rect.height / 2;

              const rotateX = (y - centerY) / 10;
              const rotateY = (centerX - x) / 10;

              this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;
            });

            card.addEventListener('mouseleave', function() {
              this.style.transform = '';
            });
          });

          // Particle system for background effects
          function createParticles() {
            const particlesContainer = document.querySelector('.particles-container') || document.body;
            for (let i = 0; i < 20; i++) {
              const particle = document.createElement('div');
              particle.className = 'particle';
              particle.style.left = Math.random() * 100 + '%';
              particle.style.top = Math.random() * 100 + '%';
              particle.style.animationDelay = Math.random() * 6 + 's';
              particlesContainer.appendChild(particle);
            }
          }

          // Create floating particles
          createParticles();

          // Ripple effect for buttons
          const buttons = document.querySelectorAll('button, .btn-professional');
          buttons.forEach(button => {
            button.addEventListener('click', function(e) {
              const ripple = document.createElement('div');
              ripple.className = 'animate-ripple';
              ripple.style.position = 'absolute';
              ripple.style.borderRadius = '50%';
              ripple.style.background = 'rgba(255, 255, 255, 0.6)';
              ripple.style.transform = 'scale(0)';
              ripple.style.animation = 'ripple 0.6s linear';

              const rect = this.getBoundingClientRect();
              const size = Math.max(rect.width, rect.height);
              ripple.style.width = ripple.style.height = size + 'px';
              ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
              ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';

              this.style.position = 'relative';
              this.appendChild(ripple);

              setTimeout(() => ripple.remove(), 600);
            });
          });

          // Enhanced scroll animations
          const scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
              if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
              }
            });
          }, { threshold: 0.1 });

          document.querySelectorAll('.animate-on-scroll').forEach(el => scrollObserver.observe(el));

          // Enhanced autocomplete functionality
          const input = document.getElementById('doctor-search');
          const list = document.getElementById('autocomplete-list');
          let debounceTimeout;

          input.addEventListener('input', function() {
            clearTimeout(debounceTimeout);
            const query = this.value.trim();
            if (query.length < 1) {
              list.innerHTML = '';
              list.classList.add('hidden');
              return;
            }
            debounceTimeout = setTimeout(() => {
              fetch(`/autocomplete/doctors?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                  if (data.length === 0) {
                    list.innerHTML = '';
                    list.classList.add('hidden');
                    return;
                  }
                  list.innerHTML = data.map(d => `<li class='px-4 py-3 cursor-pointer hover:bg-blue-50 border-b border-gray-100 last:border-b-0 animate-fade-in' data-name='${d.name}'>${d.name} <span class='text-xs text-gray-500 ml-2'>${d.specialty}</span></li>`).join('');
                  list.classList.remove('hidden');
                });
            }, 200);
          });

          list.addEventListener('mousedown', function(e) {
            if (e.target && e.target.matches('li[data-name]')) {
              input.value = e.target.getAttribute('data-name');
              list.innerHTML = '';
              list.classList.add('hidden');
            }
          });

          document.addEventListener('click', function(e) {
            if (!input.contains(e.target) && !list.contains(e.target)) {
              list.innerHTML = '';
              list.classList.add('hidden');
            }
          });

          // Keyboard shortcuts
          document.addEventListener('keydown', function(e) {
            // Ctrl + F for focus search
            if (e.ctrlKey && e.key === 'f') {
              e.preventDefault();
              input.focus();
              input.select();
            }

            // Escape to clear search
            if (e.key === 'Escape') {
              input.value = '';
              list.innerHTML = '';
              list.classList.add('hidden');
            }
          });

          // Enhanced loading states with progress
          const links = document.querySelectorAll('a[href]:not([href^="#"])');
          links.forEach(link => {
            link.addEventListener('click', function(e) {
              if (this.href && !this.href.includes('#')) {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Chargement...';
                this.style.pointerEvents = 'none';

                // Re-enable after 3 seconds (fallback)
                setTimeout(() => {
                  this.innerHTML = originalText;
                  this.style.pointerEvents = 'auto';
                }, 3000);
              }
            });
          });

          // Parallax effect for floating elements
          window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;

            document.querySelectorAll('.animate-float').forEach(element => {
              element.style.transform = `translateY(${rate * 0.1}px)`;
            });
          });

          // Theme toggle (if needed in future)
          function toggleTheme() {
            document.body.classList.toggle('dark-theme');
            localStorage.setItem('theme', document.body.classList.contains('dark-theme') ? 'dark' : 'light');
          }

          // Load saved theme
          const savedTheme = localStorage.getItem('theme');
          if (savedTheme === 'dark') {
            document.body.classList.add('dark-theme');
          }
        });

        // Utility functions
        function showNotification(message, type = 'success') {
          // Create notification element
          const notification = document.createElement('div');
          notification.className = `fixed top-4 right-4 z-50 p-4 rounded-xl shadow-2xl animate-slide-up max-w-sm ${
            type === 'success' ? 'bg-green-500 text-white' :
            type === 'error' ? 'bg-red-500 text-white' :
            'bg-blue-500 text-white'
          }`;
          notification.innerHTML = `
            <div class="flex items-center">
              <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'} mr-3"></i>
              <span class="font-medium">${message}</span>
            </div>
          `;

          document.body.appendChild(notification);

          // Remove after 5 seconds
          setTimeout(() => {
            notification.classList.add('opacity-0');
            setTimeout(() => notification.remove(), 300);
          }, 5000);
        }

        // Export functions for global use
        window.showNotification = showNotification;
      </script>
    </div>
  </section>

  <!-- Doctors List -->
  <section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      @if(isset($doctors) && $doctors->count() > 0)
        <!-- Results Header -->
        <div class="mb-8">
          <h2 class="text-2xl font-bold text-gray-900">
            {{ $doctors->total() }} médecin{{ $doctors->total() > 1 ? 's' : '' }} trouvé{{ $doctors->total() > 1 ? 's' : '' }}
          </h2>
        </div>

        <!-- Enhanced Doctors Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          @foreach($doctors as $doctor)
            <div class="bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:scale-[1.02] border border-gray-100/50 p-8 group doctor-card relative overflow-hidden animate-scale-in" style="animation-delay: {{ $loop->index * 0.1 }}s;">
              <!-- Floating decorative elements -->
              <div class="absolute top-6 left-6 opacity-10 animate-float">
                <i class="fas fa-stethoscope text-blue-500 text-lg"></i>
              </div>
              <div class="absolute bottom-6 right-6 opacity-10 animate-float" style="animation-delay: 1s;">
                <i class="fas fa-heartbeat text-red-500 text-sm"></i>
              </div>

              <!-- Animated background effect -->
              <div class="absolute inset-0 bg-gradient-to-r from-green-50 to-emerald-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

              <!-- Doctor Header -->
              <div class="flex items-center mb-6 relative z-10">
                <div class="relative mr-4">
                  <div class="absolute inset-0 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl blur-lg opacity-30 group-hover:opacity-50 transition-opacity duration-300"></div>
                  <img src="{{ $doctor->photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(($doctor->user->first_name ?? 'D') . ' ' . ($doctor->user->last_name ?? '')) . '&background=10b981&color=ffffff' }}"
                       class="relative w-20 h-20 rounded-2xl object-cover border-4 border-white shadow-lg group-hover:shadow-xl transition-all duration-300 transform group-hover:scale-105"
                       alt="Photo de {{ $doctor->user->first_name ?? 'Docteur' }}">

                  <!-- Enhanced status indicator -->
                  @if($doctor->is_available)
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-white shadow-lg flex items-center justify-center animate-pulse">
                      <i class="fas fa-check text-white text-sm"></i>
                    </div>
                  @else
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-red-500 rounded-full border-4 border-white shadow-lg flex items-center justify-center">
                      <i class="fas fa-times text-white text-sm"></i>
                    </div>
                  @endif
                </div>

                <div class="flex-1">
                  <h3 class="text-2xl font-bold text-gray-900 mb-1 group-hover:text-blue-600 transition-colors duration-300">
                    Dr. {{ $doctor->user->first_name ?? '' }} {{ $doctor->user->last_name ?? '' }}
                  </h3>
                  @if($doctor->specialty)
                    <p class="text-emerald-600 font-semibold text-lg mb-2">{{ $doctor->specialty->name }}</p>
                  @endif

                  <!-- Enhanced rating display -->
                  <div class="flex items-center mb-2">
                    @php $rating = $doctor->rating ?? 0; @endphp
                    <div class="flex text-yellow-400 mr-3">
                      @for($i = 1; $i <= 5; $i++)
                        @if($i <= $rating)
                          <i class="fas fa-star text-sm animate-pulse"></i>
                        @else
                          <i class="far fa-star text-sm"></i>
                        @endif
                      @endfor
                    </div>
                    <span class="text-sm text-gray-600 font-medium">({{ $doctor->total_reviews ?? 0 }} avis)</span>
                  </div>
                </div>
              </div>

              <!-- Enhanced Doctor Details -->
              <div class="space-y-4 mb-8 relative z-10">
                @if($doctor->clinic_address)
                  <div class="flex items-center text-gray-600 bg-gray-50 rounded-xl p-3 group-hover:bg-green-50 transition-colors duration-300">
                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                      <i class="fas fa-map-marker-alt text-red-500"></i>
                    </div>
                    <span class="text-sm font-medium">{{ $doctor->clinic_address }}</span>
                  </div>
                @endif

                @if($doctor->experience_years)
                  <div class="flex items-center text-gray-600 bg-gray-50 rounded-xl p-3 group-hover:bg-green-50 transition-colors duration-300">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center mr-3">
                      <i class="fas fa-briefcase text-emerald-500"></i>
                    </div>
                    <span class="text-sm font-medium">{{ $doctor->experience_years }} ans d'expérience</span>
                  </div>
                @endif

                @if($doctor->consultation_fee)
                  <div class="flex items-center text-gray-600 bg-gray-50 rounded-xl p-3 group-hover:bg-green-50 transition-colors duration-300">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                      <i class="fas fa-money-bill text-green-500"></i>
                    </div>
                    <span class="text-sm font-medium">{{ $doctor->consultation_fee }} DT/consultation</span>
                  </div>
                @endif
              </div>

              <!-- Enhanced Action Buttons -->
              <div class="space-y-3 relative z-10">
                <a href="{{ route('doctors.show', $doctor->id) }}"
                   class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-4 rounded-2xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center group/btn relative overflow-hidden">
                  <!-- Animated background effect -->
                  <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-green-600 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300"></div>
                  <i class="fas fa-eye mr-3 group-hover/btn:animate-pulse relative z-10"></i>
                  <span class="relative z-10">Voir le profil complet</span>
                  <!-- Floating particles -->
                  <div class="absolute top-2 right-2 w-1 h-1 bg-white rounded-full opacity-60 animate-ping"></div>
                  <div class="absolute bottom-2 left-2 w-1 h-1 bg-white rounded-full opacity-40 animate-ping" style="animation-delay: 0.3s;"></div>
                </a>

                @auth
                  <a href="{{ route('appointments.create', $doctor->id) }}"
                     class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-4 rounded-2xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center group/btn relative overflow-hidden">
                    <!-- Success particles -->
                    <div class="absolute inset-0 opacity-0 group-hover/btn:opacity-100">
                      <div class="absolute top-1 left-1/4 w-1 h-1 bg-white rounded-full animate-bounce"></div>
                      <div class="absolute top-2 right-1/3 w-1 h-1 bg-white rounded-full animate-bounce" style="animation-delay: 0.1s;"></div>
                      <div class="absolute bottom-1 left-1/2 w-1 h-1 bg-white rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                    </div>
                    <i class="fas fa-calendar-plus mr-3 group-hover/btn:animate-bounce relative z-10"></i>
                    <span class="relative z-10">Prendre rendez-vous</span>
                  </a>
                @else
                  <a href="{{ route('login') }}"
                     class="w-full bg-gradient-to-r from-orange-600 to-red-600 text-white py-4 rounded-2xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center group/btn relative overflow-hidden">
                    <!-- Warning effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-orange-600 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300"></div>
                    <i class="fas fa-sign-in-alt mr-3 group-hover/btn:animate-pulse relative z-10"></i>
                    <span class="relative z-10">Se connecter pour RDV</span>
                    <!-- Warning dots -->
                    <div class="absolute top-1 right-1 w-2 h-2 bg-white rounded-full opacity-70 animate-pulse"></div>
                  </a>
                @endauth
              </div>
            </div>
          @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
          {{ $doctors->links() }}
        </div>
      @else
        <!-- No Results -->
        <div class="text-center py-20">
          <div class="w-24 h-24 bg-gradient-to-r from-gray-400 to-gray-500 rounded-3xl flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-search text-white text-3xl"></i>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Aucun médecin trouvé</h3>
          <p class="text-lg text-gray-600 mb-8 max-w-md mx-auto">
            Aucun médecin ne correspond à vos critères de recherche. Essayez de modifier vos filtres.
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('doctors.index') }}"
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl font-semibold hover:shadow-lg transition-all duration-300">
              <i class="fas fa-search mr-2"></i>Voir tous les médecins
            </a>
            <a href="{{ route('specialties.index') }}"
               class="inline-flex items-center px-6 py-3 bg-white text-green-600 border border-green-200 rounded-xl font-semibold hover:shadow-lg transition-all duration-300">
              <i class="fas fa-stethoscope mr-2"></i>Explorer les spécialités
            </a>
          </div>
        </div>
      @endif
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-12">
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
          <a href="#" class="flex items-center space-x-2 hover:text-green-200 transition">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
            <span>Facebook</span>
          </a>
          <a href="#" class="flex items-center space-x-2 hover:text-green-200 transition">
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
</body>
</html>