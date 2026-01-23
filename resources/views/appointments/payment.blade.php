<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Paiement - RDV Médical</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  <!-- Header Section -->
  <section class="bg-gradient-to-r from-green-600 via-blue-600 to-purple-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-3xl lg:text-4xl font-bold mb-2">
            <i class="fas fa-credit-card mr-3"></i>
            Paiement du rendez-vous
          </h1>
          <p class="text-white/90 text-lg">
            Rendez-vous avec Dr. {{ $appointment->doctor->user->first_name }} {{ $appointment->doctor->user->last_name }}
          </p>
        </div>
        <div class="hidden md:block">
          <a href="{{ route('appointments.index') }}" class="inline-flex items-center bg-white/20 backdrop-blur-md text-white px-6 py-3 rounded-xl hover:bg-white/30 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Mes rendez-vous
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Payment Form -->
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-3xl shadow-xl p-8">

      <!-- Appointment Summary -->
      <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-6 mb-8 border border-blue-100">
        <div class="flex items-center mb-4">
          <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center mr-3">
            <i class="fas fa-calendar-check text-white"></i>
          </div>
          <h3 class="text-lg font-bold text-gray-900">Détails du rendez-vous</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <p class="text-sm text-gray-600">Date et heure</p>
            <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($appointment->appointment_date)->locale('fr')->isoFormat('dddd D MMMM YYYY') }} à {{ $appointment->appointment_time }}</p>
          </div>
          <div>
            <p class="text-sm text-gray-600">Médecin</p>
            <p class="font-semibold text-gray-900">Dr. {{ $appointment->doctor->user->first_name }} {{ $appointment->doctor->user->last_name }}</p>
          </div>
          <div>
            <p class="text-sm text-gray-600">Spécialité</p>
            <p class="font-semibold text-gray-900">{{ $appointment->doctor->specialty ? $appointment->doctor->specialty->name : 'Non spécifiée' }}</p>
          </div>
          <div>
            <p class="text-sm text-gray-600">Type</p>
            <p class="font-semibold text-gray-900">{{ $appointment->appointment_type === 'in_person' ? 'En personne' : 'En ligne' }}</p>
          </div>
        </div>
      </div>

      <!-- Payment Form -->
      <form method="POST" action="{{ route('appointments.payment.process', $appointment) }}" class="space-y-8">
        @csrf

        <!-- Payment Method Selection -->
        <div class="space-y-4">
          <label class="block text-sm font-semibold text-gray-700 flex items-center">
            <i class="fas fa-money-bill-wave mr-2 text-green-500"></i>Méthode de paiement <span class="text-red-500 ml-1">*</span>
          </label>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Carte bancaire -->
            <label class="relative flex items-center p-4 bg-gray-50 rounded-xl hover:bg-blue-50 cursor-pointer transition-all duration-300 border-2 border-transparent hover:border-blue-200">
              <input type="radio" name="payment_method" value="card" class="text-blue-500 focus:ring-blue-500" checked>
              <div class="ml-3">
                <div class="flex items-center">
                  <i class="fas fa-credit-card mr-2 text-blue-500"></i>
                  <span class="font-medium text-gray-900">Carte bancaire</span>
                </div>
                <p class="text-sm text-gray-600">Visa, Mastercard</p>
              </div>
            </label>
            <!-- Flouci -->
            <label class="relative flex items-center p-4 bg-gray-50 rounded-xl hover:bg-orange-50 cursor-pointer transition-all duration-300 border-2 border-transparent hover:border-orange-200">
              <input type="radio" name="payment_method" value="flouci" class="text-orange-500 focus:ring-orange-500">
              <div class="ml-3">
                <div class="flex items-center">
                  <i class="fas fa-mobile-alt mr-2 text-orange-500"></i>
                  <span class="font-medium text-gray-900">Flouci</span>
                </div>
                <p class="text-sm text-gray-600">Paiement mobile</p>
              </div>
            </label>
            <!-- Virement bancaire -->
            <label class="relative flex items-center p-4 bg-gray-50 rounded-xl hover:bg-green-50 cursor-pointer transition-all duration-300 border-2 border-transparent hover:border-green-200">
              <input type="radio" name="payment_method" value="bank_transfer" class="text-green-500 focus:ring-green-500">
              <div class="ml-3">
                <div class="flex items-center">
                  <i class="fas fa-university mr-2 text-green-500"></i>
                  <span class="font-medium text-gray-900">Virement bancaire</span>
                </div>
                <p class="text-sm text-gray-600">Transfert bancaire</p>
              </div>
            </label>
          </div>
          @error('payment_method')
            <p class="text-red-500 text-sm mt-2 flex items-center">
              <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
            </p>
          @enderror
        </div>

        <!-- Card Payment Fields -->
        <div id="card-fields" class="space-y-4">
          <h4 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-credit-card mr-2 text-blue-500"></i>
            Informations de la carte
          </h4>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
              <label for="card_number" class="block text-sm font-semibold text-gray-700">Numéro de carte</label>
              <div class="relative">
                <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456"
                       class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 hover:bg-white">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                  <i class="fas fa-credit-card text-gray-400"></i>
                </div>
              </div>
              @error('card_number')
                <p class="text-red-500 text-sm mt-2 flex items-center">
                  <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
              @enderror
            </div>
            <div class="space-y-2">
              <label for="expiry_date" class="block text-sm font-semibold text-gray-700">Date d'expiration</label>
              <div class="relative">
                <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/AA"
                       class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 hover:bg-white">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                  <i class="fas fa-calendar-alt text-gray-400"></i>
                </div>
              </div>
              @error('expiry_date')
                <p class="text-red-500 text-sm mt-2 flex items-center">
                  <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
              @enderror
            </div>
            <div class="space-y-2">
              <label for="cvv" class="block text-sm font-semibold text-gray-700">CVV</label>
              <div class="relative">
                <input type="text" id="cvv" name="cvv" placeholder="123"
                       class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 hover:bg-white">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                  <i class="fas fa-lock text-gray-400"></i>
                </div>
              </div>
              @error('cvv')
                <p class="text-red-500 text-sm mt-2 flex items-center">
                  <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
              @enderror
            </div>
          </div>
        </div>

        <!-- Flouci Payment Fields -->
        <div id="flouci-fields" class="space-y-4 hidden">
          <h4 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-mobile-alt mr-2 text-orange-500"></i>
            Informations Flouci
          </h4>
          <div class="space-y-2">
            <label for="phone_number" class="block text-sm font-semibold text-gray-700">Numéro de téléphone</label>
            <div class="relative">
              <input type="text" id="phone_number" name="phone_number" placeholder="+216 XX XXX XXX"
                     class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-4 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300 hover:bg-white">
              <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <i class="fas fa-mobile-alt text-gray-400"></i>
              </div>
            </div>
            @error('phone_number')
              <p class="text-red-500 text-sm mt-2 flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
              </p>
            @enderror
          </div>
          <div class="bg-orange-50 border border-orange-200 rounded-xl p-4">
            <p class="text-sm text-orange-800">
              <i class="fas fa-info-circle mr-2"></i>
              Vous recevrez un SMS avec les instructions de paiement Flouci.
            </p>
          </div>
        </div>

        <!-- Bank Transfer Info -->
        <div id="bank-transfer-fields" class="space-y-4 hidden">
          <h4 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-university mr-2 text-green-500"></i>
            Informations de virement
          </h4>
          <div class="bg-green-50 border border-green-200 rounded-xl p-6">
            <h5 class="font-semibold text-green-900 mb-3">Coordonnées bancaires</h5>
            <div class="space-y-2 text-sm text-green-800">
              <p><strong>Banque:</strong> Banque Centrale de Tunisie</p>
              <p><strong>RIB:</strong> 123456789012345678901234</p>
              <p><strong>IBAN:</strong> TN591234567890123456789012</p>
              <p><strong>Bénéficiaire:</strong> Cabinet Médical RDV</p>
            </div>
            <div class="mt-4 p-3 bg-green-100 rounded-lg">
              <p class="text-sm text-green-800">
                <i class="fas fa-info-circle mr-2"></i>
                Veuillez mentionner "RDV-{{ $appointment->id }}" dans la référence du virement.
              </p>
            </div>
          </div>
        </div>

        <!-- Amount Summary -->
        <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-2xl p-6 border border-green-100">
          <div class="flex justify-between items-center text-lg font-bold">
            <span class="text-gray-900">Montant total</span>
            <span class="text-green-600">{{ $appointment->fee }} DT</span>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
          <a href="{{ route('appointments.index') }}"
             class="inline-flex items-center text-gray-600 hover:text-gray-800 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Annuler
          </a>
          <button type="submit"
                  class="bg-gradient-to-r from-green-600 to-blue-600 text-white px-8 py-4 rounded-2xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center">
            <i class="fas fa-credit-card mr-2"></i>
            Payer {{ $appointment->fee }} DT
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
      const cardFields = document.getElementById('card-fields');
      const flouciFields = document.getElementById('flouci-fields');
      const bankTransferFields = document.getElementById('bank-transfer-fields');

      function togglePaymentFields() {
        const selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;

        // Hide all fields
        cardFields.classList.add('hidden');
        flouciFields.classList.add('hidden');
        bankTransferFields.classList.add('hidden');

        // Show relevant fields
        if (selectedMethod === 'card') {
          cardFields.classList.remove('hidden');
        } else if (selectedMethod === 'flouci') {
          flouciFields.classList.remove('hidden');
        } else if (selectedMethod === 'bank_transfer') {
          bankTransferFields.classList.remove('hidden');
        }
      }

      paymentMethods.forEach(method => {
        method.addEventListener('change', togglePaymentFields);
      });

      // Initialize
      togglePaymentFields();
    });
  </script>
</body>
</html>