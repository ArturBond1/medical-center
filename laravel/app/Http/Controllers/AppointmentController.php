<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointmentsQuery = Appointment::with(['patient', 'doctor']);
        if ($request->filled('patient_id')) {
            $appointmentsQuery->where('patient_id', $request->input('patient_id'));
        }
        if ($request->filled('doctor_id')) {
            $appointmentsQuery->where('doctor_id', $request->input('doctor_id'));
        }
        if ($request->filled('appointment_date')) {
            $appointmentsQuery->where('appointment_date', $request->input('appointment_date'));
        }
        if ($request->filled('status')) {
            $appointmentsQuery->where('status', $request->input('status'));
        }
        $patients = Patient::all()->pluck('user.name', 'id');
        $doctors = Doctor::all()->pluck('user.name', 'id');
        $perPage = $request->input('per_page', 3);

        $appointments = $appointmentsQuery->paginate($perPage)->appends($request->query());

        return view('appointments.index', compact('appointments', 'patients', 'doctors'));
    }

    public function create()
    {
        $patients = Patient::all()->pluck('user.name', 'id');
        $doctors = Doctor::all()->pluck('user.name', 'id');
        return view('appointments.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        Appointment::create($request->all());
        return redirect()->route('appointments.index')->with('success', 'Прийом додано.');
    }

    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $patients = Patient::all()->pluck('user.name', 'id');
        $doctors = Doctor::all()->pluck('user.name', 'id');
        return view('appointments.edit', compact('appointment', 'patients', 'doctors'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $appointment->update($request->all());
        return redirect()->route('appointments.index')->with('success', 'Прийом оновлено.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Прийом видалено.');
    }
}
