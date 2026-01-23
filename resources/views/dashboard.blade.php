@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('header')
<div class="bg-gradient-to-br from-green-600 via-emerald-600 to-teal-700 text-white relative overflow-hidden">
    <!-- Premium background elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-10 -left-10 w-64 h-64 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-20 right-10 w-96 h-96 bg-emerald-400/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-0 left-1/4 w-72 h-72 bg-teal-300/10 rounded-full blur-2xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="animate-slide-up text-center md:text-left">
                <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-md rounded-full px-4 py-2 mb-6">
                    <i class="fas fa-check-circle text-emerald-300"></i>
                    <span class="text-sm font-semibold tracking-wide uppercase">Tableau de bord {{ Auth::user()->user_type === 'doctor' ? 'Praticien' : 'Patient' }}</span>
                </div>
                
                <h1 class="text-4xl lg:text-6xl font-extrabold mb-4 tracking-tight">
                    Bonjour, <span class="bg-gradient-to-r from-emerald-200 to-white bg-clip-text text-transparent">{{ Auth::user()->first_name }}</span>
                </h1>
                
                <p class="text-emerald-50 text-xl max-w-xl leading-relaxed opacity-90">
                    Gérez vos rendez-vous et accédez à vos informations médicales en toute sécurité sur votre plateforme préférée.
                </p>
                
                <div class="flex flex-wrap justify-center md:justify-start items-center gap-6 mt-8">
                    <div class="text-center bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 min-w-[120px]">
                        <div class="text-3xl font-bold text-white">{{ \App\Models\Appointment::where(Auth::user()->user_type . '_id', Auth::user()->id)->count() }}</div>
                        <div class="text-xs text-emerald-200 uppercase font-bold tracking-widest mt-1">Total RDV</div>
                    </div>
                    <div class="text-center bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 min-w-[120px]">
                        <div class="text-3xl font-bold text-white">{{ \App\Models\Appointment::where(Auth::user()->user_type . '_id', Auth::user()->id)->where('status', 'confirmed')->count() }}</div>
                        <div class="text-xs text-emerald-200 uppercase font-bold tracking-widest mt-1">Confirmés</div>
                    </div>
                </div>
            </div>
            
            <div class="animate-fade-in hidden md:block" style="animation-delay: 0.4s;">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->first_name . ' ' . Auth::user()->last_name) }}&background=ffffff&color=059669&size=256" 
                         class="relative w-40 h-40 rounded-3xl border-4 border-white/30 shadow-2xl transition duration-500 group-hover:scale-105" 
                         alt="Avatar">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-calendar-check text-2xl"></i>
                </div>
                <div class="text-right">
                    <span class="text-3xl font-black text-gray-900">{{ \App\Models\Appointment::where(Auth::user()->user_type . '_id', Auth::user()->id)->count() }}</span>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Activités</p>
                </div>
            </div>
            <h4 class="text-xl font-bold text-gray-800 mb-2">Total consultations</h4>
            <p class="text-gray-500 text-sm leading-relaxed">Historique complet de vos interactions avec nos praticiens.</p>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 group-hover:bg-amber-500 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-hourglass-half text-2xl"></i>
                </div>
                <div class="text-right">
                    <span class="text-3xl font-black text-gray-900">{{ \App\Models\Appointment::where(Auth::user()->user_type . '_id', Auth::user()->id)->where('status', 'pending')->count() }}</span>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">En cours</p>
                </div>
            </div>
            <h4 class="text-xl font-bold text-gray-800 mb-2">À Valider</h4>
            <p class="text-gray-500 text-sm leading-relaxed">Demandes de rendez-vous en attente de confirmation.</p>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-teal-50 rounded-2xl flex items-center justify-center text-teal-600 group-hover:bg-teal-600 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-heartbeat text-2xl"></i>
                </div>
                <div class="text-right">
                    <span class="text-3xl font-black text-gray-900">Actif</span>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Statut</p>
                </div>
            </div>
            <h4 class="text-xl font-bold text-gray-800 mb-2">Santé & Bien-être</h4>
            <p class="text-gray-500 text-sm leading-relaxed">Votre compte est actif et prêt pour vos prochaines consultations.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Dashboard Sidebar -->
        <div class="lg:col-span-1 space-y-8">
            <!-- Navigation Card -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 overflow-hidden relative">
                <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-50 rounded-bl-full -mr-12 -mt-12 opacity-50"></div>
                
                <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center">
                    <span class="w-2 h-8 bg-emerald-600 rounded-full mr-4"></span>
                    Actions rapides
                </h2>
                
                <div class="space-y-4">
                    @if(Auth::user()->user_type === 'patient')
                    <a href="{{ route('doctors.index') }}" class="group flex items-center p-5 bg-emerald-50 rounded-2xl border border-emerald-100 hover:bg-emerald-600 transition-all duration-300">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-emerald-600 mr-4 shadow-sm group-hover:scale-110 transition-transform">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div>
                            <p class="font-bold text-emerald-900 group-hover:text-white transition-colors">Prendre RDV</p>
                            <p class="text-xs text-emerald-600 group-hover:text-emerald-100 transition-colors">Solution santé immédiate</p>
                        </div>
                    </a>
                    @endif
                    
                    <a href="{{ route('appointments.index') }}" class="group flex items-center p-5 bg-teal-50 rounded-2xl border border-teal-100 hover:bg-teal-600 transition-all duration-300">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-teal-600 mr-4 shadow-sm group-hover:scale-110 transition-transform">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div>
                            <p class="font-bold text-teal-900 group-hover:text-white transition-colors">Mes Rendez-vous</p>
                            <p class="text-xs text-teal-600 group-hover:text-teal-100 transition-colors">Suivi & Historique</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('profile') }}" class="group flex items-center p-5 bg-gray-50 rounded-2xl border border-gray-100 hover:bg-gray-900 transition-all duration-300">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-gray-600 mr-4 shadow-sm group-hover:scale-110 transition-transform">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-800 group-hover:text-white transition-colors">Mon Profil</p>
                            <p class="text-xs text-gray-500 group-hover:text-gray-400 transition-colors">Gérer mes infos</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Health Tips Promo -->
            <div class="bg-gradient-to-br from-emerald-600 to-teal-700 rounded-3xl shadow-xl p-8 text-white relative overflow-hidden group">
                <div class="absolute -bottom-8 -right-8 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-lightbulb text-emerald-200"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 leading-tight">Nos conseils pour une meilleure santé</h3>
                    <p class="text-emerald-100/80 mb-8 text-sm leading-relaxed">Découvrez des articles exclusifs rédigés par nos experts pour rester en forme naturellement.</p>
                    <a href="/health-tips" class="inline-flex items-center space-x-3 bg-white text-emerald-700 px-6 py-3 rounded-xl font-bold hover:shadow-2xl transition-all transform hover:scale-105">
                        <span>Explorer le guide</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content (Appointments) -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4 bg-gray-50/50">
                    <div>
                        <h2 class="text-2xl font-black text-gray-900 tracking-tight">Rendez-vous récents</h2>
                        <p class="text-gray-500 text-sm">Vos 5 dernières activités sur la plateforme</p>
                    </div>
                    <a href="{{ route('appointments.index') }}" class="inline-flex items-center px-5 py-2 bg-white border border-gray-200 text-emerald-600 font-bold rounded-xl hover:bg-emerald-50 transition-colors shadow-sm">
                        <span>Voir tout</span>
                        <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                    </a>
                </div>
                
                @php
                    $recentAppointments = \App\Models\Appointment::where(Auth::user()->user_type . '_id', Auth::user()->id)
                        ->orderBy('appointment_date', 'desc')
                        ->orderBy('appointment_time', 'desc')
                        ->limit(5)
                        ->get();
                @endphp

                @if($recentAppointments->count() > 0)
                <div class="divide-y divide-gray-100">
                    @foreach($recentAppointments as $appointment)
                    <div class="p-8 hover:bg-emerald-50/30 transition-all duration-300 group">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                            <div class="flex items-center gap-6">
                                <div class="relative">
                                    <div class="w-16 h-16 rounded-2xl bg-white border border-gray-200 flex items-center justify-center shadow-sm group-hover:border-emerald-200 transition-colors">
                                        <i class="fas fa-user-{{ Auth::user()->user_type === 'doctor' ? 'patient' : 'md' }} text-2xl text-emerald-600 opacity-70"></i>
                                    </div>
                                    <div class="absolute -top-1 -right-1 w-4 h-4 rounded-full border-2 border-white {{ $appointment->status === 'confirmed' ? 'bg-green-500' : 'bg-amber-500' }}"></div>
                                </div>
                                <div>
                                    <p class="font-extrabold text-gray-900 group-hover:text-emerald-900 transition-colors">
                                        @if(Auth::user()->user_type === 'doctor')
                                            {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}
                                        @else
                                            Dr. {{ $appointment->doctor->user->first_name }} {{ $appointment->doctor->user->last_name }}
                                        @endif
                                    </p>
                                    <div class="flex items-center gap-3 mt-1">
                                        <span class="text-sm font-semibold text-gray-500 flex items-center">
                                            <i class="far fa-calendar-alt mr-2 text-emerald-500"></i>
                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                                        </span>
                                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                        <span class="text-sm font-semibold text-gray-500 flex items-center">
                                            <i class="far fa-clock mr-2 text-emerald-500"></i>
                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-tighter shadow-sm
                                    {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-700' : 
                                       ($appointment->status === 'pending' ? 'bg-amber-100 text-amber-700' : 
                                       ($appointment->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700')) }}">
                                    {{ $appointment->status }}
                                </div>
                                <a href="{{ route('appointments.show', $appointment->id) }}" class="p-3 bg-gray-100 text-gray-400 rounded-xl hover:bg-emerald-600 hover:text-white transition-all">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="p-20 text-center">
                    <div class="w-24 h-24 bg-emerald-50 rounded-3xl flex items-center justify-center mx-auto mb-8 animate-bounce">
                        <i class="fas fa-calendar-plus text-emerald-400 text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-2">Aucune activité récente</h3>
                    <p class="text-gray-500 mb-10 max-w-sm mx-auto">Votre agenda est vide pour le moment. Commencez par planifier votre première consultation avec nos spécialistes.</p>
                    @if(Auth::user()->user_type === 'patient')
                    <a href="{{ route('doctors.index') }}" class="inline-flex items-center px-8 py-4 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 transition-all shadow-xl hover:shadow-emerald-200/50 transform hover:scale-105">
                        <span>Trouver un médecin</span>
                        <i class="fas fa-arrow-right ml-3"></i>
                    </a>
                    @endif
                </div>
                @endif
            </div>

            <!-- Health Portal Banner -->
            <div class="mt-8 bg-gray-900 rounded-3xl shadow-2xl p-10 text-white relative overflow-hidden flex flex-col sm:flex-row items-center justify-between gap-8 group">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-600/20 to-transparent opacity-50"></div>
                <div class="relative z-10 max-w-sm">
                    <h4 class="text-2xl font-black mb-3 leading-tight tracking-tight">Accédez à votre espace santé 24/7</h4>
                    <p class="text-gray-400 text-sm leading-relaxed">Téléchargez notre application mobile pour garder votre carnet de santé à portée de main.</p>
                </div>
                <div class="relative z-10 flex gap-4">
                    <a href="#" class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center hover:bg-emerald-600 hover:scale-110 transition-all duration-300">
                        <i class="fab fa-apple text-2xl"></i>
                    </a>
                    <a href="#" class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center hover:bg-emerald-600 hover:scale-110 transition-all duration-300">
                        <i class="fab fa-google-play text-2xl text-teal-400"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
