<?php

require_once 'vendor/autoload.php';

// Charger l'application Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Doctor;

echo "🧪 Test de la gestion de la disponibilité...\n";

try {
    // Vérifier qu'il y a des médecins dans la base de données
    $doctors = Doctor::with('user')->get();
    
    if ($doctors->count() > 0) {
        echo "✅ " . $doctors->count() . " médecin(s) trouvé(s) dans la base de données.\n";
        
        foreach ($doctors as $doctor) {
            echo "\n📋 Médecin : " . $doctor->user->first_name . " " . $doctor->user->last_name . "\n";
            echo "   Spécialité : " . ($doctor->specialty ? $doctor->specialty->name : 'Non définie') . "\n";
            echo "   Disponible : " . ($doctor->is_available ? 'Oui' : 'Non') . "\n";
            
            if ($doctor->availability) {
                echo "   Créneaux définis : " . count($doctor->availability) . "\n";
                foreach ($doctor->availability as $slot) {
                    echo "     - " . ucfirst($slot['day']) . " : " . $slot['from'] . " - " . $slot['to'] . "\n";
                }
            } else {
                echo "   ⚠️ Aucun créneau de disponibilité défini.\n";
            }
        }
    } else {
        echo "❌ Aucun médecin trouvé dans la base de données.\n";
    }
    
    // Vérifier les utilisateurs médecins
    $doctorUsers = User::where('user_type', 'doctor')->get();
    echo "\n👨‍⚕️ Utilisateurs médecins : " . $doctorUsers->count() . "\n";
    
    foreach ($doctorUsers as $user) {
        echo "   - " . $user->first_name . " " . $user->last_name . " (ID: " . $user->id . ")\n";
        if ($user->doctor) {
            echo "     Disponibilité : " . ($user->doctor->is_available ? 'Oui' : 'Non') . "\n";
            echo "     Créneaux : " . (is_array($user->doctor->availability) ? count($user->doctor->availability) : '0') . "\n";
        } else {
            echo "     ⚠️ Pas de profil médecin associé.\n";
        }
    }
    
    echo "\n🎉 Test terminé avec succès !\n";
    
} catch (Exception $e) {
    echo "❌ Erreur lors du test : " . $e->getMessage() . "\n";
    exit(1);
} 