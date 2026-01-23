@extends('layouts.app')

@section('title', 'Gestion de la disponibilité - RDV Médical')

@section('header')
<div class="bg-gradient-to-br from-green-600 via-emerald-600 to-teal-700 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full blur-3xl animate-pulse"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative">
        <div class="flex items-center justify-between">
            <div class="animate-slide-up">
                <h1 class="text-3xl lg:text-4xl font-bold mb-2">
                    <i class="fas fa-calendar-alt mr-3 text-emerald-200"></i>
                    Mes Disponibilités
                </h1>
                <p class="text-emerald-50 text-lg opacity-90">
                    Définissez vos horaires pour permettre aux patients de prendre RDV
                </p>
            </div>
            <div class="hidden md:block">
                <a href="{{ route('profile') }}" class="inline-flex items-center bg-white/20 backdrop-blur-md text-white px-6 py-3 rounded-xl hover:bg-white/30 transition-all duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour au profil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Messages de succès/erreur -->
    @if(session('success'))
      <div class="mb-8 bg-green-50 border-l-4 border-emerald-500 p-4 rounded-xl shadow-sm animate-fade-in">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-emerald-500 mr-3 text-xl"></i>
            <p class="text-emerald-700 font-bold">{{ session('success') }}</p>
        </div>
      </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Form Section -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2rem] shadow-xl border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-50 flex items-center justify-between">
                    <h2 class="text-xl font-black text-gray-900">Configurer mes créneaux</h2>
                    <button type="button" id="addSlot" class="inline-flex items-center px-4 py-2 bg-emerald-50 text-emerald-600 rounded-xl font-bold hover:bg-emerald-600 hover:text-white transition-all">
                        <i class="fas fa-plus mr-2"></i>Nouveau Jour
                    </button>
                </div>
                
                <form method="POST" action="{{ route('profile.availability.update') }}" class="p-8">
                    @csrf
                    <div id="availabilitySlots" class="space-y-6">
                        @if(isset($availability) && count($availability) > 0)
                            @foreach($availability as $index => $slot)
                            <div class="availability-slot bg-gray-50 rounded-2xl p-6 border border-gray-100 relative group animate-slide-up">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Jour de la semaine</label>
                                        <select name="availability[{{ $index }}][day]" class="w-full bg-white border border-gray-200 px-4 py-3 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all font-bold text-gray-700">
                                            <option value="monday" {{ isset($slot['day']) && $slot['day'] == 'monday' ? 'selected' : '' }}>Lundi</option>
                                            <option value="tuesday" {{ isset($slot['day']) && $slot['day'] == 'tuesday' ? 'selected' : '' }}>Mardi</option>
                                            <option value="wednesday" {{ isset($slot['day']) && $slot['day'] == 'wednesday' ? 'selected' : '' }}>Mercredi</option>
                                            <option value="thursday" {{ isset($slot['day']) && $slot['day'] == 'thursday' ? 'selected' : '' }}>Jeudi</option>
                                            <option value="friday" {{ isset($slot['day']) && $slot['day'] == 'friday' ? 'selected' : '' }}>Vendredi</option>
                                            <option value="saturday" {{ isset($slot['day']) && $slot['day'] == 'saturday' ? 'selected' : '' }}>Samedi</option>
                                            <option value="sunday" {{ isset($slot['day']) && $slot['day'] == 'sunday' ? 'selected' : '' }}>Dimanche</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Heure Début</label>
                                        <input type="time" name="availability[{{ $index }}][from]" value="{{ $slot['from'] ?? '' }}" 
                                               class="w-full bg-white border border-gray-200 px-4 py-3 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent font-bold text-gray-700">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Heure Fin</label>
                                        <input type="time" name="availability[{{ $index }}][to]" value="{{ $slot['to'] ?? '' }}" 
                                               class="w-full bg-white border border-gray-200 px-4 py-3 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent font-bold text-gray-700">
                                    </div>
                                </div>
                                <button type="button" class="remove-slot absolute -top-3 -right-3 w-8 h-8 bg-white text-red-500 rounded-full shadow-lg flex items-center justify-center hover:bg-red-500 hover:text-white transition-all opacity-0 group-hover:opacity-100">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            @endforeach
                        @else
                            <div class="availability-slot bg-gray-50 rounded-2xl p-6 border border-gray-100 animate-slide-up">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Jour</label>
                                        <select name="availability[0][day]" class="w-full bg-white border border-gray-200 px-4 py-3 rounded-xl font-bold">
                                            <option value="monday">Lundi</option>
                                            <option value="tuesday">Mardi</option>
                                            <option value="wednesday">Mercredi</option>
                                            <option value="thursday">Jeudi</option>
                                            <option value="friday">Vendredi</option>
                                            <option value="saturday">Samedi</option>
                                            <option value="sunday">Dimanche</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">De</label>
                                        <input type="time" name="availability[0][from]" class="w-full bg-white border border-gray-200 px-4 py-3 rounded-xl font-bold">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">À</label>
                                        <input type="time" name="availability[0][to]" class="w-full bg-white border border-gray-200 px-4 py-3 rounded-xl font-bold">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mt-12 flex gap-4">
                        <button type="submit" class="flex-1 bg-emerald-600 text-white px-8 py-4 rounded-2xl font-black shadow-xl shadow-emerald-200 hover:bg-emerald-700 transition-all transform hover:scale-[1.02]">
                            Sauvegarder mon planning
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Sidebar -->
        <div class="lg:col-span-1 space-y-8">
            <div class="bg-gray-900 rounded-[2rem] p-8 text-white relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-bl-full -mr-16 -mt-16"></div>
                <h3 class="text-xl font-black mb-6 flex items-center">
                    <i class="fas fa-info-circle text-emerald-400 mr-3"></i>Conseils
                </h3>
                <ul class="space-y-4 text-sm text-gray-400 font-medium leading-relaxed">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check text-emerald-500 mt-1"></i>
                        <span>Évitez les chevauchements d'horaires.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check text-emerald-500 mt-1"></i>
                        <span>Laissez du temps pour vos urgences.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check text-emerald-500 mt-1"></i>
                        <span>Mettez à jour régulièrement votre agenda.</span>
                    </li>
                </ul>
            </div>

            <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-xl">
                 <h3 class="text-lg font-black text-gray-900 mb-6">Aperçu rapide</h3>
                 @if(isset($availability) && count($availability) > 0)
                    <div class="space-y-3">
                        @php
                            $daysMap = ['monday'=>'Lun','tuesday'=>'Mar','wednesday'=>'Mer','thursday'=>'Jeu','friday'=>'Ven','saturday'=>'Sam','sunday'=>'Dim'];
                        @endphp
                        @foreach($availability as $slot)
                        <div class="flex justify-between items-center bg-gray-50 rounded-xl px-4 py-2">
                            <span class="font-black text-gray-700">{{ $daysMap[$slot['day']] ?? $slot['day'] }}</span>
                            <span class="text-xs font-bold text-emerald-600">{{ $slot['from'] }} - {{ $slot['to'] }}</span>
                        </div>
                        @endforeach
                    </div>
                 @else
                    <p class="text-gray-400 text-sm text-center py-4 italic">Aucun planning défini.</p>
                 @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      let slotIndex = {{ isset($availability) && count($availability) > 0 ? count($availability) : 1 }};
      const container = document.getElementById('availabilitySlots');
      
      document.getElementById('addSlot').addEventListener('click', function() {
        const div = document.createElement('div');
        div.className = 'availability-slot bg-gray-50 rounded-2xl p-6 border border-gray-100 relative group animate-slide-up';
        div.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Jour</label>
                    <select name="availability[${slotIndex}][day]" class="w-full bg-white border border-gray-200 px-4 py-3 rounded-xl font-bold">
                        <option value="monday">Lundi</option>
                        <option value="tuesday">Mardi</option>
                        <option value="wednesday">Mercredi</option>
                        <option value="thursday">Jeudi</option>
                        <option value="friday">Vendredi</option>
                        <option value="saturday">Samedi</option>
                        <option value="sunday">Dimanche</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">De</label>
                    <input type="time" name="availability[${slotIndex}][from]" class="w-full bg-white border border-gray-200 px-4 py-3 rounded-xl font-bold">
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">À</label>
                    <input type="time" name="availability[${slotIndex}][to]" class="w-full bg-white border border-gray-200 px-4 py-3 rounded-xl font-bold">
                </div>
            </div>
            <button type="button" class="remove-slot absolute -top-3 -right-3 w-8 h-8 bg-white text-red-500 rounded-full shadow-lg flex items-center justify-center hover:bg-red-500 hover:text-white transition-all">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(div);
        slotIndex++;
      });
      
      document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-slot')) {
          e.target.closest('.availability-slot').remove();
        }
      });
    });
</script>

<style>
@keyframes slide-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
.animate-slide-up { animation: slide-up 0.5s ease-out forwards; }
@keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
.animate-fade-in { animation: fade-in 0.4s ease-in forwards; }
</style>
@endsection