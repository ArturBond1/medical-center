<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Appointment;
use App\Models\Medication;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $prescriptions = Prescription::with('appointment.patient.user', 'doctor.user', 'medications')
            ->paginate(10);
        return view('prescriptions.index', compact('prescriptions'));
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $appointments = Appointment::with('patient.user', 'doctor.user')->get()->pluck('full_info', 'id');
        $medications = Medication::all()->pluck('name', 'id');
        return view('prescriptions.create', compact('appointments', 'medications'));
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
            'medication_ids' => 'required|array',
            'medication_ids.*' => 'exists:medications,id',
            'dosage' => 'required|array',
            'dosage.*' => 'nullable|string|max:255',
            'frequency' => 'required|array',
            'frequency.*' => 'nullable|string|max:255',
            'duration' => 'required|array',
            'duration.*' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $prescription = Prescription::create([
            'appointment_id' => $request->appointment_id,
            'doctor_id' => $request->doctor_id,
            'notes' => $request->notes,
        ]);

        $medicationData = [];
        foreach ($request->medication_ids as $key => $medicationId) {
            $medicationData[$medicationId] = [
                'dosage' => $request->dosage[$key] ?? '',
                'frequency' => $request->frequency[$key] ?? '',
                'duration' => $request->duration[$key] ?? '',
            ];
        }
        $prescription->medications()->attach($medicationData);

        return redirect()->route('prescriptions.index')->with('success', 'Рецепт створено успішно.');
    }

    /**
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Prescription $prescription)
    {
        $prescription->load('appointment.patient.user', 'doctor.user', 'medications');
        return view('prescriptions.show', compact('prescription'));
    }

    /**
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Prescription $prescription)
    {
        $prescription->load('medications');
        $appointments = Appointment::with('patient.user', 'doctor.user')->get()->pluck('full_info', 'id');
        $medications = Medication::all()->pluck('name', 'id');
        $prescriptionMedicationIds = $prescription->medications->pluck('id')->toArray();
        return view('prescriptions.edit', compact('prescription', 'appointments', 'medications', 'prescriptionMedicationIds'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Prescription $prescription)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'doctor_id' => 'required|exists:doctors,id',
            'medication_ids' => 'required|array',
            'medication_ids.*' => 'exists:medications,id',
            'dosage' => 'required|array',
            'dosage.*' => 'nullable|string|max:255',
            'frequency' => 'required|array',
            'frequency.*' => 'nullable|string|max:255',
            'duration' => 'required|array',
            'duration.*' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $prescription->update([
            'appointment_id' => $request->appointment_id,
            'doctor_id' => $request->doctor_id,
            'notes' => $request->notes,
        ]);

        $medicationData = [];
        foreach ($request->medication_ids as $key => $medicationId) {
            $medicationData[$medicationId] = [
                'dosage' => $request->dosage[$key] ?? '',
                'frequency' => $request->frequency[$key] ?? '',
                'duration' => $request->duration[$key] ?? '',
            ];
        }

        $prescription->medications()->sync($medicationData);

        return redirect()->route('prescriptions.index')->with('success', 'Рецепт оновлено успішно.');
    }

    /**
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
        return redirect()->route('prescriptions.index')->with('success', 'Рецепт видалено успішно.');
    }
}

