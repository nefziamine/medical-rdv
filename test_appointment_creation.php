<?php

require_once 'vendor/autoload.php';

// Charger l'application Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use Carbon\Carbon;

echo "🧪 Test de création de rendez-vous...\n";

try {
    // Vérifier les utilisateurs
    $users = User::all();
    echo "✅ " . $users->count() . " utilisateur(s) trouvé(s) :\n";
    foreach ($users as $user) {
        echo "   - ID: " . $user->id . " - " . $user->first_name . " " . $user->last_name . " (" . $user->user_type . ")\n";
    }
    
    // Vérifier les médecins
    $doctors = Doctor::with(['user', 'specialty'])->get();
    echo "\n👨‍⚕️ " . $doctors->count() . " médecin(s) trouvé(s) :\n";
    foreach ($doctors as $doctor) {
        echo "   - ID: " . $doctor->id . " - " . $doctor->user->first_name . " " . $doctor->user->last_name . "\n";
        echo "     Spécialité: " . ($doctor->specialty ? $doctor->specialty->name : 'Non définie') . "\n";
        echo "     Disponible: " . ($doctor->is_available ? 'Oui' : 'Non') . "\n";
        echo "     Frais: " . ($doctor->consultation_fee ?? 50) . " DT\n";
        echo "     Disponibilité: " . (is_array($doctor->availability) ? count($doctor->availability) . " créneaux" : "Non définie") . "\n";
        if ($doctor->availability) {
            foreach ($doctor->availability as $slot) {
                echo "       - " . ucfirst($slot['day']) . " : " . $slot['from'] . " - " . $slot['to'] . "\n";
            }
        }
        echo "     ---\n";
    }
    
    // Tester la génération de créneaux
    echo "\n📅 Test de génération de créneaux :\n";
    foreach ($doctors as $doctor) {
        echo "   Médecin: " . $doctor->user->first_name . " " . $doctor->user->last_name . "\n";
        
        $availability = $doctor->availability ?? [];
        if (empty($availability)) {
            echo "     ❌ Aucune disponibilité définie\n";
            continue;
        }
        
        $slots = [];
        foreach ($availability as $slot) {
            $day = $slot['day'];
            $from = $slot['from'];
            $to = $slot['to'];
            if (!isset($slots[$day])) $slots[$day] = [];
            $current = strtotime($from);
            $endTime = strtotime($to);
            while ($current < $endTime) {
                $time = date('H:i', $current);
                $slots[$day][] = $time;
                $current = strtotime('+30 minutes', $current);
            }
        }
        
        echo "     Créneaux générés :\n";
        foreach ($slots as $day => $times) {
            echo "       " . ucfirst($day) . ": " . implode(', ', $times) . "\n";
        }
        echo "     ---\n";
    }
    
    // Vérifier les rendez-vous existants
    $appointments = Appointment::with(['doctor.user', 'patient'])->get();
    echo "\n📋 " . $appointments->count() . " rendez-vous existant(s) :\n";
    foreach ($appointments as $appointment) {
        echo "   - ID: " . $appointment->id . "\n";
        echo "     Patient: " . ($appointment->patient ? $appointment->patient->first_name . ' ' . $appointment->patient->last_name : 'Patient non trouvé') . "\n";
        echo "     Médecin: " . ($appointment->doctor && $appointment->doctor->user ? $appointment->doctor->user->first_name . ' ' . $appointment->doctor->user->last_name : 'Médecin non trouvé') . "\n";
        echo "     Date: " . $appointment->appointment_date . " à " . $appointment->appointment_time . "\n";
        echo "     Statut: " . $appointment->status . "\n";
        echo "     ---\n";
    }
    
    echo "\n💡 URLs de test :\n";
    foreach ($doctors as $doctor) {
        echo "   http://127.0.0.1:8000/appointments/create/" . $doctor->id . "\n";
    }
    
    echo "\n🎉 Test terminé avec succès !\n";
    
} catch (Exception $e) {
    echo "❌ Erreur : " . $e->getMessage() . "\n";
    echo "Stack trace :\n" . $e->getTraceAsString() . "\n";
} 