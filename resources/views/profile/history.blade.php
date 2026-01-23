@extends('layouts.app')

@section('title', 'Historique des rendez-vous - RDV Médical')

@section('header')
<div class="bg-gradient-to-br from-green-600 via-emerald-600 to-teal-700 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full blur-3xl animate-pulse"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative">
        <div class="flex items-center justify-between">
            <div class="animate-slide-up">
                <h1 class="text-3xl lg:text-4xl font-bold mb-2">
                    <i class="fas fa-history mr-3 text-emerald-200"></i>
                    Historique Médical
                </h1>
                <p class="text-emerald-50 text-lg opacity-90">
                    Retrouvez l'ensemble de vos consultations et suivis passés
                </p>
            </div>
            <div class="hidden md:block">
                <a href="{{ route('profile') }}" class="inline-flex items-center bg-white/20 backdrop-blur-md text-white px-6 py-3 rounded-xl hover:bg-white/30 transition-all duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Tableau de bord
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    @if($appointments->isEmpty())
        <div class="bg-white rounded-3xl p-16 shadow-xl border border-gray-100 text-center animate-fade-in">
            <div class="w-24 h-24 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-8">
                <i class="fas fa-folder-open text-emerald-400 text-4xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900 mb-4">Historique vide</h3>
            <p class="text-gray-500 max-w-sm mx-auto mb-10">Vous n'avez pas encore de rendez-vous terminés dans votre historique.</p>
            <a href="{{ route('doctors.index') }}" class="inline-flex items-center px-8 py-4 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 transition-all shadow-xl">
                Prendre mon premier RDV
            </a>
        </div>
    @else
        <div class="bg-white rounded-[2.5rem] shadow-2xl border border-gray-100 overflow-hidden animate-slide-up">
            <div class="p-8 border-b border-gray-50 bg-gray-50/50 flex justify-between items-center">
                <h2 class="text-xl font-black text-gray-900">Liste des consultations</h2>
                <span class="px-4 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-black uppercase tracking-widest">{{ $appointments->count() }} Sessions</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50/30">
                            <th class="px-8 py-5 text-left text-xs font-black text-gray-400 uppercase tracking-widest">Date & Heure</th>
                            <th class="px-8 py-5 text-left text-xs font-black text-gray-400 uppercase tracking-widest">Intervenant</th>
                            <th class="px-8 py-5 text-left text-xs font-black text-gray-400 uppercase tracking-widest">Spécialité</th>
                            <th class="px-8 py-5 text-left text-xs font-black text-gray-400 uppercase tracking-widest">Statut</th>
                            <th class="px-8 py-5 text-right text-xs font-black text-gray-400 uppercase tracking-widest">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($appointments as $appointment)
                            <tr class="hover:bg-emerald-50/30 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-gray-900 font-extrabold">{{ $appointment->appointment_date ? \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') : '-' }}</span>
                                        <span class="text-emerald-600 text-xs font-bold">{{ $appointment->appointment_time ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center text-gray-400 group-hover:bg-emerald-100 group-hover:text-emerald-600 transition-colors">
                                            <i class="fas fa-user-md"></i>
                                        </div>
                                        <span class="text-gray-700 font-bold">Dr. {{ $appointment->doctor->user->first_name }} {{ $appointment->doctor->user->last_name }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 uppercase">
                                    <span class="text-xs font-black text-gray-400 tracking-tighter">{{ $appointment->doctor && $appointment->doctor->specialty ? $appointment->doctor->specialty->name : '-' }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest
                                        {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-700' : 
                                           ($appointment->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600') }}">
                                        {{ $appointment->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <a href="{{ route('appointments.show', $appointment->id) }}" class="p-3 bg-gray-100 text-gray-400 rounded-xl hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

<style>
@keyframes slide-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
.animate-slide-up { animation: slide-up 0.5s ease-out forwards; }
@keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
.animate-fade-in { animation: fade-in 0.4s ease-in forwards; }
</style>
@endsection