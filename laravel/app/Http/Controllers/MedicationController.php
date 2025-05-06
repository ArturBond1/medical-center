<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $medications = Medication::paginate(10);
        return view('medications.index', compact('medications'));
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('medications.create');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:medications|max:255',
            'dosage' => 'nullable|max:255',
            'description' => 'nullable|max:500',
            'cost' => 'nullable|numeric|min:0',
        ]);

        Medication::create($request->all());

        return redirect()->route('medications.index')->with('success', 'Медикамент успішно додано.');
    }

    /**
     * @param  \App\Models\Medication  $medication
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Medication $medication)
    {
        return view('medications.show', compact('medication'));
    }

    /**
     * @param  \App\Models\Medication  $medication
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Medication $medication)
    {
        return view('medications.edit', compact('medication'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medication  $medication
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Medication $medication)
    {
        $request->validate([
            'name' => 'required|unique:medications,name,' . $medication->id . '|max:255',
            'dosage' => 'nullable|max:255',
            'description' => 'nullable|max:500',
            'cost' => 'nullable|numeric|min:0',
        ]);

        $medication->update($request->all());

        return redirect()->route('medications.index')->with('success', 'Медикамент успішно оновлено.');
    }

    /**
     * @param  \App\Models\Medication  $medication
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Medication $medication)
    {
        if ($medication->prescriptions()->count() > 0) {
            return redirect()->route('medications.index')->with('error', 'Неможливо видалити медикамент, який використовується в рецептах.');
        }

        $medication->delete();

        return redirect()->route('medications.index')->with('success', 'Медикамент успішно видалено.');
    }
}
