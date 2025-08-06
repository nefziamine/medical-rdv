<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixDoctorAvailability extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:doctor-availability';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Corrige les jours en français dans la disponibilité des médecins par leur équivalent anglais';

    /**
     * Execute the console command.
     */
    public function handle()
    {
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
        $count = 0;

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
                    $this->info("Docteur #{$doctor->id} corrigé");
                    $count++;
                }
            }
        }
        $this->info("Correction terminée. {$count} docteurs mis à jour.");
    }
}
