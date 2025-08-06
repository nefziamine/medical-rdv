<?php

require_once 'vendor/autoload.php';

// Simuler Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Appointment;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;

echo "=== Diagnostic approfondi des boutons ===\n\n";

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
    
    // Vérifier les routes
    echo "\n🌐 Vérification des routes:\n";
    $routes = [
        'appointments.show' => 'GET /appointments/{appointment}',
        'appointments.edit' => 'GET /appointments/{appointment}/edit',
        'appointments.confirm' => 'POST /appointments/{appointment}/confirm',
        'appointments.destroy' => 'DELETE /appointments/{appointment}'
    ];
    
    foreach ($routes as $routeName => $routePath) {
        echo "   - $routeName: $routePath\n";
    }
    
    // Vérifier le contenu de la vue profile.blade.php
    echo "\n📄 Analyse de la vue profile.blade.php:\n";
    $profileContent = file_get_contents('resources/views/profile.blade.php');
    
    // Chercher les formulaires
    $formChecks = [
        'method="POST"' => 'Formulaires POST',
        'method="DELETE"' => 'Formulaires DELETE',
        '@csrf' => 'Tokens CSRF',
        'route(' => 'Appels de route',
        'action=' => 'Actions de formulaire'
    ];
    
    foreach ($formChecks as $search => $description) {
        $count = substr_count($profileContent, $search);
        echo "   - $description: $count occurrences\n";
    }
    
    // Chercher les boutons spécifiques
    $buttonChecks = [
        'Voir les détails' => 'Bouton détails',
        'Modifier' => 'Bouton modifier',
        'Annuler' => 'Bouton annuler',
        'Confirmer' => 'Bouton confirmer'
    ];
    
    foreach ($buttonChecks as $search => $description) {
        if (strpos($profileContent, $search) !== false) {
            echo "   ✅ $description trouvé\n";
        } else {
            echo "   ❌ $description manquant\n";
        }
    }
    
    // Vérifier les méthodes du contrôleur
    echo "\n🔧 Vérification du contrôleur AppointmentController:\n";
    $controllerFile = 'app/Http/Controllers/AppointmentController.php';
    $controllerContent = file_get_contents($controllerFile);
    
    $methodChecks = [
        'public function show' => 'Méthode show',
        'public function edit' => 'Méthode edit',
        'public function confirm' => 'Méthode confirm',
        'public function destroy' => 'Méthode destroy'
    ];
    
    foreach ($methodChecks as $search => $description) {
        if (strpos($controllerContent, $search) !== false) {
            echo "   ✅ $description trouvée\n";
        } else {
            echo "   ❌ $description manquante\n";
        }
    }
    
    // Tester les URLs générées
    echo "\n🔗 Test des URLs:\n";
    $baseUrl = 'http://localhost/medical-rdv/public';
    
    $urls = [
        'show' => "$baseUrl/appointments/{$appointment->id}",
        'edit' => "$baseUrl/appointments/{$appointment->id}/edit",
        'confirm' => "$baseUrl/appointments/{$appointment->id}/confirm",
        'destroy' => "$baseUrl/appointments/{$appointment->id}"
    ];
    
    foreach ($urls as $action => $url) {
        echo "   - $action: $url\n";
    }
    
    // Vérifier les permissions
    echo "\n🔐 Vérification des permissions:\n";
    
    // Simuler un utilisateur connecté
    echo "   - Patient connecté: " . $patient->first_name . " " . $patient->last_name . "\n";
    echo "   - ID patient connecté: " . $patient->id . "\n";
    echo "   - ID patient du rendez-vous: " . $appointment->patient_id . "\n";
    echo "   - Correspondance: " . ($patient->id === $appointment->patient_id ? '✅' : '❌') . "\n";
    
    // Vérifier si le médecin peut confirmer
    $doctor = Doctor::first();
    if ($doctor && $doctor->user) {
        echo "   - Médecin connecté: " . $doctor->user->first_name . " " . $doctor->user->last_name . "\n";
        echo "   - ID médecin connecté: " . $doctor->user->id . "\n";
        echo "   - ID médecin du rendez-vous: " . $appointment->doctor->user_id . "\n";
        echo "   - Correspondance: " . ($doctor->user->id === $appointment->doctor->user_id ? '✅' : '❌') . "\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    echo "   - Fichier: " . $e->getFile() . "\n";
    echo "   - Ligne: " . $e->getLine() . "\n";
}

echo "\n=== Instructions de débogage avancé ===\n";
echo "1. Ouvrez la console du navigateur (F12)\n";
echo "2. Allez sur /profile\n";
echo "3. Cliquez sur un bouton\n";
echo "4. Dans l'onglet Network, vérifiez:\n";
echo "   - La requête est-elle envoyée ?\n";
echo "   - Quel est le code de réponse ?\n";
echo "   - Y a-t-il des erreurs JavaScript ?\n";
echo "5. Dans l'onglet Console, vérifiez:\n";
echo "   - Y a-t-il des erreurs JavaScript ?\n";
echo "   - Y a-t-il des erreurs de validation ?\n";

echo "\n=== Test manuel ===\n";
echo "Testez ces URLs directement dans le navigateur:\n";
echo "- http://localhost/medical-rdv/public/appointments/7\n";
echo "- http://localhost/medical-rdv/public/appointments/7/edit\n";

echo "\n=== Fin ===\n"; 