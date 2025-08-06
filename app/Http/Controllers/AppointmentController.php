<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->doctor) {
            $appointments = $user->doctor->appointments()->with('patient')->latest()->paginate(10);
        } else {
            // Pour le patient : tous ses rendez-vous
            $appointments = $user->patientAppointments()->with('doctor.user', 'doctor.specialty')->latest()->paginate(10);
        }
        
        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($doctorId)
    {
        $user = Auth::user();
        
        // Vérifier que l'utilisateur est connecté
        if (!$user) {
            return redirect()->route('login')
                ->withErrors(['general' => 'Vous devez être connecté pour prendre un rendez-vous.']);
        }
        
        // Empêcher les médecins d'accéder à la page de création de rendez-vous
        if ($user->isDoctor()) {
            return redirect()->route('doctors.index')
                ->withErrors(['general' => 'Les médecins ne peuvent pas prendre de rendez-vous.']);
        }

        try {
            $doctor = Doctor::with(['user', 'specialty'])->findOrFail($doctorId);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('doctors.index')
                ->withErrors(['general' => 'Médecin non trouvé.']);
        }

        // On autorise la prise de rendez-vous même si le médecin n'est pas disponible ou n'a pas défini de créneaux
        return view('appointments.create', compact('doctor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $doctorId)
    {
        $user = Auth::user();
        
        // Empêcher les médecins de prendre des rendez-vous
        if ($user->isDoctor()) {
            return back()->withErrors(['general' => 'Les médecins ne peuvent pas prendre de rendez-vous.']);
        }

        $request->validate([
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:500',
            'appointment_type' => 'required|in:in_person,online',
        ]);

        $doctor = Doctor::findOrFail($doctorId);
        $user = Auth::user();

        // Vérifier que le médecin est disponible
        if (!$doctor->is_available) {
            return back()->withErrors(['general' => 'Ce médecin n\'est pas disponible pour le moment.']);
        }

        // Vérifier la disponibilité du médecin pour ce créneau
        $availability = $doctor->availability ?? [];
        $appointmentDate = Carbon::parse($request->appointment_date);
        $dayName = strtolower($appointmentDate->englishDayOfWeek); // ex: monday, tuesday
        
        $slotAvailable = false;
        foreach ($availability as $slot) {
            if ($slot['day'] === $dayName) {
                $appointmentTime = $request->appointment_time;
                $slotFrom = $slot['from'];
                $slotTo = $slot['to'];
                
                if ($appointmentTime >= $slotFrom && $appointmentTime < $slotTo) {
                    $slotAvailable = true;
                    break;
                }
            }
        }
        
        if (!$slotAvailable) {
            return back()->withErrors(['appointment_time' => 'Ce créneau n\'est pas disponible dans le planning du médecin.']);
        }

        // Check if the time slot is already taken
        $existingAppointment = Appointment::where('doctor_id', $doctorId)
            ->where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->whereIn('status', ['pending', 'confirmed'])
            ->first();

        if ($existingAppointment) {
            return back()->withErrors(['appointment_time' => 'Ce créneau horaire n\'est pas disponible.']);
        }

        // Vérifier que le patient n'a pas déjà un rendez-vous à cette heure
        $patientExistingAppointment = Appointment::where('patient_id', $user->id)
            ->where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->whereIn('status', ['pending', 'confirmed'])
            ->first();

        if ($patientExistingAppointment) {
            return back()->withErrors(['appointment_time' => 'Vous avez déjà un rendez-vous à cette heure.']);
        }

        $appointment = Appointment::create([
            'patient_id' => $user->id,
            'doctor_id' => $doctorId,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'notes' => $request->notes,
            'appointment_type' => $request->appointment_type,
            'fee' => $doctor->consultation_fee,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        // Notify doctor and patient (désactivé temporairement)
        // $doctorUser = $doctor->user;
        // $patientUser = $user;
        // $doctorUser->notify(new \App\Notifications\NewAppointmentNotification($appointment));
        // $patientUser->notify(new \App\Notifications\NewAppointmentNotification($appointment));

        return redirect()->route('appointments.index')
            ->with('success', 'Rendez-vous réservé avec succès ! En attente de confirmation du médecin.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $user = auth()->user();
        
        // Vérifier que le rendez-vous existe et est valide
        if (!$appointment || !$appointment->id) {
            return redirect()->route('appointments.index')
                ->with('error', 'Rendez-vous non trouvé ou invalide.');
        }
        
        // Check if user can view this appointment
        if ($appointment->patient_id !== $user->id && ($appointment->doctor && $appointment->doctor->user_id !== $user->id)) {
            abort(403, 'Accès non autorisé');
        }

        // Charger les relations nécessaires
        $appointment->load(['doctor.user', 'doctor.specialty', 'patient']);

        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $user = auth()->user();
        
        // Vérifier que le rendez-vous existe et est valide
        if (!$appointment || !$appointment->id) {
            return redirect()->route('appointments.index')
                ->with('error', 'Rendez-vous non trouvé ou invalide.');
        }
        
        // Debug information
        \Log::info('Edit appointment request', [
            'appointment_id' => $appointment->id,
            'appointment_patient_id' => $appointment->patient_id,
            'current_user_id' => $user->id,
            'user_is_patient' => $appointment->patient_id === $user->id,
            'user_is_doctor' => $appointment->doctor && $appointment->doctor->user_id === $user->id
        ]);
        
        // Check if user can edit this appointment
        if ($appointment->patient_id !== $user->id && ($appointment->doctor && $appointment->doctor->user_id !== $user->id)) {
            abort(403, 'Accès non autorisé');
        }

        // Charger les relations nécessaires
        $appointment->load(['doctor.user', 'doctor.specialty', 'patient']);

        $doctors = Doctor::with('user', 'specialty')->get();
        return view('appointments.edit', compact('appointment', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $user = auth()->user();
        
        // Check if user can update this appointment
        if ($appointment->patient_id !== $user->id && ($appointment->doctor && $appointment->doctor->user_id !== $user->id)) {
            abort(403, 'Accès non autorisé');
        }

        $validated = $request->validate([
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required|date_format:H:i',
            'reason' => 'required|string|max:500',
            'notes' => 'nullable|string|max:1000',
        ]);

        if ($appointment) {
            $appointment->update($validated);
        } else {
            // Gérer l'erreur (ex : abort(404) ou message)
        }

        return redirect()->route('profile')
            ->with('success', 'Rendez-vous mis à jour avec succès');
    }

    /**
     * Cancel the specified appointment.
     */
    public function destroy(Appointment $appointment)
    {
        $user = auth()->user();
        
        // Check if user is authenticated
        if (!$user) {
            abort(401, 'Vous devez être connecté pour effectuer cette action');
        }
        
        // Check if appointment exists
        if (!$appointment) {
            abort(404, 'Rendez-vous non trouvé');
        }

        // Si c'est un patient, il ne peut annuler que ses propres rendez-vous
        if ($user->isPatient() && $appointment->patient_id != $user->id) {
            abort(403, 'Accès non autorisé - Vous ne pouvez annuler que vos propres rendez-vous');
        }

        // Si c'est un médecin, il ne peut refuser que ses propres rendez-vous
        if ($user->isDoctor() && $appointment->doctor->user_id != $user->id) {
            abort(403, 'Accès non autorisé - Vous ne pouvez refuser que vos propres rendez-vous');
        }

        // Check if appointment can be cancelled
        if ($appointment->status === 'completed') {
            return back()->with('error', 'Impossible d\'annuler/refuser un rendez-vous déjà terminé.');
        }

        if ($appointment->status === 'cancelled') {
            return back()->with('error', 'Ce rendez-vous est déjà annulé.');
        }

        // Mark appointment as cancelled
        $appointment->status = 'cancelled';
        $appointment->cancelled_at = now();
        $appointment->save();

        // Message différent selon le type d'utilisateur
        $msg = $user->isDoctor() ? 'Rendez-vous refusé avec succès !' : 'Rendez-vous annulé avec succès !';
        return redirect()->route('profile')
            ->with('success', $msg);
    }

    /**
     * Permanently delete a cancelled appointment.
     */
    public function forceDelete(Appointment $appointment)
    {
        $user = auth()->user();
        
        // Check if user is authenticated
        if (!$user) {
            abort(401, 'Vous devez être connecté pour effectuer cette action');
        }
        
        // Check if appointment exists
        if (!$appointment) {
            abort(404, 'Rendez-vous non trouvé');
        }
        
        // Debug information
        \Log::info('Force delete appointment request', [
            'appointment_id' => $appointment->id,
            'appointment_patient_id' => $appointment->patient_id,
            'current_user_id' => $user->id,
            'user_is_patient' => $appointment->patient_id === $user->id,
            'user_type' => $user->user_type,
            'appointment_status' => $appointment->status
        ]);
        
        // Check if user can delete this appointment
        if ($appointment->patient_id != $user->id) {
            abort(403, 'Accès non autorisé - Vous ne pouvez supprimer que vos propres rendez-vous');
        }

        // Check if appointment is cancelled
        if ($appointment->status !== 'cancelled') {
            return back()->withErrors(['general' => 'Seuls les rendez-vous annulés peuvent être supprimés définitivement.']);
        }

        $appointment->delete();

        return redirect()->route('profile')
            ->with('success', 'Rendez-vous supprimé définitivement');
    }

    public function confirm(Appointment $appointment)
    {
        \Log::info('Méthode confirm appelée', ['appointment_id' => $appointment->id]);
        $user = auth()->user();
        \Log::info('Début confirm', [
            'appointment_id' => $appointment->id,
            'status_avant' => $appointment->status,
            'user_id' => $user->id,
            'doctor_user_id' => $appointment->doctor->user_id,
            'is_doctor' => $user->isDoctor(),
        ]);
        // Vérifier que l'utilisateur est le médecin concerné
        if (!$user->isDoctor() || $appointment->doctor->user_id !== $user->id) {
            \Log::warning('Accès non autorisé', [
                'user_id' => $user->id,
                'doctor_user_id' => $appointment->doctor->user_id,
                'is_doctor' => $user->isDoctor(),
            ]);
            abort(403, 'Accès non autorisé');
        }
        // Vérifier que le rendez-vous est en attente
        if ($appointment->status !== 'pending') {
            \Log::warning('Rendez-vous non en attente', [
                'status' => $appointment->status
            ]);
            return back()->withErrors(['general' => 'Ce rendez-vous ne peut plus être confirmé.']);
        }
        // Vérifier que le créneau est toujours disponible
        $doctor = $appointment->doctor;
        $availability = $doctor->availability ?? [];
        // Trouver le jour de la semaine
        $appointmentDate = \Carbon\Carbon::parse($appointment->appointment_date);
        $dayNameFr = strtolower($appointmentDate->locale('fr')->isoFormat('dddd'));
        $daysMap = [
            'lundi' => 'monday',
            'mardi' => 'tuesday',
            'mercredi' => 'wednesday',
            'jeudi' => 'thursday',
            'vendredi' => 'friday',
            'samedi' => 'saturday',
            'dimanche' => 'sunday',
        ];
        $dayName = $daysMap[$dayNameFr] ?? $dayNameFr;
        $dayAvailable = false;
        $timeSlotAvailable = false;
        foreach (
            $availability as $slot) {
            if ($slot['day'] === $dayName) {
                $dayAvailable = true;
                $appointmentTime = is_string($appointment->appointment_time) ? $appointment->appointment_time : \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i');
                $slotFrom = $slot['from'];
                $slotTo = $slot['to'];
                if ($appointmentTime >= $slotFrom && $appointmentTime < $slotTo) {
                    $timeSlotAvailable = true;
                    break;
                }
            }
        }
        \Log::info('Disponibilité', [
            'dayAvailable' => $dayAvailable,
            'timeSlotAvailable' => $timeSlotAvailable,
            'dayName' => $dayName,
            'appointmentTime' => $appointment->appointment_time,
            'availability' => $availability
        ]);
        \Log::info('DEBUG JOUR', [
            'dayName' => $dayName,
            'jours_disponibles' => array_map(fn($slot) => $slot['day'], $availability),
            'availability' => $availability,
            'appointment_date' => $appointment->appointment_date,
            'appointment_time' => $appointment->appointment_time,
        ]);
        if (!$dayAvailable) {
            \Log::warning('Jour non disponible', ['dayName' => $dayName]);
            return back()->withErrors(['general' => 'Ce jour n\'est plus disponible dans votre planning.']);
        }
        if (!$timeSlotAvailable) {
            \Log::warning('Créneau non disponible', ['appointmentTime' => $appointment->appointment_time]);
            return back()->withErrors(['general' => 'Ce créneau horaire n\'est plus disponible dans votre planning.']);
        }
        // Vérifier qu'aucun autre rendez-vous n'est confirmé sur ce créneau
        $conflictingAppointment = Appointment::where('doctor_id', $appointment->doctor_id)
            ->where('appointment_date', $appointment->appointment_date)
            ->where('appointment_time', $appointment->appointment_time)
            ->where('status', 'confirmed')
            ->where('id', '!=', $appointment->id)
            ->first();
        if ($conflictingAppointment) {
            \Log::warning('Créneau déjà réservé', ['conflicting_appointment_id' => $conflictingAppointment->id]);
            return back()->withErrors(['general' => 'Ce créneau est déjà réservé par un autre patient.']);
        }
        // Confirmer le rendez-vous
        $appointment->status = 'confirmed';
        $appointment->save();
        \Log::info('Statut après save', [
            'appointment_id' => $appointment->id,
            'status_apres' => $appointment->status,
        ]);
        return back()->with('success', 'Rendez-vous confirmé avec succès !');
    }

    /**
     * Nettoyer automatiquement les créneaux expirés
     */
    public function cleanupExpiredSlots()
    {
        // Marquer comme annulés les rendez-vous en attente qui sont passés
        $expiredAppointments = Appointment::where('status', 'pending')
            ->where('appointment_date', '<', date('Y-m-d'))
            ->orWhere(function($query) {
                $query->where('appointment_date', '=', date('Y-m-d'))
                      ->where('appointment_time', '<', date('H:i'));
            })
            ->update(['status' => 'cancelled']);

        return response()->json(['message' => 'Nettoyage terminé', 'updated' => $expiredAppointments]);
    }

    /**
     * Obtenir les créneaux disponibles pour un médecin
     */
    public function getAvailableSlots($doctorId, Request $request)
    {
        try {
            $doctor = Doctor::findOrFail($doctorId);
            $date = $request->get('date', date('Y-m-d'));
            
            // Vérifier que la date n'est pas dans le passé
            $selectedDate = Carbon::parse($date);
            $today = Carbon::today();
            
            if ($selectedDate->lt($today)) {
                return response()->json(['slots' => [], 'error' => 'Date dans le passé']);
            }
            
            $availability = $doctor->availability ?? [];
            // Correction ici : jour en anglais
            $dayName = strtolower($selectedDate->englishDayOfWeek); // ex: monday, tuesday
            
            $availableSlots = [];
            
            // Trouver les créneaux pour ce jour
            foreach ($availability as $slot) {
                if ($slot['day'] === $dayName) {
                    $startTime = Carbon::parse($slot['from']);
                    $endTime = Carbon::parse($slot['to']);
                    
                    // Générer des créneaux de 30 minutes
                    $currentTime = $startTime->copy();
                    
                    while ($currentTime < $endTime) {
                        $timeSlot = $currentTime->format('H:i');
                        
                        // Vérifier si le créneau n'est pas déjà pris
                        $existingAppointment = Appointment::where('doctor_id', $doctorId)
                            ->where('appointment_date', $date)
                            ->where('appointment_time', $timeSlot)
                            ->whereIn('status', ['pending', 'confirmed'])
                            ->first();
                            
                        if (!$existingAppointment) {
                            $availableSlots[] = $timeSlot;
                        }
                        
                        // Passer au créneau suivant (30 minutes plus tard)
                        $currentTime->addMinutes(30);
                    }
                }
            }
            
            // Trier les créneaux par ordre chronologique
            sort($availableSlots);
            
            return response()->json([
                'slots' => $availableSlots,
                'date' => $date,
                'day' => $dayName,
                'availability' => $availability
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'slots' => [],
                'error' => 'Erreur lors du chargement des créneaux: ' . $e->getMessage()
            ], 500);
        }
    }
}
