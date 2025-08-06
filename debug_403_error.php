<?php

require_once 'vendor/autoload.php';

// Charger l'application Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

echo "🔍 Diagnostic de l'erreur 403...\n\n";

try {
    // Vérifier l'utilisateur actuellement connecté
    $currentUser = auth()->user();
    if ($currentUser) {
        echo "✅ Utilisateur connecté: " . $currentUser->first_name . " " . $currentUser->last_name . " (ID: " . $currentUser->id . ")\n";
        echo "   Type d'utilisateur: " . $currentUser->user_type . "\n";
    } else {
        echo "❌ Aucun utilisateur connecté\n";
        exit(1);
    }
    
    // Lister tous les rendez-vous
    echo "\n📋 Tous les rendez-vous dans la base de données:\n";
    $allAppointments = Appointment::with(['patient', 'doctor.user'])->get();
    foreach ($allAppointments as $apt) {
        echo "   - Rendez-vous ID: " . $apt->id . "\n";
        echo "     Patient: " . $apt->patient->first_name . " " . $apt->patient->last_name . " (ID: " . $apt->patient_id . ")\n";
        echo "     Médecin: " . $apt->doctor->user->first_name . " " . $apt->doctor->user->last_name . "\n";
        echo "     Statut: " . $apt->status . "\n";
        echo "     ---\n";
    }
    
    // Trouver les rendez-vous du patient connecté
    echo "\n🔍 Rendez-vous du patient connecté:\n";
    $userAppointments = Appointment::where('patient_id', $currentUser->id)->get();
    if ($userAppointments->count() > 0) {
        foreach ($userAppointments as $apt) {
            echo "   - Rendez-vous ID: " . $apt->id . " (Statut: " . $apt->status . ")\n";
        }
    } else {
        echo "   ❌ Aucun rendez-vous trouvé pour ce patient\n";
    }
    
    // Vérifier si l'utilisateur est un patient
    if ($currentUser->isPatient()) {
        echo "\n✅ L'utilisateur est un patient - peut annuler ses rendez-vous\n";
    } else {
        echo "\n❌ L'utilisateur n'est pas un patient - ne peut pas annuler de rendez-vous\n";
    }
    
    echo "\n💡 Suggestions:\n";
    echo "   1. Assurez-vous d'être connecté avec le bon compte\n";
    echo "   2. Vérifiez que le rendez-vous que vous essayez d'annuler vous appartient\n";
    echo "   3. Si vous êtes un médecin, vous ne pouvez pas annuler de rendez-vous\n";
    
} catch (Exception $e) {
    echo "❌ Erreur lors du diagnostic : " . $e->getMessage() . "\n";
} 