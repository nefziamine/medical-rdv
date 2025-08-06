<?php

require_once 'vendor/autoload.php';

// Charger l'application Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;

echo "🧪 Test des rendez-vous...\n";

try {
    // Vérifier les utilisateurs
    $users = User::all();
    echo "✅ " . $users->count() . " utilisateur(s) trouvé(s).\n";
    
    // Vérifier les médecins
    $doctors = Doctor::with('user')->get();
    echo "👨‍⚕️ " . $doctors->count() . " médecin(s) trouvé(s).\n";
    
    // Vérifier les rendez-vous
    $appointments = Appointment::with(['doctor.user', 'patient'])->get();
    echo "📅 " . $appointments->count() . " rendez-vous trouvé(s).\n";
    
    if ($appointments->count() > 0) {
        echo "\n📋 Détails des rendez-vous :\n";
        foreach ($appointments as $appointment) {
            echo "   - ID: " . $appointment->id . "\n";
            echo "     Patient: " . ($appointment->patient ? $appointment->patient->first_name . ' ' . $appointment->patient->last_name : 'Patient non trouvé') . "\n";
            echo "     Médecin: " . ($appointment->doctor && $appointment->doctor->user ? $appointment->doctor->user->first_name . ' ' . $appointment->doctor->user->last_name : 'Médecin non trouvé') . "\n";
            echo "     Date: " . $appointment->appointment_date . " à " . $appointment->appointment_time . "\n";
            echo "     Statut: " . $appointment->status . "\n";
            echo "     Type: " . $appointment->appointment_type . "\n";
            echo "     Frais: " . $appointment->fee . " DT\n";
            echo "     ---\n";
        }
    }
    
    // Vérifier les relations
    echo "\n🔗 Vérification des relations :\n";
    
    // Rendez-vous orphelins (sans patient)
    $orphanedAppointments = Appointment::whereDoesntHave('patient')->count();
    echo "   Rendez-vous sans patient : " . $orphanedAppointments . "\n";
    
    // Rendez-vous orphelins (sans médecin)
    $orphanedAppointments2 = Appointment::whereDoesntHave('doctor')->count();
    echo "   Rendez-vous sans médecin : " . $orphanedAppointments2 . "\n";
    
    // Médecins sans utilisateur
    $doctorsWithoutUser = Doctor::whereDoesntHave('user')->count();
    echo "   Médecins sans utilisateur : " . $doctorsWithoutUser . "\n";
    
    // Utilisateurs médecins sans profil médecin
    $doctorUsersWithoutProfile = User::where('user_type', 'doctor')->whereDoesntHave('doctor')->count();
    echo "   Utilisateurs médecins sans profil : " . $doctorUsersWithoutProfile . "\n";
    
    echo "\n🎉 Test terminé avec succès !\n";
    
} catch (Exception $e) {
    echo "❌ Erreur lors du test : " . $e->getMessage() . "\n";
    exit(1);
} 