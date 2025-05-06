<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $doctors = Doctor::with('user', 'department')->paginate(10);
        return view('doctors.index', compact('doctors'));
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $users = User::whereDoesntHave('doctor')->get()->pluck('name', 'id');
        $departments = Department::all()->pluck('name', 'id'); // Ensure you have this
        return view('doctors.create', compact('users', 'departments'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|unique:doctors',
            'specialization' => 'required|max:255',
            'department_id' => 'required',
        ]);

        Doctor::create($request->all());

        return redirect()->route('doctors.index')->with('success', 'Лікаря успішно додано.');
    }

    /**
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    /**
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Doctor $doctor)
    {
        $users = User::all()->pluck('name', 'id');
        $departments = Department::all()->pluck('name', 'id'); // Ensure you have this
        return view('doctors.edit', compact('doctor', 'users', 'departments'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'user_id' => 'required|unique:doctors,user_id,' . $doctor->id,
            'specialization' => 'required|max:255',
            'department_id' => 'required',
        ]);

        $doctor->update($request->all());

        return redirect()->route('doctors.index')->with('success', 'Лікаря успішно оновлено.');
    }

    /**

     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Doctor $doctor)
    {
          if ($doctor->appointments()->count() > 0 || $doctor->prescriptions()->count() > 0) {
              return redirect()->route('doctors.index')->with('error', 'Неможливо видалити лікаря, який має прийоми або рецепти.');
         }

        $doctor->delete();

        return redirect()->route('doctors.index')->with('success', 'Лікаря успішно видалено.');
    }
}
