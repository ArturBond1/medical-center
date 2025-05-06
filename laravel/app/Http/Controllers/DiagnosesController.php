<?php

namespace App\Http\Controllers;

use App\Models\Diagnoses;
use Illuminate\Http\Request;

class DiagnosesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $diagnoses = Diagnoses::paginate(10);
        return view('diagnoses.index', compact('diagnoses'));
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('diagnoses.create');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:diagnoses|max:255',
            'description' => 'nullable|max:500',
        ]);

        Diagnoses::create($request->all());

        return redirect()->route('diagnoses.index')->with('success', 'Діагноз успішно додано.');
    }

    /**
     * @param  \App\Models\Diagnoses  $diagnosis
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Diagnoses $diagnosis)
    {
        return view('diagnoses.show', compact('diagnosis'));
    }

    /**
     * @param  \App\Models\Diagnoses  $diagnosis
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Diagnoses $diagnosis)
    {
        return view('diagnoses.edit', compact('diagnosis'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diagnoses  $diagnosis
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Diagnoses $diagnosis)
    {
        $request->validate([
            'name' => 'required|unique:diagnoses,name,' . $diagnosis->id . '|max:255',
            'description' => 'nullable|max:500',
        ]);

        $diagnosis->update($request->all());

        return redirect()->route('diagnoses.index')->with('success', 'Діагноз успішно оновлено.');
    }

    /**
     * @param  \App\Models\Diagnoses  $diagnosis
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Diagnoses $diagnosis)
    {
        if ($diagnosis->medicalRecords()->count() > 0) {
            return redirect()->route('diagnoses.index')->with('error', 'Неможливо видалити діагноз, який використовується в медичних картках.');
        }

        $diagnosis->delete();

        return redirect()->route('diagnoses.index')->with('success', 'Діагноз успішно видалено.');
    }
}
