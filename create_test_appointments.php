<?php

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;

require __DIR__.'/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Trouver un médecin et un patient existants
$doctor = Doctor::first();
$patient = User::where('user_type', 'patient')->first();

if (!$doctor || !$patient) {
    echo "Aucun médecin ou patient trouvé dans la base de données.\n";
    exit(1);
}

// Créer un rendez-vous test
$appointment = new Appointment();
$appointment->doctor_id = $doctor->id;
$appointment->patient_id = $patient->id;
$appointment->appointment_date = date('Y-m-d', strtotime('+1 day'));
$appointment->appointment_time = '10:00';
$appointment->status = 'pending';
$appointment->fee = $doctor->consultation_fee ?? 50;
$appointment->save();

echo "Rendez-vous test créé avec succès ! (ID: {$appointment->id})\n"; 