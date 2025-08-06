<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Specialty;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile')->with('success', 'Profil mis à jour avec succès !');
    }

    /**
     * Show patient profile page.
     */
    public function showPatientProfile(Request $request): View|RedirectResponse
    {
        $user = $request->user();
        
        if (!$user->isPatient()) {
            return redirect()->route('profile')->with('error', 'Accès non autorisé.');
        }

        return view('profile.patient', [
            'user' => $user
        ]);
    }

    /**
     * Update patient profile.
     */
    public function updatePatientProfile(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        if (!$user->isPatient()) {
            return redirect()->route('profile')->with('error', 'Accès non autorisé.');
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:homme,femme,autre',
            'address' => 'nullable|string|max:500',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ajout validation image
        ], [
            'first_name.required' => 'Le prénom est obligatoire.',
            'last_name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'phone.max' => 'Le numéro de téléphone ne peut pas dépasser 20 caractères.',
            'birth_date.date' => 'La date de naissance doit être valide.',
            'gender.in' => 'Le genre doit être homme, femme ou autre.',
            'address.max' => 'L\'adresse ne peut pas dépasser 500 caractères.',
        ]);

        if ($user) {
            $user->update($request->only([
                'first_name', 'last_name', 'email', 'phone', 
                'birth_date', 'gender', 'address'
            ]));

            // Gestion de l'upload de la photo de profil
            if ($request->hasFile('profile_photo')) {
                $file = $request->file('profile_photo');
                $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('profile_photos', $filename, 'public');
                $user->profile_photo = $path;
                $user->save();
            }
        }

        return Redirect::route('profile.patient')->with('success', 'Profil mis à jour avec succès !');
    }

    /**
     * Show doctor profile page.
     */
    public function showDoctorProfile(Request $request): View
    {
        $user = $request->user();
        
        if (!$user->isDoctor()) {
            return redirect()->route('profile')->with('error', 'Accès non autorisé.');
        }

        $specialties = Specialty::all();

        return view('profile.doctor', [
            'user' => $user,
            'specialties' => $specialties
        ]);
    }

    /**
     * Update doctor profile.
     */
    public function updateDoctorProfile(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        if (!$user->isDoctor()) {
            return redirect()->route('profile')->with('error', 'Accès non autorisé.');
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:homme,femme,autre',
            'address' => 'nullable|string|max:500',
            'specialty_id' => 'required|exists:specialties,id',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'consultation_fee' => 'nullable|numeric|min:0',
            'clinic_address' => 'nullable|string|max:255',
            'clinic_phone' => 'nullable|string|max:20',
            'is_available' => 'nullable',
            'description' => 'nullable|string|max:1000',
            'education' => 'nullable|string|max:1000',
            'certifications' => 'nullable|string|max:1000',
        ], [
            'first_name.required' => 'Le prénom est obligatoire.',
            'last_name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'phone.max' => 'Le numéro de téléphone ne peut pas dépasser 20 caractères.',
            'birth_date.date' => 'La date de naissance doit être valide.',
            'gender.in' => 'Le genre doit être homme, femme ou autre.',
            'address.max' => 'L\'adresse ne peut pas dépasser 500 caractères.',
            'specialty_id.required' => 'La spécialité est obligatoire.',
            'specialty_id.exists' => 'La spécialité sélectionnée n\'existe pas.',
            'experience_years.integer' => 'Les années d\'expérience doivent être un nombre entier.',
            'experience_years.min' => 'Les années d\'expérience ne peuvent pas être négatives.',
            'experience_years.max' => 'Les années d\'expérience ne peuvent pas dépasser 50.',
            'consultation_fee.numeric' => 'Le tarif de consultation doit être un nombre.',
            'consultation_fee.min' => 'Le tarif de consultation ne peut pas être négatif.',
            'clinic_address.max' => 'L\'adresse de la clinique ne peut pas dépasser 255 caractères.',
            'clinic_phone.max' => 'Le téléphone de la clinique ne peut pas dépasser 20 caractères.',
            'description.max' => 'La description ne peut pas dépasser 1000 caractères.',
            'education.max' => 'La formation ne peut pas dépasser 1000 caractères.',
            'certifications.max' => 'Les certifications ne peuvent pas dépasser 1000 caractères.',
        ]);

        // Mettre à jour les informations utilisateur
        if ($user) {
            $user->update($request->only([
                'first_name', 'last_name', 'email', 'phone', 
                'birth_date', 'gender', 'address'
            ]));
        }

        // Mettre à jour les informations du médecin
        if ($user && $user->doctor) {
            $doctorData = $request->only([
                'specialty_id', 'experience_years', 'consultation_fee',
                'clinic_address', 'clinic_phone', 'description', 'education', 'certifications'
            ]);
            // Cast is_available en booléen
            $doctorData['is_available'] = $request->has('is_available') ? (bool)$request->input('is_available') : false;
            $user->doctor->update($doctorData);
        }

        return Redirect::route('profile.doctor')->with('success', 'Profil mis à jour avec succès !');
    }

    /**
     * Show password change page.
     */
    public function showPasswordChange(Request $request): View
    {
        return view('profile.password', [
            'user' => $request->user()
        ]);
    }

    /**
     * Show delete account confirmation page.
     */
    public function showDeleteConfirm(Request $request): View
    {
        return view('profile.delete', [
            'user' => $request->user()
        ]);
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.required' => 'Le mot de passe actuel est obligatoire.',
            'current_password.current_password' => 'Le mot de passe actuel est incorrect.',
            'password.required' => 'Le nouveau mot de passe est obligatoire.',
            'password.min' => 'Le nouveau mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        if ($request->user()) {
            $request->user()->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return Redirect::route('profile.password')->with('success', 'Mot de passe mis à jour avec succès !');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Si un mot de passe est fourni, le valider
        if ($request->has('password')) {
            $request->validate([
                'password' => ['required', 'current_password'],
            ], [
                'password.required' => 'Le mot de passe est obligatoire pour supprimer votre compte.',
                'password.current_password' => 'Le mot de passe est incorrect.',
            ]);
        }

        $user = $request->user();

        // Supprimer d'abord les données liées si c'est un médecin
        if ($user->isDoctor() && $user->doctor) {
            $user->doctor->delete();
        }

        // Supprimer les rendez-vous liés
        if ($user->isDoctor()) {
            $user->doctor->appointments()->delete();
        } else {
            $user->patientAppointments()->delete();
        }

        // Supprimer l'utilisateur
        $user->delete();

        // Déconnexion
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'Votre compte a été supprimé avec succès.');
    }

    /**
     * Show doctor availability management page.
     */
    public function showDoctorAvailability(Request $request): View
    {
        $user = $request->user();
        
        if (!$user->isDoctor()) {
            return redirect()->route('profile')->with('error', 'Accès non autorisé.');
        }

        return view('profile.availability', [
            'user' => $user,
            'availability' => $user->doctor->availability ?? []
        ]);
    }

    /**
     * Update doctor availability.
     */
    public function updateDoctorAvailability(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        if (!$user->isDoctor()) {
            return redirect()->route('profile')->with('error', 'Accès non autorisé.');
        }

        $request->validate([
            'availability' => ['required', 'array'],
            'availability.*.day' => ['required', 'string'],
            'availability.*.from' => ['required', 'string', 'regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'],
            'availability.*.to' => ['required', 'string', 'regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'],
        ], [
            'availability.required' => 'La disponibilité est obligatoire.',
            'availability.*.day.required' => 'Veuillez sélectionner un jour.',
            'availability.*.from.required' => 'L\'heure de début est obligatoire.',
            'availability.*.from.regex' => 'L\'heure de début doit être au format HH:MM.',
            'availability.*.to.required' => 'L\'heure de fin est obligatoire.',
            'availability.*.to.regex' => 'L\'heure de fin doit être au format HH:MM.',
        ]);

        // Conversion automatique des jours en anglais
        $daysMap = [
            'lundi' => 'monday',
            'mardi' => 'tuesday',
            'mercredi' => 'wednesday',
            'jeudi' => 'thursday',
            'vendredi' => 'friday',
            'samedi' => 'saturday',
            'dimanche' => 'sunday',
            'monday' => 'monday',
            'tuesday' => 'tuesday',
            'wednesday' => 'wednesday',
            'thursday' => 'thursday',
            'friday' => 'friday',
            'saturday' => 'saturday',
            'sunday' => 'sunday',
        ];
        $availability = collect($request->availability)->map(function($slot) use ($daysMap) {
            $day = strtolower($slot['day']);
            $slot['day'] = $daysMap[$day] ?? $day;
            return $slot;
        })->toArray();

        if ($user && $user->doctor) {
            $user->doctor->update([
                'availability' => $availability
            ]);
        }

        return Redirect::route('profile.availability')->with('success', 'Disponibilité mise à jour avec succès !');
    }

    /**
     * Affiche l'historique des rendez-vous du patient.
     */
    public function showPatientHistory(Request $request): View
    {
        $user = $request->user();
        if (!$user->isPatient()) {
            return redirect()->route('profile')->with('error', 'Accès non autorisé.');
        }
        $appointments = $user->patientAppointments()->orderByDesc('date')->get();
        return view('profile.history', [
            'appointments' => $appointments,
            'user' => $user
        ]);
    }
}
