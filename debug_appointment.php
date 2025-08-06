<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Appointment;
use App\Models\User;
use App\Models\Doctor;

echo "=== Debug Appointment Data ===\n";

// Check if appointment ID 1 exists
$appointment = Appointment::find(1);
if ($appointment) {
    echo "Appointment ID 1 found:\n";
    echo "- ID: " . $appointment->id . "\n";
    echo "- Patient ID: " . $appointment->patient_id . "\n";
    echo "- Doctor ID: " . $appointment->doctor_id . "\n";
    echo "- Date: " . $appointment->appointment_date . "\n";
    echo "- Time: " . $appointment->appointment_time . "\n";
    echo "- Status: " . $appointment->status . "\n";
    
    // Check doctor relationship
    if ($appointment->doctor) {
        echo "- Doctor exists: Yes\n";
        echo "- Doctor user_id: " . $appointment->doctor->user_id . "\n";
        
        if ($appointment->doctor->user) {
            echo "- Doctor user exists: Yes\n";
            echo "- Doctor name: " . $appointment->doctor->user->first_name . " " . $appointment->doctor->user->last_name . "\n";
        } else {
            echo "- Doctor user exists: No\n";
        }
    } else {
        echo "- Doctor exists: No\n";
    }
    
    // Check patient relationship
    if ($appointment->patient) {
        echo "- Patient exists: Yes\n";
        echo "- Patient name: " . $appointment->patient->first_name . " " . $appointment->patient->last_name . "\n";
    } else {
        echo "- Patient exists: No\n";
    }
} else {
    echo "Appointment ID 1 not found\n";
}

echo "\n=== All Appointments ===\n";
$allAppointments = Appointment::with('doctor.user', 'patient')->get();
echo "Total appointments: " . $allAppointments->count() . "\n";

foreach ($allAppointments as $apt) {
    echo "Appointment ID: " . $apt->id . " - Patient: " . ($apt->patient ? $apt->patient->first_name : 'NULL') . " - Doctor: " . ($apt->doctor && $apt->doctor->user ? $apt->doctor->user->first_name : 'NULL') . "\n";
}

echo "\n=== All Users ===\n";
$users = User::all();
echo "Total users: " . $users->count() . "\n";

foreach ($users as $user) {
    echo "User ID: " . $user->id . " - Name: " . $user->first_name . " " . $user->last_name . " - Type: " . $user->user_type . "\n";
}

echo "\n=== All Doctors ===\n";
$doctors = Doctor::with('user')->get();
echo "Total doctors: " . $doctors->count() . "\n";

foreach ($doctors as $doctor) {
    echo "Doctor ID: " . $doctor->id . " - User ID: " . $doctor->user_id . " - Name: " . ($doctor->user ? $doctor->user->first_name . " " . $doctor->user->last_name : 'NULL') . "\n";
} 