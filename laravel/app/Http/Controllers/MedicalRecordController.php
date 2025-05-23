<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $query = MedicalRecord::with('patient.user');
        if ($request->has('patient_id') && $request->patient_id) {
            $query->where('patient_id', $request->patient_id);
        }
        if ($request->has('diagnosis') && $request->diagnosis) {
            $query->where('diagnosis', 'like', '%' . $request->diagnosis . '%');
        }
        if ($request->has('treatment_plan') && $request->treatment_plan) {
            $query->where('treatment_plan', 'like', '%' . $request->treatment_plan . '%');
        }
        if ($request->has('notes') && $request->notes) {
            $query->where('notes', 'like', '%' . $request->notes . '%');
        }
        $medicalRecords = $query->paginate(request('perPage', 3));

        $patients = Patient::all()->pluck('user.name', 'id');

        return view('medical_records.index', compact('medicalRecords', 'patients'));
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $patients = Patient::all()->pluck('user.name', 'id');
        return view('medical_records.create', compact('patients'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|unique:medical_records',
            'diagnosis' => 'nullable|max:500',
            'treatment_plan' => 'nullable|max:1000',
            'notes' => 'nullable|max:1000',
        ]);

        MedicalRecord::create($request->all());

        return redirect()->route('medical_records.index')->with('success', 'Медичну картку успішно додано.');
    }

    /**
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Contracts\View\View
     */
    public function show(MedicalRecord $medicalRecord)
    {
        return view('medical_records.show', compact('medicalRecord'));
    }

    /**
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(MedicalRecord $medicalRecord)
    {
        $patients = Patient::all()->pluck('user.name', 'id');
        return view('medical_records.edit', compact('medicalRecord', 'patients')); // Змінено на 'medical_records.edit'
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $request->validate([
            'patient_id' => 'required|unique:medical_records,patient_id,' . $medicalRecord->id,
            'diagnosis' => 'nullable|max:500',
            'treatment_plan' => 'nullable|max:1000',
            'notes' => 'nullable|max:1000',
        ]);

        $medicalRecord->update($request->all());

        return redirect()->route('medical_records.index')->with('success', 'Медичну картку успішно оновлено.');
    }

    /**
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();

        return redirect()->route('medical_records.index')->with('success', 'Медичну картку успішно видалено.');
    }
}
