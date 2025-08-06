<?php

require_once 'vendor/autoload.php';

// Charger l'application Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Doctor;

echo "🔍 Vérification des IDs des médecins...\n";

try {
    $doctors = Doctor::with('user')->get();
    
    if ($doctors->count() > 0) {
        echo "✅ " . $doctors->count() . " médecin(s) trouvé(s) :\n";
        foreach ($doctors as $doctor) {
            echo "   - ID: " . $doctor->id . "\n";
            echo "     Nom: " . $doctor->user->first_name . " " . $doctor->user->last_name . "\n";
            echo "     Spécialité: " . ($doctor->specialty ? $doctor->specialty->name : 'Non définie') . "\n";
            echo "     Disponible: " . ($doctor->is_available ? 'Oui' : 'Non') . "\n";
            echo "     ---\n";
        }
    } else {
        echo "❌ Aucun médecin trouvé.\n";
    }
    
    echo "\n💡 Pour créer un rendez-vous, utilisez l'URL :\n";
    foreach ($doctors as $doctor) {
        echo "   http://127.0.0.1:8000/appointments/create/" . $doctor->id . "\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur : " . $e->getMessage() . "\n";
} 