<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// Charger l'application Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🧹 Nettoyage des rendez-vous expirés...\n";

try {
    // Marquer comme annulés les rendez-vous en attente qui sont passés
    $expiredAppointments = DB::table('appointments')
        ->where('status', 'pending')
        ->where(function($query) {
            $query->where('appointment_date', '<', date('Y-m-d'))
                  ->orWhere(function($q) {
                      $q->where('appointment_date', '=', date('Y-m-d'))
                        ->where('appointment_time', '<', date('H:i'));
                  });
        })
        ->update(['status' => 'cancelled']);

    echo "✅ {$expiredAppointments} rendez-vous expirés ont été marqués comme annulés.\n";

    // Nettoyer les rendez-vous très anciens (plus de 6 mois)
    $oldAppointments = DB::table('appointments')
        ->where('appointment_date', '<', Carbon::now()->subMonths(6)->format('Y-m-d'))
        ->whereIn('status', ['cancelled', 'completed'])
        ->delete();

    echo "🗑️ {$oldAppointments} anciens rendez-vous ont été supprimés.\n";

    // Vérifier la cohérence des données
    $orphanedAppointments = DB::table('appointments')
        ->leftJoin('users as patients', 'appointments.patient_id', '=', 'patients.id')
        ->leftJoin('doctors', 'appointments.doctor_id', '=', 'doctors.id')
        ->whereNull('patients.id')
        ->orWhereNull('doctors.id')
        ->count();

    if ($orphanedAppointments > 0) {
        echo "⚠️ {$orphanedAppointments} rendez-vous orphelins détectés.\n";
        
        // Supprimer les rendez-vous orphelins
        DB::table('appointments')
            ->leftJoin('users as patients', 'appointments.patient_id', '=', 'patients.id')
            ->leftJoin('doctors', 'appointments.doctor_id', '=', 'doctors.id')
            ->whereNull('patients.id')
            ->orWhereNull('doctors.id')
            ->delete();
            
        echo "🗑️ Rendez-vous orphelins supprimés.\n";
    }

    echo "🎉 Nettoyage terminé avec succès !\n";

} catch (Exception $e) {
    echo "❌ Erreur lors du nettoyage : " . $e->getMessage() . "\n";
    exit(1);
} 