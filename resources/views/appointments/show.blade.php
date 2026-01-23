@extends('layouts.app')

@section('title', 'Détails du rendez-vous - RDV Médical')

@section('header')
<div class="bg-gradient-to-br from-green-600 via-emerald-600 to-teal-700 text-white relative overflow-hidden">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full blur-3xl animate-pulse"></div>
  </div>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative">
    <div class="flex items-center justify-between">
      <div class="animate-slide-up">
        <h1 class="text-3xl lg:text-4xl font-bold mb-2">
          <i class="fas fa-calendar-check mr-3 text-emerald-200"></i>
          Détails du rendez-vous
        </h1>
        <p class="text-emerald-50 text-lg opacity-90">
          Informations complètes sur votre consultation médicale
        </p>
      </div>
      <div class="hidden md:block">
        <a href="{{ route('appointments.index') }}" class="inline-flex items-center bg-white/20 backdrop-blur-md text-white px-6 py-3 rounded-xl hover:bg-white/30 transition-all duration-300">
          <i class="fas fa-arrow-left mr-2"></i>
          Retour à l'agenda
        </a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if(session('error'))
      <div class="mb-8 bg-red-50 border-l-4 border-red-500 p-4 rounded-xl shadow-sm animate-fade-in">
        <div class="flex items-center">
          <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
          <p class="text-red-700 font-medium">{{ session('error') }}</p>
        </div>
      </div>
    @endif

    @if($appointment && $appointment->id)
      <div class="bg-white rounded-[2.5rem] shadow-2xl border border-gray-100 overflow-hidden animate-slide-up">
        <div class="p-8 lg:p-12">
            <!-- Top Bar with Status -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 shadow-sm">
                        <i class="fas fa-file-medical text-3xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-900 tracking-tight">Récapitulatif de la séance</h2>
                        <p class="text-gray-500 font-medium">Référence #{{ str_pad($appointment->id, 6, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
                
                <div class="inline-flex items-center px-8 py-3 rounded-2xl text-sm font-black uppercase tracking-widest shadow-sm
                    @if($appointment->status === 'confirmed') bg-green-100 text-green-700
                    @elseif($appointment->status === 'completed') bg-emerald-600 text-white
                    @elseif($appointment->status === 'cancelled') bg-red-100 text-red-700
                    @else bg-amber-100 text-amber-700 @endif">
                    <span class="w-2 h-2 rounded-full mr-3 animate-pulse {{ $appointment->status === 'completed' ? 'bg-white' : 'bg-current' }}"></span>
                    {{ $appointment->status }}
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Left Column: Patient/Doctor Info -->
                <div class="lg:col-span-1 space-y-8">
                    <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-100/50 rounded-bl-full -mr-12 -mt-12 group-hover:scale-110 transition-transform"></div>
                        
                        <h3 class="text-xs font-black text-emerald-600 uppercase tracking-widest mb-6">Informations Intervenant</h3>
                        
                        <div class="flex items-center gap-4 mb-8">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->isDoctor() ? $appointment->patient->first_name . ' ' . $appointment->patient->last_name : $appointment->doctor->user->first_name . ' ' . $appointment->doctor->user->last_name) }}&background=10b981&color=ffffff" 
                                 class="w-16 h-16 rounded-2xl shadow-md border-2 border-white" alt="User">
                            <div>
                                <p class="font-extrabold text-gray-900 text-lg">
                                    {{ Auth::user()->isDoctor() ? $appointment->patient->first_name . ' ' . $appointment->patient->last_name : 'Dr. ' . $appointment->doctor->user->first_name . ' ' . $appointment->doctor->user->last_name }}
                                </p>
                                <p class="text-sm text-gray-500 font-medium">{{ Auth::user()->isDoctor() ? 'Patient' : $appointment->doctor->specialty->name ?? 'Médecin' }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center gap-3 text-gray-600">
                                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm"><i class="fas fa-envelope text-emerald-500"></i></div>
                                <span class="text-sm font-bold truncate">{{ Auth::user()->isDoctor() ? $appointment->patient->email : $appointment->doctor->user->email }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-gray-600">
                                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm"><i class="fas fa-phone text-teal-500"></i></div>
                                <span class="text-sm font-bold">{{ Auth::user()->isDoctor() ? ($appointment->patient->phone ?? 'N/A') : ($appointment->doctor->user->phone ?? 'N/A') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Financial Summary -->
                    <div class="bg-gray-900 rounded-3xl p-8 text-white">
                        <h3 class="text-xs font-black text-emerald-400 uppercase tracking-widest mb-6 text-center">Frais de consultation</h3>
                        <div class="text-center">
                            <span class="text-5xl font-black">{{ $appointment->fee }} DT</span>
                            <p class="text-gray-400 text-xs mt-2 uppercase tracking-widest font-bold">Total à régler au cabinet</p>
                        </div>
                        <div class="mt-8 pt-8 border-t border-white/10 flex justify-between items-center text-sm">
                            <span class="text-gray-400 font-bold">TVA incluse</span>
                            <span class="text-emerald-400 font-bold">100% Sécurisé</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Appointment Details -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-emerald-50 rounded-3xl p-6 border border-emerald-100 flex items-center gap-5">
                            <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-emerald-600 shadow-sm">
                                <i class="fas fa-calendar-day text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Date de session</p>
                                <p class="text-xl font-black text-emerald-900">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="bg-teal-50 rounded-3xl p-6 border border-teal-100 flex items-center gap-5">
                            <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-teal-600 shadow-sm">
                                <i class="fas fa-clock text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-teal-600 uppercase tracking-widest">Heure exacte</p>
                                <p class="text-xl font-black text-teal-900">{{ $appointment->appointment_time }}</p>
                            </div>
                        </div>
                        <div class="bg-amber-50 rounded-3xl p-6 border border-amber-100 flex items-center gap-5">
                            <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-amber-600 shadow-sm">
                                <i class="fas fa-video text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-amber-600 uppercase tracking-widest">Type de visite</p>
                                <p class="text-xl font-black text-amber-900">{{ $appointment->appointment_type === 'in_person' ? 'Présentiel' : 'Consultation Vidéo' }}</p>
                            </div>
                        </div>
                        <div class="bg-rose-50 rounded-3xl p-6 border border-rose-100 flex items-center gap-5">
                            <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-rose-600 shadow-sm">
                                <i class="fas fa-map-marker-alt text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-rose-600 uppercase tracking-widest">Localisation</p>
                                <p class="text-lg font-black text-rose-900 truncate max-w-[150px]">{{ $appointment->doctor->clinic_address ?? 'Cabinet Médical' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Notes Section -->
                    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <i class="fas fa-sticky-note text-emerald-600"></i>
                            <h3 class="text-lg font-black text-gray-900">Notes & Recommandations</h3>
                        </div>
                        <div class="bg-gray-50 rounded-2xl p-6 text-gray-600 italic">
                            {{ $appointment->notes ?: 'Aucune note particulière fournie pour ce rendez-vous.' }}
                        </div>
                    </div>

                    <!-- Action Footer -->
                    <div class="pt-8 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('appointments.index') }}" class="flex-1 px-8 py-4 bg-gray-100 text-gray-600 font-bold rounded-2xl hover:bg-gray-200 transition-all text-center">
                            Fermer les détails
                        </a>
                        
                        @if($appointment->status === 'pending')
                        <div class="flex-[2] flex gap-4">
                             @if(Auth::user()->isDoctor())
                                <form method="POST" action="{{ route('appointments.confirm', $appointment->id) }}" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full px-8 py-4 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200">
                                        Confirmer la séance
                                    </button>
                                </form>
                             @endif
                             
                             <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Annuler ce RDV ?')" class="w-full px-8 py-4 bg-red-50 text-red-600 font-black rounded-2xl hover:bg-red-600 hover:text-white transition-all">
                                    Annuler le RDV
                                </button>
                             </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
      </div>
    @else
      <div class="text-center py-20 bg-white rounded-3xl shadow-xl border border-gray-100">
        <div class="w-24 h-24 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-search-minus text-red-500 text-3xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-4">Rendez-vous introuvable</h3>
        <p class="text-gray-500 mb-8 max-w-sm mx-auto">Nous ne parvenons pas à charger les détails de cette consultation.</p>
        <a href="{{ route('appointments.index') }}" class="inline-flex items-center text-emerald-600 font-bold hover:underline">
            <i class="fas fa-arrow-left mr-2"></i>Retour à l'agenda
        </a>
      </div>
    @endif
</div>

<style>
@keyframes slide-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
.animate-slide-up { animation: slide-up 0.6s ease-out forwards; }
.animate-fade-in { animation: fadeIn 0.4s ease-in forwards; }
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
</style>
@endsection