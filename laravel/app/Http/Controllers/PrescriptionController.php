<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Medication;

class PrescriptionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $prescriptionsQuery = Prescription::with(['doctor', 'patient', 'medication']);
        if ($request->filled('doctor_id')) {
            $prescriptionsQuery->where('doctor_id', $request->input('doctor_id'));
        }
        if ($request->filled('patient_id')) {
            $prescriptionsQuery->where('patient_id', $request->input('patient_id'));
        }
        if ($request->filled('medication_id')) {
            $prescriptionsQuery->where('medication_id', $request->input('medication_id'));
        }
        if ($request->filled('notes')) {
            $prescriptionsQuery->where('notes', 'like', '%' . $request->input('notes') . '%');
        }

        $perPage = $request->input('per_page', 3);
        $prescriptions = $prescriptionsQuery->paginate($perPage)->appends($request->query());

        $patients = Patient::all()->pluck('user.name', 'id');
        $doctors = Doctor::all()->pluck('user.name', 'id');
        $medications = Medication::all()->pluck('name', 'id');

        return view('prescriptions.index', compact('prescriptions', 'patients', 'doctors', 'medications'));
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $patients = Patient::all()->pluck('user.name', 'id');
        $doctors = Doctor::all()->pluck('user.name', 'id');
        $medications = Medication::all()->pluck('name', 'id');
        return view('prescriptions.create', compact('doctors', 'patients', 'medications'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'medication_id' => 'required|exists:medications,id',
            'notes' => 'nullable|string',
        ]);

        $prescription = new Prescription();
        $prescription->appointment_id = $request->appointment_id;
        $prescription->doctor_id = $request->doctor_id;
        $prescription->patient_id = $request->patient_id;
        $prescription->medication_id = $request->medication_id;
        $prescription->notes = $request->notes;
        $prescription->save();

        return redirect()->route('prescriptions.index')->with('success', 'Prescription created successfully.');
    }

    /**
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Prescription $prescription)
    {
        $prescription->load('doctor', 'patient', 'medication');
        return view('prescriptions.show', compact('prescription'));
    }

    /**
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Prescription $prescription)
    {
        $patients = Patient::all()->pluck('user.name', 'id');
        $doctors = Doctor::all()->pluck('user.name', 'id');
        $medications = Medication::all()->pluck('name', 'id');
        return view('prescriptions.edit', compact('prescription', 'doctors', 'patients', 'medications'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Prescription $prescription)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'medication_id' => 'required|exists:medications,id',
            'notes' => 'nullable|string',
        ]);

        $prescription->doctor_id = $request->doctor_id;
        $prescription->patient_id = $request->patient_id;
        $prescription->medication_id = $request->medication_id;
        $prescription->notes = $request->notes;
        $prescription->save();

        return redirect()->route('prescriptions.index')->with('success', 'Рецепт оновлено успішно.');
    }

    /**
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Prescription $prescription)
    {
        $prescription->delete();

        return redirect()->route('prescriptions.index')->with('success', 'Рецепт було видалено успішно.');
    }
}

