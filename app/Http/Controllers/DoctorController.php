<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Doctor::with(['user', 'specialty']);

        // Filter by specialty
        if ($request->filled('specialty')) {
            $query->whereHas('specialty', function ($q) use ($request) {
                $q->where('slug', $request->specialty);
            });
        }

        // Search by name
        if ($request->filled('search')) {
            $search = trim(str_ireplace('dr.', '', $request->search));
            $query->whereHas('user', function ($q) use ($search) {
                $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"])
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        $doctors = $query->orderBy('rating', 'desc')->paginate(12);
        $specialties = Specialty::active()->ordered()->get();

        return view('doctors', compact('doctors', 'specialties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // ... logique de création du médecin ...
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with('error', "Erreur lors de l'enregistrement du médecin. Vérifiez que la spécialité sélectionnée existe.");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $doctor = Doctor::with(['user', 'specialty', 'reviews.patient'])
            ->findOrFail($id);
        
        $reviews = $doctor->reviews()->with('patient')->public()->verified()->latest()->paginate(5);
        
        return view('doctor-details', compact('doctor', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Autocomplete doctor names for AJAX search.
     */
    public function autocomplete(Request $request)
    {
        $search = trim(str_ireplace('dr.', '', $request->get('q', '')));
        $doctors = Doctor::with('user', 'specialty')
            ->whereHas('user', function ($q) use ($search) {
                $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"])
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            })
            ->limit(8)
            ->get();

        $results = $doctors->map(function($doctor) {
            return [
                'id' => $doctor->id,
                'name' => ($doctor->user ? $doctor->user->first_name . ' ' . $doctor->user->last_name : 'Nom non disponible'),
                'specialty' => $doctor->specialty ? $doctor->specialty->name : '',
            ];
        });

        return response()->json($results);
    }
}
