@extends('layouts.app')

@section('title', 'Tableau de bord - Mon Profil')

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
                    <i class="fas fa-user-circle text-emerald-300"></i>
                    <span class="text-sm font-semibold tracking-wide uppercase">Profil {{ Auth::user()->user_type === 'doctor' ? 'Praticien' : 'Patient' }}</span>
                </div>
                
                <h1 class="text-4xl lg:text-6xl font-extrabold mb-4 tracking-tight">
                    Tableau de <span class="bg-gradient-to-r from-emerald-200 to-white bg-clip-text text-transparent">Bord</span>
                </h1>
                
                <p class="text-emerald-50 text-xl max-w-xl leading-relaxed opacity-90">
                    Bienvenue dans votre espace personnel, <span class="font-bold">{{ Auth::user()->first_name }}</span>. Gérez vos rendez-vous et vos informations en quelques clics.
                </p>
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
@php
    $user = Auth::user();
    if($user->isDoctor()) {
        $totalAppointments = $user->doctor->appointments()->count();
        $pendingAppointments = $user->doctor->appointments()->where('status', 'pending')->count();
        $confirmedAppointments = $user->doctor->appointments()->where('status', 'confirmed')->count();
        $completedAppointments = $user->doctor->appointments()->where('status', 'completed')->count();
    } else {
        $totalAppointments = $user->patientAppointments()->count();
        $pendingAppointments = $user->patientAppointments()->where('status', 'pending')->count();
        $confirmedAppointments = $user->patientAppointments()->where('status', 'confirmed')->count();
        $completedAppointments = $user->patientAppointments()->where('status', 'completed')->count();
    }
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Stats Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="premium-card bg-white rounded-3xl p-6 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest leading-none">Total</p>
                    <span class="text-2xl font-black text-gray-900">{{ $totalAppointments }}</span>
                </div>
            </div>
            <p class="text-gray-500 text-sm">Consultations</p>
        </div>

        <div class="premium-card bg-white rounded-3xl p-6 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest leading-none">Attente</p>
                    <span class="text-2xl font-black text-gray-900">{{ $pendingAppointments }}</span>
                </div>
            </div>
            <p class="text-gray-500 text-sm">À confirmer</p>
        </div>

        <div class="premium-card bg-white rounded-3xl p-6 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-green-600">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest leading-none">Confirmés</p>
                    <span class="text-2xl font-black text-gray-900">{{ $confirmedAppointments }}</span>
                </div>
            </div>
            <p class="text-gray-500 text-sm">Rendez-vous validés</p>
        </div>

        <div class="premium-card bg-white rounded-3xl p-6 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-teal-50 rounded-2xl flex items-center justify-center text-teal-600">
                    <i class="fas fa-history text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest leading-none">Terminés</p>
                    <span class="text-2xl font-black text-gray-900">{{ $completedAppointments }}</span>
                </div>
            </div>
            <p class="text-gray-500 text-sm">Historique</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @if($user->isDoctor())
        <a href="{{ route('profile.availability') }}" class="group bg-white rounded-3xl p-8 shadow-xl border border-gray-100 hover:bg-emerald-600 transition-all duration-500 transform hover:-translate-y-2 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-full -mr-16 -mt-16 opacity-30 group-hover:bg-white/20 transition-all duration-500"></div>
            <div class="flex items-center mb-6">
                <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:bg-white group-hover:text-emerald-600 transition-all shadow-sm">
                    <i class="fas fa-calendar-alt text-2xl"></i>
                </div>
            </div>
            <h3 class="text-2xl font-extrabold text-gray-900 group-hover:text-white mb-2 transition-colors">Gérer ma disponibilité</h3>
            <p class="text-gray-500 group-hover:text-emerald-50 transition-colors leading-relaxed">Définissez vos horaires et vos créneaux de consultation.</p>
            <div class="mt-8 flex items-center text-emerald-600 group-hover:text-white font-bold transition-colors">
                <span>Accéder maintenant</span>
                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
            </div>
        </a>
        @else
        <a href="{{ route('doctors.index') }}" class="group bg-white rounded-3xl p-8 shadow-xl border border-gray-100 hover:bg-emerald-600 transition-all duration-500 transform hover:-translate-y-2 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-full -mr-16 -mt-16 opacity-30 group-hover:bg-white/20 transition-all duration-500"></div>
            <div class="flex items-center mb-6">
                <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:bg-white group-hover:text-emerald-600 transition-all shadow-sm">
                    <i class="fas fa-search-plus text-2xl"></i>
                </div>
            </div>
            <h3 class="text-2xl font-extrabold text-gray-900 group-hover:text-white mb-2 transition-colors">Trouver un médecin</h3>
            <p class="text-gray-500 group-hover:text-emerald-50 transition-colors leading-relaxed">Recherchez parmi nos spécialistes et prenez rendez-vous.</p>
            <div class="mt-8 flex items-center text-emerald-600 group-hover:text-white font-bold transition-colors">
                <span>Prendre rendez-vous</span>
                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
            </div>
        </a>
        @endif

        <a href="{{ route('appointments.index') }}" class="group bg-white rounded-3xl p-8 shadow-xl border border-gray-100 hover:bg-teal-600 transition-all duration-500 transform hover:-translate-y-2 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-bl-full -mr-16 -mt-16 opacity-30 group-hover:bg-white/20 transition-all duration-500"></div>
            <div class="flex items-center mb-6">
                <div class="w-14 h-14 bg-teal-50 rounded-2xl flex items-center justify-center text-teal-600 group-hover:bg-white group-hover:text-teal-600 transition-all shadow-sm">
                    <i class="fas fa-calendar-check text-2xl"></i>
                </div>
            </div>
            <h3 class="text-2xl font-extrabold text-gray-900 group-hover:text-white mb-2 transition-colors">Mes rendez-vous</h3>
            <p class="text-gray-500 group-hover:text-teal-50 transition-colors leading-relaxed">Consultez l'état de vos demandes et votre historique de RDV.</p>
            <div class="mt-8 flex items-center text-teal-600 group-hover:text-white font-bold transition-colors">
                <span>Voir mon agenda</span>
                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
            </div>
        </a>

        <a href="{{ route('profile') }}" class="group bg-white rounded-3xl p-8 shadow-xl border border-gray-100 hover:bg-gray-900 transition-all duration-500 transform hover:-translate-y-2 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-bl-full -mr-16 -mt-16 opacity-30 group-hover:bg-white/10 transition-all duration-500"></div>
            <div class="flex items-center mb-6">
                <div class="w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-600 group-hover:bg-white group-hover:text-gray-900 transition-all shadow-sm">
                    <i class="fas fa-user-cog text-2xl"></i>
                </div>
            </div>
            <h3 class="text-2xl font-extrabold text-gray-900 group-hover:text-white mb-2 transition-colors">Mon Profil</h3>
            <p class="text-gray-500 group-hover:text-gray-400 transition-colors leading-relaxed">Mettez à jour vos informations personnelles et votre compte.</p>
            <div class="mt-8 flex items-center text-gray-600 group-hover:text-white font-bold transition-colors">
                <span>Gérer mon compte</span>
                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
            </div>
        </a>
    </div>

    <!-- Health Tips / Portal Promo -->
    <div class="mt-16 bg-gradient-to-br from-emerald-600 to-teal-700 rounded-[2.5rem] shadow-2xl p-12 text-white relative overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-12 group">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-600/30 to-transparent opacity-50"></div>
        <div class="absolute -bottom-24 -left-20 w-80 h-80 bg-white/10 rounded-full blur-3xl group-hover:scale-110 transition-transform duration-1000"></div>
        
        <div class="relative z-10 max-w-2xl text-center lg:text-left">
            <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-md rounded-full px-4 py-1.5 mb-6">
                <i class="fas fa-lightbulb text-emerald-300"></i>
                <span class="text-xs font-bold uppercase tracking-widest">Conseils Santé</span>
            </div>
            <h2 class="text-4xl lg:text-5xl font-black mb-6 leading-tight tracking-tighter">Découvrez nos astuces pour une vie saine</h2>
            <p class="text-emerald-50 text-lg leading-relaxed opacity-90 mb-8">Accédez à notre guide complet de santé préventive, nutrition et bien-être rédigé par nos experts partenaires.</p>
            <a href="/health-tips" class="inline-flex items-center px-8 py-4 bg-white text-emerald-700 font-black rounded-2xl hover:bg-emerald-50 transition-all shadow-xl hover:shadow-emerald-900/20 transform hover:scale-105">
                <span>Explorer les conseils</span>
                <i class="fas fa-heart ml-3 text-red-400"></i>
            </a>
        </div>
        
        <div class="relative z-10 hidden lg:block">
            <div class="w-64 h-64 bg-white/20 backdrop-blur-xl rounded-full flex items-center justify-center border border-white/30 animate-float">
                <i class="fas fa-laptop-medical text-8xl text-white opacity-90"></i>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes slide-up {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-slide-up { animation: slide-up 0.6s ease-out forwards; }
.animate-float { animation: float 6s ease-in-out infinite; }
@keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-20px); } 100% { transform: translateY(0px); } }
</style>
@endsection