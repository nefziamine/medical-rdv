@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold mb-6 text-gray-900">Historique des rendez-vous</h1>
    @if($appointments->isEmpty())
        <div class="bg-white p-6 rounded shadow text-center text-gray-500">
            Aucun rendez-vous trouvé dans votre historique.
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Heure</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Médecin</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Spécialité</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($appointments as $appointment)
                        <tr>
                            <td class="px-4 py-2">{{ $appointment->date ? $appointment->date->format('d/m/Y') : '-' }}</td>
                            <td class="px-4 py-2">{{ $appointment->time ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $appointment->doctor ? $appointment->doctor->user->getFullNameAttribute() : '-' }}</td>
                            <td class="px-4 py-2">{{ $appointment->doctor && $appointment->doctor->specialty ? $appointment->doctor->specialty->name : '-' }}</td>
                            <td class="px-4 py-2">
                                @if($appointment->status === 'confirmed')
                                    <span class="text-green-600 font-semibold">Confirmé</span>
                                @elseif($appointment->status === 'cancelled')
                                    <span class="text-red-600 font-semibold">Annulé</span>
                                @else
                                    <span class="text-gray-600">{{ ucfirst($appointment->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <div class="mt-8">
        <a href="{{ route('profile.patient') }}" class="inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Retour au profil</a>
    </div>
</div>
@endsection 