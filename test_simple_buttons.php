<?php

require_once 'vendor/autoload.php';

// Simuler Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Appointment;
use App\Models\User;

echo "=== Test simple des boutons ===\n\n";

try {
    // Récupérer le patient de test
    $patient = User::where('email', 'patient@test.com')->first();
    
    if (!$patient) {
        echo "❌ Patient de test non trouvé\n";
        exit;
    }
    
    echo "✅ Patient: " . $patient->first_name . " " . $patient->last_name . " (ID: " . $patient->id . ")\n";
    
    // Récupérer un rendez-vous du patient
    $appointment = Appointment::where('patient_id', $patient->id)
        ->with('doctor.user', 'doctor.specialty', 'patient')
        ->first();
    
    if (!$appointment) {
        echo "❌ Aucun rendez-vous trouvé pour ce patient\n";
        exit;
    }
    
    echo "✅ Rendez-vous #" . $appointment->id . " trouvé\n";
    echo "   - Statut: " . $appointment->status . "\n";
    echo "   - Date: " . $appointment->appointment_date . "\n";
    echo "   - Heure: " . $appointment->appointment_time . "\n";
    
    // Tester la méthode destroy directement
    echo "\n🔧 Test de la méthode destroy:\n";
    
    // Simuler la méthode destroy
    if ($appointment->status !== 'cancelled') {
        $oldStatus = $appointment->status;
        $appointment->status = 'cancelled';
        $appointment->cancelled_at = now();
        $appointment->save();
        
        echo "   ✅ Statut changé de '$oldStatus' à '" . $appointment->status . "'\n";
        
        // Remettre en pending pour les tests
        $appointment->status = 'pending';
        $appointment->cancelled_at = null;
        $appointment->save();
        echo "   ✅ Statut remis en 'pending' pour les tests\n";
    } else {
        echo "   ❌ Rendez-vous déjà annulé\n";
    }
    
    // Vérifier les URLs
    echo "\n🔗 URLs de test:\n";
    $baseUrl = 'http://localhost/medical-rdv/public';
    
    echo "   - Détails: $baseUrl/appointments/{$appointment->id}\n";
    echo "   - Modifier: $baseUrl/appointments/{$appointment->id}/edit\n";
    echo "   - Annuler: $baseUrl/appointments/{$appointment->id} (DELETE)\n";
    echo "   - Confirmer: $baseUrl/appointments/{$appointment->id}/confirm (POST)\n";
    
    // Vérifier les formulaires dans la vue
    echo "\n📄 Vérification des formulaires:\n";
    $profileContent = file_get_contents('resources/views/profile.blade.php');
    
    $checks = [
        '@method(\'DELETE\')' => 'Méthode DELETE',
        'route(\'appointments.destroy\'' => 'Route destroy',
        'route(\'appointments.show\'' => 'Route show',
        'route(\'appointments.edit\'' => 'Route edit',
        'route(\'appointments.confirm\'' => 'Route confirm'
    ];
    
    foreach ($checks as $search => $description) {
        if (strpos($profileContent, $search) !== false) {
            echo "   ✅ $description trouvé\n";
        } else {
            echo "   ❌ $description manquant\n";
        }
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

echo "\n=== Instructions de test ===\n";
echo "1. Connectez-vous avec patient@test.com / password123\n";
echo "2. Allez sur /profile\n";
echo "3. Dans 'Mes Rendez-vous', testez:\n";
echo "   - Bouton 'Voir les détails' → Doit ouvrir la page de détails\n";
echo "   - Bouton 'Modifier' → Doit ouvrir le formulaire de modification\n";
echo "   - Bouton 'Annuler' → Doit demander confirmation puis annuler\n";
echo "4. Si les boutons ne marchent pas, ouvrez la console (F12) et regardez les erreurs\n";

echo "\n=== Fin ===\n"; 