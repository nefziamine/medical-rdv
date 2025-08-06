<?php

require_once 'vendor/autoload.php';

// Charger l'application Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

echo "🔍 Test de l'autorisation des rendez-vous...\n";

try {
    // Simuler un utilisateur connecté (premier patient)
    $patient = User::where('user_type', '!=', 'doctor')->first();
    if (!$patient) {
        echo "❌ Aucun patient trouvé.\n";
        exit(1);
    }
    
    echo "✅ Patient connecté: " . $patient->first_name . " " . $patient->last_name . " (ID: " . $patient->id . ")\n";
    
    // Trouver un rendez-vous de ce patient
    $appointment = Appointment::where('patient_id', $patient->id)->first();
    if (!$appointment) {
        echo "❌ Aucun rendez-vous trouvé pour ce patient.\n";
        exit(1);
    }
    
    echo "✅ Rendez-vous trouvé: ID " . $appointment->id . " (Patient ID: " . $appointment->patient_id . ")\n";
    
    // Simuler l'authentification
    Auth::login($patient);
    echo "✅ Utilisateur authentifié\n";
    
    // Test de l'autorisation
    echo "\n🔐 Test d'autorisation:\n";
    $user = auth()->user();
    echo "   - Utilisateur connecté: " . ($user ? $user->first_name . " " . $user->last_name : "Aucun") . "\n";
    echo "   - Patient ID du rendez-vous: " . $appointment->patient_id . "\n";
    echo "   - ID de l'utilisateur connecté: " . ($user ? $user->id : "Aucun") . "\n";
    echo "   - Égalité: " . ($user && $appointment->patient_id == $user->id ? 'VRAI' : 'FAUX') . "\n";
    
    // Test de la logique d'autorisation
    if (!$user) {
        echo "❌ Erreur: Aucun utilisateur connecté\n";
    } elseif ($appointment->patient_id != $user->id) {
        echo "❌ Erreur: L'utilisateur ne peut pas modifier ce rendez-vous\n";
    } else {
        echo "✅ Autorisation accordée - Le patient peut modifier ce rendez-vous\n";
    }
    
    // Test de la méthode destroy
    echo "\n🔄 Test de la méthode destroy:\n";
    try {
        // Simuler l'appel à la méthode destroy
        $user = auth()->user();
        if (!$user) {
            echo "❌ Erreur: Vous devez être connecté pour effectuer cette action\n";
        } elseif ($appointment->patient_id != $user->id) {
            echo "❌ Erreur: Accès non autorisé - Vous ne pouvez annuler que vos propres rendez-vous\n";
        } else {
            echo "✅ Autorisation accordée pour l'annulation\n";
        }
    } catch (Exception $e) {
        echo "❌ Exception: " . $e->getMessage() . "\n";
    }
    
    echo "\n🎉 Test terminé !\n";
    
} catch (Exception $e) {
    echo "❌ Erreur lors du test : " . $e->getMessage() . "\n";
    echo "Stack trace :\n" . $e->getTraceAsString() . "\n";
} 