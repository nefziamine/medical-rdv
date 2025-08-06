<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $specialty->name }} - RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Tajawal', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  <!-- Specialty Header -->
  <div class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="flex items-center space-x-4">
        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
          <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
          </svg>
        </div>
        <div>
          <h1 class="text-3xl font-bold text-gray-900">{{ $specialty->name }}</h1>
          @if($specialty->description)
            <p class="text-gray-600 mt-2">{{ $specialty->description }}</p>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- Fiche de présentation de la spécialité -->
  <div class="max-w-3xl mx-auto my-8 bg-gray-50 border border-gray-200 rounded-xl shadow p-8">
    @if($specialty->slug === 'cardiology')
      <div>
        <div class="flex items-center mb-4">
          <span class="text-3xl mr-2">🫀</span>
          <span class="text-xl font-bold">Fiche de présentation : La Cardiologie</span>
        </div>
        <ul class="space-y-4">
          <li><span class="font-semibold text-green-700">✅ Définition :</span><br>
            La cardiologie est une spécialité de la médecine qui s’occupe des maladies du cœur et des vaisseaux sanguins (artères et veines).
          </li>
          <li><span class="font-semibold text-blue-700">🩺 Rôle du cardiologue :</span><br>
            Le cardiologue est le médecin spécialiste du cœur. Il :
            <ul class="list-disc list-inside ml-4">
              <li>Diagnostique les problèmes cardiaques,</li>
              <li>Propose des traitements (médicaments, interventions…),</li>
              <li>Suit les patients atteints de maladies cardiovasculaires.</li>
            </ul>
          </li>
          <li><span class="font-semibold text-red-700">❤️ Maladies prises en charge :</span>
            <ul class="list-disc list-inside ml-4">
              <li>Hypertension artérielle (pression élevée),</li>
              <li>Infarctus du myocarde (crise cardiaque),</li>
              <li>Arythmies (troubles du rythme du cœur),</li>
              <li>Insuffisance cardiaque,</li>
              <li>Malformations cardiaques.</li>
            </ul>
          </li>
          <li><span class="font-semibold text-purple-700">🔍 Examens réalisés :</span>
            <ul class="list-disc list-inside ml-4">
              <li>Électrocardiogramme (ECG),</li>
              <li>Échographie cardiaque,</li>
              <li>Test d’effort,</li>
              <li>Coronarographie.</li>
            </ul>
          </li>
          <li><span class="font-semibold text-green-700">🥦 Prévention :</span><br>
            Pour garder un cœur en bonne santé :
            <ul class="list-disc list-inside ml-4">
              <li>Avoir une alimentation équilibrée,</li>
              <li>Faire du sport régulièrement,</li>
              <li>Éviter le tabac et l’alcool,</li>
              <li>Surveiller sa tension et son cholestérol.</li>
            </ul>
          </li>
          <li><span class="font-semibold text-pink-700">🧠 Petite info intéressante :</span><br>
            Le cœur bat en moyenne 100 000 fois par jour et pompe environ 5 litres de sang par minute !
          </li>
        </ul>
      </div>
    @elseif($specialty->slug === 'dermatology')
      <div>
        <div class="flex items-center mb-4">
          <span class="text-3xl mr-2">🧴</span>
          <span class="text-xl font-bold">Fiche de présentation : La Dermatologie</span>
        </div>
        <ul class="space-y-4">
          <li><span class="font-semibold text-green-700">✅ Définition :</span><br>
            La dermatologie est la spécialité médicale qui s’occupe de la peau, des cheveux, des ongles et des muqueuses.
          </li>
          <li><span class="font-semibold text-blue-700">🩺 Rôle du dermatologue :</span><br>
            Le dermatologue :
            <ul class="list-disc list-inside ml-4">
              <li>Diagnostique et traite les maladies de la peau,</li>
              <li>Prend en charge les allergies cutanées,</li>
              <li>Réalise des actes esthétiques (laser, injections, etc.).</li>
            </ul>
          </li>
          <li><span class="font-semibold text-red-700">🌞 Maladies prises en charge :</span>
            <ul class="list-disc list-inside ml-4">
              <li>Eczéma, psoriasis, acné,</li>
              <li>Infections de la peau,</li>
              <li>Chute de cheveux,</li>
              <li>Cancers de la peau.</li>
            </ul>
          </li>
          <li><span class="font-semibold text-purple-700">🔍 Examens réalisés :</span>
            <ul class="list-disc list-inside ml-4">
              <li>Biopsie cutanée,</li>
              <li>Dermatoscopie,</li>
              <li>Tests allergologiques.</li>
            </ul>
          </li>
          <li><span class="font-semibold text-green-700">🧴 Prévention :</span><br>
            <ul class="list-disc list-inside ml-4">
              <li>Protéger sa peau du soleil,</li>
              <li>Hydrater régulièrement,</li>
              <li>Consulter en cas de lésion suspecte.</li>
            </ul>
          </li>
          <li><span class="font-semibold text-pink-700">🧠 Petite info intéressante :</span><br>
            La peau est l’organe le plus grand du corps humain !
          </li>
        </ul>
      </div>
    @elseif($specialty->slug === 'pediatrics')
      <div>
        <div class="flex items-center mb-4">
          <span class="text-3xl mr-2">🧒</span>
          <span class="text-xl font-bold">Fiche de présentation : La Pédiatrie</span>
        </div>
        <ul class="space-y-4">
          <li><span class="font-semibold text-green-700">✅ Définition :</span><br>
            La pédiatrie est la spécialité médicale qui s’occupe de la santé des enfants, de la naissance à l’adolescence.
          </li>
          <li><span class="font-semibold text-blue-700">🩺 Rôle du pédiatre :</span><br>
            Le pédiatre :
            <ul class="list-disc list-inside ml-4">
              <li>Suit la croissance et le développement de l’enfant,</li>
              <li>Diagnostique et traite les maladies infantiles,</li>
              <li>Assure la prévention (vaccins, conseils nutritionnels…)</li>
            </ul>
          </li>
          <li><span class="font-semibold text-red-700">👶 Maladies prises en charge :</span>
            <ul class="list-disc list-inside ml-4">
              <li>Infections infantiles (angine, otite…),</li>
              <li>Asthme, allergies,</li>
              <li>Problèmes de croissance,</li>
              <li>Maladies chroniques de l’enfant.</li>
            </ul>
          </li>
          <li><span class="font-semibold text-purple-700">🔍 Examens réalisés :</span>
            <ul class="list-disc list-inside ml-4">
              <li>Examens cliniques réguliers,</li>
              <li>Tests auditifs et visuels,</li>
              <li>Bilans sanguins.</li>
            </ul>
          </li>
          <li><span class="font-semibold text-green-700">🥦 Prévention :</span><br>
            <ul class="list-disc list-inside ml-4">
              <li>Vaccination,</li>
              <li>Alimentation équilibrée,</li>
              <li>Suivi médical régulier.</li>
            </ul>
          </li>
          <li><span class="font-semibold text-pink-700">🧠 Petite info intéressante :</span><br>
            Un enfant double son poids de naissance en 5 mois et le triple en 1 an !
          </li>
        </ul>
      </div>
    @elseif($specialty->slug === 'gynecology')
      <div>
        <div class="flex items-center mb-4">
          <span class="text-3xl mr-2">❤️</span>
          <span class="text-xl font-bold">Fiche de présentation : La Gynécologie</span>
        </div>
        <ul class="space-y-4">
          <li><span class="font-semibold text-green-700">✅ Définition :</span><br>
            La gynécologie est la spécialité médicale qui s’occupe de la santé de la femme et de l’appareil génital féminin.
          </li>
          <li><span class="font-semibold text-blue-700">🩺 Rôle du gynécologue :</span><br>
            Le gynécologue :
            <ul class="list-disc list-inside ml-4">
              <li>Suit la grossesse et l’accouchement,</li>
              <li>Diagnostique et traite les maladies gynécologiques,</li>
              <li>Assure la prévention (dépistage, contraception…)</li>
            </ul>
          </li>
          <li><span class="font-semibold text-red-700">👩‍⚕️ Maladies prises en charge :</span>
            <ul class="list-disc list-inside ml-4">
              <li>Infections génitales,</li>
              <li>Fibromes, kystes,</li>
              <li>Endométriose,</li>
              <li>Cancers gynécologiques.</li>
            </ul>
          </li>
          <li><span class="font-semibold text-purple-700">🔍 Examens réalisés :</span>
            <ul class="list-disc list-inside ml-4">
              <li>Frottis,</li>
              <li>Échographie pelvienne,</li>
              <li>Mammographie.</li>
            </ul>
          </li>
          <li><span class="font-semibold text-green-700">🌸 Prévention :</span><br>
            <ul class="list-disc list-inside ml-4">
              <li>Dépistage régulier,</li>
              <li>Hygiène intime,</li>
              <li>Consultation annuelle.</li>
            </ul>
          </li>
          <li><span class="font-semibold text-pink-700">🧠 Petite info intéressante :</span><br>
            L’utérus d’une femme adulte mesure environ 7 à 8 cm de long !
          </li>
        </ul>
      </div>
    @elseif($specialty->slug === 'orthopedics')
      <div>
        <div class="flex items-center mb-4">
          <span class="text-3xl mr-2">🦴</span>
          <span class="text-xl font-bold">Fiche de présentation : L'Orthopédie</span>
        </div>
        <ul class="space-y-4">
          <li><span class="font-semibold text-green-700">✅ Définition :</span><br>
            L’orthopédie est la spécialité chirurgicale qui traite les maladies et traumatismes de l’appareil locomoteur (os, articulations, muscles, tendons).
          </li>
          <li><span class="font-semibold text-blue-700">🩺 Rôle de l’orthopédiste :</span><br>
            L’orthopédiste :
            <ul class="list-disc list-inside ml-4">
              <li>Diagnostique et traite les fractures, luxations, entorses,</li>
              <li>Prend en charge les maladies des os et des articulations (arthrose, scoliose…)</li>
              <li>Réalise des interventions chirurgicales (prothèses, réparation des ligaments…)</li>
            </ul>
          </li>
          <li><span class="font-semibold text-red-700">🦵 Pathologies prises en charge :</span>
            <ul class="list-disc list-inside ml-4">
              <li>Fractures, entorses, luxations,</li>
              <li>Arthrose, arthrite,</li>
              <li>Déformations de la colonne (scoliose, cyphose),</li>
              <li>Maladies des tendons et des ligaments.</li>
            </ul>
          </li>
          <li><span class="font-semibold text-purple-700">🔍 Examens réalisés :</span>
            <ul class="list-disc list-inside ml-4">
              <li>Radiographie,</li>
              <li>IRM, scanner,</li>
              <li>Arthroscopie.</li>
            </ul>
          </li>
          <li><span class="font-semibold text-green-700">🏃 Prévention :</span><br>
            <ul class="list-disc list-inside ml-4">
              <li>Pratiquer une activité physique adaptée,</li>
              <li>Éviter les chutes,</li>
              <li>Adopter une alimentation riche en calcium et vitamine D.</li>
            </ul>
          </li>
          <li><span class="font-semibold text-pink-700">🧠 Petite info intéressante :</span><br>
            Le squelette humain compte 206 os !
          </li>
        </ul>
      </div>
    @elseif($specialty->slug === 'neurology')
      <div>
        <div class="flex items-center mb-4">
          <span class="text-3xl mr-2">🧠</span>
          <span class="text-xl font-bold">Fiche de présentation : La Neurologie</span>
        </div>
        <ul class="space-y-4">
          <li><span class="font-semibold text-green-700">✅ Définition :</span><br>
            La neurologie est la spécialité médicale qui s’occupe du système nerveux (cerveau, moelle épinière, nerfs).
          </li>
          <li><span class="font-semibold text-blue-700">🩺 Rôle du neurologue :</span><br>
            Le neurologue :
            <ul class="list-disc list-inside ml-4">
              <li>Diagnostique et traite les maladies du cerveau et des nerfs,</li>
              <li>Suit les patients atteints de maladies chroniques (épilepsie, sclérose en plaques…)</li>
              <li>Réalise des examens spécialisés (EEG, EMG…)</li>
            </ul>
          </li>
          <li><span class="font-semibold text-red-700">🧩 Maladies prises en charge :</span>
            <ul class="list-disc list-inside ml-4">
              <li>Accidents vasculaires cérébraux (AVC),</li>
              <li>Épilepsie,</li>
              <li>Maladie de Parkinson,</li>
              <li>Sclérose en plaques,</li>
              <li>Migraines,</li>
              <li>Neuropathies.</li>
            </ul>
          </li>
          <li><span class="font-semibold text-purple-700">🔍 Examens réalisés :</span>
            <ul class="list-disc list-inside ml-4">
              <li>IRM cérébrale,</li>
              <li>Électroencéphalogramme (EEG),</li>
              <li>Électromyogramme (EMG).</li>
            </ul>
          </li>
          <li><span class="font-semibold text-green-700">🧘 Prévention :</span><br>
            <ul class="list-disc list-inside ml-4">
              <li>Éviter le stress,</li>
              <li>Adopter une bonne hygiène de vie,</li>
              <li>Consulter rapidement en cas de trouble neurologique.</li>
            </ul>
          </li>
          <li><span class="font-semibold text-pink-700">🧠 Petite info intéressante :</span><br>
            Le cerveau humain pèse environ 1,4 kg et contient près de 100 milliards de neurones !
          </li>
        </ul>
      </div>
    @endif
  </div>

  <!-- Doctors List -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if($doctors->count() > 0)
      <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $doctors->count() }} médecin(s) trouvé(s)</h2>
        <p class="text-gray-600">Consultez les médecins spécialisés en {{ strtolower($specialty->name) }}</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($doctors as $doctor)
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-6">
          <div class="flex items-start space-x-4">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
              <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
              </svg>
            </div>
            <div class="flex-1 min-w-0">
              <h3 class="text-lg font-semibold text-gray-900 mb-1">
                <a href="{{ route('doctors.show', $doctor->id) }}" class="hover:text-red-500 transition">
                  Dr. {{ $doctor->full_name }}
                </a>
              </h3>
              <p class="text-sm text-gray-600 mb-2">{{ $doctor->clinic_address }}</p>
              
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                  @for($i = 1; $i <= 5; $i++)
                    @if($i <= $doctor->rating)
                      <span class="text-yellow-400 text-sm">★</span>
                    @else
                      <span class="text-gray-300 text-sm">★</span>
                    @endif
                  @endfor
                  <span class="ml-1 text-xs text-gray-500">({{ $doctor->total_reviews }})</span>
                </div>
                <span class="text-green-600 font-semibold text-sm">{{ $doctor->consultation_fee }} DT</span>
              </div>

              <div class="flex items-center justify-between">
                @if($doctor->is_available)
                  <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Disponible
                  </span>
                @else
                  <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    Non disponible
                  </span>
                @endif
                
                <a href="{{ route('doctors.show', $doctor->id) }}" 
                   class="text-red-500 hover:text-red-600 text-sm font-medium">
                  Voir détails →
                </a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    @else
      <div class="text-center py-12">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
          </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Aucun médecin trouvé</h3>
        <p class="text-gray-600 mb-6">Aucun médecin n'est actuellement disponible pour cette spécialité.</p>
        <a href="/doctors" class="bg-red-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-600 transition">
          Voir tous les médecins
        </a>
      </div>
    @endif
  </div>

  <!-- Footer -->
  <footer class="bg-gradient-to-r from-red-500 to-pink-500 text-white py-12 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <p>&copy; 2025 RDV Médical. Tous droits réservés.</p>
    </div>
  </footer>
</body>
</html> 