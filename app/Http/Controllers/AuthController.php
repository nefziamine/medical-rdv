<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRules;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    /**
     * Show the login choice form.
     */
    public function showLoginChoice()
    {
        return view('login-choice');
    }

    /**
     * Show the patient login form.
     */
    public function showPatientLogin()
    {
        return view('login-patient');
    }

    /**
     * Show the doctor login form.
     */
    public function showDoctorLogin()
    {
        return view('login-doctor');
    }

    /**
     * Handle patient login request.
     */
    public function loginPatient(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            
            // Vérifier que l'utilisateur est bien un patient
            if ($user->user_type !== 'patient') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Ce compte n\'est pas un compte patient.',
                ])->withInput($request->only('email'));
            }

            $request->session()->regenerate();
            return redirect()->intended('/profile');
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->withInput($request->only('email'));
    }

    /**
     * Handle doctor login request.
     */
    public function loginDoctor(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            
            // Vérifier que l'utilisateur est bien un médecin
            if ($user->user_type !== 'doctor') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Ce compte n\'est pas un compte médecin.',
                ])->withInput($request->only('email'));
            }

            $request->session()->regenerate();
            return redirect()->intended('/profile');
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->withInput($request->only('email'));
    }

    /**
     * Show the registration choice form.
     */
    public function showRegisterChoice()
    {
        return view('register-choice');
    }

    /**
     * Show the patient registration form.
     */
    public function showPatientRegister()
    {
        return view('register-patient');
    }

    /**
     * Handle patient registration request.
     */
    public function registerPatient(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'gender' => 'required|in:homme,femme,autre',
            'password' => ['required', 'confirmed', PasswordRules::defaults()],
            'terms' => 'required|accepted',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = 'profile_' . time() . '.' . $file->getClientOriginalExtension();
            $profilePhotoPath = $file->storeAs('profile_photos', $filename, 'public');
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => '+216' . $request->phone,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'user_type' => 'patient',
            'password' => Hash::make($request->password),
            'profile_photo' => $profilePhotoPath,
        ]);

        Auth::login($user);

        return redirect('/profile')->with('success', 'Compte patient créé avec succès !');
    }

    /**
     * Show the doctor registration form.
     */
    public function showDoctorRegister()
    {
        $specialties = \App\Models\Specialty::active()->ordered()->get();
        return view('register-doctor', compact('specialties'));
    }

    /**
     * Handle doctor registration request.
     */
    public function registerDoctor(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'phone_country_code' => 'required|string|max:5',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'diploma_number' => 'nullable|string|max:100',
            'university' => 'nullable|string|max:200',
            'graduation_year' => 'nullable|integer|min:1950|max:2030',
            'tele_secretariat' => 'nullable|in:yes,no',
            'professional_website' => 'nullable|in:yes,no',
            'photo_video' => 'nullable|in:yes,no',
            'waiting_room_display' => 'nullable|in:yes,no',
            'whatsapp_reminders' => 'nullable|in:yes,no',
            'message' => 'nullable|string|max:1000',
            'password' => ['required', 'confirmed', PasswordRules::defaults()],
            'terms' => 'required|accepted',
            'recaptcha' => 'required|accepted',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = 'profile_' . time() . '.' . $file->getClientOriginalExtension();
            $profilePhotoPath = $file->storeAs('profile_photos', $filename, 'public');
        }

        // Create user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone_country_code . $request->phone,
            'address' => $request->address,
            'user_type' => 'doctor',
            'password' => Hash::make($request->password),
            'profile_photo' => $profilePhotoPath,
        ]);

        // Create doctor profile
        $doctor = \App\Models\Doctor::create([
            'user_id' => $user->id,
            'specialty_id' => 1, // Default specialty
            'experience_years' => 0,
            'consultation_fee' => 50,
            'description' => $request->message ?? '',
            'education' => $request->university ?? '',
            'certifications' => $request->diploma_number ?? '',
            'languages' => ['arabe', 'français'],
            'start_time' => '09:00',
            'end_time' => '17:00',
            'available_days' => ['lundi', 'mardi', 'mercredi', 'jeudi'],
            'clinic_address' => $request->address,
            'clinic_phone' => $request->phone_country_code . $request->phone,
            'is_available' => true,
            'rating' => 0,
        ]);

        // Store additional services preferences
        $additionalServices = [
            'tele_secretariat' => $request->tele_secretariat === 'yes',
            'professional_website' => $request->professional_website === 'yes',
            'photo_video' => $request->photo_video === 'yes',
            'waiting_room_display' => $request->waiting_room_display === 'yes',
            'whatsapp_reminders' => $request->whatsapp_reminders === 'yes',
        ];

        // You can store these in a separate table or as JSON in the doctor table
        if ($doctor) {
            $doctor->update(['additional_services' => $additionalServices]);
        } else {
            // Gérer l'erreur (ex : abort(404) ou message)
        }

        // Auto-login the user
        Auth::login($user);

        return redirect('/profile')->with('success', 'Inscription réussie ! Votre compte médecin a été créé avec succès.');
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Show the password reset link request form.
     */
    public function showForgotPassword()
    {
        return view('forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'account_type' => 'required|in:patient,doctor',
        ]);

        // Check if user exists with the specified account type
        $user = User::where('email', $request->email)
                   ->where('user_type', $request->account_type)
                   ->first();

        if (!$user) {
            return back()->withInput($request->only('email', 'account_type'))
                        ->withErrors(['email' => 'Aucun utilisateur trouvé avec cette adresse email et ce type de compte.']);
        }

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', 'Lien de réinitialisation envoyé à votre adresse email.')
                    : back()->withInput($request->only('email', 'account_type'))
                            ->withErrors(['email' => __($status)]);
    }

    /**
     * Show the password reset form.
     */
    public function showResetPassword(Request $request)
    {
        return view('reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
