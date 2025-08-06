<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialty_id',
        'experience_years',
        'consultation_fee',
        'description',
        'education',
        'certifications',
        'languages',
        'start_time',
        'end_time',
        'available_days',
        'image',
        'is_available',
        'rating',
        'clinic_address',
        'clinic_phone',
        'availability',
        'additional_services',
    ];

    protected $casts = [
        'languages' => 'array',
        'available_days' => 'array',
        'consultation_fee' => 'decimal:2',
        'experience_years' => 'integer',
        'is_available' => 'boolean',
        'rating' => 'decimal:2',
        'availability' => 'array',
        'additional_services' => 'array',
    ];

    /**
     * Get the user that owns the doctor profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the specialty of this doctor.
     */
    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    /**
     * Get the appointments for this doctor.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get the reviews for this doctor.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the doctor's full name.
     */
    public function getFullNameAttribute(): string
    {
        return $this->user ? $this->user->full_name : 'Nom non disponible';
    }

    /**
     * Get the doctor's email.
     */
    public function getEmailAttribute(): string
    {
        return $this->user ? $this->user->email : 'Email non disponible';
    }

    /**
     * Get the doctor's phone.
     */
    public function getPhoneAttribute(): string
    {
        return $this->user ? $this->user->phone : 'Téléphone non disponible';
    }

    /**
     * Scope a query to only include available doctors.
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    /**
     * Scope a query to only include doctors by specialty.
     */
    public function scopeBySpecialty($query, $specialtyId)
    {
        return $query->where('specialty_id', $specialtyId);
    }
}

// Ajout d'une commande artisan pour corriger les jours dans availability
if (app()->runningInConsole() && !app()->runningUnitTests()) {
    \Illuminate\Support\Facades\Artisan::command('fix:doctor-availability-days', function () {
        \App\Models\Doctor::all()->each(function($d) {
            $a = $d->availability;
            if (is_string($a)) { $a = json_decode($a, true); }
            if (is_array($a)) {
                foreach ($a as &$slot) {
                    if (isset($slot['day'])) {
                        $slot['day'] = strtolower($slot['day']);
                        if ($slot['day'] == 'lundi') $slot['day'] = 'monday';
                        if ($slot['day'] == 'mardi') $slot['day'] = 'tuesday';
                        if ($slot['day'] == 'mercredi') $slot['day'] = 'wednesday';
                        if ($slot['day'] == 'jeudi') $slot['day'] = 'thursday';
                        if ($slot['day'] == 'vendredi') $slot['day'] = 'friday';
                        if ($slot['day'] == 'samedi') $slot['day'] = 'saturday';
                        if ($slot['day'] == 'dimanche') $slot['day'] = 'sunday';
                    }
                }
                $d->availability = $a;
                $d->save();
            }
        });
        $this->info('Correction des jours de disponibilité terminée.');
    });
}

if (app()->runningInConsole() && !app()->runningUnitTests()) {
    \Illuminate\Support\Facades\Artisan::command('force:doctor-availability', function () {
        \App\Models\Doctor::all()->each(function($d) {
            $d->availability = [
                ['day'=>'monday','from'=>'10:00','to'=>'11:00'],
                ['day'=>'tuesday','from'=>'16:00','to'=>'17:00']
            ];
            $d->save();
        });
        $this->info('Disponibilité forcée pour tous les médecins.');
    });
}
