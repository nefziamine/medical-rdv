<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

use Illuminate\Support\Facades\DB;

$daysMap = [
    'Lundi' => 'monday',
    'Mardi' => 'tuesday',
    'Mercredi' => 'wednesday',
    'Jeudi' => 'thursday',
    'Vendredi' => 'friday',
    'Samedi' => 'saturday',
    'Dimanche' => 'sunday',
];

$doctors = DB::table('doctors')->get();

foreach ($doctors as $doctor) {
    if ($doctor->availability) {
        $availability = json_decode($doctor->availability, true);
        $changed = false;
        foreach ($availability as &$slot) {
            if (isset($daysMap[$slot['day']])) {
                $slot['day'] = $daysMap[$slot['day']];
                $changed = true;
            }
        }
        if ($changed) {
            DB::table('doctors')->where('id', $doctor->id)
                ->update(['availability' => json_encode($availability)]);
            echo "Docteur #{$doctor->id} corrigé\n";
        }
    }
}

echo "Correction terminée.\n"; 