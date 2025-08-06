<?php

require_once 'vendor/autoload.php';

// Charger l'application Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Doctor;
use App\Models\User;

echo "🧪 Test de la route de création de rendez-vous...\n";

try {
    // Vérifier les médecins
    $doctors = Doctor::with('user')->get();
    echo "✅ " . $doctors->count() . " médecin(s) trouvé(s) :\n";
    foreach ($doctors as $doctor) {
        echo "   - ID: " . $doctor->id . " - " . $doctor->user->first_name . " " . $doctor->user->last_name . "\n";
    }
    
    // Vérifier les utilisateurs
    $users = User::all();
    echo "\n👥 " . $users->count() . " utilisateur(s) trouvé(s) :\n";
    foreach ($users as $user) {
        echo "   - ID: " . $user->id . " - " . $user->first_name . " " . $user->last_name . " (" . $user->user_type . ")\n";
    }
    
    // Tester la route pour chaque médecin
    echo "\n🔗 URLs de test pour créer des rendez-vous :\n";
    foreach ($doctors as $doctor) {
        echo "   http://127.0.0.1:8000/appointments/create/" . $doctor->id . "\n";
    }
    
    // Vérifier les routes
    echo "\n📋 Routes disponibles :\n";
    $routes = [
        'appointments.index' => '/appointments',
        'appointments.create' => '/appointments/create/{doctorId}',
        'appointments.store' => '/appointments/{doctorId}',
        'appointments.show' => '/appointments/{id}',
        'appointments.edit' => '/appointments/{id}/edit',
        'appointments.update' => '/appointments/{id}',
        'appointments.destroy' => '/appointments/{id}',
        'appointments.confirm' => '/appointments/{appointment}/confirm',
    ];
    
    foreach ($routes as $name => $path) {
        echo "   " . $name . " => " . $path . "\n";
    }
    
    echo "\n💡 Pour tester :\n";
    echo "   1. Assurez-vous d'être connecté en tant que patient\n";
    echo "   2. Accédez à l'URL : http://127.0.0.1:8000/appointments/create/8\n";
    echo "   3. Si vous obtenez une erreur 404, vérifiez que le serveur Laravel est démarré\n";
    
} catch (Exception $e) {
    echo "❌ Erreur : " . $e->getMessage() . "\n";
} 