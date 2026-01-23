<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RDV Médical - Prenez rendez-vous avec les meilleurs médecins</title>
  <meta name="description" content="Plateforme de prise de rendez-vous médical en Tunisie. Trouvez et consultez les meilleurs médecins près de chez vous.">
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body { font-family: 'Inter', sans-serif; }
    .gradient-bg { background: linear-gradient(135deg, #ffffff 0%, #038358ff 100%); }
    .hero-gradient { background: linear-gradient(135deg, #ffffff 0%, #038358ff 50%, #34d399 100%); }
    .glass-effect { backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.1); }
    .animate-fade-in { animation: fadeIn 1s ease-in; }
    .animate-slide-up { animation: slideUp 0.8s ease-out; }
    .animate-float { animation: float 6s ease-in-out infinite; }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { transform: translateY(30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
    @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
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
          <a href="/doctors" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 relative group">
            Médecins
            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
          </a>
          <a href="/specialties" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 relative group">
            Spécialités
            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
          </a>
          <a href="/health-tips" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 relative group">
            Conseils Santé
            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-600 group-hover:w-full transition-all duration-300"></span>
          </a>
          <a href="/contact" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 relative group">
            Contact
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
                <a href="/profile" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                  <i class="fas fa-user-circle text-green-500"></i>
                  <span>Mon profil</span>
                </a>
                @if(Auth::user()->isDoctor())
                <a href="/profile/availability" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                  <i class="fas fa-calendar-alt text-emerald-500"></i>
                  <span>Disponibilité</span>
                </a>
                @endif
                <a href="/appointments" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                  <i class="fas fa-calendar-check text-teal-500"></i>
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
          <a href="/login" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 hidden sm:block">Connexion</a>
          <a href="/register" class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-2.5 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105 font-medium">
            <i class="fas fa-user-plus mr-2"></i>Inscription
          </a>
          @endauth
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero-gradient py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-float"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-300/20 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center min-h-[600px]">
        <div class="animate-slide-up">
          <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 mb-6">
            <i class="fas fa-star text-yellow-400"></i>
            <span class="text-white font-medium">Plateforme #1 de RDV médicaux en Tunisie</span>
          </div>

          <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
            Trouvez un <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">médecin</span> près de chez vous
          </h1>

          <p class="text-xl text-white/90 mb-8 leading-relaxed">
            Réservez facilement votre consultation chez un professionnel de santé certifié.
            Plus de 500 médecins partenaires vous attendent.
          </p>

          <form method="GET" action="{{ route('doctors.index') }}" class="bg-white/10 backdrop-blur-md rounded-2xl p-6 mb-8 border border-white/20" autocomplete="off">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
              <div class="relative">
                <i class="fas fa-stethoscope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <select name="specialty" class="w-full pl-10 pr-4 py-3 bg-white rounded-xl border-0 focus:ring-2 focus:ring-green-500 transition-all duration-300">
                  <option value="">Toutes les spécialités</option>
                  @foreach($specialties as $specialty)
                    <option value="{{ $specialty->slug }}">{{ $specialty->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="relative">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" id="doctor-search-welcome" name="search" placeholder="Nom du médecin" class="w-full pl-10 pr-4 py-3 bg-white rounded-xl border-0 focus:ring-2 focus:ring-green-500 transition-all duration-300" autocomplete="off">
                <ul id="autocomplete-list-welcome" class="absolute left-0 right-0 top-full mt-2 bg-white border border-gray-200 rounded-xl shadow-xl z-50 hidden max-h-60 overflow-y-auto"></ul>
              </div>
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-4 rounded-xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105">
              <i class="fas fa-search mr-2"></i>Chercher un médecin
            </button>
          </form>
         <script>
           document.addEventListener('DOMContentLoaded', function() {
             const input = document.getElementById('doctor-search-welcome');
             const list = document.getElementById('autocomplete-list-welcome');
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
                     list.innerHTML = data.map(d => `<li class='px-4 py-3 cursor-pointer hover:bg-blue-50 border-b border-gray-100 last:border-b-0' data-name='${d.name}'>${d.name} <span class='text-xs text-gray-500 ml-2'>${d.specialty}</span></li>`).join('');
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
           });
         </script>

         <div class="flex flex-wrap items-center gap-6 text-white/90">
           <div class="flex items-center space-x-2">
             <i class="fas fa-check-circle text-green-400"></i>
             <span class="font-medium">Gratuit</span>
           </div>
           <div class="flex items-center space-x-2">
             <i class="fas fa-shield-alt text-blue-400"></i>
             <span class="font-medium">Sécurisé</span>
           </div>
           <div class="flex items-center space-x-2">
             <i class="fas fa-clock text-purple-400"></i>
             <span class="font-medium">24/7</span>
           </div>
         </div>
       </div>

       <div class="animate-fade-in relative">
         <div class="relative">
           <img src="https://images.pexels.com/photos/6129048/pexels-photo-6129048.jpeg?auto=compress&w=600&q=80" alt="Doctor consultation" class="w-full max-w-lg mx-auto rounded-3xl shadow-2xl transform hover:scale-105 transition-transform duration-500">
           <div class="absolute -top-4 -right-4 bg-white rounded-2xl shadow-xl p-4 animate-float">
             <div class="flex items-center space-x-2">
               <i class="fas fa-star text-yellow-400"></i>
               <span class="font-bold text-gray-800">4.9/5</span>
             </div>
             <p class="text-xs text-gray-600">Note moyenne</p>
           </div>
           <div class="absolute -bottom-4 -left-4 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-2xl shadow-xl p-4 animate-float" style="animation-delay: 1s;">
             <div class="flex items-center space-x-2">
               <i class="fas fa-users"></i>
               <span class="font-bold">500+</span>
             </div>
             <p class="text-xs opacity-90">Médecins partenaires</p>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
  <!-- Video Section -->
  <section class="py-20 bg-gradient-to-br from-green-50 to-emerald-50 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full">
      <div class="absolute top-20 left-20 w-64 h-64 bg-green-200/30 rounded-full blur-3xl"></div>
      <div class="absolute bottom-20 right-20 w-96 h-96 bg-emerald-200/20 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-4xl font-bold text-gray-900 mb-4">Découvrez l'importance de la santé préventive</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">Regardez cette vidéo informative sur l'importance des soins de santé réguliers et comment RDV Médical facilite l'accès aux professionnels de santé</p>
      </div>

      <div class="max-w-4xl mx-auto">
        <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden group">
          <div class="aspect-video relative">
            <iframe
              class="w-full h-full"
              src="https://www.youtube.com/embed/HPfBMZFmHQM"
              title="Santé Préventive - Conseils pour une meilleure santé"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen
            ></iframe>

            <!-- Video overlay with play button -->
            <div class="absolute inset-0 bg-black/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
              <div class="w-20 h-20 bg-white/90 rounded-full flex items-center justify-center shadow-lg">
                <i class="fas fa-play text-green-600 text-2xl ml-1"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Video description -->
        <div class="mt-8 text-center">
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Pourquoi consulter régulièrement ?</h3>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
              <div class="w-12 h-12 bg-gradient-to-r from-green-600 to-emerald-600 rounded-xl flex items-center justify-center mb-4 mx-auto">
                <i class="fas fa-shield-alt text-white"></i>
              </div>
              <h4 class="font-bold text-gray-900 mb-2">Prévention</h4>
              <p class="text-gray-600 text-sm">Détecter les problèmes de santé avant qu'ils ne deviennent graves</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
              <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-xl flex items-center justify-center mb-4 mx-auto">
                <i class="fas fa-heartbeat text-white"></i>
              </div>
              <h4 class="font-bold text-gray-900 mb-2">Suivi médical</h4>
              <p class="text-gray-600 text-sm">Maintenir un suivi régulier de votre état de santé général</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
              <div class="w-12 h-12 bg-gradient-to-r from-purple-600 to-pink-600 rounded-xl flex items-center justify-center mb-4 mx-auto">
                <i class="fas fa-clock text-white"></i>
              </div>
              <h4 class="font-bold text-gray-900 mb-2">Temps opportun</h4>
              <p class="text-gray-600 text-sm">Consulter au bon moment pour des soins plus efficaces</p>
            </div>
          </div>
        </div>

        <!-- Health Resources Link -->
        <div class="text-center mt-8">
          <a href="/health-tips" class="inline-flex items-center space-x-2 bg-white text-green-600 px-6 py-3 rounded-2xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-green-200 animate-pulse">
            <i class="fas fa-heartbeat"></i>
            <span>Découvrez nos conseils santé</span>
            <i class="fas fa-arrow-right"></i>
          </a>
        </div>
        <!-- Call to action -->
        <div class="text-center mt-12">
          <p class="text-gray-600 mb-6">Prêt à prendre soin de votre santé ? Réservez votre prochain rendez-vous dès maintenant !</p>
          <a href="/register-patient" class="inline-flex items-center space-x-2 bg-gradient-to-r from-white to-green-600 text-green-800 px-8 py-4 rounded-2xl font-semibold shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
            <i class="fas fa-calendar-plus"></i>
            <span>Réserver un rendez-vous</span>
          </a>
        </div>
      </div>
    </div>
  </section>

 <!-- Statistics Section -->
 <section class="py-16 bg-white">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
     <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
       <div class="text-center">
         <div class="w-16 h-16 bg-gradient-to-r from-green-600 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
           <i class="fas fa-user-md text-white text-2xl"></i>
         </div>
         <div class="text-3xl font-bold text-gray-900 mb-2">500+</div>
         <p class="text-gray-600">Médecins certifiés</p>
       </div>
       <div class="text-center">
         <div class="w-16 h-16 bg-gradient-to-r from-green-600 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
           <i class="fas fa-calendar-check text-white text-2xl"></i>
         </div>
         <div class="text-3xl font-bold text-gray-900 mb-2">10K+</div>
         <p class="text-gray-600">RDV réussis</p>
       </div>
       <div class="text-center">
         <div class="w-16 h-16 bg-gradient-to-r from-teal-600 to-cyan-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
           <i class="fas fa-map-marker-alt text-white text-2xl"></i>
         </div>
         <div class="text-3xl font-bold text-gray-900 mb-2">24</div>
         <p class="text-gray-600">Gouvernorats couverts</p>
       </div>
       <div class="text-center">
         <div class="w-16 h-16 bg-gradient-to-r from-lime-600 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
           <i class="fas fa-clock text-white text-2xl"></i>
         </div>
         <div class="text-3xl font-bold text-gray-900 mb-2">24/7</div>
         <p class="text-gray-600">Support disponible</p>
       </div>
     </div>
   </div>
 </section>

  <!-- Section Spécialités -->
  <section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-4xl font-bold text-gray-900 mb-4">Nos Spécialités Médicales</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">Découvrez notre large panel de spécialités médicales avec des professionnels expérimentés</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($specialties as $specialty)
          <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border border-gray-100 group">
            <div class="w-16 h-16 bg-gradient-to-r from-green-600 to-emerald-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
              <i class="fas fa-stethoscope text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $specialty->name }}</h3>
            <p class="text-gray-600 mb-6 line-clamp-2">{{ $specialty->description ?? 'Spécialité médicale de qualité avec des professionnels certifiés.' }}</p>
            <div class="w-full">
              @if($specialty->slug && !empty($specialty->slug))
                <a href="{{ route('specialties.show', $specialty->slug) }}" class="inline-flex items-center justify-center w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                  <span>Voir les médecins</span>
                  <i class="fas fa-arrow-right ml-2"></i>
                </a>
              @else
                <span class="inline-flex items-center justify-center w-full bg-gray-300 text-gray-500 px-6 py-3 rounded-xl font-semibold cursor-not-allowed">
                  <span>Bientôt disponible</span>
                </span>
              @endif
            </div>
          </div>
        @endforeach
      </div>

      <div class="text-center mt-12">
        <a href="/specialties" class="inline-flex items-center space-x-2 bg-white text-green-600 px-8 py-4 rounded-2xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-green-200">
          <span>Voir toutes les spécialités</span>
          <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>
  <!-- How It Works Section -->
  <section class="py-20 bg-white relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full">
      <div class="absolute top-20 left-20 w-64 h-64 bg-blue-100/50 rounded-full blur-3xl"></div>
      <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-100/30 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-4xl font-bold text-gray-900 mb-4">Comment ça marche ?</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">Simple, rapide et sécurisé : réservez votre rendez-vous médical en quelques étapes</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Step 1 -->
        <div class="text-center group">
          <div class="relative mb-8">
            <div class="w-20 h-20 bg-gradient-to-r from-green-600 to-emerald-600 rounded-3xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
              <span class="text-2xl font-bold text-white">1</span>
            </div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-24 h-24 bg-blue-100 rounded-full opacity-20 group-hover:opacity-30 transition-opacity duration-300"></div>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Choisissez votre médecin</h3>
          <p class="text-gray-600 leading-relaxed">Parcourez notre répertoire de médecins certifiés, filtrez par spécialité, localisation ou disponibilité pour trouver le professionnel idéal.</p>
        </div>

        <!-- Step 2 -->
        <div class="text-center group">
          <div class="relative mb-8">
            <div class="w-20 h-20 bg-gradient-to-r from-green-600 to-teal-600 rounded-3xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
              <span class="text-2xl font-bold text-white">2</span>
            </div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-24 h-24 bg-green-100 rounded-full opacity-20 group-hover:opacity-30 transition-opacity duration-300"></div>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Réservez votre créneau</h3>
          <p class="text-gray-600 leading-relaxed">Sélectionnez la date et l'heure qui vous conviennent parmi les disponibilités du médecin. Confirmation instantanée par email et SMS.</p>
        </div>

        <!-- Step 3 -->
        <div class="text-center group">
          <div class="relative mb-8">
            <div class="w-20 h-20 bg-gradient-to-r from-teal-600 to-cyan-600 rounded-3xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
              <span class="text-2xl font-bold text-white">3</span>
            </div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-24 h-24 bg-purple-100 rounded-full opacity-20 group-hover:opacity-30 transition-opacity duration-300"></div>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Consultez en toute sérénité</h3>
          <p class="text-gray-600 leading-relaxed">Rendez-vous au cabinet médical à l'heure convenue. Vos données sont sécurisées et confidentielles selon les normes RGPD.</p>
        </div>
      </div>

      @guest
      <!-- Call to action -->
      <div class="text-center mt-12">
        <a href="/register-patient" class="inline-flex items-center space-x-2 bg-gradient-to-r from-green-600 to-emerald-600 text-white px-8 py-4 rounded-2xl font-semibold shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
          <span>Commencer maintenant</span>
          <i class="fas fa-arrow-right"></i>
        </a>
      </div>
      @endguest
    </div>
  </section>

  <!-- SECTION 1 : Praticien de santé -->
  <section class="py-24 bg-gradient-to-br from-blue-50 to-indigo-100 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full">
      <div class="absolute top-20 left-20 w-64 h-64 bg-blue-200/30 rounded-full blur-3xl"></div>
      <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-200/20 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <!-- Images -->
        <div class="grid grid-cols-2 gap-6">
          <div class="relative group">
            <img src="https://images.pexels.com/photos/8460157/pexels-photo-8460157.jpeg?auto=compress&w=400&q=80" class="rounded-3xl shadow-2xl object-cover w-full h-48 group-hover:scale-105 transition-transform duration-300" alt="Visio médecin">
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </div>
          <div class="relative group">
            <img src="https://images.pexels.com/photos/5452201/pexels-photo-5452201.jpeg?auto=compress&w=400&q=80" class="rounded-3xl shadow-2xl object-cover w-full h-48 group-hover:scale-105 transition-transform duration-300" alt="Médecins">
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </div>
          <div class="bg-gradient-to-br from-green-600 to-emerald-600 rounded-3xl shadow-2xl flex items-center justify-center h-48 text-white relative overflow-hidden group">
            <div class="absolute inset-0 bg-white/10 group-hover:bg-white/20 transition-colors duration-300"></div>
            <div class="relative text-center">
              <i class="fas fa-clock text-4xl mb-2"></i>
              <div class="text-3xl font-bold">24/7</div>
              <div class="text-sm opacity-90">Support</div>
            </div>
          </div>
          <div class="relative group">
            <img src="https://images.pexels.com/photos/5327580/pexels-photo-5327580.jpeg?auto=compress&w=400&q=80" class="rounded-3xl shadow-2xl object-cover w-full h-48 group-hover:scale-105 transition-transform duration-300" alt="Consultation patient">
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </div>
        </div>

        <!-- Texte -->
        <div class="animate-slide-up">
          <div class="inline-flex items-center space-x-2 bg-blue-100 text-blue-800 px-4 py-2 rounded-full mb-6">
            <i class="fas fa-user-md"></i>
            <span class="font-semibold">Professionnels de santé</span>
          </div>

          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
            Simplifiez la gestion de votre <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">cabinet médical</span>
          </h2>

          <p class="text-lg text-gray-700 mb-8 leading-relaxed">
            Rejoignez notre plateforme et concentrez-vous sur l'essentiel : vos patients.
            Nous nous occupons de la gestion des rendez-vous, des paiements et du suivi.
            <span class="font-semibold text-blue-600">Inscription gratuite, aucun engagement.</span>
          </p>

          <div class="flex flex-col sm:flex-row gap-4 mb-8">
            <div class="flex items-center space-x-3">
              <i class="fas fa-check-circle text-green-500"></i>
              <span class="text-gray-700">Gestion automatique des RDV</span>
            </div>
            <div class="flex items-center space-x-3">
              <i class="fas fa-check-circle text-green-500"></i>
              <span class="text-gray-700">Interface intuitive</span>
            </div>
          </div>

          @guest
          <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('register.doctor') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-green-600 to-emerald-600 text-white px-8 py-4 rounded-2xl font-semibold shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
              <i class="fas fa-user-plus mr-2"></i>
              <span>Inscription gratuite</span>
            </a>
            <a href="/login" class="inline-flex items-center justify-center bg-white text-green-600 px-8 py-4 rounded-2xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-green-200">
              <i class="fas fa-sign-in-alt mr-2"></i>
              <span>Connexion</span>
            </a>
          </div>
          @endguest
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 2 : Patient -->
  <section class="py-24 bg-gradient-to-br from-purple-50 to-pink-100 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full">
      <div class="absolute top-20 right-20 w-64 h-64 bg-purple-200/30 rounded-full blur-3xl"></div>
      <div class="absolute bottom-20 left-20 w-96 h-96 bg-pink-200/20 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <!-- Texte -->
        <div class="animate-slide-up order-1 lg:order-1">
          <div class="inline-flex items-center space-x-2 bg-purple-100 text-purple-800 px-4 py-2 rounded-full mb-6">
            <i class="fas fa-user"></i>
            <span class="font-semibold">Patients</span>
          </div>

          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
            Prenez soin de votre <span class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">santé</span> en toute simplicité
          </h2>

          <p class="text-lg text-gray-700 mb-8 leading-relaxed">
            Trouvez le médecin qu'il vous faut près de chez vous, réservez en quelques clics et recevez des rappels automatiques.
            Vos données médicales sont <span class="font-semibold text-purple-600">protégées et sécurisées</span> selon les normes RGPD.
          </p>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
            <div class="flex items-center space-x-3">
              <i class="fas fa-search text-purple-500"></i>
              <span class="text-gray-700">Recherche facile</span>
            </div>
            <div class="flex items-center space-x-3">
              <i class="fas fa-calendar-alt text-purple-500"></i>
              <span class="text-gray-700">RDV instantané</span>
            </div>
            <div class="flex items-center space-x-3">
              <i class="fas fa-bell text-purple-500"></i>
              <span class="text-gray-700">Rappels automatiques</span>
            </div>
            <div class="flex items-center space-x-3">
              <i class="fas fa-shield-alt text-purple-500"></i>
              <span class="text-gray-700">Données sécurisées</span>
            </div>
          </div>

          @guest
          <div class="flex flex-col sm:flex-row gap-4">
            <a href="/register-patient" class="inline-flex items-center justify-center bg-gradient-to-r from-teal-600 to-cyan-600 text-white px-8 py-4 rounded-2xl font-semibold shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
              <i class="fas fa-user-plus mr-2"></i>
              <span>Créer mon compte</span>
            </a>
            <a href="/login" class="inline-flex items-center justify-center bg-white text-teal-600 px-8 py-4 rounded-2xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-teal-200">
              <i class="fas fa-sign-in-alt mr-2"></i>
              <span>Se connecter</span>
            </a>
          </div>
          @endguest
        </div>

        <!-- Images -->
        <div class="grid grid-cols-2 gap-6 order-2 lg:order-2">
          <div class="relative group">
            <img src="https://images.pexels.com/photos/3845761/pexels-photo-3845761.jpeg?auto=compress&w=400&q=80" class="rounded-3xl shadow-2xl object-cover w-full h-48 group-hover:scale-105 transition-transform duration-300" alt="Consultation patient">
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </div>
          <div class="relative group">
            <img src="https://images.pexels.com/photos/1170979/pexels-photo-1170979.jpeg?auto=compress&w=400&q=80" class="rounded-3xl shadow-2xl object-cover w-full h-48 group-hover:scale-105 transition-transform duration-300" alt="Médecins">
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </div>
          <div class="bg-gradient-to-br from-teal-600 to-cyan-600 rounded-3xl shadow-2xl flex items-center justify-center h-48 text-white relative overflow-hidden group">
            <div class="absolute inset-0 bg-white/10 group-hover:bg-white/20 transition-colors duration-300"></div>
            <div class="relative text-center">
              <i class="fas fa-heartbeat text-4xl mb-2"></i>
              <div class="text-3xl font-bold">100%</div>
              <div class="text-sm opacity-90">Sécurisé</div>
            </div>
          </div>
          <div class="relative group">
            <img src="https://images.pexels.com/photos/3845125/pexels-photo-3845125.jpeg?auto=compress&w=400&q=80" class="rounded-3xl shadow-2xl object-cover w-full h-48 group-hover:scale-105 transition-transform duration-300" alt="Pédiatre">
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- About Us Section -->
  <section class="py-20 bg-gradient-to-br from-indigo-50 to-blue-50 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full">
      <div class="absolute top-20 right-20 w-64 h-64 bg-indigo-200/30 rounded-full blur-3xl"></div>
      <div class="absolute bottom-20 left-20 w-96 h-96 bg-blue-200/20 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <!-- Content -->
        <div class="animate-slide-up">
          <div class="inline-flex items-center space-x-2 bg-indigo-100 text-indigo-800 px-4 py-2 rounded-full mb-6">
            <i class="fas fa-info-circle"></i>
            <span class="font-semibold">À propos de nous</span>
          </div>

          <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
            Révolutionner les soins de <span class="bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent">santé en Tunisie</span>
          </h2>

          <p class="text-lg text-gray-700 mb-8 leading-relaxed">
            RDV Médical est née d'une vision simple : faciliter l'accès aux soins de santé de qualité pour tous les Tunisiens.
            Notre plateforme connecte patients et professionnels de santé de manière sécurisée et efficace.
          </p>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
              <div class="w-12 h-12 bg-gradient-to-r from-green-600 to-emerald-600 rounded-xl flex items-center justify-center mb-4">
                <i class="fas fa-heart text-white"></i>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-2">Notre Mission</h3>
              <p class="text-gray-600">Rendre les soins de santé accessibles à tous, partout en Tunisie, en simplifiant la prise de rendez-vous médical.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
              <div class="w-12 h-12 bg-gradient-to-r from-green-600 to-teal-600 rounded-xl flex items-center justify-center mb-4">
                <i class="fas fa-eye text-white"></i>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-2">Notre Vision</h3>
              <p class="text-gray-600">Devenir la référence nationale en matière de prise de rendez-vous médical, favorisant une meilleure santé pour tous.</p>
            </div>
          </div>

          <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex items-center space-x-3">
              <i class="fas fa-shield-alt text-indigo-500 text-xl"></i>
              <span class="text-gray-700 font-medium">Données 100% sécurisées</span>
            </div>
            <div class="flex items-center space-x-3">
              <i class="fas fa-users text-blue-500 text-xl"></i>
              <span class="text-gray-700 font-medium">500+ médecins partenaires</span>
            </div>
            <div class="flex items-center space-x-3">
              <i class="fas fa-clock text-purple-500 text-xl"></i>
              <span class="text-gray-700 font-medium">Support 24/7</span>
            </div>
          </div>
        </div>

        <!-- Images -->
        <div class="grid grid-cols-2 gap-6">
          <div class="relative group">
            <img src="https://images.pexels.com/photos/6129048/pexels-photo-6129048.jpeg?auto=compress&w=400&q=80" class="rounded-3xl shadow-2xl object-cover w-full h-48 group-hover:scale-105 transition-transform duration-300" alt="Medical consultation">
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </div>
          <div class="relative group">
            <img src="https://images.pexels.com/photos/3845761/pexels-photo-3845761.jpeg?auto=compress&w=400&q=80" class="rounded-3xl shadow-2xl object-cover w-full h-48 group-hover:scale-105 transition-transform duration-300" alt="Healthcare professional">
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </div>
          <div class="bg-gradient-to-br from-green-600 to-emerald-600 rounded-3xl shadow-2xl flex items-center justify-center h-48 text-white relative overflow-hidden group">
            <div class="absolute inset-0 bg-white/10 group-hover:bg-white/20 transition-colors duration-300"></div>
            <div class="relative text-center">
              <i class="fas fa-award text-4xl mb-2"></i>
              <div class="text-3xl font-bold">2025</div>
              <div class="text-sm opacity-90">Fondée</div>
            </div>
          </div>
          <div class="relative group">
            <img src="https://images.pexels.com/photos/5327580/pexels-photo-5327580.jpeg?auto=compress&w=400&q=80" class="rounded-3xl shadow-2xl object-cover w-full h-48 group-hover:scale-105 transition-transform duration-300" alt="Medical team">
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="py-20 bg-white relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full">
      <div class="absolute top-20 left-20 w-64 h-64 bg-yellow-100/50 rounded-full blur-3xl"></div>
      <div class="absolute bottom-20 right-20 w-96 h-96 bg-orange-100/30 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-4xl font-bold text-gray-900 mb-4">Ce que disent nos patients</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">Découvrez les témoignages de patients satisfaits qui ont choisi RDV Médical</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Testimonial 1 -->
        <div class="bg-gradient-to-br from-white to-gray-50 p-8 rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
          <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-gradient-to-r from-green-600 to-emerald-600 rounded-full flex items-center justify-center mr-4">
              <span class="text-white font-bold">S</span>
            </div>
            <div>
              <h4 class="font-bold text-gray-900">Sarah Ben Ali</h4>
              <p class="text-gray-600 text-sm">Patient, Tunis</p>
            </div>
          </div>
          <div class="flex text-yellow-400 mb-4">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <p class="text-gray-700 leading-relaxed italic">
            "RDV Médical m'a sauvé beaucoup de temps ! J'ai trouvé un pédiatre pour mon fils en quelques minutes.
            L'interface est intuitive et le service est impeccable."
          </p>
        </div>

        <!-- Testimonial 2 -->
        <div class="bg-gradient-to-br from-white to-gray-50 p-8 rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
          <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-gradient-to-r from-green-600 to-teal-600 rounded-full flex items-center justify-center mr-4">
              <span class="text-white font-bold">M</span>
            </div>
            <div>
              <h4 class="font-bold text-gray-900">Mohamed Trabelsi</h4>
              <p class="text-gray-600 text-sm">Patient, Sfax</p>
            </div>
          </div>
          <div class="flex text-yellow-400 mb-4">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <p class="text-gray-700 leading-relaxed italic">
            "Enfin une plateforme sérieuse pour prendre RDV ! Les médecins sont vérifiés et les confirmations arrivent instantanément.
            Je recommande à tous mes amis."
          </p>
        </div>

        <!-- Testimonial 3 -->
        <div class="bg-gradient-to-br from-white to-gray-50 p-8 rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
          <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-gradient-to-r from-teal-600 to-cyan-600 rounded-full flex items-center justify-center mr-4">
              <span class="text-white font-bold">A</span>
            </div>
            <div>
              <h4 class="font-bold text-gray-900">Amira Gharbi</h4>
              <p class="text-gray-600 text-sm">Patient, Sousse</p>
            </div>
          </div>
          <div class="flex text-yellow-400 mb-4">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <p class="text-gray-700 leading-relaxed italic">
            "Service exceptionnel ! J'ai pu consulter un cardiologue en urgence grâce à RDV Médical.
            L'application est sécurisée et respecte la confidentialité des données médicales."
          </p>
        </div>
      </div>

      <!-- Trust indicators -->
      <div class="mt-16 text-center">
        <div class="inline-flex items-center space-x-2 bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3 rounded-2xl font-semibold shadow-lg">
          <i class="fas fa-users"></i>
          <span>Plus de 10,000 patients satisfaits</span>
        </div>
      </div>
    </div>
  </section>
  <!-- Avantages -->
  <section class="py-20 bg-gradient-to-br from-gray-900 via-blue-900 to-purple-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="absolute top-0 left-0 w-full h-full">
      <div class="absolute top-20 left-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
      <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-4xl font-bold text-white mb-4">
          Pourquoi choisir <span class="bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">RDV Médical</span> ?
        </h2>
        <p class="text-xl text-white/80 max-w-2xl mx-auto">
          Une plateforme moderne et sécurisée pour tous vos besoins médicaux
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20 hover:bg-white/20 transition-all duration-300 transform hover:scale-105 group">
          <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-emerald-500 rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
            <i class="fas fa-rocket text-white text-3xl"></i>
          </div>
          <h3 class="text-2xl font-bold text-white mb-4">Réservation Express</h3>
          <p class="text-white/80 leading-relaxed">Prenez rendez-vous en quelques clics seulement, disponible 24h/24 et 7j/7 pour votre convenience</p>
        </div>

        <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20 hover:bg-white/20 transition-all duration-300 transform hover:scale-105 group">
          <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-teal-500 rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
            <i class="fas fa-user-shield text-white text-3xl"></i>
          </div>
          <h3 class="text-2xl font-bold text-white mb-4">Médecins Vérifiés</h3>
          <p class="text-white/80 leading-relaxed">Tous nos professionnels de santé sont certifiés, expérimentés et régulièrement évalués</p>
        </div>

        <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20 hover:bg-white/20 transition-all duration-300 transform hover:scale-105 group">
          <div class="w-20 h-20 bg-gradient-to-r from-lime-500 to-green-500 rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
            <i class="fas fa-check-circle text-white text-3xl"></i>
          </div>
          <h3 class="text-2xl font-bold text-white mb-4">Confirmation Instantanée</h3>
          <p class="text-white/80 leading-relaxed">Recevez immédiatement la confirmation de votre rendez-vous avec tous les détails nécessaires</p>
        </div>
      </div>

      <!-- Trust indicators -->
      <div class="mt-16 text-center">
        <p class="text-white/60 mb-8">Ils nous font confiance</p>
        <div class="flex flex-wrap justify-center items-center gap-8 opacity-60">
          <div class="bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-3">
            <span class="text-white font-semibold">RGPD Compliant</span>
          </div>
          <div class="bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-3">
            <span class="text-white font-semibold">SSL Sécurisé</span>
          </div>
          <div class="bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-3">
            <span class="text-white font-semibold">Support 24/7</span>
          </div>
          <div class="bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-3">
            <span class="text-white font-semibold">Données Protégées</span>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Footer -->
  <footer class="bg-gradient-to-br from-gray-900 via-blue-900 to-purple-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-black/30"></div>
    <div class="absolute top-0 left-0 w-full h-full">
      <div class="absolute top-20 left-20 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl"></div>
      <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative">
      <!-- Main Footer Content -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <!-- Company Info -->
          <div class="lg:col-span-2">
            <div class="flex items-center space-x-3 mb-6">
              <div class="w-12 h-12 bg-gradient-to-r from-green-600 to-emerald-600 rounded-2xl flex items-center justify-center">
                <i class="fas fa-stethoscope text-white text-xl"></i>
              </div>
              <div>
                <h3 class="text-2xl font-bold bg-gradient-to-r from-green-400 to-emerald-400 bg-clip-text text-transparent">RDV Médical</h3>
                <p class="text-sm text-white/60">Tunisie</p>
              </div>
            </div>
            <p class="text-white/80 mb-6 leading-relaxed max-w-md">
              Votre plateforme de confiance pour prendre rendez-vous avec les meilleurs médecins en Tunisie.
              Sécurité, rapidité et qualité au service de votre santé.
            </p>
            <div class="flex space-x-4">
              <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-colors duration-300">
                <i class="fab fa-facebook-f text-white"></i>
              </a>
              <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-colors duration-300">
                <i class="fab fa-instagram text-white"></i>
              </a>
              <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-colors duration-300">
                <i class="fab fa-linkedin-in text-white"></i>
              </a>
              <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-colors duration-300">
                <i class="fab fa-twitter text-white"></i>
              </a>
            </div>
          </div>

          <!-- Quick Links -->
          <div>
            <h4 class="text-lg font-semibold mb-6 text-white">Liens Rapides</h4>
            <ul class="space-y-3">
              <li><a href="/doctors" class="text-white/70 hover:text-white transition-colors duration-200">Trouver un médecin</a></li>
              <li><a href="/specialties" class="text-white/70 hover:text-white transition-colors duration-200">Spécialités</a></li>
              <li><a href="/contact" class="text-white/70 hover:text-white transition-colors duration-200">Contact</a></li>
              <li><a href="/about" class="text-white/70 hover:text-white transition-colors duration-200">À propos</a></li>
            </ul>
          </div>

          <!-- Support -->
          <div>
            <h4 class="text-lg font-semibold mb-6 text-white">Support</h4>
            <ul class="space-y-3">
              <li class="flex items-center space-x-3">
                <i class="fas fa-envelope text-blue-400"></i>
                <span class="text-white/70">support@rdvmedical.tn</span>
              </li>
              <li class="flex items-center space-x-3">
                <i class="fas fa-phone text-green-400"></i>
                <span class="text-white/70">+216 00 000 000</span>
              </li>
              <li class="flex items-center space-x-3">
                <i class="fas fa-clock text-purple-400"></i>
                <span class="text-white/70">24/7 Support</span>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Bottom Footer -->
      <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
          <div class="flex flex-col md:flex-row justify-between items-center">
            <p class="text-white/60 text-sm">
              &copy; 2025 RDV Médical. Tous droits réservés.
            </p>
            <div class="flex space-x-6 mt-4 md:mt-0">
              <a href="#" class="text-white/60 hover:text-white text-sm transition-colors duration-200">Confidentialité</a>
              <a href="#" class="text-white/60 hover:text-white text-sm transition-colors duration-200">Conditions</a>
              <a href="#" class="text-white/60 hover:text-white text-sm transition-colors duration-200">RGPD</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Chatbot -->
  @include('components.chatbot')
</body>
</html>

