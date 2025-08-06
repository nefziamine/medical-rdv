<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use App\Models\Doctor;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialties = Specialty::active()->ordered()->get();
        
        return view('specialties', compact('specialties'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $specialty = Specialty::where('slug', $slug)->active()->firstOrFail();
        $doctors = Doctor::with(['user', 'specialty'])
            ->where('specialty_id', $specialty->id)
            ->available()
            ->get();
        
        return view('specialty-details', compact('specialty', 'doctors'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialty $specialty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialty $specialty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialty $specialty)
    {
        //
    }
}
