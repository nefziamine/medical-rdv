<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Specialty;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get specialties
        $specialties = Specialty::all();

        // Create test doctors
        $doctors = [
            [
                'first_name' => 'Dr. Ahmed',
                'last_name' => 'Ben Ali',
                'email' => 'ahmed.benali@rdvmedical.tn',
                'phone' => '+216 71 234 567',
                'birth_date' => '1980-05-15',
                'address' => '123 Rue de la Santé, Tunis',
                'user_type' => 'doctor',
                'password' => Hash::make('password123'),
                'specialty_id' => 1, // Cardiologie
                'experience_years' => 15,
                'consultation_fee' => 80.00,
                'available_days' => ['lundi', 'mardi', 'mercredi', 'jeudi'],
                'start_time' => '09:00',
                'end_time' => '17:00',
                'description' => 'Cardiologue expérimenté spécialisé dans les maladies cardiovasculaires.',
                'education' => 'Faculté de Médecine de Tunis, Spécialisation en Cardiologie',
                'certifications' => 'Certification en Échocardiographie, Diplôme de Cardiologie Interventionnelle',
                'languages' => ['arabe', 'français', 'anglais'],
                'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
            ],
            [
                'first_name' => 'Dr. Fatma',
                'last_name' => 'Zghal',
                'email' => 'fatma.zghal@rdvmedical.tn',
                'phone' => '+216 71 345 678',
                'birth_date' => '1985-08-22',
                'address' => '456 Avenue Habib Bourguiba, Sfax',
                'user_type' => 'doctor',
                'password' => Hash::make('password123'),
                'specialty_id' => 2, // Dermatologie
                'experience_years' => 12,
                'consultation_fee' => 70.00,
                'available_days' => ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'],
                'start_time' => '08:00',
                'end_time' => '16:00',
                'description' => 'Dermatologue spécialisée dans le traitement des maladies de la peau.',
                'education' => 'Faculté de Médecine de Sfax, Spécialisation en Dermatologie',
                'certifications' => 'Certification en Dermatologie Esthétique, Diplôme de Dermatologie Chirurgicale',
                'languages' => ['arabe', 'français'],
                'image' => 'https://images.unsplash.com/photo-1594824475545-9d0e4b6b8b8b?w=400&h=400&fit=crop&crop=face',
            ],
            [
                'first_name' => 'Dr. Mohamed',
                'last_name' => 'Trabelsi',
                'email' => 'mohamed.trabelsi@rdvmedical.tn',
                'phone' => '+216 71 456 789',
                'birth_date' => '1978-12-10',
                'address' => '789 Rue de la Paix, Sousse',
                'user_type' => 'doctor',
                'password' => Hash::make('password123'),
                'specialty_id' => 3, // Pédiatrie
                'experience_years' => 20,
                'consultation_fee' => 60.00,
                'available_days' => ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'],
                'start_time' => '08:30',
                'end_time' => '18:00',
                'description' => 'Pédiatre expérimenté spécialisé dans les soins aux enfants.',
                'education' => 'Faculté de Médecine de Sousse, Spécialisation en Pédiatrie',
                'certifications' => 'Certification en Néonatologie, Diplôme de Pédiatrie Générale',
                'languages' => ['arabe', 'français', 'anglais'],
                'image' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=400&fit=crop&crop=face',
            ],
            [
                'first_name' => 'Dr. Salma',
                'last_name' => 'Hammami',
                'email' => 'salma.hammami@rdvmedical.tn',
                'phone' => '+216 71 567 890',
                'birth_date' => '1982-03-18',
                'address' => '321 Boulevard de la Liberté, Monastir',
                'user_type' => 'doctor',
                'password' => Hash::make('password123'),
                'specialty_id' => 4, // Gynécologie
                'experience_years' => 14,
                'consultation_fee' => 85.00,
                'available_days' => ['lundi', 'mardi', 'mercredi', 'jeudi'],
                'start_time' => '09:00',
                'end_time' => '16:30',
                'description' => 'Gynécologue spécialisée dans la santé des femmes.',
                'education' => 'Faculté de Médecine de Monastir, Spécialisation en Gynécologie',
                'certifications' => 'Certification en Échographie Gynécologique, Diplôme de Gynécologie Obstétrique',
                'languages' => ['arabe', 'français'],
                'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
            ],
            [
                'first_name' => 'Dr. Karim',
                'last_name' => 'Bouaziz',
                'email' => 'karim.bouaziz@rdvmedical.tn',
                'phone' => '+216 71 678 901',
                'birth_date' => '1987-07-25',
                'address' => '654 Rue des Oliviers, Gabès',
                'user_type' => 'doctor',
                'password' => Hash::make('password123'),
                'specialty_id' => 5, // Orthopédie
                'experience_years' => 10,
                'consultation_fee' => 90.00,
                'available_days' => ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'],
                'start_time' => '08:00',
                'end_time' => '17:00',
                'description' => 'Orthopédiste spécialisé dans les problèmes musculo-squelettiques.',
                'education' => 'Faculté de Médecine de Gabès, Spécialisation en Orthopédie',
                'certifications' => 'Certification en Chirurgie Orthopédique, Diplôme de Traumatologie',
                'languages' => ['arabe', 'français', 'anglais'],
                'image' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=400&fit=crop&crop=face',
            ],
        ];

        foreach ($doctors as $doctorData) {
            // Create user
            $user = User::create([
                'first_name' => $doctorData['first_name'],
                'last_name' => $doctorData['last_name'],
                'email' => $doctorData['email'],
                'phone' => $doctorData['phone'],
                'birth_date' => $doctorData['birth_date'],
                'address' => $doctorData['address'],
                'user_type' => $doctorData['user_type'],
                'password' => $doctorData['password'],
            ]);

            // Create doctor profile
            Doctor::create([
                'user_id' => $user->id,
                'specialty_id' => $doctorData['specialty_id'],
                'experience_years' => $doctorData['experience_years'],
                'consultation_fee' => $doctorData['consultation_fee'],
                'available_days' => $doctorData['available_days'],
                'start_time' => $doctorData['start_time'],
                'end_time' => $doctorData['end_time'],
                'description' => $doctorData['description'],
                'education' => $doctorData['education'],
                'certifications' => $doctorData['certifications'],
                'languages' => $doctorData['languages'],
                'image' => $doctorData['image'],
            ]);
        }
    }
}
