<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $treatmentsQuery = Treatment::with('patient.user', 'doctor.user');
        if ($request->filled('patient_id')) {
            $treatmentsQuery->where('patient_id', $request->input('patient_id'));
        }
        if ($request->filled('doctor_id')) {
            $treatmentsQuery->where('doctor_id', $request->input('doctor_id'));
        }
        if ($request->filled('diagnosis')) {
            $treatmentsQuery->where('diagnosis', 'like', '%' . $request->input('diagnosis') . '%');
        }
        if ($request->filled('start_date')) {
            $treatmentsQuery->whereDate('start_date', $request->input('start_date'));
        }
        if ($request->filled('end_date')) {
            $treatmentsQuery->whereDate('end_date', $request->input('end_date'));
        }
        $perPage = $request->input('per_page', 3);

        $treatments = $treatmentsQuery->paginate($perPage)->appends($request->query());
        $patients = Patient::with('user')->get()->pluck('user.name', 'id');
        $doctors = Doctor::with('user')->get()->pluck('user.name', 'id');

        return view('treatments.index', compact('treatments', 'patients', 'doctors'));
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $patients = Patient::with('user')->get()->pluck('user.name', 'id');
        $doctors = Doctor::with('user')->get()->pluck('user.name', 'id');
        return view('treatments.create', compact('patients', 'doctors'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'diagnosis' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        Treatment::create($request->all());

        return redirect()->route('treatments.index')->with('success', 'Лікування створено успішно.');
    }

    /**
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Treatment $treatment)
    {
        $treatment->load('patient.user', 'doctor.user');
        return view('treatments.show', compact('treatment'));
    }

    /**
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Treatment $treatment)
    {
        $patients = Patient::with('user')->get()->pluck('user.name', 'id');
        $doctors = Doctor::with('user')->get()->pluck('user.name', 'id');
        return view('treatments.edit', compact('treatment', 'patients', 'doctors'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Treatment $treatment)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'diagnosis' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        $treatment->update($request->all());

        return redirect()->route('treatments.index')->with('success', 'Лікування оновлено успішно.');
    }

    /**
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        return redirect()->route('treatments.index')->with('success', 'Лікування видалено успішно.');
    }
}

