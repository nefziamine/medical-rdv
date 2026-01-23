<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            [
                'name' => 'Cardiologie',
                'slug' => 'cardiologie',
                'description' => 'Spécialité médicale qui traite les maladies du cœur et des vaisseaux sanguins.',
                'icon' => 'heart',
                'sort_order' => 1,
            ],
            [
                'name' => 'Dermatologie',
                'slug' => 'dermatologie',
                'description' => 'Spécialité médicale qui traite les maladies de la peau, des cheveux et des ongles.',
                'icon' => 'skin',
                'sort_order' => 2,
            ],
            [
                'name' => 'Orthopédie',
                'slug' => 'orthopedie',
                'description' => 'Spécialité chirurgicale qui traite les maladies et traumatismes de l\'appareil locomoteur.',
                'icon' => 'bone',
                'sort_order' => 3,
            ],
            [
                'name' => 'Neurologie',
                'slug' => 'neurologie',
                'description' => 'Spécialité médicale qui traite les maladies du système nerveux central et périphérique.',
                'icon' => 'brain',
                'sort_order' => 4,
            ],
            [
                'name' => 'Pédiatrie',
                'slug' => 'pediatrie',
                'description' => 'Spécialité médicale qui traite les maladies des enfants de la naissance à l\'adolescence.',
                'icon' => 'child',
                'sort_order' => 5,
            ],
            [
                'name' => 'Gynécologie',
                'slug' => 'gynecologie',
                'description' => 'Spécialité médicale qui traite les maladies de l\'appareil génital féminin.',
                'icon' => 'female',
                'sort_order' => 6,
            ],
            [
                'name' => 'Psychiatrie',
                'slug' => 'psychiatrie',
                'description' => 'Spécialité médicale qui traite les troubles mentaux et comportementaux.',
                'icon' => 'mind',
                'sort_order' => 7,
            ],
            [
                'name' => 'Dentisterie',
                'slug' => 'dentisterie',
                'description' => 'Spécialité médicale qui traite les maladies de la bouche et des dents.',
                'icon' => 'tooth',
                'sort_order' => 8,
            ],
            [
                'name' => 'Ophtalmologie',
                'slug' => 'ophtalmologie',
                'description' => 'Spécialité médicale qui traite les maladies des yeux et de la vision.',
                'icon' => 'eye',
                'sort_order' => 9,
            ],
            [
                'name' => 'Gastro-entérologie',
                'slug' => 'gastro-enterologie',
                'description' => 'Spécialité médicale qui traite les maladies du tube digestif.',
                'icon' => 'stomach',
                'sort_order' => 10,
            ],
        ];

        foreach ($specialties as $specialty) {
            DB::table('specialties')->insert([
                'name' => $specialty['name'],
                'slug' => $specialty['slug'],
                'description' => $specialty['description'],
                'icon' => $specialty['icon'],
                'sort_order' => $specialty['sort_order'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
