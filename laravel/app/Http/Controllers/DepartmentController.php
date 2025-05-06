<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $departments = Department::paginate(10);
        return view('departments.index', compact('departments'));
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:departments|max:255',
            'description' => 'nullable|max:500',
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')->with('success', 'Відділення успішно додано.');
    }

    /**
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    /**
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|unique:departments,name,' . $department->id . '|max:255',
            'description' => 'nullable|max:500',
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')->with('success', 'Відділення успішно оновлено.');
    }

    /**
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Department $department)
    {
        if ($department->doctors()->count() > 0 || $department->staff()->count() > 0) {
            return redirect()->route('departments.index')->with('error', 'Неможливо видалити відділення, яке має лікарів або персонал.');
        }

        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Відділення успішно видалено.');
    }
}
