<?php

require_once 'vendor/autoload.php';

// Charger l'application Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use Carbon\Carbon;

echo "🧪 Test de création d'un rendez-vous...\n";

try {
    // Trouver un patient
    $patient = User::where('user_type', '!=', 'doctor')->first();
    if (!$patient) {
        echo "❌ Aucun patient trouvé.\n";
        exit(1);
    }
    
    // Trouver un médecin
    $doctor = Doctor::with('user')->first();
    if (!$doctor) {
        echo "❌ Aucun médecin trouvé.\n";
        exit(1);
    }
    
    echo "✅ Patient: " . $patient->first_name . " " . $patient->last_name . "\n";
    echo "✅ Médecin: " . $doctor->user->first_name . " " . $doctor->user->last_name . "\n";
    
    // Créer un rendez-vous de test
    $appointmentData = [
        'patient_id' => $patient->id,
        'doctor_id' => $doctor->id,
        'appointment_date' => Carbon::tomorrow()->format('Y-m-d'),
        'appointment_time' => '10:00',
        'appointment_type' => 'in_person',
        'notes' => 'Test de création de rendez-vous',
        'fee' => $doctor->consultation_fee ?? 50,
        'status' => 'pending',
        'payment_status' => 'pending'
    ];
    
    echo "\n📝 Tentative de création du rendez-vous...\n";
    echo "   Date: " . $appointmentData['appointment_date'] . "\n";
    echo "   Heure: " . $appointmentData['appointment_time'] . "\n";
    echo "   Type: " . $appointmentData['appointment_type'] . "\n";
    echo "   Frais: " . $appointmentData['fee'] . " DT\n";
    
    $appointment = Appointment::create($appointmentData);
    
    echo "\n✅ Rendez-vous créé avec succès !\n";
    echo "   ID: " . $appointment->id . "\n";
    echo "   Statut: " . $appointment->status . "\n";
    
    // Vérifier que le rendez-vous a été créé
    $createdAppointment = Appointment::with(['doctor.user', 'patient'])->find($appointment->id);
    echo "\n📋 Détails du rendez-vous créé :\n";
    echo "   Patient: " . $createdAppointment->patient->first_name . " " . $createdAppointment->patient->last_name . "\n";
    echo "   Médecin: " . $createdAppointment->doctor->user->first_name . " " . $createdAppointment->doctor->user->last_name . "\n";
    echo "   Date: " . $createdAppointment->appointment_date . " à " . $createdAppointment->appointment_time . "\n";
    echo "   Type: " . $createdAppointment->appointment_type . "\n";
    echo "   Frais: " . $createdAppointment->fee . " DT\n";
    echo "   Statut: " . $createdAppointment->status . "\n";
    
    // Supprimer le rendez-vous de test
    $appointment->delete();
    echo "\n🗑️ Rendez-vous de test supprimé.\n";
    
    echo "\n🎉 Test terminé avec succès !\n";
    echo "💡 Le système de création de rendez-vous fonctionne correctement.\n";
    
} catch (Exception $e) {
    echo "❌ Erreur lors de la création du rendez-vous : " . $e->getMessage() . "\n";
    echo "Stack trace :\n" . $e->getTraceAsString() . "\n";
} 