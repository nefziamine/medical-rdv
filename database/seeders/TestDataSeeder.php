<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer des spécialités si elles n'existent pas
        $specialties = [
            ['name' => 'Cardiologie', 'slug' => 'cardiologie'],
            ['name' => 'Dermatologie', 'slug' => 'dermatologie'],
            ['name' => 'Gynécologie', 'slug' => 'gynecologie'],
            ['name' => 'Neurologie', 'slug' => 'neurologie'],
            ['name' => 'Ophtalmologie', 'slug' => 'ophtalmologie'],
            ['name' => 'Orthopédie', 'slug' => 'orthopedie'],
            ['name' => 'Pédiatrie', 'slug' => 'pediatrie'],
            ['name' => 'Psychiatrie', 'slug' => 'psychiatrie'],
            ['name' => 'Radiologie', 'slug' => 'radiologie'],
            ['name' => 'Urologie', 'slug' => 'urologie']
        ];

        foreach ($specialties as $specialtyData) {
            Specialty::firstOrCreate(
                ['slug' => $specialtyData['slug']],
                [
                    'name' => $specialtyData['name'],
                    'slug' => $specialtyData['slug'],
                    'description' => 'Spécialité médicale en ' . $specialtyData['name'],
                    'is_active' => true,
                    'sort_order' => 0
                ]
            );
        }

        // Créer un utilisateur patient de test
        $patient = User::firstOrCreate(
            ['email' => 'patient@test.com'],
            [
                'first_name' => 'Ahmed',
                'last_name' => 'Ben Ali',
                'email' => 'patient@test.com',
                'phone' => '+21612345678',
                'birth_date' => '1990-05-15',
                'gender' => 'homme',
                'address' => '123 Rue de la Paix, Tunis',
                'user_type' => 'patient',
                'password' => Hash::make('password123'),
            ]
        );

        // Créer un utilisateur médecin de test
        $doctorUser = User::firstOrCreate(
            ['email' => 'doctor@test.com'],
            [
                'first_name' => 'Dr. Sarah',
                'last_name' => 'Martin',
                'email' => 'doctor@test.com',
                'phone' => '+21698765432',
                'birth_date' => '1985-03-20',
                'gender' => 'femme',
                'address' => '456 Avenue des Médecins, Tunis',
                'user_type' => 'doctor',
                'password' => Hash::make('password123'),
            ]
        );

        // Créer le profil médecin
        if ($doctorUser->user_type === 'doctor' && !$doctorUser->doctor) {
            $specialty = Specialty::first();
            
            Doctor::create([
                'user_id' => $doctorUser->id,
                'specialty_id' => $specialty->id,
                'experience_years' => 8,
                'consultation_fee' => 75.00,
                'description' => 'Médecin expérimentée spécialisée en cardiologie avec plus de 8 ans d\'expérience.',
                'education' => 'Faculté de Médecine de Tunis',
                'certifications' => 'Diplôme de Cardiologie Interventionnelle',
                'languages' => ['arabe', 'français', 'anglais'],
                'start_time' => '09:00',
                'end_time' => '17:00',
                'available_days' => ['lundi', 'mardi', 'mercredi', 'jeudi'],
                'clinic_address' => '456 Avenue des Médecins, Tunis',
                'clinic_phone' => '+21698765432',
                'is_available' => true,
                'rating' => 4.8,
                'additional_services' => [
                    'tele_secretariat' => true,
                    'professional_website' => false,
                    'photo_video' => true,
                    'waiting_room_display' => false,
                    'whatsapp_reminders' => true
                ],
                'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
            ]);
        }

        // Créer quelques médecins supplémentaires
        $doctors = [
            [
                'first_name' => 'Dr. Mohamed',
                'last_name' => 'Hassan',
                'email' => 'mohamed.hassan@test.com',
                'specialty' => 'Dermatologie',
                'experience_years' => 12,
                'consultation_fee' => 60.00,
                'gender' => 'homme',
                'additional_services' => [
                    'tele_secretariat' => false,
                    'professional_website' => true,
                    'photo_video' => false,
                    'waiting_room_display' => true,
                    'whatsapp_reminders' => false
                ]
            ],
            [
                'first_name' => 'Dr. Fatima',
                'last_name' => 'Zouari',
                'email' => 'fatima.zouari@test.com',
                'specialty' => 'Gynécologie',
                'experience_years' => 15,
                'consultation_fee' => 80.00,
                'gender' => 'femme',
                'additional_services' => [
                    'tele_secretariat' => true,
                    'professional_website' => true,
                    'photo_video' => true,
                    'waiting_room_display' => true,
                    'whatsapp_reminders' => true
                ]
            ],
            [
                'first_name' => 'Dr. Ali',
                'last_name' => 'Ben Salem',
                'email' => 'ali.bensalem@test.com',
                'specialty' => 'Pédiatrie',
                'experience_years' => 10,
                'consultation_fee' => 50.00,
                'gender' => 'homme',
                'additional_services' => [
                    'tele_secretariat' => true,
                    'professional_website' => false,
                    'photo_video' => false,
                    'waiting_room_display' => false,
                    'whatsapp_reminders' => true
                ]
            ]
        ];

        foreach ($doctors as $doctorData) {
            $user = User::firstOrCreate(
                ['email' => $doctorData['email']],
                [
                    'first_name' => $doctorData['first_name'],
                    'last_name' => $doctorData['last_name'],
                    'email' => $doctorData['email'],
                    'phone' => '+216' . rand(10000000, 99999999),
                    'birth_date' => '198' . rand(0, 9) . '-' . rand(1, 12) . '-' . rand(1, 28),
                    'gender' => $doctorData['gender'],
                    'address' => rand(1, 999) . ' Rue de la Santé, Tunis',
                    'user_type' => 'doctor',
                    'password' => Hash::make('password123'),
                ]
            );

            if ($user->user_type === 'doctor' && !$user->doctor) {
                $specialty = Specialty::where('name', $doctorData['specialty'])->first();
                
                Doctor::create([
                    'user_id' => $user->id,
                    'specialty_id' => $specialty->id,
                    'experience_years' => $doctorData['experience_years'],
                    'consultation_fee' => $doctorData['consultation_fee'],
                    'description' => 'Médecin expérimenté en ' . $doctorData['specialty'] . ' avec ' . $doctorData['experience_years'] . ' ans d\'expérience.',
                    'education' => 'Faculté de Médecine de Tunis',
                    'certifications' => 'Diplôme de ' . $doctorData['specialty'],
                    'languages' => ['arabe', 'français'],
                    'start_time' => '09:00',
                    'end_time' => '17:00',
                    'available_days' => ['lundi', 'mardi', 'mercredi', 'jeudi'],
                    'clinic_address' => $user->address,
                    'clinic_phone' => $user->phone,
                    'is_available' => true,
                    'rating' => rand(35, 50) / 10,
                    'additional_services' => $doctorData['additional_services'],
                    'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
                ]);
            }
        }

        $this->command->info('Données de test créées avec succès !');
        $this->command->info('Comptes de test :');
        $this->command->info('Patient: patient@test.com / password123');
        $this->command->info('Médecin: doctor@test.com / password123');
    }
}
