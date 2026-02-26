<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::latest()->get();
        return view('admin.patients.index', compact('patients'));
    }
    public function create()
    {
        return view('admin.patients.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'owner_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'status' => 'required|string|in:Rawat Inap,Rawat Jalan,Selesai',
        ]);
        Patient::create($validated);
        return redirect()->route('admin.patients.index')->with('success', 'Patient added successfully.');
    }
    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'owner_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'status' => 'required|string|in:Rawat Inap,Rawat Jalan,Selesai',
        ]);
        $patient->update($validated);
        return redirect()->route('admin.patients.index')->with('success', 'Patient updated successfully.');
    }
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('admin.patients.index')->with('success', 'Patient deleted successfully.');
    }
}
