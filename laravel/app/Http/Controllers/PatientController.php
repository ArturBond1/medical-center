<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 3);

        $patientsQuery = Patient::with('user')
            ->when($request->filled('id'), fn($q) => $q->where('id', $request->input('id')))
            ->when($request->filled('user_name'), fn($q) => $q->whereHas('user', fn($q2) =>
            $q2->where('name', 'like', '%' . $request->input('user_name') . '%')
            ))
            ->when($request->filled('gender'), fn($q) => $q->where('gender', $request->input('gender')))
            ->when($request->filled('phone_number'), fn($q) => $q->where('phone_number', 'like', '%' . $request->input('phone_number') . '%'));

        $patients = $patientsQuery->paginate($perPage)->appends($request->query());

        return view('patients.index', compact('patients', 'perPage'));
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $users = User::whereDoesntHave('patient')->get()->pluck('name', 'id');
        return view('patients.create', compact('users'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|unique:patients',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|max:255',
            'phone_number' => 'nullable|max:20',
        ]);

        Patient::create($request->all());

        return redirect()->route('patients.index')->with('success', 'Пацієнта успішно додано.');
    }

    /**
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    /**
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Patient $patient)
    {
        $users = User::all()->pluck('name', 'id');
        return view('patients.edit', compact('patient', 'users'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'user_id' => 'required|unique:patients,user_id,' . $patient->id,
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|max:255',
            'phone_number' => 'nullable|max:20',
        ]);

        $patient->update($request->all());

        return redirect()->route('patients.index')->with('success', 'Пацієнта успішно оновлено.');
    }

    /**
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Patient $patient)
    {
        //  if ($patient->medicalRecords()->count() > 0 || $patient->appointments()->count() > 0) {
        //      return redirect()->route('patients.index')->with('error', 'Неможливо видалити пацієнта, який має медичні записи або прийоми.');
        //
        //  }

        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Пацієнта успішно видалено.');
    }
}
